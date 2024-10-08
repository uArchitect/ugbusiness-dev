<html>
<head>
    <meta charset="utf-8">
</head>
<body onload="generateQRCodes(230900101, 3);">

    <div id="yazdir3"></div>

    <script src="<?=base_url('assets/dist/js/qr.js')?>"></script>
    <script>
        function generateQRCodes(startSerial, totalCount) {
            let yazdirDiv = document.getElementById("yazdir3");

            for (let i = 0; i < totalCount; i++) {
                const serialNo = startSerial + i;
                let qrContainer = document.createElement("div");

                qrContainer.innerHTML = `
                    <div class="col-lg-12 text-center" style="text-align:center">
                        <div id="canvas5_${serialNo}" style="scale: 0.7;margin-left: 11px;margin-top: 26px;"></div>
                        <p style="margin-top:-10px;text-align:center;font-weight:500;font-family: system-ui;margin-left: 2px;">
                            <b>LAMBA ETİKETİ</b><br>
                            Seri No : <span>${serialNo}</span>
                        </p>
                        <div id="canvas6_${serialNo}" style="scale: 0.7;margin-left: 12px;margin-top: 20px;"></div>
                    </div>
                `;

                yazdirDiv.appendChild(qrContainer);

                // QR kodlarını oluştur
                const qrCode5 = new QRCodeStyling({
                    width: 200,
                    height: 200, 
                    data: serialNo.toString(),
                    dotsOptions: {
            color: "#000",
            type: "square"
        },
        backgroundOptions: {
            color: "#fff",
        },
        imageOptions: {
            crossOrigin: "anonymous"
        }
                });
                const qrCode6 = new QRCodeStyling({
                    width: 200,
                    height: 200, 
                    data: serialNo.toString(),
                    dotsOptions: {
            color: "#000",
            type: "square"
        },
        backgroundOptions: {
            color: "#fff",
        },
        imageOptions: {
            crossOrigin: "anonymous"
        }
                });

                qrCode5.append(document.getElementById(`canvas5_${serialNo}`));
                qrCode6.append(document.getElementById(`canvas6_${serialNo}`));
            }

            // QR kodları tamamlandıktan sonra yazdır
            setTimeout(function () {
                window.print();
                window.close(); // Yazdırma bittiğinde pencereyi kapat
            }, 1000); // 1 saniye bekleme süresi
        }
    </script>
</body>
</html>
