
<div class="content-wrapper" style="padding-top:8px">
 
<section class="content text-md">

<div class="card card-dark col-md-8">
    <div class="card-header">UG Business - Stok Çıkış Ekranı</div>
    <div class="card-body">
    <form id="stokForm">

    <div class="row">
        <div class="col-5">
        <label>Stok Seri Kodu</label>
            <input type="text" id="seriKod" name="seriKod" class="form-control" placeholder=".col-3">
        </div>
        <div class="col-3">
        <label>Çıkış Birimi</label>
        <select id="cikisBirimi" class="form-control" name="cikisBirimi" required>
            <option value="Adet">Adet</option>
            <option value="Kg">Kg</option>
            <option value="Litre">Litre</option>
        </select>
        </div>
        <div class="col-2">
            <label>Stok Çıkış Miktarı</label>
            <input type="number" id="cikisMiktari" name="cikisMiktari"  min="1" value="1" class="form-control" placeholder=".col-5">
        </div>
        <div class="col-2">
        <label>&nbsp;</label>
            <button type="button" class="btn btn-success d-block" style="width:100%;" onclick="ekleStokCikisi()"><i class="fas fa-arrow-circle-down"></i> Listeye Ekle</button>
        </div>
    </div>
 
    
  
 
    </form>
    <label class="mt-3 ml-2">Çıkış Yapılacak Stok Listesi</label>
    <table id="stokCikisTablosu" class="table table-bordered table-striped  ml-2  fixed-width-table" style="margin-right:20px">
       
        <thead>
            <tr>
                <th style="  width: 43.33%; background:#1818183b;padding:0px;padding-left:5px;padding-top:5px;padding-bottom:5px;font-weight:normal">Ürün Adı</th>
                <th style="  width: 43.33%; background:#1818183b;padding:0px;padding-left:5px;padding-top:5px;padding-bottom:5px;font-weight:normal">Seri Kod</th>
               
                <th style="  width: 33.33%; background:#1818183b;padding:0px;padding-left:5px;padding-top:5px;padding-bottom:5px;font-weight:normal">Çıkış Birimi</th>
                <th style="  width: 23.33%; background:#1818183b;padding:0px;padding-left:5px;padding-top:5px;padding-bottom:5px;font-weight:normal">Stok Çıkış Miktarı</th>
         
            </tr>
        </thead>
        <tbody>
            <!-- Buraya JavaScript ile dinamik olarak eklenen satırlar gelecek -->
        </tbody>
    </table>
    
    <script>

 
        $(document).ready(function() {
            $('#stokCikisTablosu').DataTable();
    
           
    
    
        });
    
 
        function ekleStokCikisi() {
            var seriKod = document.getElementById("seriKod").value;
            var cikisBirimi = document.getElementById("cikisBirimi").value;
            var cikisMiktari = document.getElementById("cikisMiktari").value;

            var formData = new FormData();
            formData.append('seriKod', seriKod);

            // API çağrısı yaparak ürün bilgilerini alma
            fetch('https://ugbusiness.com.tr/stok/coklu_stok_cikis_kontrol', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var urunAdi = data.stok_tanim_ad; // API'den gelen ürün adı

                // Tabloya yeni bir satır eklemek için HTML oluşturma
                var table = document.getElementById("stokCikisTablosu").getElementsByTagName('tbody')[0];
                var newRow = table.insertRow(table.rows.length);
                
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell3 = newRow.insertCell(3);

                cell1.innerHTML = '<input type="text" class="form-control" value="' + seriKod + '">';
                cell2.innerHTML = '<input type="text" class="form-control" value="' + urunAdi + '">';
                cell3.innerHTML = cikisBirimi;
                cell4.innerHTML = '<input type="number" class="form-control" value="' + cikisMiktari + '">';
                cell4.classList.add('editable');  

                
                cell3.addEventListener('dblclick', function() {
                    var currentValue = this.querySelector('input').value.trim();
                    this.innerHTML = '<input type="number" class="form-control" value="' + currentValue + '" onblur="updateCellValue(this.value, this.parentElement.rowIndex, this.cellIndex)">';
                    this.querySelector('input').focus();
                });

                // Formu sıfırla
                document.getElementById("stokForm").reset();
            })
            .catch(error => {
                console.error('Ürün bilgileri alınırken bir hata oluştu:', error);
            });
        }

        // Hücre değerini güncelleme fonksiyonu
        function updateCellValue(value, rowIndex, cellIndex) {
            var table = document.getElementById("stokCikisTablosu");
            table.rows[rowIndex].cells[cellIndex].innerHTML = '<input type="number" class="form-control" value="' + value + '">';
        }
    </script>
    
    </div>


    </div>
 
</section>
</div>

<style>
   
</style>