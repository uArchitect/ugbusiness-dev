<!DOCTYPE html>
<html>
<head>
    <title>Başarı</title>
    <script type="text/javascript">
          function isPopupWindow() {
      try {
        return window && window !== window.top;
      } catch (e) {
        return false; // Eğer bir hata oluşursa pencere bir açılır penceredir.
      }
    }

        function closeWindow() {
            if (isPopupWindow()) { 
            window.close();
            }
        }
        window.onload = closeWindow;  // Sayfa yüklendiğinde pencereyi kapatır
    </script>
</head>
<body>
  
</body>
</html>
