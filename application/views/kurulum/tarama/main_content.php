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
      border: 10px solid green!important;
    }
    .red {
        border: 10px solid red!important;
    }
    #izinMesaji {
      margin-top: 20px;
      color: #555;
    }
    #photoButton {
      margin-top: 20px;
      display: none;
    }
  </style>
</head>
<body>
  <h2 id="maintitle">Belgedeki QR Kodunu Tara</h2>
  <video id="video" class="red" autoplay muted playsinline></video>
  <div id="izinMesaji">Kamera izni isteniyor...</div>

  <!-- Fotoğraf çekme butonu -->
  <button id="photoButton" onclick="document.getElementById('fileInput').click()">Fotoğraf Çek</button>
  <input type="file" id="fileInput" style="display:none" accept="image/*" onchange="handleFileChange(event)" />

  <script>
    const video = document.getElementById("video");
    const izinMesaji = document.getElementById("izinMesaji");
    const photoButton = document.getElementById("photoButton");

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
              if (kod.data === "TT") {
                document.getElementById("maintitle").innerHTML = "TESLİM TUTANAĞI";
                document.getElementById("maintitle").style.color = "orange";
                video.classList.remove("red");
                video.classList.add("green");
                photoButton.style.display = "inline-block"; // Fotoğraf butonunu göster
              } else if (kod.data === "S1") {
                document.getElementById("maintitle").innerHTML = "SÖZLEŞME 1. SAYFA";
                document.getElementById("maintitle").style.color = "blue";
                video.classList.remove("red");
                video.classList.add("green");
                photoButton.style.display = "inline-block"; // Fotoğraf butonunu göster
              } else if (kod.data === "S2") {
                document.getElementById("maintitle").innerHTML = "SÖZLEŞME 2. SAYFA";
                document.getElementById("maintitle").style.color = "green";
                video.classList.remove("red");
                video.classList.add("green");
                photoButton.style.display = "inline-block"; // Fotoğraf butonunu göster
              } else {
                alert("BELGE TANINMADI");
                document.getElementById("maintitle").innerHTML = "BELGE TANINMADI";
                document.getElementById("maintitle").style.color = "red";
                video.classList.remove("green");
                video.classList.add("red");
                photoButton.style.display = "none"; // Fotoğraf butonunu gizle
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

    function handleFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        alert(`Fotoğraf yüklendi: ${file.name}`);
      }
    }

    kameraAc();
  </script>
</body>
</html>
