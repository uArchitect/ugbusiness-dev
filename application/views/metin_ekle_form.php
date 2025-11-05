<!DOCTYPE html>
<html>
<head>
    <title>Metin Ekle</title>
    <script>
        
        window.onload = function() {
            document.getElementById('myInput').focus();
        };
    </script>
</head>
<body>
    <form method="post" action="<?= site_url('metinler/ekle'); ?>">
        <label>Türkçe Metin:</label>
        <input type="text" id="myInput" name="metin_turkce"><br>

        <input type="submit" value="Metin Ekle">
    </form>
</body>
</html>
