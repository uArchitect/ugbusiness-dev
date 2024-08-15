<html>
  <head>
    <meta charset="utf-8" />
    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
    <script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
  </head>

  <body>
     
  </body>

  <script>
    const { degrees, PDFDocument, rgb, StandardFonts } = PDFLib;
    const fontkit = window.fontkit;

    async function modifyPdf() {
       
        const url = "<?=base_url("assets/dist/certificates/pdf-"."ozel".".pdf")?>";
         
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer());

     
        const url1 = "<?=base_url("assets/dist/certificates/gilroy.ttf")?>";
        const fontBytes = await fetch(url1).then(res => res.arrayBuffer());

        
        const pdfDoc = await PDFDocument.load(existingPdfBytes);
        pdfDoc.registerFontkit(fontkit);
        const customFont = await pdfDoc.embedFont(fontBytes);

       
        const names = <?=$isimler?>;

        
        const fontSize = 50;

        
        function addTextToPage(page, text) {
            const textWidth = customFont.widthOfTextAtSize(text, fontSize);
            const textHeight = customFont.heightAtSize(fontSize);

            
            const { width, height } = page.getSize();
            const x = (width - textWidth) / 2 + 44;
            const y = 391;

           
            page.drawText(text, {
                x: x,
                y: y,
                size: fontSize,
                font: customFont,
                color: rgb(1, 1, 1)
            });
			
			const today = new Date();
const month = today.getMonth() + 1; 
const year = today.getFullYear();
const formattedDate = `${month<10 ? "0"+month : month}/${year}`;

			
			 page.drawText(formattedDate, {
                x: (width - 120),
                y: y+147,
                size: 17,
                font: customFont,
                color: rgb(1, 1, 1)
            });
        }




        function addBrandToPage(page, text) {
            const fontSize2 = 17;
            const textWidth = customFont.widthOfTextAtSize(text, fontSize2);
            const textHeight = customFont.heightAtSize(fontSize2);

            
            const { width, height } = page.getSize();
            const x = (width - textWidth) / 2 + 24;
            const y = 335;

           
            page.drawText(text, {
                x: x,
                y: y,
                size: fontSize2,
                font: customFont,
                color: rgb(1, 1, 1)
            });
			
		
        }


        
        for (const name of names) {
            
            const [copiedPage] = await pdfDoc.copyPages(pdfDoc, [0]);
            pdfDoc.addPage(copiedPage);

            
            const [newPage] = pdfDoc.getPages().slice(-1); 
            addTextToPage(newPage, name);
            addBrandToPage(newPage, "<?=$brand_names?>");
        }
pdfDoc.removePage(0);
       
        const pdfBytes = await pdfDoc.save();

 
        download(pdfBytes, "umex-sertifika.pdf", "application/pdf");
       // location.href='<?=base_url("sertifika/uretilecek-sertifikalar")?>';
    }


    modifyPdf();
   
  </script>
</html>
