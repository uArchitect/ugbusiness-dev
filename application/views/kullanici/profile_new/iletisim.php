<style>
         
        .ccontainer { 
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .message-container {
            width: 420px;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            background: white;
            border: 1px solid #dee2e6;
        }
        .whatsapp-section {
            border-top: 4px solid #128C7E;
        }
        .sms-section {
            border-top: 4px solid #0056b3;
        }
        .history-section {
            width: 420px;
            padding: 16px;
            border-radius: 8px;
            background: white;
            border: 1px solid #dee2e6;
        }
        h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }
        .input-group {
            display: flex;
            align-items: center;
            background: #f1f3f5;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
            border: 1px solid #ced4da;
        }
        .input-group i {
            margin-right: 12px;
            color: #495057;
        }
        input, textarea {
            width: 100%;
            border: none;
            outline: none;
            background: none;
            font-size: 16px;
            color: #212529;
        }
        textarea {
            height: 80px;
            resize: none;
        }
        .send-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            color: white;
        }
        .whatsapp-btn {
            background: #128C7E;
        }
        .sms-btn {
            background: #0056b3;
        }
        .send-btn:hover {
            opacity: 0.85;
        }
        .history {
            font-size: 14px;
            color: #555;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .history:last-child {
            border-bottom: none;
        }
    </style>
 <div class="ccontainer">
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
        
        <div class="history-section">
            <h2>Son Gönderilen Mesajlar</h2>
            <div id="message-history"></div>
        </div>
    </div>
    
    <script>
        function sendWhatsApp() {
            var number = document.getElementById("whatsapp-number").value;
            var message = document.getElementById("whatsapp-message").value;
            if (number && message) {
                window.open(`https://wa.me/${number}?text=${encodeURIComponent(message)}`, '_blank');
                saveMessage("WhatsApp", number, message);
            } else {
                alert("Lütfen telefon numarası ve mesaj giriniz.");
            }
        }
        
        function sendSMS() {
            var number = document.getElementById("sms-number").value;
            var message = document.getElementById("sms-message").value;
            if (number && message) {
                window.open(`sms:${number}?body=${encodeURIComponent(message)}`, '_blank');
                saveMessage("SMS", number, message);
            } else {
                alert("Lütfen telefon numarası ve mesaj giriniz.");
            }
        }

        function saveMessage(type, number, message) {
            var historyDiv = document.getElementById("message-history");
            var newMessage = document.createElement("div");
            newMessage.classList.add("history");
            newMessage.innerHTML = `<strong>${type}:</strong> ${number} - ${message}`;
            historyDiv.prepend(newMessage);
        }
    </script>