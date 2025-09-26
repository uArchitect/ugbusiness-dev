<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesai Takip Kartları</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
         
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 0;
         
        }
        .card {
            aspect-ratio: 1/1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border:1px solid #737f955c;
            border-radius:5px;
            margin:2px;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }
        @media (max-width: 640px) {
            .card-container {
                grid-template-columns: 1fr;
            }
            .card {
                aspect-ratio: auto;
                min-height: 150px;
            }
        }

        ::-webkit-scrollbar {display:none;} 
    </style>
</head>
<body class="bg-gradient-to-br from-gray-800 to-gray-900 min-h-screen">
    <div class="  mx-auto" >
        <h1 class="text-2xl font-extrabold text-center my-3 text-white tracking-tight"><?=date("d.m.Y")?> Mesai Takip</h1>
        <div class="card-container" id="card-container"></div>
    </div>

    <script>
       
        async function fetchData() {
             
            const users = <?=json_encode($data)?>;

            

            const container = document.getElementById('card-container');
            container.innerHTML = '';  

            users.forEach(user => {
                const hasCheckedIn = user.mesai_takip_okutma_tarihi !== null;
                const card = document.createElement('div');
                card.className = `card p-4 ${
                    hasCheckedIn 
                        ? 'bg-gradient-to-br from-green-400 to-green-600 text-white' 
                        : 'bg-red text-white'
                }`;
                card.innerHTML = `
                    <h2 class="text-lg font-bold tracking-wide">${user.kullanici_ad_soyad.toUpperCase()}</h2>
                    <p class="text-sm mt-1 font-medium">${
                        hasCheckedIn ? user.mesai_takip_okutma_tarihi : ''
                    }</p>
                `;
                container.appendChild(card);
            });
        }

       
        document.addEventListener('DOMContentLoaded', fetchData);
    </script>
</body>
</html>