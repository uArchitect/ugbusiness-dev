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

      const templatePage = (await pdfDoc.copyPages(pdfDoc, [0]))[0];

      // Her sayfa 3x3 kutu içerir (9 kutu)
      const cols = 3;
      const rows = 4;
      const itemsPerPage = cols * rows;

      // Kutu boyutu ve başlangıç konumu (örnek değerler)
      const startX = 60;
      const startY = 670;
      const cellWidth = 220;
      const cellHeight = 130;

      for (let i = 0; i < names.length; i++) {
        if (i % itemsPerPage === 0) {
          var [newPage] = await pdfDoc.copyPages(pdfDoc, [0]);
          pdfDoc.addPage(newPage);
        }

        const currentPage = pdfDoc.getPages()[pdfDoc.getPageCount() - 1];
        const indexInPage = i % itemsPerPage;

        const col = indexInPage % cols;
        const row = Math.floor(indexInPage / cols);

        const x = startX + col * cellWidth;
        const y = startY - row * cellHeight;

        currentPage.drawText(names[i], {
          x: x,
          y: y,
          size: fontSize,
          font: customFont,
          color: rgb(0, 0, 0),
        });
      }

      // İlk boş şablon sayfayı kaldır
      pdfDoc.removePage(0);

      const pdfBytes = await pdfDoc.save();
      download(pdfBytes, "umex-etiket.pdf", "application/pdf");
    }

    modifyPdf();
  </script>
</html>
