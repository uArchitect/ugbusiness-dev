<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
        </h1>
    </section>
    <section class="content">
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $grafik_verileri['toplam']; ?></h3>
                <p>Toplam Senet</p>
            </div>
            <div class="icon"><i class="fas fa-file-invoice-dollar"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $grafik_verileri['gecen']; ?></h3>
                <p>Vadesi Geçenler</p>
            </div>
            <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $grafik_verileri['yaklasan_7_gun']; ?></h3>
                <p>Yaklaşanlar (1-7 Gün)</p>
            </div>
            <div class="icon"><i class="fas fa-bell"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $grafik_verileri['diger']; ?></h3>
                <p>Diğer (Vadesi Uzak)</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
        </div>
    </div>
</div>
 
<div class="row">
    <div class="col-12">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Tüm Senetler</h3>
                <div class="card-tools">
                    <a href="<?php echo base_url('senet/ekle'); ?>" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-plus"></i> Yeni Senet Ekle
                    </a>
                    <form action="<?php echo base_url('senet'); ?>" method="get" class="form-inline d-inline-block">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="q" class="form-control" placeholder="Müşteri Adı veya Tel No Ara..." value="<?php echo isset($search_term) ? html_escape($search_term) : ''; ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Müşteri Adı Soyadı</th>
                            <th>İletişim Numarası</th>
                            <th>Vade Tarihi</th>
                            <th>Durum</th>
                            <th style="width: 150px;" class="text-right">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($senetler)): ?>
                            <?php foreach ($senetler as $senet): ?>
                                <?php $durum = get_senet_durum($senet->senet_tarihi); ?>
                                <tr class="<?php echo $durum->satir_class; ?>">
                                    <td><?php echo $senet->id; ?></td>
                                    <td><?php echo html_escape($senet->musteri_adsoyad); ?></td>
                                    <td><?php echo html_escape($senet->iletisim_numarasi); ?></td>
                                    <td><?php echo date('d.m.Y', strtotime($senet->senet_tarihi)); ?></td>
                                    <td><?php echo $durum->kalan_gun_metni; ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo base_url('senet/duzenle/' . $senet->id); ?>" class="btn btn-sm btn-info" title="Düzenle"><i class="fas fa-edit"></i></a>
                                        <a href="#" data-url="<?php echo base_url('senet/sil/' . $senet->id); ?>" class="btn btn-sm btn-danger btn-delete" title="Sil"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">Arama kriterlerinize uygun kayıt bulunamadı.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                        </section>
                        </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
   
    // SweetAlert ile silme onayı
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu işlem geri alınamaz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
});
</script>