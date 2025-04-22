<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>QR Kod Tarayıcı</title>
  <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background-color: #f4f4f9;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    #maintitle {
      font-size: 28px;
      color: #444;
      font-weight: 600;
      margin-bottom: 20px;
      transition: color 0.3s ease;
    }

    #video {
      width: 100%;
      max-width: 500px;
      height: auto;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .green {
      border: 4px solid #4CAF50;
    }

    .red {
      border: 4px solid #f44336;
    }

    button {
      background-color: #007BFF;
      color: white;
      font-size: 16px;
      padding: 12px 30px;
      margin: 15px 0;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #0056b3;
      transform: translateY(-3px);
    }

    button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }

    #photoButton {
      display: none;
    }

    #preview {
      max-width: 100%;
      margin-top: 20px;
      border-radius: 10px;
      display: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #formContainer {
      margin-top: 20px;
      display: none;
      text-align: center;
    }

    #formContainer form button {
      background-color: #28a745;
    }

    #izinMesaji {
      color: #555;
      font-size: 14px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <h2 id="maintitle">QR Kod Tarayıcı</h2>
  <video id="video" class="red" autoplay muted playsinline></video>
  
  <button id="photoButton">Fotoğraf Çek</button>

  <img id="preview" alt="Fotoğraf Önizleme" />

  <div id="formContainer">
    <form id="photoForm">
      <input type="hidden" id="capturedImage" name="capturedImage" />
      <button type="submit">Kaydet ve Gönder</button>
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

    let qrSonGorulmeZamani = 0;
    let qrKodAktif = false;

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
            const suan = Date.now();

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
                qrSonGorulmeZamani = suan;

                if (!qrKodAktif && suan - qrSonGorulmeZamani > 500) {
                  qrKodAktif = true;
                  video.classList.remove("red");
                  video.classList.add("green");
                  photoButton.style.display = "inline-block";
                }
              }
            } else {
              if (qrKodAktif && suan - qrSonGorulmeZamani > 1000) {
                qrKodAktif = false;
                temizle();
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

        function temizle() {
          setDurum("QR Kod Tarayıcı", "#444");
          video.classList.remove("green");
          video.classList.add("red");
          photoButton.style.display = "none";
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
          video.style.display = "none";
          photoButton.style.setProperty('display', 'none', 'important');
        });

        // Tekrar çek
        retryButton.addEventListener("click", () => {
          preview.style.display = "none";
          formContainer.style.display = "none";
          photoButton.style.display = "inline-block";
          video.style.display = "block";
          video.classList.remove("green");
          video.classList.add("red");
          setDurum("QR Kod Tarayıcı", "#444");
        });

        // Form gönderimi (örnek amaçlı)
        document.getElementById("photoForm").addEventListener("submit", function(e) {
          e.preventDefault();
          alert("Fotoğraf başarıyla gönderildi.");
        });

      } catch (hata) {
        console.error("Kamera hatası:", hata);
      }
    }

    kameraAc();
  </script>
</body>
</html>
