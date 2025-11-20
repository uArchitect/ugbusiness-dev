<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: 36mm 36mm;
            margin: 0;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 36mm;
                height: 36mm;
            }
            #yazdir3 {
                width: 36mm;
                height: 36mm;
                margin: 0;
                padding: 0;
            }
        }
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body onload="qr3('<?=$_GET['serino']?>');">

 <div class="row" id="yazdir3">
        <div class="col-lg-12 text-center" style="text-align:center">
            
            <div id="canvas5" style="scale: 0.6;margin-left: 11px;margin-top: 26px;"></div>
            <p id="cp3" style="margin-top:-30px;text-align:center;font-weight:500;font-family: system-ui;margin-left: 2px;"><b>-<br>
			<b>LAMBA ETİKETİ</b><br>
			Seri No : <?=$_GET['serino']?>
			</p>
            <div id="canvas6" style="scale: 0.6;margin-left: 12px;margin-top: 20px;"></div>
            LAMBA ETİKETİ
        </div>
    </div>
    
	 <script src="<?=base_url("assets/dist/js/qr.js")?>"></script>
<script>
 
  
  function qr3(id) {
            document.getElementById("canvas5").innerHTML = "";
            document.getElementById("canvas6").innerHTML = "";
            const qrCode5 = new QRCodeStyling({
                width: 200,
                height: 200,
                type: "svg",
                data: id,
                image: "<?=base_url("assets/dist/img/ugteknoloji.svg")?>",
                backgroundOptions: {
                    color: "#fff",
                },
                imageOptions: {
                    crossOrigin: "anonymous",
                    margin: 5
                }
            });
            const qrCode6 = new QRCodeStyling({
                width: 200,
                height: 200,
                type: "svg",
                data: id,
                image: "<?=base_url("assets/dist/img/ugteknoloji.svg")?>",
                backgroundOptions: {
                    color: "#fff",
                },
                imageOptions: {
                    crossOrigin: "anonymous",
                    margin: 5
                }
            });
            qrCode5.append(document.getElementById("canvas5"));
            qrCode6.append(document.getElementById("canvas6"));
           setTimeout(function() {
        window.print();
      
    }, 500);
        }
  
</script>
</body>

</html>