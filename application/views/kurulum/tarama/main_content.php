<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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
      border: 10px solid green !important;
    }
    .red {
      border: 10px solid red !important;
    }
    #izinMesaji {
      margin-top: 20px;
      color: #555;
    }
    #photoButton {
      margin-top: 20px;
      display: none;
    }
    #preview {
      margin-top: 20px;
      max-width: 100%;
    }
  </style>
</head>
<body>
  <h2 id="maintitle">Belgedeki QR Kodunu Tara</h2>
  <video id="video" class="red" autoplay muted playsinline></video>
  <div id="izinMesaji">Kamera izni isteniyor...</div>

  <!-- Fotoğraf çekme butonu -->
  <button id="photoButton">Fotoğraf Çek</button>

  <!-- Fotoğraf önizleme -->
  <img id="preview" style="display:none;" />

  <!-- Base64 veriyi taşıyacak gizli input -->
  <input type="hidden" id="capturedImage" name="capturedImage" />

  <script>
    const video = document.getElementById("video");
    const izinMesaji = document.getElementById("izinMesaji");
    const photoButton = document.getElementById("photoButton");
    const preview = document.getElementById("preview");
    const capturedImageInput = document.getElementById("capturedImage");

    async function kameraAc() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: {  facingMode: "environment",
  focusMode: "continuous", // bazı tarayıcılarda çalışabilir
  width: { ideal: 1280 },
  height: { ideal: 720 }},
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
              let bulundu = false;
              if (kod.data === "TT") {
                setDurum("TESLİM TUTANAĞI", "orange");
                bulundu = true;
              } else if (kod.data === "S1") {
                setDurum("SÖZLEŞME 1. SAYFA", "blue");
                bulundu = true;
              } else if (kod.data === "S2") {
                setDurum("SÖZLEŞME 2. SAYFA", "green");
                bulundu = true;
              }

              if (bulundu) {
                video.classList.remove("red");
                video.classList.add("green");
                photoButton.style.display = "inline-block";
              } else {
                setDurum("BELGE TANINMADI", "red");
                video.classList.remove("green");
                video.classList.add("red");
                photoButton.style.display = "none";
              }
            }
          }
          requestAnimationFrame(qrTara);
        }

        qrTara();

        function setDurum(text, color) {
          const title = document.getElementById("maintitle");
          title.innerHTML = text;
          title.style.color = color;
        }

        // Fotoğraf çekme işlemi
        photoButton.addEventListener("click", () => {
          const canvas = document.createElement("canvas");
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          const ctx = canvas.getContext("2d");
          ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
          const dataUrl = canvas.toDataURL("image/png");

          // Önizleme ve inputa aktar
          preview.src = dataUrl;
          preview.style.display = "block";
          capturedImageInput.value = dataUrl;
        });

      } catch (hata) {
        izinMesaji.textContent = "Kamera izni verilmedi veya bir hata oluştu.";
        console.error("Kamera hatası:", hata);
      }
    }

    kameraAc();
  </script>
</body>
</html>
