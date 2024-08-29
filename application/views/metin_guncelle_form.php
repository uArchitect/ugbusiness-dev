<!DOCTYPE html>
<html>
<head>
    <title>Metin Güncelle</title>
</head>
<body style="font-family:arial;">
    <form method="post" onsubmit="setTimeout(function() {window.close();}, 1);" action="<?= site_url('metinler/guncelle/' . $metin->metin_id); ?>">
        <label style="color:red;font-weight:bold">TÜRKÇE METİN</label><br>
        <textarea rows="6" name="metin_turkce"  style="padding:5px;width:98%;font-family:arial;"><?= $metin->metin_turkce; ?></textarea><br>
<br>
        <label style="color:brown;font-weight:bold">ALMANCA METİN</label><br>
        <textarea rows="6" name="metin_almanca" style="padding:5px;width:98%;font-family:arial;"><?= $metin->metin_almanca; ?></textarea><br>
        <br>
        <label style="color:green;font-weight:bold">ARAPÇA METİN</label><br>
        <textarea rows="6" name="metin_arapca" style="padding:5px;width:98%;font-family:arial;"><?= $metin->metin_arapca; ?></textarea><br>
        <br>
        <label style="color:blue;font-weight:bold">İNGİLİZCE METİN</label><br>
        <textarea rows="6" name="metin_ingilizce" style="padding:5px;width:98%;font-family:arial;"><?= $metin->metin_ingilizce; ?></textarea><br>
        <br>
        <label style="color:purple;font-weight:bold">RUSÇA METİN</label><br>
        <textarea rows="6" name="metin_rusca" style="padding:5px;width:98%;font-family:arial;"><?= $metin->metin_rusca; ?></textarea><br>

        <input type="submit" style="width:99.5%;background:green;color:white;padding:10px;font-size:25px;" value="Metin Bilgisini Güncelle">
    </form>
</body>
</html>
