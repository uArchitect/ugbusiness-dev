 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- /.content-header -->
   <section class="content col  ">
     <div class="card card-dark" style=" ">
       <div class="card-header with-border" style="background:#061f3a">
         <h3 class="card-title text-center"> UG Business - Servis Detayları - <?=$servis->servis_kod?></h3>


         <div class="card-tools">
            <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>" class="btn btn-success <?=((!empty($_GET["filter"]))?"":"d-none")?>"><i class="fas fa-arrow-circle-left"></i> SERVİS İŞLEM SAYFASINA GİT</a>
            <a href="?filter=duzenle" class="btn btn-warning <?=((!empty($_GET["filter"]))?"d-none":"")?>" style="
    color: white;
    background: #0a376b;
    border: 0px;
"><i class="far fa-edit"></i> SERVİS BİLGİLERİNİ DÜZENLE</a>
         
          </div>


       </div>
         <div class="card-body p-0" style="    zoom: 0.8;">
           <div class="row" style="background:#053eab;height: 269px;">
             <div class="col-4 text-left" style="height: 269px;padding: 0;" style="width:150px">
               <span class="badge bg-dark text-md p-4" style="    height: -webkit-fill-available;width: inherit;flex:1;font-weight:500;border-radius:0px;background:#004ac1!important;border: 0px solid #00274f;">
                 <div style="height:30px"></div>
                 <i class="fa fa-user-circle" style="font-size: 55px;color:#ffffff"></i>
                 <br>
                 <br>
                 <b> <?=mb_strtoupper($cihaz->musteri_ad)?> </b>
                 <br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                   <i class="fa fa-user " style="margin-left:11px"></i> <?=$cihaz->musteri_kod?> <i class="fa fa-mobile-alt " style="margin-left:11px"></i> <?=$cihaz->musteri_iletisim_numarasi?> </span>
                 <br>
                 <a href="
													<?=base_url("musteri/duzenle/").$cihaz->musteri_id?>" type="button" class="btn  btn-dark" style="border:2px solid white;border-radius: 50px; padding: 8px;width: max-content!important;background: #061f3a;width: -webkit-fill-available;">
                   <i class="fas fa-pen"></i> Müşteri Düzenle </a>
             </div>
             <div class="col-4 text-center" style="border-width: 12px;   border-color: #004ac1; ">
              
             <img src="
												
													<?=base_url("assets/dist/img/".$cihaz->urun_slug.".png")?>" style="    margin-top: 22px;" alt="" width="145">
               
               <br>
               <div class="container-fluid">
                 <div class="row p-1">
                   <div class="col" style="
																	<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>">
                     <img src="
																		<?=base_url("uploads/umex-diode.png")?>" style="
																		<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background:#081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-diode">
                   </div>
                   <div class="col" style="
																		<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>">
                     <img src="
																			<?=base_url("uploads/umex-ems.png")?>" style="
																			<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-ems">
                   </div>
                   <div class="col" style="
																			<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>">
                     <img src="
																				<?=base_url("uploads/umex-gold.png")?>" style="
																				<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-gold">
                   </div>
                   <div class="col" style="
																				<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>">
                     <img src="
																					<?=base_url("uploads/umex-lazer.png")?>" style="
																					<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-lazer">
                   </div>
                   <div class="col" style="
																					<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>">
                     <img src="
																						<?=base_url("uploads/umex-plus.png")?>" style="
																						<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;      " class="img-fluid" alt="umex-plus">
                   </div>
                   <div class="col" style="
																						<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>">
                     <img src="
																							<?=base_url("uploads/umex-q.png")?>" style="
																							<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-q">
                   </div>
                   <div class="col" style="
																							<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>">
                     <img src="
																								<?=base_url("uploads/umex-s.png")?>" style="
																								<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-s">
                   </div>
                   <div class="col" style="
																								<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>">
                     <img src="
																									<?=base_url("uploads/umex-slim.png")?>" style="
																									<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-slim">
                   </div>
                 </div>
               </div>
               <br>
             </div>
             <div class="col-4 text-left" style="padding: 0;">
               <span class="badge bg-warning text-md p-4" style=" height: 269px;display: block;font-weight:500;border-radius:0px;color:white!important;background:#004ac1!important;border: 0px solid #093d7d;">
                 <div style="height:30px"></div>
                 <i class="fa fa-building" style="font-size: 55px;color:#ffffff"></i>
                 <br>
                 <br>
                 <b> <?=mb_strtoupper($cihaz->merkez_adi)?> </b>
                 <br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                   <i class="far fa-map"></i> <?=$cihaz->merkez_adresi?> <b> <?=$cihaz->ilce_adi?> / <?=$cihaz->sehir_adi?> </b>
                 </span>
                 <br>
                 <a type="button" href="
																													<?=base_url("merkez/duzenle/").$cihaz->merkez_id?>" class="btn  btn-dark" style="color:white!important;border:2px solid white;border-radius: 50px; padding: 8px;width: max-content!important;background: #061f3a;width: -webkit-fill-available;">
                   <i class="fas fa-pen"></i> Merkez Düzenle </a>
                 <br>
                 <br>
                 <br>
               </span>
             </div>
           </div>
           <h3 class="timeline-header bg-dark text-center d-none" style="background:#001429!important;margin-bottom: 0;">
             <div class="container-fluid">
               <div class="row p-3">
                 <div class="col" style="
																																<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>">
                   <img src="
																																	<?=base_url("uploads/umex-diode.png")?>" style="
																																	<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-diode">
                 </div>
                 <div class="col" style="
																																	<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>">
                   <img src="
																																		<?=base_url("uploads/umex-ems.png")?>" style="
																																		<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-ems">
                 </div>
                 <div class="col" style="
																																		<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>">
                   <img src="
																																			<?=base_url("uploads/umex-gold.png")?>" style="
																																			<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-gold">
                 </div>
                 <div class="col" style="
																																			<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>">
                   <img src="
																																				<?=base_url("uploads/umex-lazer.png")?>" style="
																																				<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-lazer">
                 </div>
                 <div class="col" style="
																																				<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>">
                   <img src="
																																					<?=base_url("uploads/umex-plus.png")?>" style="
																																					<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-plus">
                 </div>
                 <div class="col" style="
																																					<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>">
                   <img src="
																																						<?=base_url("uploads/umex-q.png")?>" style="
																																						<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-q">
                 </div>
                 <div class="col" style="
																																						<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>">
                   <img src="
																																							<?=base_url("uploads/umex-s.png")?>" style="
																																							<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-s">
                 </div>
                 <div class="col" style="
																																							<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>">
                   <img src="
																																								<?=base_url("uploads/umex-slim.png")?>" style="
																																								<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-slim">
                 </div>
               </div>
             </div>
           </h3>
         </div>


  

     </div>



     <div class="row">

     <div class="col col-md-12">

    



<!-- /.row -->
<div class="card card-primary card-outline" style="    min-height: 640px;zoom: 0.9;">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Servis Bilgileri 
            </h3>
         
          </div>
      
          <div class="card-body">
            <div class="row">
              <div class="col d-none" style="max-width: 200px!important;zoom: 1.2;">
                <div class=" nav flex-column nav-tabs h-100" style="min-height: 570px;border-right: 1px solid #104cbd12;" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link <?=((!empty($_GET["filter"]))?"active":"")?>" id="vert-tabs-first-tab" data-toggle="pill" href="#vert-tabs-first" role="tab" aria-controls="vert-tabs-home" aria-selected="true"><i class="fas fa-tachometer-alt"></i> Genel Bakış</span></a>
                  
                <a class="nav-link" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-home" aria-selected="true"><i class="fas fa-user-tag"></i> Görevler <span class="badge bg-primary" style="border-radius: 50%; /* margin-top: -5px !important; */ margin-left: 5px;"><?=count($servis_gorevleri)?></span></a>
                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"><i class="fas fa-tools"></i> Yapılan İşlemler <span class="badge bg-primary" style="border-radius: 50%; /* margin-top: -5px !important; */ margin-left: 5px;"><?=count($servis_islemleri)?></span></a>

                </div>
              </div>
              <div class="col" style="width:100%;">
                <div class="tab-content" id="vert-tabs-tabContent">
                 
                
                
                
                
                <div class="tab-pane text-left fade <?=((!empty($_GET["filter"]))?"active show":"")?>" id="vert-tabs-first" role="tabpanel" aria-labelledby="vert-tabs-first-tab">
                               <!-- ########################## -->





                               <div class="row" style="background: #104cbd0f;">
<div class="col-12" style="padding-top: 10px;border: 1px solid #c0d5ff; border-bottom: 0px;">
<h4 style="color: #104cbd;font-size: 18px;"> Servis Bilgileri
</h4>

</div>

</div>




                               <div class="row" style="padding-top: 10px;border: 1px solid #c0d5ff;border-top: 0px;margin-bottom: 15px;">
    <div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-folder-open text-primary"></i> Servis Kodu</label>
        <input type="text" disabled value="<?=$servis->servis_kod?>" class="form-control">
</div>
    </div>

    <div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-user-edit text-success"></i> Kayıt Oluşturan Kullanıcı</label>
        <input type="text" disabled value="<?=$servis->kullanici_ad_soyad?>" class="form-control">
</div>
    </div>



    <div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="far fa-calendar-alt text-warning"></i> Servis Kayıt Tarihi</label>
        <input type="text" disabled value="<?=date("d.m.Y H:i:s",strtotime($servis->servis_kayit_tarihi))?>" class="form-control">
</div>
    </div>



    <div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-question-circle text-danger"></i> Servis Durumu</label>
        <input type="text" disabled value="<?=$servis->servis_durum_kategori_adi?>" class="form-control">
</div>
    </div>








  </div>






 <!-- ########################## -->


                               
                  </div>
                
                
                
                
                
                
                <div class="tab-pane fade <?=((empty($_GET["filter"]))?"active show":"")?>" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                              
                  <div class="row">
<div class="col-12">
<h4>

<i class="fas fa-globe"></i> Servise Tanımlanmış İşlemler
<small class="float-right">Toplam İşlem Sayısı : <?=count($servis_islemleri)?></small>
</h4>
<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
Servis kaydına tanımlanmış olan kullanıcı görevleri listelenmiştir. Yeni kullanıcı görevi tanımlamak için <a href="">tıklayınız</a>
</p>
</div>

</div>

                  <table class="table text-md table-bordered table-striped nowrap">
      <thead>
        <tr>
          <th style="width:30%"><i class="far fa-user"></i> İşlem Detayı</th>
          <th style="width:30%"><i class="far fa-calendar-alt"></i> İşlem Tarihi</th>
          <th><i class="far fa-comment-dots"></i> İşlem Açıklaması</th>
          <th style="width:275px"><i class="fas fa-tasks"></i> İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($servis_islemleri as $islem) {
          ?>

            <tr>   
              <td>
                <?=$islem->servis_islem_kategori_adi?>
              </td>

           
              <td>
              <?=date("d.m.Y H:i:s",strtotime($islem->servis_islem_kayit_tarihi))?>
              </td>
              <td> <?=($islem->servis_islem_aciklama != "") ? $islem->servis_islem_aciklama : "<span style='opacity:0.6'>İşlem Açıklaması Girilmedi.</span>"?></td>
              <td>
              <button class="btn btn-dark"><i class="fas fa-edit"></i> Bilgileri Düzenle</button>
                <button class="btn btn-danger" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu işlem kaydını silmek istediğinize emin misiniz? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_islem_sil/'.$servis->servis_id.'/'.$islem->servis_islem_id )?>');"><i class="fas fa-user-times"></i> İşlemi Sil</button>
              </td>
          
            </tr>

          <?php
        }
        ?>
        
      </tbody>
    </table>








    

   


<form action="<?=base_url("servis/servis_islem_tanimla/".$servis->servis_id)?>" method="POST">


<div class="form-group">
        <label for="formClient-Code"> Cihaz</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="servis_islem_tanim_id" id="servis_islem_tanim_id" required class="select2 form-control rounded-0" style="width: 100%;">
      
              <option value="">İşlem Seçiniz</option>
                                      <?php 
                            foreach ($servis_islem_kategorileri as $islem_kategori) {
                              ?>
                              <option value="<?=$islem_kategori->servis_islem_kategori_id ?>"><?=$islem_kategori->servis_islem_kategori_adi?></option>
                              <?php
                            }
                            ?>
            </select>   
      </div>

              
    
<input type="text" class="form-control" name="servis_islem_aciklama" placeholder="İşlem açıklamasını giriniz...">

<button class="btn btn-success" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> İşlemi Kaydet</button>


</form>














                  </div>
                  <div class="tab-pane fade <?=((!empty($_GET["filter"]))?"active show":"")?>" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                  
                  


                  <!-- #############  -->

           
                  <div class="row">
<div class="col-12">
<h4>
<i class="fas fa-globe"></i> Servise Tanımlanmış Görevler / Kullanıcılar
<small class="float-right">Toplam Görev Sayısı : <?=count($servis_gorevleri)?></small>
</h4>
<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
Servis kaydına tanımlanmış olan islemler listelenmiştir. Yeni islem tanımlamak için <a href="">tıklayınız</a>
</p>
</div>

</div>

                  <table id="servisDetaylariTable" class="table text-md table-bordered table-striped nowrap">
      <thead>
        <tr>
          <th style="width:20%"><i class="far fa-user"></i> Teknisyen Ad Soyad</th>
          <th style="width:20%"><i class="far fa-calendar-alt"></i> Tanımlanma Tarihi</th>
          <th><i class="far fa-comment-dots"></i> Görev Açıklaması</th>
          <th style="width:275px"><i class="fas fa-tasks"></i> İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($servis_gorevleri as $gorev) {
          ?>

            <tr>
              <td>
                <?=$gorev->kullanici_ad_soyad?>
              </td>
              <td>
              <?=date("d.m.Y H:i:s",strtotime($gorev->servis_gorev_kayit_tarihi))?>
              </td>
              <td> <?=($gorev->servis_gorev_aciklama != "") ? $gorev->servis_gorev_aciklama : "<span style='opacity:0.6'>Görev Açıklaması Girilmedi.</span>"?></td>
              <td>
              <button class="btn btn-dark"><i class="fas fa-edit"></i> Bilgileri Düzenle</button>
                <button class="btn btn-danger" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu görev kaydını silmek istediğinize emin misiniz? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_gorev_sil/'.$servis->servis_id.'/'.$gorev->servis_gorev_id)?>');"><i class="fas fa-user-times"></i> Görevi Sil</button>
              </td>
          
            </tr>

          <?php
        }
        ?>
        
      </tbody>
    </table>





    <div class="card card-danger" >
<div class="card-header" style="    background-color: #f2fff3;color: #008712;">
<h3 class="card-title">Yeni Görev Tanımla</h3>
</div>
<div class="card-body">

<form action="<?=base_url("servis/servis_gorev_tanimla/".$servis->servis_id)?>" method="POST">
<div class="row">
<div class="col-3">
<select class="form-control" name="servis_gorev_kullanici_id" required>
<option value="">Görev Kullanıcısı Seçiniz</option>
                         <?php 
              foreach ($kullanicilar as $kullanici) {
                ?>
                <option value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?></option>
                <?php
              }
              ?>
            </select>
</div>
<div class="col-7">
<input type="text" class="form-control" name="servis_gorev_aciklama" placeholder="Görev açıklamasını giriniz...">
</div>
<div class="col-2">
<button class="btn btn-success" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> Görevi Kaydet</button>
</div>
</div>
</form>





</div>

</div>




 <!-- #############  -->






                  </div>
                
                </div>
              </div>
            </div>
              
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->









</div>
 
</div>
<br><br>

 </div>
 <!-- /.card-body -->
 <!-- /.card-footer-->

 </div>
 <!-- /.card -->






 </section>
 
 </div>

 <style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #104cbd;
    border-color: #dee2e6 #dee2e6 #fff;
}
.table th {
    background: #ffffff !important;
    color: #174b85;
    padding: 12px;
    padding-left: 10px;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}
  </style>