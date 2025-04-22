<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    #qrScanner { /* Kapsayıcı div */
      font-family: 'Inter', sans-serif;
      background-color: #f7f9fc;
      color: #222;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }
    #qrScanner h2 {
      margin: 20px 0;
      font-size: 24px;
      color: #444;
    }
    #qrScanner #video {
      width: 100%;
      max-width: 480px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      border: 6px solid transparent;
      transition: border-color 0.3s ease;
    }
    #qrScanner .green {
      border-color: #4CAF50 !important;
    }
    #qrScanner .red {
      border-color: #f44336 !important;
    }
    #qrScanner button {
      padding: 12px 24px;
      font-size: 16px;
      background-color: #0057ff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin: 15px 10px 0;
      transition: background-color 0.3s ease;
    }
    #qrScanner button:hover {
      background-color: #0041cc;
    }
    #qrScanner #photoButton {
      display: none;
    }
    #qrScanner #preview {
      margin-top: 20px;
      max-width: 100%;
      border-radius: 8px;
      display: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    #qrScanner #formContainer {
      display: none;
      margin-top: 20px;
    }
    #qrScanner #formContainer button {
      background-color: #28a745;
    }
    #qrScanner #formContainer button#retryButton {
      background-color: #dc3545;
    }
  </style>


<div class="btn-group">
                        <button type="button" class="btn btn-default text-bold" style="font-size:9px!important">Cihaz F.1</button>
                        <button type="button" class="btn btn-default text-bold" style="font-size:9px!important">Cihaz F.2</button>
                        <button type="button" class="btn btn-default text-bold" style="font-size:9px!important">Sözleşme 1</button>
                        <button type="button" class="btn btn-default text-bold" style="font-size:9px!important">Sözleşme 2</button>
                        <button type="button" class="btn btn-default text-bold" style="font-size:9px!important">Teslim T.</button>
                      </div>
<div id="qrScanner">
    <h2 id="maintitle">QR Kod Tarayıcı</h2>
    <video id="video" class="red" autoplay muted playsinline></video>

    <button id="photoButton">📸 Fotoğraf Çek</button>

    <img id="preview" alt="Önizleme" />

    <div id="formContainer">
      <form id="photoForm">
        <input type="hidden" id="capturedImage" name="capturedImage" />
        <button type="submit">Kaydet & Gönder</button>
        <button type="button" id="retryButton">Tekrar Çek</button>
      </form>
    </div>
  </div>

  <script>
    const video = document.getElementById("video");
    const photoButton = document.getElementById("photoButton");
    const preview = document.getElementById("preview");
    const capturedImageInput = document.getElementById("capturedImage");
    const formContainer = document.getElementById("formContainer");
    const retryButton = document.getElementById("retryButton");
    const title = document.getElementById("maintitle");

    async function kameraAc() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: { facingMode: "environment" }
        });
        video.srcObject = stream;

        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");

        let lastScanTime = 0;

        function qrTara() {
          const currentTime = Date.now();
          if (currentTime - lastScanTime > 1000) {
            if (video.readyState === video.HAVE_ENOUGH_DATA && video.style.display !== "none") {
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
                  if (video.style.display !== "none") {
                    photoButton.style.display = "inline-block";
                  }
                } else {
                  setDurum("BELGE TANINMADI", "red");
                  video.classList.remove("green");
                  video.classList.add("red");
                  photoButton.style.display = "none";
                }
              } else {
                setDurum("BELGE TANINMADI", "red");
                video.classList.remove("green");
                video.classList.add("red");
                photoButton.style.display = "none";
              }
            }

            lastScanTime = currentTime;
          }

          requestAnimationFrame(qrTara);
        }

        qrTara();

        function setDurum(text, color) {
          title.textContent = text;
          title.style.color = color;
        }

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
          photoButton.style.display = "none";
        });

        retryButton.addEventListener("click", () => {
          preview.style.display = "none";
          formContainer.style.display = "none";
          photoButton.style.display = "inline-block";
          video.style.display = "block";
          video.classList.remove("green");
          video.classList.add("red");
          setDurum("QR Kod Tarayıcı", "#444");
        });

        document.getElementById("photoForm").addEventListener("submit", function (e) {
          e.preventDefault();
          alert("Fotoğraf başarıyla gönderildi.");
        });

      } catch (err) {
        console.error("Kamera hatası:", err);
      }
    }

    kameraAc();
  </script>