<!DOCTYPE html>
<html>
<head>
    <title>Başarı</title>
    <script type="text/javascript">
  var isPopup = false;

  function openPopup() {
    var popup = window.open('', '_blank');
    if (popup) {
      isPopup = true;
      popup.close();
    }
  }

  function isPopupWindow() {
    return isPopup;
  }

  function closeWindow() {
    if (isPopupWindow()) {
      alert("Not a popup");
      window.close();
    } else {
      alert("It is a popup");
      window.location.href = "<?php echo $redirect_url; ?>";
    }
  }

  window.onload = function() {
    openPopup(); // Bu işlevi yalnızca test amacıyla çalıştırın
    closeWindow();
  };
</script>
</head>
<body>
<?php echo $redirect_url; ?>
</body>
</html>
