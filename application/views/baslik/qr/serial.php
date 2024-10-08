<html>
<head>
    <meta charset="utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
</head>
<body onload="generateQRCodes(230900101, 10);">

    <div id="yazdir3"></div>

    <script>
        function generateQRCodes(startSerial, totalCount) {
            let yazdirDiv = document.getElementById("yazdir3");

            for (let i = 0; i < totalCount; i++) {
                const serialNo = startSerial + i;
                let qrContainer = document.createElement("div");

                qrContainer.innerHTML = `
                    <div class="col-lg-12 text-center" style="text-align:center">
                       <p style="margin-top:-10px;text-align:center;font-weight:500;font-family: system-ui;margin-left: 2px;">
                           <div id="canvas_${serialNo}" style="scale: 0.7;margin-left: 11px;margin-top: 26px;"></div>
                          <b>LAMBA ETİKETİ</b><br>
                            Seri No : <span>${serialNo}</span>
                        </p>
                    </div>
                    <div class="col-lg-12 text-center" style="text-align:center">
                       <p style="margin-top:-10px;text-align:center;font-weight:500;font-family: system-ui;margin-left: 2px;">
                           <div id="canvas_${serialNo}" style="scale: 0.7;margin-left: 11px;margin-top: 26px;"></div>
                           
                        </p>
                    </div>
                `;

                yazdirDiv.appendChild(qrContainer);

                // QR kodunu oluştur
                $('#canvas_' + serialNo).qrcode({
                    text: serialNo.toString(),
                    width: 200,
                    height: 200
                });
            }

            // QR kodları tamamlandıktan sonra yazdır
            setTimeout(() => {
                window.print();
                window.close(); // Yazdırma bittiğinde pencereyi kapat
            }, 1000); // 1 saniye bekleme süresi
        }
    </script>
</body>
</html>
