<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-wrapper" style="padding-top:0px;background:#f4f4f4;padding-right:0px;">
  <section class="content p-0" style="margin-bottom:-120px;"> 
    <div class="row" style="flex-wrap:nowrap;">
      <?php $this->load->view("kullanici/profil/kullanici_list"); ?>
      <?php $this->load->view("kullanici/profil/kullanici_top_bar"); ?>
      <div class="card col p-0" style="    width: -webkit-fill-available;border-radius:0px;border-bottom:1px solid #dbdbdb;border-right:1px solid #dbdbdb; margin-top:-16px;height: 738px;">
        <!-- CONTENT -->
        <?php $this->load->view("kullanici/profil/$onpage"); ?>
        <!-- CONTENT -->
      </div>
    </div>
    <?php $this->load->view("kullanici/profil/kullanici_right_bar"); ?>   
  <section>
</div>
<style>
  .card{
    box-shadow: none;
  }
  .btn-default:hover{
    background:#007bff!important;
    color:white;
  }
  .btn-default:active{
    scale:0.9;
  }
</style>