
<div class="content-wrapper" style="padding-top:8px">
 
<section class="content text-md">

<div class="card card-dark col-md-8">
    <div class="card-header">UG Business - Stok Çıkış Ekranı</div>
    <div class="card-body">
    <form id="stokForm">

    <div class="row">
        <div class="col-5">
        <label>Stok Seri Kodu</label>
            <input type="text" id="urunAdi" name="urunAdi" class="form-control" placeholder=".col-3">
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
        var urunAdi = document.getElementById("urunAdi").value;
        var cikisBirimi = document.getElementById("cikisBirimi").value;
        var cikisMiktari = document.getElementById("cikisMiktari").value;
    
        // Tabloya yeni bir satır eklemek için HTML oluşturma
        var table = document.getElementById("stokCikisTablosu").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        
        cell1.innerHTML = urunAdi;
        cell2.innerHTML = cikisBirimi;
        cell3.innerHTML = '<input type="number" class="form-control" value="' + cikisMiktari + '">';
        cell3.classList.add('editable'); // Bu hücrenin düzenlenebilir olduğunu belirtmek için sınıf ekleyelim
    
        // Düzenlenebilir hücreye çift tıklama ile düzenleme özelliği ekleme
        cell3.addEventListener('dblclick', function() {
            var currentValue = this.innerText.trim();
            this.innerHTML = '<input type="number" class="form-control" value="' + currentValue + '" onblur="updateCellValue(this.value)">';
            this.querySelector('input').focus();
        });
    
        // Formu sıfırla
        document.getElementById("stokForm").reset();
    }
    
    function updateCellValue(newValue) {
        var cell = event.target.parentElement;
        cell.innerHTML = newValue;
        cell.classList.add('editable');
    }
    </script>
    
    </div>


    </div>
 
</section>
</div>

<style>
   
</style>