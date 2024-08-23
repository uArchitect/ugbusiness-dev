<div class="info-box " onclick="location.href='http://192.168.2.211/ugbusiness/arac/index/1'" style="cursor: pointer;min-height: 68px;margin-top:2px;padding:0px;margin-bottom: 2px;">
    <span class="info-box-icon bg-success" id="ARAC1" style="border-radius:0px;background-color: #007317 !important">
        <i class="fas fa-car"></i>
    </span>
    <div class="info-box-content" style="line-height: 1;">
        <span class="info-box-text" style="font-weight: 400;color: #143967;">
            ANA GİRİŞ - 1
        </span>
    </div>
</div>
<script>
        document.addEventListener("DOMContentLoaded", () => {
            // WebSocket bağlantısını oluştur
            const socket = new WebSocket('wss://192.168.2.211:7006');

            // WebSocket bağlantısı açıldığında
            socket.addEventListener('open', (event) => {
                console.log('WebSocket bağlantısı açıldı.');
                
                // Mesaj gönder
                socket.send('Merhaba, WebSocket sunucusu!');

                // Bağlantıyı kapat
                socket.close();
            });

            // WebSocket bağlantısı kapandığında
            socket.addEventListener('close', (event) => {
                console.log('WebSocket bağlantısı kapandı:', event);
            });

            // WebSocket'ten mesaj alındığında
            socket.addEventListener('message', (event) => {
                console.log('Sunucudan gelen mesaj:', event.data);
            });

            // WebSocket hatası olduğunda
            socket.addEventListener('error', (event) => {
                console.error('WebSocket hatası:', event);
            });
        });
    </script>