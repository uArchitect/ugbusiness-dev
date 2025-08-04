<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12" style="width : -webkit-fill-available;">
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Hata!</h4>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tüm Senetler</h3>
                        <div class="card-tools">
                            <form action="<?php echo base_url('senet'); ?>" method="get" class="form-inline">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="q" class="form-control pull-right" placeholder="Müşteri Adı veya Tel No Ara..." value="<?php echo html_escape($search_term); ?>">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Müşteri Ad Soyad</th>
                                    <th>İletişim Numarası</th>
                                    <th>Senet Tarihi</th>
                                    <th>Kalan Gün</th>
                                    <th style="width: 120px;">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($senetler)): ?>
                                    <?php foreach ($senetler as $senet): ?>
                                        <?php
                                            $bugun = new DateTime();
                                            $senet_tarihi = new DateTime($senet->senet_tarihi);
                                            $fark = $bugun->diff($senet_tarihi);
                                            $kalan_gun = $fark->days;
                                            $gecmisMi = $fark->invert;

                                            $class = '';
                                            if ($gecmisMi) {
                                                $class = 'danger'; // Vadesi geçenler için kırmızı
                                            } elseif (!$gecmisMi && $kalan_gun <= 3) {
                                                $class = 'warning'; // Vadesine 3 gün veya daha az kalanlar için sarı
                                            }
                                        ?>
                                        <tr class="<?php echo $class; ?>">
                                            <td><?php echo $senet->id; ?></td>
                                            <td><?php echo html_escape($senet->musteri_adsoyad); ?></td>
                                            <td><?php echo html_escape($senet->iletisim_numarasi); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($senet->senet_tarihi)); ?></td>
                                            <td>
                                                <?php
                                                    if ($gecmisMi) {
                                                        echo '<span class="label label-danger">Vadesi Geçti</span>';
                                                    } else {
                                                        echo $kalan_gun . ' gün';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('senet/duzenle/' . $senet->id); ?>" class="btn btn-xs btn-info">Düzenle</a>
                                                <a href="<?php echo base_url('senet/sil/' . $senet->id); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Bu senedi silmek istediğinizden emin misiniz?');">Sil</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Kayıt bulunamadı.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                         <a href="<?php echo base_url('senet/ekle'); ?>" class="btn btn-primary">Yeni Senet Ekle</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>