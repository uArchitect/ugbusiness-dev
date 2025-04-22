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
      display: none;
    }
    #formContainer {
      display: none;
      margin-top: 20px;
    }
    button {
      margin: 10px;
      padding: 10px 20px;
      font-size: 16px;
    }
  </style>
</head>
<body>
  <h2 id="maintitle"></h2>
  <video id="video" class="red" autoplay muted playsinline></video>
  
  <!-- Fotoğraf çekme butonu -->
  <button id="photoButton">Fotoğraf Çek</button>

  <!-- Fotoğraf önizleme ve form -->
  <img id="preview" />

  <div id="formContainer">
    <form id="photoForm">
      <input type="hidden" id="capturedImage" name="capturedImage" />
      <button type="submit">Kaydet Gönder</button>
      <button type="button" id="retryButton">Tekrar Çek</button>
    </form>
  </div>

  <script>
    const video = document.getElementById("video");
   
    const photoButton = document.getElementById("photoButton");
    const preview = document.getElementById("preview");
    const capturedImageInput = document.getElementById("capturedImage");
    const formContainer = document.getElementById("formContainer");
    const retryButton = document.getElementById("retryButton");

    async function kameraAc() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: { facingMode: "environment", focusMode: "continuous" },
        });

        video.srcObject = stream;
    

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

        // Fotoğraf çekme
        photoButton.addEventListener("click", () => {
          const canvas = document.createElement("canvas");
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          const ctx = canvas.getContext("2d");
          ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
          const dataUrl = canvas.toDataURL("image/png");

          preview.src = dataUrl;
          preview.style.display = "block";
          capturedImageInput.value = dataUrl;
          formContainer.style.display = "block";
          photoButton.style.display = "none";
          video.style.display = "none";
        });

        // Tekrar çek
        retryButton.addEventListener("click", () => {
          preview.style.display = "none";
          formContainer.style.display = "none";
          photoButton.style.display = "inline-block";
          video.style.display = "block";
        });

        // Form gönderimi (örnek amaçlı)
        document.getElementById("photoForm").addEventListener("submit", function(e) {
          e.preventDefault();
          alert("Fotoğraf başarıyla gönderildi.");
          // Buraya fetch/post işlemleri eklenebilir
        });

      } catch (hata) {
  
        console.error("Kamera hatası:", hata);
      }
    }

    kameraAc();
  </script>
</body>
</html>
