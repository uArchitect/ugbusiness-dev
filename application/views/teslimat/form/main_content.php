 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 



<h1>Fotoğraf Çekme Formu</h1>
    <form id="photoForm">
        <!-- Teslimat Belge Fotoğrafları -->
        <div class="photo-section">
            <label for="belgePhoto1">TESLİMAT BELGE FOTOĞRAFI 1</label>
            <button type="button" onclick="capturePhoto('belgePhoto1')">Fotoğraf Çek</button>
            <div class="photo-preview" id="previewBelgePhoto1"></div>
        </div>
        <div class="photo-section">
            <label for="belgePhoto2">TESLİMAT BELGE FOTOĞRAFI 2</label>
            <button type="button" onclick="capturePhoto('belgePhoto2')">Fotoğraf Çek</button>
            <div class="photo-preview" id="previewBelgePhoto2"></div>
        </div>

        <!-- Teslimat Ürün Fotoğrafı -->
        <div class="photo-section">
            <label for="urunPhoto">TESLİMAT ÜRÜN FOTOĞRAFI</label>
            <button type="button" onclick="capturePhoto('urunPhoto')">Fotoğraf Çek</button>
            <div class="photo-preview" id="previewUrunPhoto"></div>
        </div>

        <button type="submit">Gönder</button>
    </form>

    <script>
        function capturePhoto(id) {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.capture = 'environment'; // Sadece kamera ile fotoğraf çekme
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
    </script>


            </div>