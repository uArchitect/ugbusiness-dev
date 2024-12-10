<style>
    
    .content-wrapper {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #343a40;
        margin-bottom: 20px;
    }
    .photo-section {
        margin-bottom: 30px;
    }
    .photo-section label {
        display: block;
        font-weight: bold;
        color: #495057;
        margin-bottom: 8px;
    }
    .photo-preview {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        justify-content: center;
    }
    img {
        max-width: 120px;
        max-height: 120px;
        object-fit: cover;
        border: 2px solid #007BFF;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    img:hover {
        transform: scale(1.1);
    }
    button {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        background: linear-gradient(135deg, #007BFF, #0056b3);
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.3s ease;
    }
    button:hover {
        background: linear-gradient(135deg, #0056b3, #007BFF);
        transform: scale(1.05);
    }
    #errorMessage {
        color: #dc3545;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
    }
    button[type="submit"] {
        width: 100%;
        margin-top: 20px;
        padding: 12px 0;
        font-size: 16px;
        background-color: #28a745;
        background: linear-gradient(135deg, #28a745, #218838);
    }
    button[type="submit"]:hover {
        background: linear-gradient(135deg, #218838, #28a745);
    }
</style>

<div class="content-wrapper"> 
    <h1>Teslimat Kontrol</h1>
    <form id="photoForm">
        <!-- Teslimat Belge Fotoğrafları -->
        <div class="photo-section text-center">
            <label for="belgePhoto1">Teslimat Belge Fotoğrafı 1</label>
            <button type="button" onclick="capturePhoto('belgePhoto1')">Fotoğraf Çek</button>
            <div class="photo-preview" id="previewBelgePhoto1"></div>
        </div>
        <div class="photo-section text-center">
            <label for="belgePhoto2">Teslimat Belge Fotoğrafı 2</label>
            <button type="button" onclick="capturePhoto('belgePhoto2')">Fotoğraf Çek</button>
            <div class="photo-preview" id="previewBelgePhoto2"></div>
        </div>

        <!-- Teslimat Ürün Fotoğrafı -->
        <div class="photo-section text-center">
            <label for="urunPhoto">Teslimat Ürün Fotoğrafı</label>
            <button type="button" onclick="capturePhoto('urunPhoto')">Fotoğraf Çek</button>
            <div class="photo-preview" id="previewUrunPhoto"></div>
        </div>

        <div id="errorMessage"></div>
        <button type="submit">Gönder</button>
    </form>
</div>

<script>
    function capturePhoto(id) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.capture = 'environment';
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    document.getElementById(`preview${id.charAt(0).toUpperCase() + id.slice(1)}`).innerHTML = '';
                    document.getElementById(`preview${id.charAt(0).toUpperCase() + id.slice(1)}`).appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
        input.click();
    }

    document.getElementById('photoForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const previews = ['previewBelgePhoto1', 'previewBelgePhoto2', 'previewUrunPhoto'];
        let allPhotosProvided = true;

        previews.forEach(id => {
            const previewDiv = document.getElementById(id);
            if (!previewDiv.querySelector('img')) {
                allPhotosProvided = false;
            }
        });

        const errorMessage = document.getElementById('errorMessage');
        if (!allPhotosProvided) {
            errorMessage.textContent = 'Lütfen tüm fotoğrafları yükleyin.';
        } else {
            errorMessage.textContent = '';
            alert('Form başarıyla gönderildi!');
        }
    });
</script>