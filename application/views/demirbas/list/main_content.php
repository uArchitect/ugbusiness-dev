<style>
        /* Genel sayfa stili */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 80%;
            max-width: 900px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header h1 {
            font-size: 36px;
            color: #4a4a4a;
        }

        .user-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Kullanıcı kartı başlık kısmı */
        .user-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4c6ef5;
            color: white;
            padding: 15px;
        }

        .user-card-header h3 {
            font-size: 24px;
            margin: 0;
        }

        .toggle-icon {
            font-size: 20px;
            transition: transform 0.3s;
        }

        /* Envanter listesi kısmı */
        .inventory {
            display: none;
            padding: 20px;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }

        .inventory ul {
            list-style-type: none;
            padding: 0;
        }

        .inventory ul li {
            font-size: 16px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .inventory ul li:last-child {
            border-bottom: none;
        }

        .inventory-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .inventory-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .inventory-item .details {
            display: flex;
            flex-direction: column;
        }

        .inventory-item .details h4 {
            font-size: 18px;
            color: #333;
            margin: 0;
        }

        .inventory-item .details p {
            font-size: 14px;
            color: #777;
        }

        /* Kart açıldığında animasyon */
        .user-card.active .inventory {
            display: block;
        }

        .user-card.active .toggle-icon {
            transform: rotate(180deg);
        }
    </style>


<div class="user-card" onclick="toggleInventory(this)">
        <div class="user-card-header">
            <h3>Ahmet Yılmaz</h3>
            <span class="toggle-icon">&#x25BC;</span>
        </div>
        <div class="inventory">
            <div class="inventory-item">
                <img src="https://via.placeholder.com/50" alt="Telefon">
                <div class="details">
                    <h4>Telefon</h4>
                    <p>iPhone 14 Pro Max - 256GB</p>
                </div>
            </div>
            <div class="inventory-item">
                <img src="https://via.placeholder.com/50" alt="Tablet">
                <div class="details">
                    <h4>Tablet</h4>
                    <p>iPad Air 5 - 64GB</p>
                </div>
            </div>
            <div class="inventory-item">
                <img src="https://via.placeholder.com/50" alt="Bilgisayar">
                <div class="details">
                    <h4>Bilgisayar</h4>
                    <p>MacBook Pro M1 - 16GB RAM</p>
                </div>
            </div>
        </div>
    </div>

    <div class="user-card" onclick="toggleInventory(this)">
        <div class="user-card-header">
            <h3>Ayşe Kaya</h3>
            <span class="toggle-icon">&#x25BC;</span>
        </div>
        <div class="inventory">
            <div class="inventory-item">
                <img src="https://via.placeholder.com/50" alt="Telefon">
                <div class="details">
                    <h4>Telefon</h4>
                    <p>Samsung Galaxy S22 - 128GB</p>
                </div>
            </div>
            <div class="inventory-item">
                <img src="https://via.placeholder.com/50" alt="Bilgisayar">
                <div class="details">
                    <h4>Bilgisayar</h4>
                    <p>Dell XPS 13 - 8GB RAM</p>
                </div>
            </div>
        </div>
    </div>

    <div class="user-card" onclick="toggleInventory(this)">
        <div class="user-card-header">
            <h3>Mehmet Çelik</h3>
            <span class="toggle-icon">&#x25BC;</span>
        </div>
        <div class="inventory">
            <div class="inventory-item">
                <img src="https://via.placeholder.com/50" alt="Tablet">
                <div class="details">
                    <h4>Tablet</h4>
                    <p>Samsung Galaxy Tab S7</p>
                </div>
            </div>
            <div class="inventory-item">
                <img src="https://via.placeholder.com/50" alt="Bilgisayar">
                <div class="details">
                    <h4>Bilgisayar</h4>
                    <p>HP Spectre x360 - 16GB RAM</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleInventory(card) {
        const icon = card.querySelector('.toggle-icon');
        const inventory = card.querySelector('.inventory');
        card.classList.toggle('active');
    }
</script>