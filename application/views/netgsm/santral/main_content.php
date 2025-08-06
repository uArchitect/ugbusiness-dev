 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Santral Görüşme Kayıtları</h3>
                <a href="<?=base_url("departman/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Arama</th>
                    <th>Telefon Numarası</th>
                    <th>Dahili</th>
                    <th style="width: 130px;">Görüşme Tarihi</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($santral_kayitlar as $gorusme) : ?>


<?php
try {
?>
    <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 

<td>
 
<?php
  switch ($gorusme['values'][0]['direction']) {
    case '0':
      echo '<span class="badge bg-warning">Giden Arama</span>';
      break;
      case '1':
        echo '<span class="badge bg-success">Gelen Arama</span>';
        break;
        case '2':
          echo '<span class="badge bg-danger">Gelen Cevapsız Arama</span>';
          break;
          case '3':
            echo '<span class="badge bg-danger">Giden Cevapsız Arama</span>';
            break;
            case '4':
              echo '<span class="badge bg-dark">İç Arama</span>';
              break;
              case '5':
                echo '<span class="badge bg-dark">İç Cevapsız Arama</span>';
                break;
    default:
      # code...
      break;
  }

?>
 
                    </td>



                      <td><i class="fa fa-user" style="margin-right:5px;opacity:1"></i> 
                
                       <?=$gorusme['values'][0]['source']?> 
                    </td>
                    <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                
                <?=$gorusme['values'][0]['destination']?> 
             </td>
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($gorusme['values'][0]['date']));?></td>
                     
                      <td>
                    
                          <a href="<?=$gorusme['values'][0]['recording'] ?? "#"?> " target="_blank" type="button" class="btn btn-dark btn-xs <?=$gorusme['values'][0]['recording'] ?? "d-none"?> "><i class="fa fa-volume-up" style="font-size:12px" aria-hidden="true"></i> Görüşmeyi Dinle</a>
                       
                        
                      </td>
                       
                    </tr>
<?php
} catch (\Throwable $th) {
  echo "Sınır Aşıldı. Dakikada En Fazla 2 Kez Sorgulama Yapılabilir.";
}
  
  ?>



                  
                  <?php  endforeach; ?>











                  <?php $count=0; foreach ($santral_kayitlar1 as $gorusme) : ?>


<?php
try {
?>
    <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 

<td>
 
<?php
  switch ($gorusme['values'][0]['direction']) {
    case '0':
      echo '<span class="badge bg-warning">Giden Arama</span>';
      break;
      case '1':
        echo '<span class="badge bg-success">Gelen Arama</span>';
        break;
        case '2':
          echo '<span class="badge bg-danger">Gelen Cevapsız Arama</span>';
          break;
          case '3':
            echo '<span class="badge bg-danger">Giden Cevapsız Arama</span>';
            break;
            case '4':
              echo '<span class="badge bg-dark">İç Arama</span>';
              break;
              case '5':
                echo '<span class="badge bg-dark">İç Cevapsız Arama</span>';
                break;
    default:
      # code...
      break;
  }

?>
 
                    </td>



                      <td><i class="fa fa-user" style="margin-right:5px;opacity:1"></i> 
                
                       <?=$gorusme['values'][0]['source']?> 
                    </td>
                    <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                
                <?=$gorusme['values'][0]['destination']?> 
             </td>
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($gorusme['values'][0]['date']));?></td>
                     
                      <td>
                    
                          <a href="<?=$gorusme['values'][0]['recording'] ?? "#"?> " target="_blank" type="button" class="btn btn-dark btn-xs <?=$gorusme['values'][0]['recording'] ?? "d-none"?> "><i class="fa fa-volume-up" style="font-size:12px" aria-hidden="true"></i> Görüşmeyi Dinle</a>
                       
                        
                      </td>
                       
                    </tr>
<?php
} catch (\Throwable $th) {
  echo "Sınır Aşıldı. Dakikada En Fazla 2 Kez Sorgulama Yapılabilir.";
}
  
  ?>



                  
                  <?php  endforeach; ?>

<?php $count=0; foreach ($santral_kayitlar2 as $gorusme) : ?>


<?php
try {
?>
    <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 

<td>
 
<?php
  switch ($gorusme['values'][0]['direction']) {
    case '0':
      echo '<span class="badge bg-warning">Giden Arama</span>';
      break;
      case '1':
        echo '<span class="badge bg-success">Gelen Arama</span>';
        break;
        case '2':
          echo '<span class="badge bg-danger">Gelen Cevapsız Arama</span>';
          break;
          case '3':
            echo '<span class="badge bg-danger">Giden Cevapsız Arama</span>';
            break;
            case '4':
              echo '<span class="badge bg-dark">İç Arama</span>';
              break;
              case '5':
                echo '<span class="badge bg-dark">İç Cevapsız Arama</span>';
                break;
    default:
      # code...
      break;
  }

?>
 
                    </td>



                      <td><i class="fa fa-user" style="margin-right:5px;opacity:1"></i> 
                
                       <?=$gorusme['values'][0]['source']?> 
                    </td>
                    <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                
                <?=$gorusme['values'][0]['destination']?> 
             </td>
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($gorusme['values'][0]['date']));?></td>
                     
                      <td>
                    
                          <a href="<?=$gorusme['values'][0]['recording'] ?? "#"?> " target="_blank" type="button" class="btn btn-dark btn-xs <?=$gorusme['values'][0]['recording'] ?? "d-none"?> "><i class="fa fa-volume-up" style="font-size:12px" aria-hidden="true"></i> Görüşmeyi Dinle</a>
                       
                        
                      </td>
                       
                    </tr>
<?php
} catch (\Throwable $th) {
  echo "Sınır Aşıldı. Dakikada En Fazla 2 Kez Sorgulama Yapılabilir.";
}
  
  ?>



                  
                  <?php  endforeach; ?>

                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">ID</th> 
                  <th>Arama</th>
                    <th>Telefon Numarası</th>
                    <th>Dahili</th>
                    <th style="width: 130px;">Görüşme Tarihi</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>