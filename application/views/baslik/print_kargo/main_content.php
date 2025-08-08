<!-- application/views/print_template.php -->



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Umex Kargo</title>

</head>

<body style="font-family:arial" onload="window.print()">

    <div style="width: 120mm; height: 80mm; border: 1px solid #000; padding: 10px;">

        <table>

		<tr>

		<td colspan="2" style=" background:black;font-size:14px;color:white;border:1px solid black;   text-align:center;padding-left:20px; padding-right:20px;  ">

		KARGO BİLGİLERİ

		</td>

		</tr>

		<tr>

		<td style=" border:1px solid black;font-size:12px ;  text-align:center;padding-left:20px; padding-right:20px;  ">

		Gönderici

		</td>

		<td style=" border:1px solid black;padding:5px;font-size:13px; ">

		<b>UG TEKNOLOJİ MEDİKAL SAN. TİC. LTD. ŞTİ.</b><br>
		Yeşiloba Mah. 46023 Sokak No:72 Seyhan / Adana
		<br>
<b>Yurtiçi Kargo Anlaşma Kodu :</b> 698779844  

		 </td>

		</tr>

		<tr>

		<td style="font-size:12px;border:1px solid black; text-align:center;  ">
Alıcı
		

		</td>

		<td style="min-height: 90px;font-size:14px;

   border:1px solid black;padding:5px ">

		<b><?=$alici->merkez_adi?></b><br>

		<span style="font-size:12px;"> <?=$alici->merkez_adresi?> <b> <?=mb_strtoupper($alici->ilce_adi)?> /  <?=mb_strtoupper($alici->sehir_adi)?> </b> </span><br><br>

		<b>İletişim :</b> <b style="font-size: large;"><?=formatTelephoneNumber($alici->musteri_iletisim_numarasi)?></b>

		

		


	    

		</td>

		</tr>

		<tr style=" ">

		<td style="border:1px solid black; border-right:0px solid">

		<img src="<?=base_url("assets/dist/img/ug-logo-kargo.png")?>" style="width:55px;margin:10px;margin-left:20px;">

		</td>

		<td style="color:black;font-size: small;text-align:CENTER;padding-right:32px; border:1px solid black;border-left:0px solid; ">

		<span style="font-size:22px">Teknik Servis</span><br>

		0546 831 10 11 - 0546 831 10 12

		</td>

		</tr>

		<tr>

		<td colspan="2" style=" background:black;color:white;border:1px solid black;   text-align:center;padding-left:20px; padding-right:20px;  ">

		www.umex.com.tr

		</td>

		</tr>

		</table>

    </div>

</body>

</html>