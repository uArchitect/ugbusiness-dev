 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Öneri, Şikayet Ve Talepler</h3>
                <a href="<?=base_url("bildirim/add")?>" type="button" class="btn btn-success btn-xs" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
            
                <table id="examplekullanicilar" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
                  <th>Kategori</th>
                    <th>Konu</th>
                    <th>Oluşturan Kullanıcı</th>
                    <th>Kalite / İşlem Durumu</th>
                    <th>IK / İşlem Durumu</th>
                    <th style="width: 130px;">Son Durum</th>
                    <th style="width: 100px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($bildirimler_data as $bildirim) : ?>
                      <?php $count++?>
                    <tr>
                    <td>
                      
                      <?php 
                      switch ($bildirim->bildirim_kategori) {
                        case 1:
                          echo "ÖNERİ";
                          break;
                          case 2:
                            echo "ŞİKAYET";
                            break;
                            case 3:
                              echo "TALEP";
                              break;
                        default:
                          # code...
                          break;
                      }
                      ?>
                    </td>
                      <td>
                      <?=$bildirim->bildirim_konusu?> 
                       
                        </td>
                      <td style="display: flex;">
                      <?php 
                      if($bildirim->bildirim_gizle == 1){
                        ?>
                        <button type="button" class="btn btn-block btn-danger btn-sm"><i class="fas fa-user-lock"></i> ANONİM KULLANICI</button>
                        <?php
                      }else{
                          ?>
                            <i class="fa fa-user" style="margin-right:5px;opacity:0.8"></i>
                        <?=$bildirim->kullanici_ad_soyad?> 
                       
                          <?php
                      }
                      ?>
                      
                      </td>
                      
                      <td>
                      
                      <?php 
                      switch ($bildirim->kalite_durum) {
                        case 1:
                          echo "Beklemede";
                          break;
                          case 2:
                            echo "Yönlendirildi";
                            break;
                        default:
                          # code...
                          break;
                      }
                      ?>
                    </td>
                      <td>
                      
                      <?php 
                      switch ($bildirim->ik_durum) {
                        case 1:
                          echo "Beklemede";
                          break;
                          case 2:
                            echo "İşleme Alındı";
                            break;
                        default:
                          # code...
                          break;
                      }
                      ?>
                    
                    </td>

                    <td><i class="fa fa-envelope" style="margin-right:5px;opacity:0.8"></i>
                      
                      <?php 
                      switch ($bildirim->bildirim_sonuc) {
                        case 1:
                          echo "Beklemede";
                          break;
                          case 2:
                            echo "Kalite Tarafından Yönlendirildi";
                            break;
                            case 3:
                              echo "TAMAMLANDI";
                              break;
                              case 4:
                                echo "REDDEDİLDİ";
                                break;
                        default:
                          # code...
                          break;
                      }
                      ?>
                    
                    </td>


                       
                      <td>
                     
                     
                        
                          <a href="<?=base_url("bildirim/edit/".$bildirim->bildirim_id)?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> GÖRÜNTÜLE</a>
                       
  
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>