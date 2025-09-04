 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Teklif Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Teklif Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-8">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Teklif Form Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($teklif_form)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('teklif_form/save').'/'.$teklif_form->teklif_form_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('teklif_form/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Müşteri Adı</label>
        <input type="text" value="<?php echo  !empty($teklif_form) ? $teklif_form->teklif_form_musteri_ad : '';?>" class="form-control" name="teklif_form_musteri_ad" required="" placeholder="Müşteri Adını Giriniz..." autofocus="">
       </div>

      <div class="form-group">
        <label for="formClient-Code"> Birinci Not</label>
        <input type="text" value="<?php echo !empty($teklif_form) ? $teklif_form->teklif_form_birinci_not : 'Vadeli satışlarda maksimum 20 ay sıralı senet şeklinde ( kefilli ) vadeye bölünecektir.';?>" class="form-control" name="teklif_form_birinci_not" placeholder="Birinci Not Giriniz..." autofocus="">
       </div>
  

        <div class="form-group">
        <label for="formClient-Code"> İkinci Not</label>
        <input type="text" value="<?php echo !empty($teklif_form) ? $teklif_form->teklif_form_ucuncu_not : '';?>" class="form-control" name="teklif_form_ucuncu_not" placeholder="İkinci Not Giriniz..." autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Uyarı Notu</label>
        <input type="text" value="<?php echo !empty($teklif_form) ? $teklif_form->teklif_form_ikinci_not : 'Not: Peşinat ve vade sayısına göre cihaz fiyatlarında artış yada indirim gerçekleşebilir.';?>" class="form-control" name="teklif_form_ikinci_not" placeholder="İkinci Not Giriniz..." autofocus="">
       </div>


        


    <div class="form-group">
        <label for="formClient-Code"> Teklif Form Tarihi</label>
        <input type="date" required class="form-control" value="<?php echo  !empty($teklif_form) ? date("Y-m-d",strtotime($teklif_form->teklif_form_tarihi)) : date("Y-m-d")?>" name="teklif_form_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
     </div>
       
    </div>





    <label for="formClient-Code"><i class="fas fa-tools text-danger"></i> Ürün Bilgileri</label>

<table id="servisDetaylariTable" class="table text-md table-bordered table-striped nowrap m-2">
  <thead>
    <tr>
      <th style="width:20%">Ürün</th>
      <th style="width:13%">Adet</th>
      <th style="width:13%">Peşin</th>
      <th style="width:13%">Vadeli</th>
      <th style="width:13%">Peşinat</th>
      <th style="width:13%">Takas Bedeli</th>
         <th style="width:13%">Yenilenmis Mi ?</th>
      <th style="width:15%">İşlem</th>
    </tr>
  </thead>
  <tbody>

<?php 
if(!empty($teklif_form)){
  $urun_liste = json_decode($teklif_form->teklif_form_urunler, true); 
  $adet_liste = json_decode($teklif_form->teklif_form_adetler, true); 
  $pesin_liste = json_decode($teklif_form->teklif_form_pesinler, true); 
  $vade_liste = json_decode($teklif_form->teklif_form_vadeliler, true); 
  $pesinat_liste = json_decode($teklif_form->teklif_form_pesinatlar, true); 
  $takas_liste = json_decode($teklif_form->teklif_form_takas_bedelleri, true); 
  $yenilenmis_liste = json_decode($teklif_form->teklif_form_yenilenmisler, true); 
  $count = 0;
  foreach ($urun_liste as $urun) {
 
             
        
  ?>
   <tr>
      <td>
        <select class="form-control select2" required name="teklif_form_urunler[]" data-select2-id="2">
        <option value="">Ürün Seçiniz</option>

        <?php 
      
          foreach ($urunler as $urun) {
            ?>
            <option value="<?=$urun->urun_id?>" <?=($urun_liste[$count] == $urun->urun_id) ? "selected":""?>><?=$urun->urun_adi?></option>
          <?php }?>

        </select>
      </td>
      <td><input type="number" value="<?=$adet_liste[$count]?>" name="teklif_form_adetler[]"  class="form-control"></td>
      <td><input type="text" value="<?=$pesin_liste[$count]?>" name="teklif_form_pesinler[]"   class="form-control"></td>
      <td><input type="text" value="<?=$vade_liste[$count]?>" name="teklif_form_vadeliler[]"  class="form-control"></td>
      <td><input type="text" value="<?=$pesinat_liste[$count]?>" name="teklif_form_pesinatlar[]" class="form-control"></td>
      <td><input type="text" value="<?=$takas_liste[$count]?>" name="teklif_form_takaslar[]" class="form-control"></td>
      <td><input type="text" value="<?=$takas_liste[$count]?>" name="teklif_form_yenilenmisler[]" class="form-control"></td>
     
      <td>
        <button class="btn btn-danger" disabled>İptal</button>
      </td>
   
    </tr>
  <?php
  
  $count++;      }
}else{
?>
  <tr>
  <td>
    <select class="form-control select2" required name="teklif_form_urunler[]" data-select2-id="2">
    <option value="">Ürün Seçiniz</option>

    <?php 
      foreach ($urunler as $urun) {
        ?>
        <option value="<?=$urun->urun_id?>"><?=$urun->urun_adi?></option>
        <?php
      }
      ?>

    </select>
  </td>
  <td><input type="number" name="teklif_form_adetler[]"  class="form-control"></td>
  <td><input type="text" name="teklif_form_pesinler[]"   class="form-control"></td>
  <td><input type="text" name="teklif_form_vadeliler[]"  class="form-control"></td>
  <td><input type="text" name="teklif_form_pesinatlar[]" class="form-control"></td>
  <td><input type="text" name="teklif_form_takaslar[]" class="form-control"></td>
  <td><input type="text" name="teklif_form_yenilenmisler[]" class="form-control"></td>
  
  
  <td>
    <button class="btn btn-danger" disabled>İptal</button>
  </td>

</tr>
<?php
}

?>




    
  </tbody>
</table>

<button id="satirEkleBtn" type="button" onclick="ekle();" class="btn btn-success d-block p-2 mt-2" style=" border: 2px dotted #6cbd6b;   color: #126503;background: #dfffde;width:220px;"><i class="fa fa-plus-circle"></i> Yeni Satır Ekle</button>




    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("teklif_form")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>






            <script>
              function ekle(){
  var table = document.getElementById("servisDetaylariTable").getElementsByTagName('tbody')[0]; 
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
 var cell7 = row.insertCell(6);
 var cell8 = row.insertCell(7);

    var select2 = document.createElement("select");
    var textbox = document.createElement("input");
    var textbox2 = document.createElement("input");
    var textbox3 = document.createElement("input");
    var textbox4 = document.createElement("input");
        var textbox5 = document.createElement("input");
    var deleteButton = document.createElement("button");

    select2.className = "form-control select2";
    select2.name = "teklif_form_urunler[]";
    select2.innerHTML = '<option value="">Ürün Seçiniz</option><?php foreach ($urunler as $urun): ?><option value="<?= $urun->urun_id ?>"><?= $urun->urun_adi ?></option><?php endforeach; ?>';
   
    textbox.type = "number";
    textbox.name = "teklif_form_adetler[]";
    textbox.className = "form-control";
   
    textbox2.type = "text";
    textbox2.name = "teklif_form_pesinler[]";
    textbox2.className = "form-control";

    textbox3.type = "text";
    textbox3.name = "teklif_form_vadeliler[]";
    textbox3.className = "form-control";

    textbox4.type = "text";
    textbox4.name = "teklif_form_pesinatlar[]";
    textbox4.className = "form-control";

    textbox5.type = "text";
    textbox5.name = "teklif_form_takaslar[]";
    textbox5.className = "form-control";

    textbox6.type = "text";
    textbox6.name = "teklif_form_yenilenmisler[]";
    textbox6.className = "form-control";

    deleteButton.type = "button";
    deleteButton.className = "btn btn-danger satirSilBtn";
    deleteButton.textContent = "İptal";
    deleteButton.addEventListener("click", function() {
      var tables = document.getElementById("servisDetaylariTable")
      var rowIndex = row.rowIndex;
      console.log("Satır silme düğmesine tıklandı, satır indexi: " + rowIndex);
      tables.deleteRow(rowIndex);
    });
    
    cell1.appendChild(select2);
    cell2.appendChild(textbox);
    cell3.appendChild(textbox2);
    cell4.appendChild(textbox3);
    cell5.appendChild(textbox4);
    cell6.appendChild(textbox5);
     cell7.appendChild(textbox6);
    cell8.appendChild(deleteButton);
}


document.addEventListener("DOMContentLoaded", function() {


var select2Inputs = table.find('.select2');


select2Inputs.each(function() {
$(this).select2({
    templateResult: formatState
});
});

 
});
            </script>