<!DOCTYPE html>
<html>
<head>
    <title>Başarı</title>
    <script type="text/javascript">


  function isPopup() {
    // Pencerenin boyutlarını kontrol et
    if (window.outerWidth - window.innerWidth > 100 || window.outerHeight - window.innerHeight > 100) {
        // Pencere, genellikle bir pop-up olarak kabul edilir
        return true;
    }

    // Pencere adını kontrol et (bazı pop-up'lar belirli adlara sahip olabilir)
    if (window.name && window.name.startsWith("popup")) {
        return true;
    }

    // Fallback olarak window.opener'ı kontrol et
    if (window.opener && !window.opener.closed) {
        return true;
    }

    return false;
}

// Kullanım örneği
if (isPopup()) {
    alert("Bu bir pop-up.");
} else {
    alert("Bu bir pop-up değil.");
}
</script>
</head>
<body>
<?php echo $redirect_url; ?>
</body>
</html>
