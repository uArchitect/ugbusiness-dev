<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md" style="    margin-top: -5px;">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header" style="background:#00264f!important">
              <h3 class="card-title"><strong>UG Business</strong> - Müşteri Bilgileri</h3>
  
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="    min-height: 790px !important;">


              <form action="#" method="post" style="margin:10px;">
            <div class="row">
              <div class="col">
 <select class="form-control" name="cihaz_id">
                      <option <?=$filter_cihaz_id==1?"selected":""?> value="1">UMEX LAZER</option>
                      <option <?=$filter_cihaz_id==2?"selected":""?> value="2">UMEX DIODE</option>
                      <option <?=$filter_cihaz_id==3?"selected":""?> value="3">UMEX EMS</option>
                      <option <?=$filter_cihaz_id==4?"selected":""?> value="4">UMEX GOLD</option>
                      <option <?=$filter_cihaz_id==5?"selected":""?> value="5">UMEX SLIM</option>
                      <option <?=$filter_cihaz_id==6?"selected":""?> value="6">UMEX S</option>
                      <option <?=$filter_cihaz_id==7?"selected":""?> value="7">UMEX Q</option>
                      <option <?=$filter_cihaz_id==8?"selected":""?> value="8">UMEX PLUS</option>

               </select>
              </div>
              <div class="col">
                <select class="form-control" name="il_id">
                  <option value="9999">TÜM İLLER</option>
                  <?php 
                  foreach ($sehirler as $il) {
                   ?>
                      <option <?=$il->sehir_id==$filter_il_id?"selected":""?> value="<?=$il->sehir_id?>"><?=$il->sehir_adi?></option>
                   <?php
                  }
                  ?>
                

               </select>
              </div>
            </div>
              
                 
          
          
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


