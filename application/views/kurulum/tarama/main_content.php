<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QR Kod Tarayıcı</title>
  <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      text-align: center;
    }
    #video {
      width: 100%;
      height: auto;
      border: 10px solid transparent;
      box-sizing: border-box;
    }
    .green {
      border-color: green;
    }
    .red {
      border-color: red;
    }
    #izinMesaji {
      margin-top: 20px;
      color: #555;
    }
  </style>
</head>
<body>
  <h2>Belgedeki QR Kodunu Tara</h2>
  <video id="video" class="red" autoplay muted playsinline></video>
  <div id="izinMesaji">Kamera izni isteniyor...</div>

  <script>
    const video = document.getElementById("video");
    const izinMesaji = document.getElementById("izinMesaji");

    async function kameraAc() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: { facingMode: "environment" }
        });

        video.srcObject = stream;
        izinMesaji.textContent = "Kamera açıldı, QR kodu taratın.";

        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");

        function qrTara() {
          if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const kod = jsQR(imageData.data, canvas.width, canvas.height);

            if (kod) {
              if (kod.data === "ABC123") {
                video.classList.remove("red");
                video.classList.add("green");
              } else {
                video.classList.remove("green");
                video.classList.add("red");
              }
            }
          }
          requestAnimationFrame(qrTara);
        }

        qrTara();

      } catch (hata) {
        izinMesaji.textContent = "Kamera izni verilmedi veya bir hata oluştu.";
        console.error("Kamera hatası:", hata);
      }
    }

    kameraAc();
  </script>
</body>
</html>
