 <?php if (!empty($altKategoriler)): ?>
    <ul class="nav nav-treeview">
        <?php foreach ($altKategoriler as $altKategori): ?>

            <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p style="font-size:15px"><?php echo $altKategori->kategori_adi; ?></p>
                </a>
                <?php $this->load->view('kategori/altKategoriler', array('ustKategoriID' => $altKategori->ID)); ?>
              </li>
 
        <?php endforeach; ?>
    </ul>
<?php endif; ?>