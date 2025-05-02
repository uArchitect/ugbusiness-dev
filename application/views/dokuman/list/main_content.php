 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">






<div class="row">
<div class="col-md-2">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Döküman Kategorileri</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" >
 
  <?php
    
   

    $categories = kategoriler();

     
    function buildCategoryTree($categories, $parentId = 0) {
        $tree = [];
    
        foreach ($categories as $category) {
            if ($category->dokuman_kategori_ust_kategori_id == $parentId) {
                $category->children = buildCategoryTree($categories, $category->dokuman_kategori_id);
                $tree[] = $category;
            }
        }
    
        return $tree;
    }
    
     
    $categoryTree = buildCategoryTree($categories);
    
   
    function displayCategoryTree($categories, $parentName = "") {
        echo '<ul style="margin-left:-30px">';
    
        foreach ($categories as $category) {
          if ($parentName || $category->dokuman_kategori_ust_kategori_id != 0) {
       

            $icon = ($category->children) ? '	fas fa-folder-open text-warning' : 'far fa-file-alt text-red';
            $style = ($category->children) ? 'font-weight:550' : 'font-weight:normal';
            $categoryName = $parentName ?  $category->dokuman_kategori_adi : $category->dokuman_kategori_adi;

            echo '<a href="'.base_url("dokuman/kategori/$category->dokuman_kategori_id").'" style="color:black"><li style="cursor:pointer; margin-top:5px;  list-style-type:none; '.$style.'"><span style="margin-right:5px" class="' . $icon . '" ></span>'. $categoryName;
    
            if (!empty($category->children)) {
                displayCategoryTree($category->children, $categoryName);
            }
    
            echo '</li></a>';

          } else {
            // If the category is the root category and should not be displayed, skip it
            displayCategoryTree($category->children, $parentName);
        }
        }
    
        echo '</ul>';
    }
    
  
    displayCategoryTree($categoryTree);
    
    ?>



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

 


          <div class="card card-dark col-md-10" style="padding:0px"  >
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Dokuman Yönetimi - 
              <span class="adana">
                <?=($dokuman_kategori != null) ? $dokuman_kategori->dokuman_kategori_adi : "TÜM BELGELER"?>
              </span>
            
            </h3>
                <a href="<?=base_url("dokuman/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1dokuman" class="table table-bordered table-striped text-sm nowrap">
                  <thead>
                  <tr>
                  <th style="width: 215px;">Döküman İşlemleri</th> 
                    <th style="width: 110px;">Dokuman No</th>
                    <th>Dokuman Adı</th>
                    <th style="min-width: 110px;">Yükleyen</th>
                    <th style="min-width: 110px;">Geçerlilik Tarihi</th>
                  
                   
                
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($dokumanlar as $dokuman) : ?>
        
                    <tr>

                    <td style="vertical-align:middle !important">
                          <a href="<?=site_url("dokuman/revizyon_goruntule/$dokuman->dokuman_id")?>" target="_blank" type="button" class="btn btn-dark btn-xs"><i class="fa fa-eye " style="font-size:12px" aria-hidden="true"></i> Görüntüle</a>
                           <a href="<?=site_url("dokuman/duzenle/$dokuman->dokuman_id")?>" type="button" class="btn btn-dark btn-xs"><i class="fa fa-pen text-warning" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('dokuman/sil/').$dokuman->dokuman_id?>');" class="btn btn-dark btn-xs"><i class="fa fa-times text-danger" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>


                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$dokuman->dokuman_belge_no?> 
                    </td>

                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <a style="text-decoration:underline" href="<?=site_url("dokuman/revizyon_goruntule/$dokuman->dokuman_id")?>" target="_blank"><?=$dokuman->dokuman_adi?> </a>
                    </td>
                     
                      <td>
                      <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/$dokuman->kullanici_resim")?>"> 
                             
                      <b><?=$dokuman->kullanici_ad_soyad?></b> / <?=$dokuman->kullanici_unvan?></td>
                     
                     <?php 
                     if(strpos($dokuman->dokuman_adi,"CE ") || strpos($dokuman->dokuman_adi,"UYGUNLUK") || strpos($dokuman->dokuman_adi,"SO-") || strpos($dokuman->dokuman_adi,"SOI")){
?>
 <td style="<?php
                      $gun = gunSayisiHesapla(date('d.m.Y',strtotime($dokuman->dokuman_yururluk_tarihi)),date("d.m.Y"));
                      if($gun < 10){echo "background: #ff0000; color: #ffffff;";}
                      else if($gun < 30){echo "background: #ffeb00;";}
                      else if($gun < 60){echo "background: #fffbcc;";}
                      ?>"> 
                        <?=date('d.m.Y',strtotime($dokuman->dokuman_yururluk_tarihi));?>

                      <?php 
                        if(date('Y-m-d',strtotime($dokuman->dokuman_yururluk_tarihi)) < date("Y-m-d")){
                          echo " (".$gun." gün geçti)"; 
           
                        }else{
                          echo " (".$gun." gün kaldı)"; 
           
                        }
                      ?>
                     
                    </td>
<?php
                     }else{
                      echo "<td>-</td>";
                     }
                     ?>
                    
                       
                 
                    
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->






</div>










</section>
            </div>