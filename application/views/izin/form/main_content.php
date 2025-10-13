<div class="content-wrapper" style="padding-top:10px"><div class="izin-form">
        <h2>İzin Talep Formu</h2>
        <form action="<?=base_url("izin/add")?>" method="POST">

          <div class="form-group">
                <label for="izinBaslangic">İzin Başlangıç Tarihi:</label>
                <select class="select2 form-control" name="izin_talep_eden_kullanici_id" required>
<option value="">Personel Seçiniz</option>
                         <?php 
              foreach ($kullanicilar as $kullanici) {
                ?>
                <option value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?></option>
                <?php
              }
              ?>
            </select>
            </div>


            <div class="form-group">
                <label for="izinBaslangic">İzin Başlangıç Tarihi:</label>
                <input type="datetime" id="izin_baslangic_tarihi" name="izin_baslangic_tarihi" required>
            </div>

            <div class="form-group">
                <label for="izinBitis">İzin Bitiş Tarihi:</label>
                <input type="datetime" id="izin_bitis_tarihi" name="izin_bitis_tarihi" required>
            </div>

            <div class="form-group">
                <label for="izinNedeni">İzin Nedeni:</label>
                <select id="izinNedeni" name="izin_neden_no" required>
                   <option value="">Seçim Yapınız</option>
               
                    <?php 
              foreach ($nedenler as $neden) {
                ?>
                <option value="<?=$neden->izin_neden_id?>"><?=$neden->izin_neden_detay?></option>
                <?php
              }
              ?>
                </select>
            </div>

            <div class="form-group">
                <label for="izinNotu">İzin Notu:</label>
                <textarea id="izinNotu" name="izinNotu" rows="4" placeholder="Notunuz burada..." required></textarea>
            </div>

            <div class="form-group">
                <button type="submit">Gönder</button>
            </div>
        </form>
        </div>  </div>

    <style scoped>
        /* Scoped CSS */
        .izin-form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .izin-form h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .izin-form .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .izin-form label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        .izin-form input, .izin-form select, .izin-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fafafa;
        }

        .izin-form input:focus, .izin-form select:focus, .izin-form textarea:focus {
            border-color: #4caf50;
            outline: none;
        }

        .izin-form button {
            width: 100%;
            padding: 12px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .izin-form button:hover {
            background-color: #45a049;
        }

        .izin-form textarea {
            resize: vertical;
        }
    </style>