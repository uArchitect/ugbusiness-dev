<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>İstek Bildirim</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style="background-color: #e9ecef;">

  <!-- start preheader -->
  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
    İstek Bildirim Kaydı Oluşturuldu. <?=$istek->istek_adi?>
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start logo -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;">
          <tr>
            <td align="center" valign="top" style="padding: 36px 24px;">
             </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;">
		
          <tr>
		  
            <td align="center" bgcolor="#ffffff" style="display: grid;padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
			<span style="text-align:center"> <img style="margin:auto" width="70" src="data:image/png;base64, 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"></span>
              <h1 style="margin: 0; font-size: 30px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">#<?=$istek->istek_kodu?> - <?=$istek->istek_birim_adi?> - İstek Bildirim</h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;">

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 0 24px 24px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;text-align:center">
				Bilgi Sistemleri birimi için <?=date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi))?> tarihinde yeni istek bildirimi oluşturulmuştur.
 
			  </p>
			  <p style="margin: 0;margin-top:10px;text-align:center">
				<b>Kullanıcı :</b> <?=$istek->kullanici_ad_soyad?>
				<b style="margin-left:10px">Departman :</b> <?=$istek->departman_adi?>
				<b style="margin-left:10px">Dahili No :</b> <?=$istek->kullanici_dahili_iletisim_no?>
			  </p>
			  		  <p style="background: #f1f1f1;padding:10px;margin: 0;margin-top:10px;text-align:center">
				<b style="opacity:1">İstek Detayı</b> <br>  <?=$istek->istek_aciklama?>
			  </p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align="left" bgcolor="#ffffff">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center"  style="border-radius: 6px;padding-right:15px; ">
                          <a href="https://www.blogdesire.com"   target="_blank" style="background:#008f06;display: inline-block; padding: 16px 36px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">İsteği Onayla</a>
						            
					   </td>
					  <td align="center"  style="border-radius: 6px; ">
                          <a href="https://www.blogdesire.com"   target="_blank" style="background:#b30000;display: inline-block; padding: 16px 36px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">İsteği Reddet</a>
						            
					   </td>
					  
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align="center" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;"><b>İşlem düğmeleri çalışmıyorsa bağlantıları ziyaret edebilirsiniz:</b></p> <br>
              <p style="margin: 0;">Onay Bağlantısı : <a href="https://blogdesire.com" target="_blank">https://business/onayla</a>
			  <p style="margin: 0;">Reddetme Bağlantısı : <a href="https://blogdesire.com" target="_blank">https://business/reddet</a></p>
            </td>
          </tr>
          <!-- end copy -->

      

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 750px;">

          <!-- start permission -->
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
              <p style="margin: 0;opacity:0.7">Bu mail UmexBusiness ERP Sistemi tarafından otomatik olarak gönderilmiştir. Maili düzgün görüntüleyemiyor veya bağlantılarda sorun yaşıyorsanız aşağıda bulunan iletişim kanallarını kullanarak bize bildirebilirsiniz.</p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
              <p style="margin: 0;">UG Business - Bu sistem UG TEKNOLOJI tarafından geliştirilmiştir.</p> 
			    <p style="margin: 0;"><b>Email :</b> iletisim@ugteknoloji.com <b style="margin-left:10px">İletişim :</b> 0545 670 01 00</p> 
              <p style="margin: 0;">Yeşiloba Mah. 46023 Sokak No:72 Seyhan / Adana</p>
            </td>
          </tr>
          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>