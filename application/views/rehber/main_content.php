<div class="content-wrapper pr-2 mobil-genislik" style="padding-top:15px">
 

<section class="col-lg-12 connectedSortable pl-0">



<style>
  .content-wrapper>.content {
padding: 0 0rem;
}
  .bg-dark{
    background:#003675!important;
    border-radius:0px!important;

  }
  .content-wrapper{
    padding:0px!important;
  }
.card2 {
width: calc(100% / 5 - 10px);
background: #fff;
border-radius: 5px;    border: 1px solid #073773;
padding: 10px 5px;
margin:5px;
box-shadow: 0 5px 5px rgba(0, 0, 0, 0.05);
transition: all 0.4s ease;
}@media (max-width: 768px) { /* Tabletler için */
.card2 {
width: calc(100% / 2 - 10px); /* 3 sütun */
}
}

@media (max-width: 480px) { /* Telefonlar için */
.card2 {
width: calc(100% / 2 - 10px); /* 3 sütun */
}
}
.card2 .content {
width: 100%;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
text-align: center;
}
</style>

<div class="row">
<?php foreach ($kullanicilar as $kullanici) : ?>

<div class="card2">
<div class="content">
<div class="img">
<img style="border: 3px solid #ffffff; outline: 2px solid #393c3721;width:40px;height:40px;border-radius:50%; object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                      
</div>
<div class="details">
<div class="name text-bold"><?=$kullanici->kullanici_ad_soyad?></div>
  <div class="job"><?=$kullanici->kullanici_unvan?></div>
  </div>
  <div onclick="location.href='tel:<?=$kullanici->kullanici_bireysel_iletisim_no?>';" class="media-icons text-primary" style="background: #ebebeb; color: black !important; border-radius: 5px; padding: 5px 5px;">
<i class="fa fa-phone"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?>
  </div>  
</div>
</div>

<?php endforeach; ?>
</div>





   

   
</section> </div>