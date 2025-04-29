 
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
                    <td><?=date("d.m.Y h:i",strtotime($data->paylasim_tarihi))?></td>
                    <td>
                      <div class="custom-control custom-checkbox">
                          <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox1" <?=$data->instagram == 0 ? 'checked=""' : ''?>>
                          <label for="customCheckbox1" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                    
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                          <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox2" <?=$data->facebook == 0 ? 'checked=""' : ''?>>
                          <label for="customCheckbox2" class="custom-control-label" style="font-weight: 400;"> Beklemede</label>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                          <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox3" <?=$data->youtube == 0 ? 'checked=""' : ''?>>
                          <label for="customCheckbox3" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                          <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4"  <?=$data->whatsapp == 0 ? 'checked=""' : ''?>>
                          <label for="customCheckbox4" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                          <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox5"  <?=$data->website == 0 ? 'checked=""' : ''?>>
                          <label for="customCheckbox5" class="custom-control-label" style="font-weight: 400;"> Beklemede  </label>
                        </div>
                      </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                          <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox6"  <?=$data->sms == 0 ? 'checked=""' : ''?>>
                          <label for="customCheckbox6" class="custom-control-label" style="font-weight: 400;"> Beklemede </label>
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