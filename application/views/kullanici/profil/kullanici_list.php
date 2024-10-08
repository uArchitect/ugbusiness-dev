<div class="col-md-2 p-0">
    <div class="card card-default" style="max-height: 865px; border-radius:0px; border-right:1px solid #dbdbdb; border-top: 5px solid #007bff;">
        <div class="card-header text-bold" style="color: #0065e5;">
            TÜM SİSTEM KULLANICILARI
        </div>
        <div class="card-body p-0" style="max-height: 865px; overflow-y: auto;">
            <input type="text" class="form-control" placeholder=" Kullanıcı Ara..." id="searchInput" style="width:100%;margin-bottom:0px;padding-bottom:0px;border:0px;" onkeyup="filterUsers()">
           <hr class="p-0 m-0 mt-2">
            <div id="userList">
                <?php 
                foreach ($kullanicilar as $k) {
                ?>
                    <a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$k->kullanici_id")?>" class="btn user-item pl-0" style="     width: -webkit-fill-available; border-bottom:1px solid #e7e7e7;">
                        <div class="row">
                            <div class="col" style="max-width:60px;">
                                <img src="https://ugbusiness.com.tr/uploads/<?=$k->kullanici_resim?>" style="object-fit:cover;max-width:50px;max-height:50px;border: 3px solid #0060c7;background:black" alt="user-avatar" class="img-circle img-fluid">
                            </div>
                            <div class="col text-left">
                                <span style="font-weight: 500; display:block"><?=$k->kullanici_ad_soyad?></span>
                                <span style="font-weight: 300; display:block">
                                    <i class="fa fa-bookmark-o" style="color:gray"></i>    
                                    <?=$k->kullanici_unvan?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
function filterUsers() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const userItems = document.querySelectorAll('.user-item');

    userItems.forEach(item => {
        const userName = item.querySelector('span').textContent.toLowerCase();
        if (userName.includes(filter)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>