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
            window.close();
            }else{
                setTimeout(function() {
                    window.location.href = "<?php echo $redirect_url; ?>";
                }, 1000);
            }
        }
        window.onload = closeWindow;   
    </script>
</head>
<body>
  
</body>
</html>
