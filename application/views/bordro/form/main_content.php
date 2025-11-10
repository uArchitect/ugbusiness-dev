 
 
<div class="content-wrapper">
     
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bordro Form</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Bordro Form</li>
            </ol>
          </div> 
        </div> 
      </div> 
    </div> 
<section class="content col-md-6">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Bordro Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($bordro)){?>
            <form class="form-horizontal"  enctype="multipart/form-data" method="POST" action="<?php echo site_url('bordro/save').'/'.$bordro->bordro_id;?>">
    <?php }else{?>
            <form class="form-horizontal"  enctype="multipart/form-data" method="POST" action="<?php echo site_url('bordro/save');?>">
    <?php } ?>
    <div class="card-body">

    <div class="form-group row">
  <div class="col-md-12 pl-0 ">
  <label for="formClient-Code"> Belge Seçiniz</label>
<br>

<input type="file" <?=empty($bordro) ? "required" : ""?> name="bordro_belge">

    </div></div>





    <div class="form-group row">
  <div class="col-md-12 pl-0 ">
        <label for="formClient-Code"> Hangi Kullanıcı / Personel İçin Bordro Yüklüyorsunuz ?</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              
              <select name="bordro_kullanici_id" required class="select2 form-control rounded-0" style="width: 100%;">
              <option value="">Bordro İçin Çalışan Seçiniz...</option>
                  
              <?php foreach($kullanicilar as $kullanici) : ?> 
                <?php if(aktif_kullanici()->kullanici_id == $kullanici->kullanici_id){continue;} ?>
                              <option data-icon="fa fa-user" value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($bordro) && $bordro->bordro_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>
</div>



<div class="form-group row">
  <div class="col-md-12 pl-0 ">
        <label for="formClient-Code"> Bordro Ay</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              
              <select name="bordro_ay" required class="select2 form-control rounded-0" style="width: 100%;">
              <option value="">Bordro Ayını Seçiniz...</option>
                  
              <?php for ($i=1; $i <= 12 ; $i++) { 
                ?>
                
                <option value="<?=$i?>" <?php echo  (!empty($bordro) && $bordro->bordro_ay == $i) ? 'selected="selected"'  : '';?>><?=$i?></option>
                
                <?php
              } ?> 
           
                            
                 
              </select>
        </div>  
      </div>
</div>



<div class="form-group row">
  <div class="col-md-12 pl-0 ">
        <label for="formClient-Code"> Bordro Yıl</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              
              <select name="bordro_yil" required class="select2 form-control rounded-0" style="width: 100%;">
              <option value="">Bordro yılını Seçiniz...</option>
                  
              <?php for ($i=2019; $i <= date("Y") ; $i++) { 
                ?>
                
                <option value="<?=$i?>" <?php echo  (!empty($bordro) && $bordro->bordro_yil == $i) ? 'selected="selected"'  : '';?>><?=$i?></option>
                
                <?php
              } ?> 
           
                             
              </select>
        </div>  
      </div>
</div>
  
      
    </div>
    

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("departman")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
   

    </form>
  </div>
           






<?php if(!empty($bordro)) : ?>


            <div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>Destek</strong> - Bordro Görüntüleme Hareketleri</h3>
              </div>
             
              <div class="card-body">
                <table id="example1" class="table table-bordered nowrap table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                
                    <th>Kullanıcı</th> 
                    <th style="width: 180px;">Görüntülenme Tarihi</th>
              
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($bordro_hareketleri as $bordro) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                     
                      <td><i class="far fa-user" style="margin-right:5px;opacity:1"></i> 
                       <?=$bordro->kullanici_ad_soyad?> / <?=$bordro->kullanici_unvan?>  / <?=$bordro->departman_adi?> 
                    </td>
                      
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($bordro->goruntuleme_tarihi));?></td>
                     
                      
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                   
                </table>
              </div>
             
            </div>
             

<?php endif; ?>





</section>
            </div>