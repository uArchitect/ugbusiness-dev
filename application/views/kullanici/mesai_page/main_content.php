<?php 
 $api_url = "https://ugbusiness.com.tr/api/tv_api";
                    $response = @file_get_contents($api_url);

?>

<div class="content-wrapper" style="padding-top:8px"> 
<section class="content text-md">
 <div class="row">
  <div class="col-md-12">
    <div class="content content-fixed p-1">
      <div class="pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row g-2">
          <div class="col-lg-6">
            <div class="card" style="border:1px solid #031e49">
              <div class="card-header d-sm-flex justify-content-between bd-b-0 pd-t-20 pd-b-0" style="height:40px;margin-bottom:15px; background:black">
                <div class="mg-b-10 mg-sm-b-0" style="margin-top:-10px;margin-bottom:10px;margin-left:-10px">
                  <h6 class="mg-b-5" style="margin:5px;color:white;font-weight:900;">Yönetim Departmanı Personel Mesai Bilgileri</h6>
                </div>
              </div>

              <div class="card-body" style="margin-top:-15px; padding-left:6px; padding-right:3px; padding-top:2px; padding-bottom:5px">
                <div class="chart-fifteen" style="min-height:213px; max-height:505px; padding-bottom:0px">
                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" id="personel-listesi">
                    
                    <?php 
                   
                   
                        $json = json_decode($response, true);

                            $data = $json["data"];
                            $i = 0;

                            foreach ($data as $personel) {
                              if($personel["kullanici_departman_id"] != 1){
                                continue;
                              }
                                if ($i % 9 === 0) {
                                    if ($i > 0) echo '</div>';  
                                    echo '<div class="btn-group mr-2" style="width:-webkit-fill-available;" role="group">';
                                }

                                $renk = match($personel["durum_renk"]) {
                                    "green"  => "green",
                                    "orange" => "#fa6402",
                                    "blue"   => "#0000ff",
                                    "black"  => "#000000",
                                    default  => "#bb0707"
                                };

                                $yaziRenk = $personel["durum_renk"] === "orange" ? "#522401" : "#fff";
                                ?>

                                <button type="button" class="btn btn-secondary custombtn"
                                  style="width:100px; height:65px; margin:1px; min-width:82px; max-width:82px;
                                         line-height:12px; padding:5px; border-radius:3px;
                                         border:2px solid black; background-color:<?= $renk ?>; color:<?= $yaziRenk ?>;">
                                  <span style="font-size:7px">
                                    <b style="font-size:10px">
                                      <?= htmlspecialchars($personel["kullanici_ad_soyad"]) ?><br>
                                      <span style="opacity:1;font-weight:400;font-size:11px">
                                        <?= $personel["mesai_baslama_saati"] ?>
                                      </span>
                                    </b>
                                  </span>
                                </button>

                                <?php
                                $i++;
                            }

                            echo '</div>';  
                      
                   
                    ?>
                    
                  </div>
                </div>
              </div>

            </div>







 <div class="col-lg-6">
            <div class="card" style="border:1px solid #031e49">
              <div class="card-header d-sm-flex justify-content-between bd-b-0 pd-t-20 pd-b-0" style="height:40px;margin-bottom:15px; background:black">
                <div class="mg-b-10 mg-sm-b-0" style="margin-top:-10px;margin-bottom:10px;margin-left:-10px">
                  <h6 class="mg-b-5" style="margin:5px;color:white;font-weight:900;">Bilgi İşlem Departmanı Personel Mesai Bilgileri</h6>
                </div>
              </div>

              <div class="card-body" style="margin-top:-15px; padding-left:6px; padding-right:3px; padding-top:2px; padding-bottom:5px">
                <div class="chart-fifteen" style="min-height:213px; max-height:505px; padding-bottom:0px">
                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" id="personel-listesi">
                    
                    <?php 
                   
                   
                        $json = json_decode($response, true);

                            $data = $json["data"];
                            $i = 0;

                            foreach ($data as $personel) {
                              if($personel["kullanici_departman_id"] != 14){
                                continue;
                              }
                                if ($i % 9 === 0) {
                                    if ($i > 0) echo '</div>';  
                                    echo '<div class="btn-group mr-2" style="width:-webkit-fill-available;" role="group">';
                                }

                                $renk = match($personel["durum_renk"]) {
                                    "green"  => "green",
                                    "orange" => "#fa6402",
                                    "blue"   => "#0000ff",
                                    "black"  => "#000000",
                                    default  => "#bb0707"
                                };

                                $yaziRenk = $personel["durum_renk"] === "orange" ? "#522401" : "#fff";
                                ?>

                                <button type="button" class="btn btn-secondary custombtn"
                                  style="width:100px; height:65px; margin:1px; min-width:82px; max-width:82px;
                                         line-height:12px; padding:5px; border-radius:3px;
                                         border:2px solid black; background-color:<?= $renk ?>; color:<?= $yaziRenk ?>;">
                                  <span style="font-size:7px">
                                    <b style="font-size:10px">
                                      <?= htmlspecialchars($personel["kullanici_ad_soyad"]) ?><br>
                                      <span style="opacity:1;font-weight:400;font-size:11px">
                                        <?= $personel["mesai_baslama_saati"] ?>
                                      </span>
                                    </b>
                                  </span>
                                </button>

                                <?php
                                $i++;
                            }

                            echo '</div>';  
                      
                   
                    ?>
                    
                  </div>
                </div>
              </div>

            </div>







            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
