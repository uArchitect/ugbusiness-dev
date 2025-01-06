<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-1 mobil-genislik" style="padding-top:0px;margin-top:-4px;      margin-right: -4px;">





<div style="background: #3d3a3a;
    height: 40px;
    width: 100%;
    color: #ffffff;
    border-top: 1px solid #1b1c21;
    text-align: right;
    /* background: linear-gradient(181deg, rgba(2, 0, 36, 1) 0%, rgb(24 24 24) 35%, rgb(24 24 24) 100%); */
    padding-top: 9px;
    border-bottom: 2px solid #181818;" class="<?=($yemek->yemek_detay=="")?"d-none":""?>">

<b>YEMEK MENÜ : </b>
<?php
    $items = explode('#', $yemek->yemek_detay);
    $lastItem = end($items);  
    
    foreach ($items as $item) {
        echo $item;
        if ($item !== $lastItem) {
            echo " , ";  
        }else{
           echo "  ";
        }
    }
?>
<b> YEMEK SAATİ : </b> 12:00 &nbsp;&nbsp;
</div>
<div tabindex="-1" class=" d-none d-sm-block" style="position: relative; width: 100%;  height: 1051px; padding-top: 50.0000%;
 padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16);  margin-bottom: 0.9em; overflow: hidden;
 border-radius: 8px; will-change: transform;">
  <iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
    src="https://www.canva.com/design/DAGT7hcPHQc/tL9MP00uO79UoQqzpAqasw/view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
  </iframe>
</div> 

 

</div>

<style>
  .grid-container {
    display: flex;
    justify-content: center;
    align-items: center;
    
  }

  .grid {
    display: grid;
    grid-template-columns: repeat(13, 1fr); /* 13 sütun */
    grid-template-rows: repeat(19, 1fr);   /* 19 satır */
    gap: 1px; /* Butonlar arası boşluk */
    width: 100%;
    height: 100%;
  }

  .grid-button {
    width: 100%;
    height: 100%;
    padding: 10px 3px 10px 3px;
    background-color: #ffffff;
    border: 0px solid whitesmoke;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .grid-button:hover {
    background-color: #f0f0f0; /* Hover rengi */
  }

  main footer{
    display:none!important;
  }
</style>
