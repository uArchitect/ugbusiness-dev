<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>QR Kod Tarayıcı</title>
  <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
  <style>
    :root {
      --primary: #4f46e5;
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;
      --gray: #6b7280;
      --light: #f3f4f6;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9fafb;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    h1 {
      color: var(--primary);
      font-size: 28px;
      margin-bottom: 10px;
    }

    #video {
      width: 100%;
      max-width: 600px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      border: 6px solid var(--danger);
      transition: border 0.3s ease;
    }

    .green-border {
      border-color: var(--success) !important;
    }

    .red-border {
      border-color: var(--danger) !important;
    }

    .status {
      margin-top: 15px;
      font-size: 18px;
      color: var(--gray);
    }

    .button {
      margin-top: 20px;
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      background-color: var(--primary);
      color: white;
      cursor: pointer;
      transition: background 0.3s;
    }

    .button:hover {
      background-color: #4338ca;
    }

    #preview {
      margin-top: 20px;
      max-width: 100%;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      display: none;
    }

    #formContainer {
      margin-top: 20px;
      display: none;
    }

    #formContainer button {
      margin-right: 10px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    form button {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <h1 id="maintitle">QR Kod Tarayıcı</h1>
  <video id="video" class="red-border" autoplay muted playsinline></video>
  <div class="status" id="statusText">Kamera başlatılıyor...</div>

  <button id="photoButton" class="button" style="display:none;">📷 Fotoğraf Çek</button>
  <img id="preview" />

  <div id="formContainer">
    <form id="photoForm">
      <input type="hidden" id="capturedImage" name="capturedImage" />
      <button type="submit" class="button" style="background: var(--success);">✅ Kaydet & Gönder</button>
      <button type="button" id="retryButton" class="button" style="background: var(--danger);">🔄 Tekrar Çek</button>
    </form>
  </div>

  <script>
    const video = document.getElementById("video");
    const photoButton = document.getElementById("photoButton");
    const preview = document.getElementById("preview");
    const capturedImageInput = document.getElementById("capturedImage");
    const formContainer = document.getElementById("formContainer");
    const retryButton = document.getElementById("retryButton");
    const statusText = document.getElementById("statusText");
    const mainTitle = document.getElementById("maintitle");

    async function kameraAc() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } });
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
              let title = "-";
              let color = "--danger";
              let showButton = false;

              switch (kod.data) {
                case "TT":
                  title = "TESLİM TUTANAĞI";
                  color = "--warning";
                  showButton = true;
                  break;
                case "S1":
                  title = "SÖZLEŞME 1. SAYFA";
                  color = "--primary";
                  showButton = true;
                  break;
                case "S2":
                  title = "SÖZLEŞME 2. SAYFA";
                  color = "--success";
                  showButton = true;
                  break;
                default:
                  title = "BELGE TANINMADI";
              }

              statusText.textContent = title;
              mainTitle.textContent = "QR Kod Tespit Edildi";
              video.className = showButton ? "green-border" : "red-border";
              photoButton.style.display = showButton ? "inline-block" : "none";
            }
          }

          requestAnimationFrame(qrTara);
        }

        qrTara();

        photoButton.addEventListener("click", () => {
          const canvas = document.createElement("canvas");
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          canvas.getContext("2d").drawImage(video, 0, 0);
          const dataUrl = canvas.toDataURL("image/png");
          preview.src = dataUrl;
          preview.style.display = "block";
          capturedImageInput.value = dataUrl;
          formContainer.style.display = "block";
          video.style.display = "none";
          photoButton.style.display = "none";
        });

        retryButton.addEventListener("click", () => {
          preview.style.display = "none";
          formContainer.style.display = "none";
          photoButton.style.display = "inline-block";
          video.style.display = "block";
          video.className = "red-border";
          mainTitle.textContent = "QR Kod Tarayıcı";
          statusText.textContent = "Yeniden taranıyor...";
        });

        document.getElementById("photoForm").addEventListener("submit", function(e) {
          e.preventDefault();
          alert("Fotoğraf başarıyla gönderildi!");
        });

      } catch (error) {
        statusText.textContent = "Kamera erişimi reddedildi.";
        console.error("Kamera hatası:", error);
      }
    }

    kameraAc();
  </script>
</body>
</html>
