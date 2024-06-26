 
     <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 













 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header" style="background:#00264f!important">
              <h3 class="card-title"><strong>UG Business</strong> - Müşteri Bilgileri</h3>
                <a href="<?=base_url("musteri/ekle")?>" onclick="waiting('Yeni Müşteri Ekle');" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="users_table" class="table table-bordered table-striped nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>















            </div>



            



 <style>
     .table th {
    background: #ffffff !important;
    color: #0a0a0a!important;
    padding: 10px!important;
    padding-left: 10px !important;
}
  .custom-href:hover {
        text-decoration: underline;
      }
   
 </style>





<script type="text/javascript">
    $(document).ready(function() {
        $('#users_table').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ajax": {
                "url": "<?php echo site_url('exampledata/get_users'); ?>",
                "type": "GET"
            },
            "columns": [
                { "data": 0 },
                { "data": 1 },
                { "data": 2 },
                { "data": 3 }
            ]
        });

        $('#users_table').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            window.location.href = "<?php echo site_url('users/edit/'); ?>" + id;
        });


    });
</script>
 


