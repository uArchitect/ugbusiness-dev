<?php $this->load->view('siparis/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-ban card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    İptal Edilen Sipariş Ürünleri
                  </h3>
                  <small class="card-header-subtitle">İptal edilen sipariş ürünlerini görüntüle</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('siparis/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <div class="table-responsive">
              <table id="example1" class="table table-siparis table-bordered table-striped nowrap">
                <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Cihaz Adı</th>
                    <th>Müşteri / Merkez Bilgisi</th>
                    <th>İl İlçe</th>
                    <th>Satış Fiyatı</th>
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Fatura Tutarı</th>  
                    <th>Takas Bedeli</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($urunler as $urun) : ?>
                    <tr>
                      <td><?=$urun->siparis_urun_id?></td>
                      <td><?=$urun->urun_adi?></td> 
                      <td>
                        <b><i class="far fa-user-circle" style="margin-right:5px;opacity:1"></i> 
                        <?=$urun->musteri_ad?> / <?=$urun->merkez_adi?> / <span style="font-weight:normal"><?=$urun->musteri_iletisim_numarasi?></span></b>
                        <br>
                        <span class="text-danger"><?=$urun->siparis_iptal_nedeni?></span>
                      </td>
                      <td>
                        <i class="fas fa-map-marker-alt" style="margin-right:5px;opacity:1"></i> 
                        <?=$urun->sehir_adi?> / <?=$urun->ilce_adi?> 
                      </td>
                      <td><?=number_format($urun->satis_fiyati,2)." ₺"?></td>
                      <td><?=number_format($urun->kapora_fiyati,2)." ₺"?></td>
                      <td><?=number_format($urun->pesinat_fiyati,2)." ₺"?></td>
                      <td><?=number_format($urun->fatura_tutari,2)." ₺"?></td>
                      <td><?=number_format($urun->takas_bedeli,2)." ₺"?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Cihaz Adı</th>
                    <th>Müşteri / Merkez Bilgisi</th>
                    <th>İl İlçe</th>
                    <th>Satış Fiyatı</th>
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Fatura Tutarı</th>  
                    <th>Takas Bedeli</th> 
                  </tr>
                </tfoot>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>