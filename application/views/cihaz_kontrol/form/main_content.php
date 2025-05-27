<div class="content-wrapper pt-2">
  <section>
 
  <div class="row">
    <div class="col-md-7">
      <div class="card card-dark">

  <div class="card-header text-center" style="font-size: 31px; font-weight: 500;">

  CİHAZ KONTROL FORMU

  </div>

  <div class="card-body">




 <table border="2" style=" height:40px; margin-bottom:15px;  width: -webkit-fill-available;">
        <tr>
            <td style="width:120px;border:2px solid black; text-align:center;font-weight:900">
            Cihaz Seri No:
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <input type="text" style="  height:20px;  border: 0;" name="" class="form-control" id=""></input>
          </td>
          <td style="width:120px;border:2px solid black; text-align:center;font-weight:900">
            Cihaz Seri No:
          </td>
          <td style="width:175px;padding-left:5px;border:2px solid black;">
            <input type="text" style="  height:20px;  border: 0;" name="" class="form-control" id=""></input>
          </td>
        </tr>
      </table>


  
 <div class="row mb-3">
  <div class="col pl-0">
     <table border="2" style="    width: -webkit-fill-available;">
      <?php 
        for ($i=0; $i < 10 ; $i++) { 
      ?>
        <tr>
          <td style="border:2px solid black;padding:5px;text-align:center;font-weight:900">
            <?=$i+1?>
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <?=$checklist[$i]->kontrol_form_checklist_label?>
          </td>
          <td style="border:2px solid black;padding:10px;text-align:center">
            <input type="checkbox" name="" id="">
          </td>
        </tr>
      <?php
        }
      ?>
      </table>
  </div>
<div class="col pr-2 pl-2">
     <table border="2" style="    width: -webkit-fill-available;">
      <?php 
        for ($i=10; $i < 20 ; $i++) { 
      ?>
        <tr>
            <td style="border:2px solid black;padding:5px;text-align:center;font-weight:900">
            <?=$i+1?>
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <?=$checklist[$i]->kontrol_form_checklist_label?>
          </td>
            <td style="border:2px solid black;padding:10px;text-align:center">
            <input type="checkbox" name="" id="">
          </td>
        </tr>
      <?php
        }
      ?>
      </table>
  </div>
  <div class="col pr-0">
     <table border="2" style="    width: -webkit-fill-available;">
      <?php 
        for ($i=20; $i < 30 ; $i++) { 
      ?>
        <tr>
              <td style="border:2px solid black;padding:5px;text-align:center;font-weight:900">
            <?=$i+1?>
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <?=$checklist[$i]->kontrol_form_checklist_label?>
          </td>
            <td style="border:2px solid black;padding:10px;text-align:center">
            <input type="checkbox" name="" id="">
          </td>
        </tr>
      <?php
        }
      ?>
      </table>
  </div>


 </div>




 <table border="2" style="    width: -webkit-fill-available;">
    <tr>
        <th style="width:120px;border:2px solid black;padding:10px;text-align:center">Atış Sayısı</th>
        <?php foreach ($headers as $h): ?>
            <th style=" border:2px solid black;padding:10px;text-align:center;"><?= htmlspecialchars($h['kontrol_form_baslik_adi']) ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($rows as $r): ?>
        <tr style="height:50px">
            <td style="font-weight:600;border:2px solid black;padding:20px;text-align:center"><?= htmlspecialchars($r['kontrol_form_data_row_label']) ?></td>
            <?php foreach ($headers as $h): ?>
                <td style="padding:20px;text-align:center">
                    <?= isset($data[$r['kontrol_form_data_row_id']][$h['kontrol_form_baslik_id']]) ? htmlspecialchars($data[$r['kontrol_form_data_row_id']][$h['kontrol_form_baslik_id']]) : '-' ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>







 <table border="2" style="  margin-top:15px;  width: -webkit-fill-available;">
        <tr>
            <td style="width:120px;border:2px solid black;padding:5px;text-align:center;font-weight:900">
            NOT:
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <textarea style="    border: 0;" name="" class="form-control" id=""></textarea>
          </td>
         
        </tr>
      </table>




  </div>
</div>
    </div>
  </div>


   
  </section>
</div>
 
            


