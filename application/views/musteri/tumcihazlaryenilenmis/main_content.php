<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md" style="    margin-top: -5px;">
<div class="card card-success" style="border-radius:0px !important;">
              <div class="card-header" style="background:#00264f!important">
              <h3 class="card-title"><strong>UG Business</strong> - YENİLENMİŞ CİHAZLAR LİSTESİ</h3>
  
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="    min-height: 790px !important;">


              <form action="#" method="post" style="margin:10px;">
              <label for="">Garanti Bitiş Tarihi Seçiniz : </label>
              <input type="date" class="form-control" name="filter_garanti_bitis_tarihi" value="<?=(!empty($garanti_bitis_data) ? date("Y-m-d",strtotime($garanti_bitis_data)) : date("Y-m-d"))?>">
          <button class="form-control mt-2" class="btn btn-success" type="submit">Filtrele</button>
              </form>

              <table id="example1yonlendirilentablo"   class="table table-bordered table-striped nowrap" style="width:100%;">
        <thead>
            <tr>
                 <th>Garanti Bitiş</th>     <th>Cihaz</th>  <th>Seri Numarası</th>
             
                <th>Müşteri Adı</th>
                <th>Merkez Bilgisi</th> 
                <th>Adres</th>
                <th>İl</th>
                <th>İlçe</th>
                <th>İletişim Numarası</th> 
              
                
            </tr>
        </thead>
        <tbody>
     <?php 
     foreach ($data as $musteri) {
       ?>
       <tr>
       <td><?=date("d.m.Y",strtotime($musteri->garanti_bitis_tarihi))?>
       <?php 
                    
                    $kalangun = gunSayisiHesapla(date("Y-m-d"),date("Y-m-d",strtotime($musteri->garanti_bitis_tarihi)));
                    if(date("Y-m-d",strtotime($musteri->garanti_bitis_tarihi)) > date("Y-m-d"))
                    {
                      echo "<span class='text-success'> ".$kalangun." Gün Kaldı </span>";
                    }else{
                      echo "<span class='text-danger'> ".($kalangun)." Gün Geçti </span>";
                    }
                    
                    ?> 
      </td>
        <td><?=$musteri->urun_adi?></td>    <td><?=$musteri->seri_numarasi?></td>
        <td><?=$musteri->musteri_ad?></td>
        <td><?=$musteri->merkez_adi?></td>
        <td><?=$musteri->merkez_adresi?></td>
        <td><?=$musteri->sehir_adi?></td>
        <td><?=$musteri->ilce_adi?></td>
        <td><?=$musteri->musteri_iletisim_numarasi?></td>
     </tr>
       <?php
     }
     ?>
    </tbody>
    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>















            </div>


