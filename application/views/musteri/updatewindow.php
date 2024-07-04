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
            }
        }
        window.onload = closeWindow;   
    </script>
</head>
<body>
  
</body>
</html>
