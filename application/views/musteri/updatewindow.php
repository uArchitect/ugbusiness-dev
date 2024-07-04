<!DOCTYPE html>
<html>
<head>
    <title>Başarı</title>
    <script type="text/javascript">
          function isPopupWindow() {
      try {
        return window && window !== window.top;
      } catch (e) {
        return false;  
      }
    }

        function closeWindow() {
            if (!isPopupWindow()) { 
                alert("s");
            window.close();
            }else{
                alert("sd");
                    window.location.href = "<?php echo $redirect_url; ?>";
                 
            }
        }
        window.onload = closeWindow;   
    </script>
</head>
<body>
<?php echo $redirect_url; ?>
</body>
</html>
