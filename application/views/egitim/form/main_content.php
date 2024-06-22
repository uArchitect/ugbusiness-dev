 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     
    <!-- /.content-header -->
<section class="content col col-lg-12 mt-2">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Eğitim Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($egitim)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('egitim/save').'/'.$egitim->egitim_id.'/'.$egitim->siparis_urun_no;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('egitim/save').'/'.'0'.'/'.$urunler[0]->siparis_urun_id;?>">
    <?php } ?>
    <div class="card-body">

    





<!-- ADIM 12-->
<div style="background: #f6faff;border: 2px dashed #07357a;padding-right:0px !important;" class="p-2  ">
        



 <div class="row nowrap d-flex">
 <div class="col-sm-12 invoice-col mr-1 p-0 mb-2" style="flex:1;border: 1px solid #013a8f59;background:#f6faff">
                  
                  <span style="font-weight:bold;color:#07357a;background: #d9e7f9;display: block;padding-left:5px">
                    Müşteri / Merkez Bilgileri
                  </span>
                  <address class="m-2">
                <div class="row mb-0 d-flex">

                <span class="badge bg-dark text-md p-4" style="flex:1;font-weight:500;border-radius:0px;background:#004993!important;border: 1px solid #093d7d;">
                 <i class="fa fa-user-circle" style="font-size:25px"></i><br><br> <b><?=mb_strtoupper($merkez->musteri_ad)?></b><br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                 <i class="far fa-address-card"></i>  <?=$merkez->musteri_kod?>
                 <i class="fa fa-mobile-alt " style="margin-left:11px"></i>   <?=$merkez->musteri_iletisim_numarasi?>
                
                </span> 
                 
                 </span>
                 
                 
                 <span class="badge bg-warning text-md p-4" style="flex:1;font-weight:500;border-radius:0px;color:white!important;background:#004993!important;border: 1px solid #093d7d;">
                 <i class="fa fa-building" style="font-size:25px"></i><br><br> <b><?=mb_strtoupper($merkez->merkez_adi)?></b><br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                 <i class="far fa-map"></i>  <?=$merkez->merkez_adresi?> <?=$merkez->ilce_adi?> / <?=$merkez->sehir_adi?>
    </span>
                 </span>
                 
                </div>
                 
                
     



               </address>
                </div>

    </div>
           




    

            

            <div class="timeline mb-0">
            <?php $count1 = 0;
          

         
                            foreach ($urunler as $urun) {
                             
                              $count1++;
                               ?>
          
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                    <?php 
                    if($count1>1){
                    ?>
                      <span class="time text-white p-0" >
                                    <a class="btn btn-xs btn-warning mr-1" onclick="copyPersons('<?=$urun->siparis_urun_id?>','<?=$urun->urun_adi?>')" style="margin-top:5px">   <i class="fas fa-arrow-alt-circle-down"></i>  Kişileri Aktar</a>
                                    
                                    </span>

                    <?php
                    }

                    ?>

                


                  <h3 class="timeline-header bg-dark" style="background:#002a5b!important">
                    <a href="#"><?=$urun->urun_adi?> (<?=$urun->seri_numarasi?>)</a> <?=$urun->urun_aciklama?>
                  </h3>
                  <div class="timeline-body"  id="adSoyadContainer<?=$urun->siparis_urun_id?>"> 
               
                  <?php 
                  if(!empty($egitim)){
                    $kursiyerler = json_decode($egitim->kursiyerler,true);
                  }else{
                    $kursiyerler = ["","","","",""];
                  }
              
                   
                   $count = 0;
                
              
                 
                    foreach ($kursiyerler as $kursiyer) {
                      $count++;
                 
                        $uniqueid = uniqid();
                        ?>
                          <div id="row<?=$uniqueid?>">
                            <i class="fas fa-user text-dark <?=($count != 1) ? "mt-3" : ""?> mb-1"></i><b> Kursiyer Ad Soyad</b> (Zorunlu) :</span> 
                            <div class="input-group">
                              <input type="text" required name="urun<?=$urun->siparis_urun_id?>[]" value="<?=$kursiyer?>" class="form-control" placeholder="Ad Soyad Giriniz - <?=$urun->urun_adi?>">
                                              
                              <div class="input-group-append">
                              <a class="btn btn-danger" onclick="deleteRow('<?=$uniqueid?>');"><i class="fas fa-times"></i> İptal</a>
                              </div>
                              </div>
                          </div>
  
                        <?php
                      }
                    
                 




                   ?>
                 
               
             
                 
                
                  </div>
                <div class="p-2">
                <a class="btn btn-success d-block p-2" style=" border: 2px dotted #6cbd6b;   color: #126503;background: #dfffde;width:100%" onclick="addNewInput('<?=$urun->urun_adi?>','<?=$urun->siparis_urun_id?>')"><i class="fa fa-plus-circle"></i> Yeni Kişi Ekle (<?=$urun->urun_adi?> Eğitimi)</a>
               
                </div> 

                </div>
              </div>
    
            <?php
                            }   
                        ?>



 




          </div>
            </div>  
             <!-- ADIM 12-->









 
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("egitim")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>



            
<script>
  

  function copyPersons(id,urun_adi){
    var adSoyadContainerDivs = document.querySelectorAll('[id^="adSoyadContainer"]');
    if (adSoyadContainerDivs.length > 0) {
     
      var firstAdSoyadContainerDiv = adSoyadContainerDivs[0];
  
     
      var inputElements = firstAdSoyadContainerDiv.querySelectorAll('input');
  
      document.getElementById("adSoyadContainer"+id).innerHTML = '';
      inputElements.forEach(function(input) {
        if(input.value.trim() != ""){
          document.getElementById("adSoyadContainer"+id).appendChild(addNewInput(urun_adi,id,input.value));
     
        }
       
      });
  } else {
      console.log("adSoyadContainer ile başlayan id'ye sahip div bulunamadı.");
  }
  }
  
    function generateUniqueID() {
       var timestamp = new Date().getTime();
  
       var randomNumber = Math.floor(Math.random() * 10000);
  
    
      var uniqueID = timestamp + '-' + randomNumber;
  
      return uniqueID;
  }
  
      function deleteRow(id){
        var divToBeRemoved = document.getElementById("row"+id);
        divToBeRemoved.remove();
      }
  
      function addNewInput(urun_adi,urun_id,val="") {
        var inputCounter =  document.getElementById("adSoyadContainer"+urun_id).getElementsByTagName("input").length;
          
          var newDiv = document.createElement("div");
          newDiv.className = "timeline-body";
          var uid = generateUniqueID();
          newDiv.id = "row"+uid;
          var div1 = document.createElement("div");
          div1.className = "input-group";
  
          var div2 = document.createElement("div");
          div2.className = "input-group-append";
  
          var button_delete = document.createElement("a");
          button_delete.className = "btn btn-danger";
  
         
          var deleteIcon = document.createElement("i");
          deleteIcon.className = "fas fa-times";
  
  
          var deleteText = document.createElement("span");
          deleteText.innerHTML =  " İptal";
  
        
  
          var newIcon = document.createElement("i");
          newIcon.className = "fas fa-user text-dark mt-3";
  
         
          var newLabel = document.createElement("b");
          newLabel.innerHTML =  " Kursiyer Ad Soyad";
  
          var newLabel2 = document.createElement("span");
          newLabel2.innerHTML =  " (Zorunlu) :";
  
          var newInput = document.createElement("input");
          newInput.type = "text";
          newInput.required = true;
          newInput.name = "urun"+urun_id+"[]";
          newInput.className = "form-control";
          newInput.placeholder ="Ad Soyad Giriniz - "+urun_adi;
          if(val!=""){
            newInput.value = val;
          }
          button_delete.appendChild(deleteIcon);
          button_delete.appendChild(deleteText);
  
  
          button_delete.addEventListener("click", function() {
              deleteRow(uid);
          });
  
          div1.appendChild(newInput);
  
          div2.appendChild(button_delete);
          div1.appendChild(div2);
  
   
          newDiv.appendChild(newIcon);
          newDiv.appendChild(newLabel);
          newDiv.appendChild(newLabel2);
          newDiv.appendChild(div1);
  
      
  
  
          if(val!=""){
            return newDiv;
          }else{
            document.getElementById("adSoyadContainer"+urun_id).appendChild(newDiv);
     
          }
  
          
      }
  </script>