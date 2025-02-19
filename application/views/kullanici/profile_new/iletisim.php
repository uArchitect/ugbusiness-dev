<style>
        .message-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }
        .whatsapp-section {
            background: #25D366;
            color: white;
        }
        .sms-section {
            background: #007BFF;
            color: white;
        }
        .message-container h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        .message-container input, .message-container textarea, .message-container button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }
        .message-container textarea {
            height: 100px;
            resize: none;
        }
        .message-container button {
            background: rgba(0, 0, 0, 0.2);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        .message-container button:hover {
            background: rgba(0, 0, 0, 0.4);
        }
    </style>

<div class="message-container whatsapp-section">
        <h2>WhatsApp Mesaj Gönder</h2>
        <input type="text" id="whatsapp-number" placeholder="Telefon Numarası" />
        <textarea id="whatsapp-message" placeholder="Mesajınızı yazın..."></textarea>
        <button onclick="sendWhatsApp()">Gönder</button>
    </div>
    
    <div class="message-container sms-section">
        <h2>SMS Gönder</h2>
        <input type="text" id="sms-number" placeholder="Telefon Numarası" />
        <textarea id="sms-message" placeholder="Mesajınızı yazın..."></textarea>
        <button onclick="sendSMS()">Gönder</button>
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