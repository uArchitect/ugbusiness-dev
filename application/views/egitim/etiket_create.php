<html>
  <head>
    <meta charset="utf-8" />
    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
    <script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
  </head>
  <body></body>

  <script>
    const { PDFDocument, rgb } = PDFLib;
    const fontkit = window.fontkit;

    async function modifyPdf() {
      const url = "<?=base_url("assets/dist/certificates/etiket.pdf")?>";
      const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer());

      const fontUrl = "<?=base_url("assets/dist/certificates/fa.otf")?>";
      const fontBytes = await fetch(fontUrl).then(res => res.arrayBuffer());

      const pdfDoc = await PDFDocument.load(existingPdfBytes);
      pdfDoc.registerFontkit(fontkit);
      const customFont = await pdfDoc.embedFont(fontBytes);

      const names = <?=$isimler?>;
      const fontSize = 18;

      const cols = 3;
      const rows = 4;
      const itemsPerPage = cols * rows;

      // Kutu ayarları
      const startX = 60;          // Sol boşluk
      const startY = 690;         // Üst boşluk
      const cellWidth = 165;      // Hücre genişliği
      const cellHeight = 175;     // Hücre yüksekliği

      for (let i = 0; i < names.length; i++) {
        if (i % itemsPerPage === 0) {
          var [newPage] = await pdfDoc.copyPages(pdfDoc, [0]);
          pdfDoc.addPage(newPage);
        }

        const currentPage = pdfDoc.getPages()[pdfDoc.getPageCount() - 1];
        const indexInPage = i % itemsPerPage;

        const col = indexInPage % cols;
        const row = Math.floor(indexInPage / cols);

        const cellX = startX + col * cellWidth;
        const cellY = startY - row * cellHeight;

        // Ortalamak için metin genişliği hesaplanıyor
        const text = names[i];
        const textWidth = customFont.widthOfTextAtSize(text, fontSize);
        const x = cellX + (cellWidth - textWidth) / 2;
        const y = cellY + (cellHeight - fontSize) / 2;

        currentPage.drawText(text, {
          x,
          y,
          size: fontSize,
          font: customFont,
          color: rgb(0, 0, 0),
        });

        // (İsteğe bağlı) hücre çizimi
        // currentPage.drawRectangle({
        //   x: cellX,
        //   y: cellY,
        //   width: cellWidth,
        //   height: cellHeight,
        //   borderColor: rgb(0.8, 0.8, 0.8),
        //   borderWidth: 0.5,
        // });
      }

      // Şablon sayfayı kaldır
      pdfDoc.removePage(0);

      const pdfBytes = await pdfDoc.save();
      download(pdfBytes, "umex-etiket.pdf", "application/pdf");
    }

    modifyPdf();
  </script>
</html>
