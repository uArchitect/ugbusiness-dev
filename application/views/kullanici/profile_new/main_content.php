<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="content-wrapper " style="    padding-top: 5px;" >
    <!-- Content Header (Page header) -->
     
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="padding:0px!important;">
        <div class="row">
          <div class="col-md-3 p-0">

            <!-- Profile Image -->
            <div class="card card-dark card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src=" <?=base_url("uploads/".$data_kullanici->kullanici_resim)?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$data_kullanici->kullanici_ad_soyad?></h3>

                <p class="text-muted text-center" style="margin-top:-5px!important;display:block"><?=$data_kullanici->kullanici_unvan?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Mail Adresi</b> <a class="float-right"><?=$data_kullanici->kullanici_email_adresi?></a>
                  </li>
                  <li class="list-group-item">
                    <b>İletişim Numarası</b> <a class="float-right"><?=$data_kullanici->kullanici_bireysel_iletisim_no?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Departman</b> <a class="float-right"><?=$data_kullanici->departman_adi?> Departmanı</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-dark btn-block"><b>Kullanıcı Bilgilerini Düzenle</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kullanıcı Hakkında Genel Bilgiler </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Çalışma Hayatı</strong>

                <p class="text-muted">
                  İşe Giriş :<?=date("d.m.Y",strtotime($data_kullanici->kullanici_ise_giris_tarihi))?>
                  İşten Ayrılma: (*Devam Ediyor)
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Adres</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9 pr-0">
            <div class="card">
              <div class="card-header p-2"  >
                <ul class="nav nav-pills">
                <li class="nav-item" style="flex: 1;"><a class="nav-link btn btn-default"  href="#activity" data-toggle="tab">
                  <i class="nav-icon fas fa-folder" style="font-size:13px"></i>  
                  Özlük Dosyası</a></li>
                  <li class="nav-item" style="flex: 1;"><a class="nav-link active btn btn-default"  href="#activity" data-toggle="tab">
                  <i class="nav-icon fas fa-car" style="font-size:13px"></i>  
                  Araç Bilgisi</a></li>
                  <li class="nav-item" style="flex: 1;"><a class="nav-link btn btn-default" style="margin-left: 6px;" href="#timeline" data-toggle="tab">
                  <i class="nav-icon 	fas fa-people-arrows " style="font-size:13px"></i>  
                  Satış Rapor</a></li>
                  <li class="nav-item" style="flex: 1;"><a class="nav-link btn btn-default" style="margin-left: 6px;" href="#timeline" data-toggle="tab">
                  <i class="nav-icon 	fas fa-people-arrows " style="font-size:13px"></i>  
                  Eğitim Rapor</a></li>
                  <li class="nav-item" style="flex: 1;"><a class="nav-link btn btn-default" style="margin-left: 6px;"  href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-phone " style="font-size:13px"></i>  
                  Talep Rapor</a></li>
                  <li class="nav-item" style="flex: 1;"><a class="nav-link btn btn-default" style="margin-left: 6px;"  href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-calendar " style="font-size:13px"></i>  
                  Mesai Bilgileri</a></li>
                  <li class="nav-item" style="flex: 1;"><a class="nav-link btn btn-default" style="margin-left: 6px;"  href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-award " style="font-size:13px"></i>  
                  Envanter</a></li>
                  <li class="nav-item" style="flex: 1;"><a class="nav-link btn btn-default" style="margin-left: 6px;"  href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-envelope " style="font-size:13px"></i>  
                  İletişim</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body" style="    padding: 0px;!important">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">

                  <?php
                  $this->load->view($subpage);
                  ?>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>