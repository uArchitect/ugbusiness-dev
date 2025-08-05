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
    <div class="col-md-12">
         <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Senet Durum Dağılımı
                </h3>
            </div>
            <div class="card-body">
                <div style="height: 300px; position: relative;">
                    <canvas id="senetDurumPieChart"></canvas>
                </div>
            </div>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Grafik verisini PHP'den al
    const grafikVerileri = <?php echo json_encode($grafik_verileri); ?>;
    if (document.getElementById('senetDurumPieChart')) {
        const ctx = document.getElementById('senetDurumPieChart').getContext('2d');
        const senetDurumPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [ 'Vadesi Geçenler', 'Yaklaşanlar (1-7 Gün)', 'Yaklaşanlar (8-30 Gün)', 'Diğer (30+ Gün)'],
                datasets: [{
                    label: 'Senet Sayısı',
                    data: [ grafikVerileri.gecen, grafikVerileri.yaklasan_7_gun, grafikVerileri.yaklasan_30_gun, grafikVerileri.diger ],
                    backgroundColor: [ 'rgba(220, 53, 69, 0.8)', 'rgba(255, 193, 7, 0.8)', 'rgba(23, 162, 184, 0.8)', 'rgba(40, 167, 69, 0.8)' ],
                    borderColor: [ '#dc3545', '#ffc107', '#17a2b8', '#28a745' ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right' } }
            }
        });
    }

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