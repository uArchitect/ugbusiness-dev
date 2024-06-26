 
     <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<div class="container">
    <h2>Users List</h2>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#users_table').DataTable({
            "processing": true,
            "serverSide": true,
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
 