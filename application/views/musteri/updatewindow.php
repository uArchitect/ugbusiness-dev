<!DOCTYPE html>
<html>
<head>
    <title>Başarı</title>
    <script type="text/javascript">




         

        function closeWindow() {
            if (window.outerWidth < 800) {
    window.close();
    }else{
        window.location.href = "<?php echo $redirect_url; ?>";
    }

        }
        window.onload = closeWindow;   
    </script>
</head>
<body>
 
</body>
</html>
