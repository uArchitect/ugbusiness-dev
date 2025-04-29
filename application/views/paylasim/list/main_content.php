 
<?php 

date_default_timezone_set('Europe/Istanbul');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">
<div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Files</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Kampanya / Paylaşım Başlık</th>
                    <th>Paylaşım Tarihi</th>
                    <th><img style="width:20px" src="https://ugbusiness.com.tr/assets/dist/img/icon_instagram.png"> Instagram</th>
                    <th><img style="width:20px" src="https://ugbusiness.com.tr/assets/dist/img/icon_facebook.png"> Facebook</th>
                    <th><img style="width:20px" src="https://cdn.iconscout.com/icon/free/png-256/free-youtube-logo-icon-download-in-svg-png-gif-file-formats--social-media-70-flat-icons-color-pack-logos-432560.png"> Youtube</th>
                    <th><img style="width:20px" src="https://cdn0.iconfinder.com/data/icons/social-network-flat-4/512/whatsapp_icon-512.png"> Whatsapp</th>
                    <th>Website</th>
                    <th>SMS</th> 
                  </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($paylasim_data as $data) {
                 ?>
                  <tr>
                    <td><?=$data->paylasim_adi?></td>
                    <td><?=date("d.m.Y H:i",strtotime($data->paylasim_tarihi))?></td>
                    <td>
                      <div class="custom-control custom-checkbox">
                         
                          <?php 
                          if($data->instagram == 0){
                            ?>

                  <a type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Beklemede</a>


                           
                                                
                            <?php
                          }else{
                            ?>
                           <a type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-check"></i> Yayınlandı</a>
                            <?php
                          }
                          ?>
                         
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        
                          <?php 
                          if($data->facebook == 0){
                            ?>
                              <input class="custom-control-input custom-control-input-<?=$data->facebook == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox2<?=$data->paylasim_id?>" <?=$data->facebook == 1 ? 'checked=""' : ''?>>
                            <label for="customCheckbox2<?=$data->paylasim_id?>" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                                                
                            <?php
                          }else{
                            ?>
                              <input class="custom-control-input custom-control-input-<?=$data->facebook == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox2<?=$data->paylasim_id?>" <?=$data->facebook == 1 ? 'checked=""' : ''?>>
                <label for="customCheckbox2<?=$data->paylasim_id?>" class="custom-control-label text-success" style="font-weight: 400;"> Yayınlandı </label>
                                          
                            <?php
                          }
                          ?>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                         
                          <?php 
                          if($data->youtube == 0){
                            ?>
                             <input class="custom-control-input custom-control-input-<?=$data->youtube == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox3<?=$data->paylasim_id?>" <?=$data->youtube == 1 ? 'checked=""' : ''?>>
                            <label for="customCheckbox3<?=$data->paylasim_id?>" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                                                
                            <?php
                          }else{
                            ?>
                             <input class="custom-control-input custom-control-input-<?=$data->youtube == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox3<?=$data->paylasim_id?>" <?=$data->youtube == 1 ? 'checked=""' : ''?>>
                <label for="customCheckbox3<?=$data->paylasim_id?>" class="custom-control-label text-success" style="font-weight: 400;"> Yayınlandı </label>
                                          
                            <?php
                          }
                          ?>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                         
                          <?php 
                          if($data->whatsapp == 0){
                            ?>
                             <input class="custom-control-input custom-control-input-<?=$data->whatsapp == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox4<?=$data->paylasim_id?>"  <?=$data->whatsapp == 1 ? 'checked=""' : ''?>>
                            <label for="customCheckbox4<?=$data->paylasim_id?>" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                                                
                            <?php
                          }else{
                            ?>
                             <input class="custom-control-input custom-control-input-<?=$data->whatsapp == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox4<?=$data->paylasim_id?>"  <?=$data->whatsapp == 1 ? 'checked=""' : ''?>>
                <label for="customCheckbox4<?=$data->paylasim_id?>" class="custom-control-label text-success" style="font-weight: 400;"> Yayınlandı </label>
                                          
                            <?php
                          }
                          ?>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                          
                          <?php 
                          if($data->website == 0){
                            ?>
                            <input class="custom-control-input custom-control-input-<?=$data->website == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox5<?=$data->paylasim_id?>"  <?=$data->website == 1 ? 'checked=""' : ''?>>
                            <label for="customCheckbox5<?=$data->paylasim_id?>" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                                                
                            <?php
                          }else{
                            ?>
                            <input class="custom-control-input custom-control-input-<?=$data->website == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox5<?=$data->paylasim_id?>"  <?=$data->website == 1 ? 'checked=""' : ''?>>
                <label for="customCheckbox5<?=$data->paylasim_id?>" class="custom-control-label text-success" style="font-weight: 400;"> Yayınlandı </label>
                                          
                            <?php
                          }
                          ?>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                         
                          <?php 
                          if($data->sms == 0){
                            ?>
                             <input class="custom-control-input custom-control-input-<?=$data->sms == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox6<?=$data->paylasim_id?>"  <?=$data->sms == 1 ? 'checked=""' : ''?>>
                            <label for="customCheckbox6<?=$data->paylasim_id?>" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                                                
                            <?php
                          }else{
                            ?>
                             <input class="custom-control-input custom-control-input-<?=$data->sms == 1 ? 'success' : 'danger'?>" type="checkbox" id="customCheckbox6<?=$data->paylasim_id?>"  <?=$data->sms == 1 ? 'checked=""' : ''?>>
                <label for="customCheckbox6<?=$data->paylasim_id?>" class="custom-control-label text-success" style="font-weight: 400;"> Yayınlandı </label>
                                          
                            <?php
                          }
                          ?>
                        </div>
                      </td>
                  </tr>
                 <?php
                }
                ?>
                     </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
</section>
            </div>