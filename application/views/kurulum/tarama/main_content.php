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
   padding-left:4px;
   padding-right:4px;
    }
    #qrScanner h2 {
      margin: 20px 0;
      font-size: 24px;
      color: #444;
    }
    #qrScanner #video {
      width: 100%;
      max-width: 480px; 
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      border: 4px solid transparent;
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
    .mnav{
      display:none!important;
    }
  </style>

<div class="btn-group d-flex" style="  gap:4px;  margin: 4px">
      <button type="button" class="btn btn-primary text-bold" style="    width: 100%;">
        UG01020302UX01 
      </button> 
    </div>
    <div class="btn-group d-flex" style="  gap:4px;  margin: 4px">
      <button type="button" class="btn btn-default text-bold" style="    width: 33.33%;">
        Cihaz Görsel 1
        <br>
        <span style="font-weight:300">Yüklenmedi</span>
      </button>
      <button type="button" class="btn btn-default text-bold" style="    width: 33.33%;">
        Cihaz Görsel 2
        <br>
        <span style="font-weight:300">Yüklenmedi</span>
      </button>
      <button type="button" class="btn btn-default text-bold" style="    width: 33.33%;">
        Cihaz Görsel 3
        <br>
        <span style="font-weight:300">Yüklenmedi</span>
      </button> 
    </div>
    <div class="btn-group d-flex" style="   gap:4px;   margin: 4px"> 
      <button type="button" class="btn btn-default text-bold" style="    width: 33.33%;">
        Sözleşme 1
        <br>
        <span style="font-weight:300">Yüklenmedi</span>
      </button>
      <button type="button" class="btn btn-default text-bold" style="    width: 33.33%;">
        Sözleşme 2
        <br>
        <span style="font-weight:300">Yüklenmedi</span>
      </button>
      <button type="button" class="btn btn-default text-bold" style="    width: 33.33%;">
        Teslim T.
        <br>
        <span style="font-weight:300">Yüklenmedi</span>
      </button>
    </div>
    




    <div class="btn-group d-flex" style="  gap:4px;  margin: 4px">
      <button type="button" id="maintitle" class="btn btn-dark text-bold" style="    width: 100%;">
        - 
      </button> 
    </div>

<div id="qrScanner">
 
    <video id="video" class="red" autoplay muted playsinline></video>

    <button id="photoButton" style="
    position: fixed;
    bottom: 20px; 
    z-index: 9999;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    cursor: pointer;
        width: -webkit-fill-available;
">
    📸 Fotoğraf Çek
</button>


    <img id="preview" alt="Önizleme" />

    <div id="formContainer" style=" position: fixed;
    bottom: 20px; 
    z-index: 9999;
    padding: 10px 20px;
    font-size: 16px; 
    color: white;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    cursor: pointer;
        width: -webkit-fill-available;">
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
                  setDurum("TESLİM TUTANAĞI", "green");
                  bulundu = true;
                } else if (kod.data === "S1") {
                  setDurum("SÖZLEŞME 1. SAYFA", "green");
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
                  setDurum("BELGE ALGILANMADI", "red");
                  video.classList.remove("green");
                  video.classList.add("red");
                  photoButton.style.display = "none";
                }
              } else {
                setDurum("BELGE ALGILANMADI", "red");
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
          title.style.background = color;
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
          setDurum("Belge Tarama", "#444");
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