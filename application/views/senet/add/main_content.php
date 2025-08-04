<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Senet Bilgileri</h3>
                    </div>
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <form role="form" action="<?php echo base_url('senet/ekle'); ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="musteri_adsoyad">Müşteri Ad Soyad</label>
                                <input type="text" class="form-control" id="musteri_adsoyad" name="musteri_adsoyad" placeholder="Müşteri adını ve soyadını giriniz">
                            </div>
                            <div class="form-group">
                                <label for="iletisim_numarasi">İletişim Numarası</label>
                                <input type="text" class="form-control" id="iletisim_numarasi" name="iletisim_numarasi" placeholder="İletişim numarasını giriniz">
                            </div>
                            <div class="form-group">
                                <label for="senet_tarihi">Senet Tarihi</label>
                                <input type="date" class="form-control" id="senet_tarihi" name="senet_tarihi">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>