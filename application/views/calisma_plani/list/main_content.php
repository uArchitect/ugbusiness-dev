 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 <div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header bg-success">YAPILACAK İŞLER</div>
      <div class="card-body">
        <?php 
        $count = 0;
          foreach ($calisma_planlari as $calisma_plan) {$count++;
            if($calisma_plan->calisma_plani_durum == 0){continue;}
            ?>

              <div class="card <?=($calisma_plan->calisma_plani_sorumlu_kullanici_id == aktif_kullanici()->kullanici_id) ? "card-success" : "card-dark"?> card-outline">
                <div class="card-header" style="<?=($calisma_plan->calisma_plani_sorumlu_kullanici_id == aktif_kullanici()->kullanici_id) ? "background:#caffd58c" : ""?>">
                  <h5 class="card-title" style="font-size: large;"><b><?=mb_strtoupper($calisma_plan->calisma_plani_baslik)?></b>
                  <br>

                  
                <span style="font-size:13px">
                  <i class="fa fa-user-circle"></i> Kullanici : <?=$calisma_plan->kullanici_ad_soyad?>
                   <i class="far fa-calendar-alt ml-2"></i> Oluşturulma Tarih : <?=date("d.m.Y",strtotime($calisma_plan->kayit_tarihi))?>
                  <i class="far fa-calendar-alt ml-2"></i> Tamamlanma Tarih : <?=date("d.m.Y",strtotime($calisma_plan->calisma_plani_gecerlilik_tarihi))?>
                <span>


                </h5>
                  <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-link">#<?=$count?></a>
                   <?php 
                    if($calisma_plan->calisma_plani_sorumlu_kullanici_id == aktif_kullanici()->kullanici_id){
                     ?>
                      <a href="<?=base_url("calisma_plan/edit/".$calisma_plan->calisma_plan_id)?>" class="btn btn-tool text-orange">
                      <i class="fas fa-pen"></i> Düzenle
                    </a>
                    <a href="<?=base_url("calisma_plan/delete/".$calisma_plan->calisma_plan_id)?>" class="btn btn-tool text-danger">
                      <i class="fas fa-times"></i> Sil
                    </a>
                     <?php
                  }
                   
                   ?>
                   


                    <a  onclick="waiting('Çalışma Planı');" href="<?=base_url("calisma_plan/is_tamamla/".$calisma_plan->calisma_plan_id)?>" class="btn btn-tool text-success">
                      <i class="fas fa-check"></i> Tamamlandı
                    </a>
                  </div>
                </div>
              </div>

            <?php
          }
        ?>
    
    <a class="btn btn-success d-block p-2" href="<?=base_url("calisma_plan/add")?>"
    style=" border: 2px dotted #6cbd6b;   color: #126503;background: #dfffde;width:100%" >
    <i class="fa fa-plus-circle"></i> Yeni Çalışma Planı Ekle</a>

      </div>
      <div class="card-footer"></div>
    </div>
  </div>
  <div class="col">
  <div class="card">
      <div class="card-header bg-warning">TAMAMLANAN İŞLER</div>
      <div class="card-body">
        <?php 
        $count = 0;
          foreach ($calisma_planlari as $calisma_plan) {$count++;
            if($calisma_plan->calisma_plani_durum == 1){continue;}
            ?>

              <div class="card <?=($calisma_plan->calisma_plani_sorumlu_kullanici_id == aktif_kullanici()->kullanici_id) ? "card-warning" : "card-dark"?> card-outline">
                <div class="card-header">
                  <h5 class="card-title" style="font-size: large;"><b><?=mb_strtoupper($calisma_plan->calisma_plani_baslik)?></b>
                  <br>
                <span style="font-size:13px">
                  <i class="fa fa-user-circle"></i> Kullanici : <?=$calisma_plan->kullanici_ad_soyad?>
                  <i class="far fa-calendar-alt ml-2"></i> Tarih : <?=date("d.m.Y",strtotime($calisma_plan->calisma_plani_gecerlilik_tarihi))?>
                <span>
                </h5>
                  <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-link">#<?=$count?></a>
                    <?php 
                    if($calisma_plan->calisma_plani_sorumlu_kullanici_id == aktif_kullanici()->kullanici_id){
                     ?>
                      <a href="<?=base_url("calisma_plan/edit/".$calisma_plan->calisma_plan_id)?>" class="btn btn-tool text-orange">
                      <i class="fas fa-pen"></i> Düzenle
                    </a>
                    <a href="<?=base_url("calisma_plan/delete/".$calisma_plan->calisma_plan_id)?>" class="btn btn-tool text-danger">
                      <i class="fas fa-times"></i> Sil
                    </a>
                     <?php
                  }
                   
                   ?>
                    <a onclick="waiting('Çalışma Planı');" href="<?=base_url("calisma_plan/is_beklemeye_al/".$calisma_plan->calisma_plan_id)?>" class="btn btn-tool text-warning">
                      <i class="fas fa-clock"></i> Beklemede
                    </a>
                  </div>
                </div>
              </div>

            <?php
          }
        ?>
    


      </div>
      <div class="card-footer"></div>
    </div>
  </div>
 </div>

</div>



            



 