<?php 
// DOSYA YOLU: /proje_klasörü/kod_analizi.php
require_once 'session_check.php'; 
require_once 'header.php';
?>

<section class="content-section">
    <h2>Entegrasyonun Anatomisi: Kritik Kod Analizi </h2>
    <p style="font-size: 1.1em; border-left: 4px solid var(--primary-accent); padding-left: 15px; margin-bottom: 30px;">
        Projenin teknik derinliği, MethodChannel çağrılarının Dart, Kotlin ve Swift dillerinde nasıl ele alındığına bağlıdır. Burada sunulan kodlar, hem tekil çağrıyı (MethodChannel) hem de sürekli veri akışını (EventChannel) yöneten gelişmiş servis mantığını kanıtlamaktadır.
    </p>

    <h3 style="margin-top: 40px; color: var(--bg-dark-header);">1. İstemci: Dart - İleri Düzey Hata ve Tip Yönetimi</h3>
    <div class="feature-grid" style="grid-template-columns: 1fr;">
        <div class="feature-box" style="background-color: #f0f4c3;">
            <h4 style="color: #689f38;">Mühendislik Kararı: Tip Güvenliği ve Zaman Aşımı</h4>
            <p>Sadece `PlatformException`'ı yakalamak yetmez. Native taraftan gelen verinin tipini kontrol etmek ve ağ/işlem yavaşlamalarında `TimeoutException` fırlatmak, uygulamanın kararlılığını artırır.</p>
            <div class="code-block" style="background-color: #272727; color: #f8f8f2;">
                <pre>// Dart Kodu: lib/services/battery_service.dart (Kritik Kesit)
static Future<int?> getBatteryLevel({Duration timeout = const Duration(seconds: 5)}) async {
    try {
        final dynamic result = await _methodChannel.invokeMethod('getBatteryLevel').timeout(timeout); // Zaman Aşımı Kontrolü
        
        if (result == null) return null;
        
        // Tip Güvenliği: Native'den gelen dinamik tipin kontrolü
        if (result is int) return result;
        if (result is double) return result.toInt(); 

    } on PlatformException catch (e) {
        [cite_start]// Native taraftan gelen hatalar loglanır [cite: 114]
        print('PlatformException: ${e.code} - ${e.message}');
        return null; 
    } on MissingPluginException catch (e) {
        [cite_start]// Implementasyon eksik 
        return null;
    } on TimeoutException catch (e) {
        print('Timeout: ${e.message}'); // Zaman aşımı durumunda loglama
        return null;
    } catch (e, st) {
        // Bilinmeyen hatalar
        return null;
    }
}
</pre>
            </div>
        </div>
    </div>

    <h3 style="margin-top: 40px; color: var(--bg-dark-header);">2. Sunucu: Android Host (Kotlin) - Geriye Uyumlu Optimizasyon</h3>
    <p>Android host kodu, hem **MethodChannel** hem de **EventChannel**'ı kurar. `getBatteryLevel` metodu, farklı Android sürümleri için geriye dönük uyumluluk sağlayarak **Android cihaz çeşitliliği** zorluğunu yönetir.</p>

    <div class="feature-grid" style="grid-template-columns: 1fr;">
        <div class="feature-box" style="background-color: #e3f2fd;">
            <h4 style="color: #1a237e;">Teknik Çözüm: BatteryManager ve BroadcastReceiver Kullanımı</h4>
            <p>Kod, **API 21 (Lollipop) öncesi ve sonrası** için en doğru API'yi seçer. EventChannel için `BroadcastReceiver` kullanarak pil seviyesi değiştiğinde (ACTION\_BATTERY\_CHANGED) anlık bildirim sağlar.</p>
            
            <div class="code-block" style="background-color: #272727; color: #f8f8f2;">
                <pre>// Kotlin Kodu: MainActivity.kt (Kritik Entegrasyon Bölümü)
// MethodChannel kurulumu (Tekil çağrı)
MethodChannel(...).setMethodCallHandler { call, result ->
    when (call.method) {
       "getBatteryLevel" -> {
           val level = getBatteryLevel() // Geriye uyumlu metod çağrısı
           if (level != -1) { result.success(level) } else { result.error("UNAVAILABLE", "Battery level not available.", null) }
       }
       else -> result.notImplemented()
    }
}

// EventChannel kurulumu (Sürekli Akış Yönetimi)
EventChannel(...).setStreamHandler(object : EventChannel.StreamHandler {
    override fun onListen(arguments: Any?, events: EventChannel.EventSink?) {
        // BroadcastReceiver kurulur, kaydedilir ve sürekli dinlenir.
        registerReceiver(batteryReceiver, IntentFilter(Intent.ACTION_BATTERY_CHANGED))
        events?.success(getBatteryLevel()) // Başlangıç değeri gönderilir
    }
    
    override fun onCancel(arguments: Any?) {
        // Kaynak yönetimi: Receiver kaydı silinir.
        batteryReceiver?.let { unregisterReceiver(it) }
    }
})
</pre>
            </div>
        </div>
    </div>

    <h3 style="margin-top: 40px; color: var(--bg-dark-header);">3. Sunucu: iOS Host (Swift) - NotificationCenter Entegrasyonu</h3>
    <p>iOS'ta pil seviyesi izlemesi, **EventChannel** için `NotificationCenter` kullanılarak anlık olarak dinlenir.Bu, iOS sisteminin pil değişikliklerini yakalayıp Dart'a (Stream) göndermeyi sağlar. Pil seviyesi erişimi mümkündür ancak "monitoring" modunun açılması gerekir.</p>

    <div class="feature-grid" style="grid-template-columns: 1fr;">
        <div class="feature-box" style="background-color: #fff8e1;">
            <h4 style="color: #ff6f00;">Mühendislik Çözümü: Lifecycle Yönetimi ve Gözlemci (Observer) Kullanımı</h4>
            <div class="code-block" style="background-color: #272727; color: #f8f8f2;">
                <pre>// Swift Kodu: AppDelegate.swift ve FlutterStreamHandler Extension
// MethodChannel kurulumu (Tekil çağrı)
methodChannel.setMethodCallHandler { (call: FlutterMethodCall, result: @escaping FlutterResult) in
    if call.method == "getBatteryLevel" {
        self.handleGetBatteryLevel(result: result) // handleGetBatteryLevel metodu çağrılır
    }
    // ...
}

// onListen (FlutterStreamHandler):
func onListen(withArguments arguments: Any?, eventSink events: @escaping FlutterEventSink) -> FlutterError? {
    UIDevice.current.isBatteryMonitoringEnabled = true // İzleme etkinleştirilir
    // NotificationCenter ile pil seviyesi değişiklikleri dinlenir
    NotificationCenter.default.addObserver(self, selector: #selector(batteryLevelDidChange), name: UIDevice.batteryLevelDidChangeNotification, object: nil)
    events(Int(level * 100)) // Başlangıç değeri gönderilir
    return nil
}

// onCancel: Gözlemci kaldırılır (Bellek sızıntısını önler) 
func onCancel(withArguments arguments: Any?) -> FlutterError? {
    NotificationCenter.default.removeObserver(self, name: UIDevice.batteryLevelDidChangeNotification, object: nil)
    return nil
}
</pre>
            </div>
        </div>
    </div>

    <h3 style="margin-top: 40px; color: var(--bg-dark-header);">4. Kod Kalitesi ve Mimari Prensipler</h3>
    <p>Kod Kalitesi  kriterini karşılamak için yazılım mühendisliği prensipleri uygulanmıştır:</p>
    <ul>
        <li>**SRP (Single Responsibility Principle):** Flutter servis sınıfları tek iş yapar; Kotlin/Swift kodları yalnızca sensör verisi alır.</li>
        <li>**Lifecycle Yönetimi:** EventChannel'daki `onListen` ve `onCancel` metotları, gereksiz kaynak kullanımını engeller.</li>
        <li>**DRY (Don’t Repeat Yourself):** Kanal isimleri tek yerde tanımlanmıştır.</li>
        <li>**Maintainability:** Kod, plugin haline getirilmeye uygundur.</li>
    </ul>

</section>

<?php 
require_once 'footer.php';
?>