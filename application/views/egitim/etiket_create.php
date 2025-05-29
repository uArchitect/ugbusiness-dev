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
       
        const url = "<?=base_url("assets/dist/certificates/etiket.pdf")?>";
         
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer());

     
        const url1 = "<?=base_url("assets/dist/certificates/fa.otf")?>";
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
            const x = (width - textWidth) / 2 + 24;
            const y = 371;

           
            page.drawText(text, {
                x: x,
                y: y,
                size: fontSize,
                font: customFont,
                color: rgb(1, 1, 1)
            });
			 
        }

        
        for (const name of names) {
            
            const [copiedPage] = await pdfDoc.copyPages(pdfDoc, [0]);
            pdfDoc.addPage(copiedPage);

            
            const [newPage] = pdfDoc.getPages().slice(-1); 
            addTextToPage(newPage, name);
        }
pdfDoc.removePage(0);
       
        const pdfBytes = await pdfDoc.save();

 
        download(pdfBytes, "umex-sertifika.pdf", "application/pdf");
       // location.href='<?=base_url("sertifika/uretilecek-sertifikalar")?>';
    }


    modifyPdf();
   
  </script>
</html>
