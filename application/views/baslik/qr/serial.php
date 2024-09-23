<html>
<head>
    <meta charset="utf-8">
</head>
<body onload="generateQRCodes(100000, 100);">

    <div id="yazdir3">
        <div class="col-lg-12 text-center" style="text-align:center">
            <div id="canvas5" style="scale: 1; margin-left: 11px; margin-top: 26px;"></div>
            <p id="cp3" style="margin-top:-10px;text-align:center;font-weight:500;font-family: system-ui;margin-left: 2px;">
                <b>Garanti Etiketi-Sökülemez!!</b><br>
                Seri No : <span id="seriNo"></span>
            </p>
        </div>
    </div>

    <script src="<?=base_url('assets/dist/js/qr.js')?>"></script>
    <script>
        let currentSerial = 0; // Global değişken seri numarayı takip etmek için
        let qrIndex = 0; // Kaçıncı QR kodda olduğumuzu tutar
        let totalQRCodes = 0; // Toplam kaç tane QR kod üretileceğini tutar

        function generateQRCodes(startSerial, totalCount) {
            currentSerial = startSerial; // Başlangıç seri numarası
            totalQRCodes = totalCount; // Yazdırılacak QR kod sayısı
            printNextQRCode(); // İlk QR kodunu başlat
        }

        function printNextQRCode() {
            if (qrIndex < totalQRCodes) {
                qr3(currentSerial + qrIndex); // QR kodu yazdır
                qrIndex++; // Bir sonrakine geç
            }
        }

        function qr3(id) {
            document.getElementById("canvas5").innerHTML = "";
            document.getElementById("seriNo").innerText = id;

            // Görüntüsüz sade QR kod oluştur
            const qrCode = new QRCodeStyling({
                width: 300,  // Daha büyük QR kod
                height: 300, // Daha büyük QR kod
                type: "svg",
                data: id.toString(), // Seri numarasını string olarak gönder
                backgroundOptions: {
                    color: "#ffffff", // Beyaz arka plan
                },
                dotsOptions: {
                    color: "#000000", // Siyah QR kod noktaları
                    type: "rounded"  // Noktalar yuvarlatılmış olabilir (isteğe bağlı)
                },
                imageOptions: {
                    margin: 5, // Görüntü marjı
                }
            });

            qrCode.append(document.getElementById("canvas5"));

            setTimeout(function () {
                window.print();
                setTimeout(function () {
                    if (qrIndex < totalQRCodes) {
                        printNextQRCode(); // Bir sonrakine geç
                    } else {
                        window.close(); // Sonuncuyu yazdırdıktan sonra pencereyi kapat
                    }
                }, 1000); // 1 saniye bekle
            }, 500);
        }
    </script>
</body>
</html>
