<style>
       
        .message-container {
            width: 400px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: 0.3s ease-in-out;
            margin-bottom: 20px;
            background: white;
        }
        .message-container:hover {
            transform: scale(1.05);
        }
        .whatsapp-section {
            border-top: 5px solid #25D366;
        }
        .sms-section {
            border-top: 5px solid #007BFF;
        }
        h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
        }
        .input-group {
            display: flex;
            align-items: center;
            background: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .input-group i {
            margin-right: 10px;
            color: #555;
        }
        input, textarea {
            width: 100%;
            border: none;
            outline: none;
            background: none;
            font-size: 16px;
        }
        textarea {
            height: 80px;
            resize: none;
        }
        .send-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            color: white;
        }
        .whatsapp-btn {
            background: #25D366;
        }
        .sms-btn {
            background: #007BFF;
        }
        .send-btn:hover {
            filter: brightness(85%);
        }
    </style>

<div class="message-container whatsapp-section">
        <h2><i class="fab fa-whatsapp"></i> WhatsApp Mesaj Gönder</h2>
        <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="text" id="whatsapp-number" placeholder="Telefon Numarası" />
        </div>
        <div class="input-group">
            <i class="fas fa-comment"></i>
            <textarea id="whatsapp-message" placeholder="Mesajınızı yazın..."></textarea>
        </div>
        <button class="send-btn whatsapp-btn" onclick="sendWhatsApp()">Gönder</button>
    </div>
    
    <div class="message-container sms-section">
        <h2><i class="fas fa-sms"></i> SMS Gönder</h2>
        <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="text" id="sms-number" placeholder="Telefon Numarası" />
        </div>
        <div class="input-group">
            <i class="fas fa-comment"></i>
            <textarea id="sms-message" placeholder="Mesajınızı yazın..."></textarea>
        </div>
        <button class="send-btn sms-btn" onclick="sendSMS()">Gönder</button>
    </div>
    
    <script>
        function sendWhatsApp() {
            var number = document.getElementById("whatsapp-number").value;
            var message = encodeURIComponent(document.getElementById("whatsapp-message").value);
            if (number && message) {
                window.open(`https://wa.me/${number}?text=${message}`, '_blank');
            } else {
                alert("Lütfen telefon numarası ve mesaj giriniz.");
            }
        }
        
        function sendSMS() {
            var number = document.getElementById("sms-number").value;
            var message = encodeURIComponent(document.getElementById("sms-message").value);
            if (number && message) {
                window.open(`sms:${number}?body=${message}`, '_blank');
            } else {
                alert("Lütfen telefon numarası ve mesaj giriniz.");
            }
        }
    </script>