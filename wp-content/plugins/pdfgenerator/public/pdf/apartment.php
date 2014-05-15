<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $filename ?></title>
        <style>
            *
            {
                margin:0;
                padding:0;
                font-family:Arial;
                font-size:14pt;
                color:#000;
            }
            body
            {
                width:100%;
                font-family:Arial;
                font-size:14pt;
                margin:0;
                padding:0;
            }

            p
            {
                margin:0;
                padding:0;
            }

            #wrapper
            {
                width:180mm;
                margin:0 15mm;
            }

            .page
            {
                height:297mm;
                width:210mm;
                page-break-after:always;
            }

            table
            {
                border-spacing:0;
                border-collapse: collapse;
            }

            .border-bottom {
                border-bottom: 4px solid silver;
            }

            h2 {
                text-align:center; 
                font-weight:bold; 
                padding-top:5mm; 
                font-size: 20px; 
                background: red;
            }

            
            p {
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">

            <table style="width:180mm;">
                <tr>
                    <td class="border-bottom" style="width:100%;"><h1>Logo</h1></td>
                    <td class="border-bottom" style="text-align: right; width:100%;">
                        <h4>
                        Firma
                        ulice | 110 00 mesto
                        telefon | fax
                        </h4>
                    </td>
                </tr>
                <tr>                    
                    <td colspan="2" style="text-align:right; width:100%;">
                        <a href="#">www.aden-immo.com</a> | <a href="#">berlin@aden-immo.com</a>
                    </td>
                </tr>
            </table>


            <table style="width:100%;">
                <tr>
                    <td style="width: 50%">Ref: MUE-DA-16</td>
                    <td style="width: 50%; text-align: right;">
                        Loyer 1.450 EUR <br>
                        - 10245 Berlin / Friedrichshain
                    </td>
                </tr>
            </table>

            <h2>3-pieces de charme avec balcon dans bel Albau a friedrichshain</h2>

            <table style="width:180mm;">
                <tr>
                    <td style="width: 50%">
                        <table style="width:100%">
                            <tr>
                                <td style="width: 50%">Type</td>
                                <td style="width: 50%">Appartement</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">Nombre de pieces</td>
                                <td style="width: 50%">3.5</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">Surface:  </td>
                                <td style="width: 50%">114 m2</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">Etage:  </td>
                                <td style="width: 50%">1 er etage sur rue</td>
                            </tr>
                            <tr>
                                <td style="width: 50%">Charges mensuelles  </td>
                                <td style="width: 50%">250 EUR</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width:100%;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="width:50%;">Anné construction  </td>
                                <td style="width:50%;">250 EUR</td>
                            </tr>
                            <tr>
                                <td style="width:50%;">Etat  </td>
                                <td style="width:50%;">Bien entretrenu</td>
                            </tr>
                            <tr>
                                <td style="width:50%;">Type de chauffage </td>
                                <td style="width:50%;">Chauffage central</td>
                            </tr>
                            <tr>
                                <td style="width:50%;">Balcon/Terrase </td>
                                <td style="width:50%;">Oui</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 100%;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="width:50%;">Loyer </td>
                                <td style="width:50%;"><b>1.250 EUR</b></td>
                            </tr>
                            <tr>
                                <td style="width:50%;">Caution </td>
                                <td style="width:50%;"><b>3 mois de loyer</b></td>
                            </tr>                            
                        </table>
                    </td>

                    <td style="width: 50%">
                        obrazek
                    </td>
                </tr>

                <tr>
                    <td style="width: 50%">Obrazek</td>
                    <td style="width: 50%">Obrazek</td>
                </tr>
            </table>


            <h2>Description de l apartment, immeuble et enviroe</h2>

            <table style="width:100%; background: green;">
                <tr>
                    <td style="width: 50%">
                        Hello
                    </td>
                    <td style="width: 50%">
                        Hows going
                    </td>    
                </tr>
            </table>

            <h2>Galeries des images</h2>

            <div class="image-wrap">
                <div class="image-image">
                    obrazek
                </div>
                <div class="iamge-title">
                    obrazek title
                </div>    
            </div>    


            <div class="image-wrap">
                <div class="image-image">
                    obrazek
                </div>
                <div class="iamge-title">
                    obrazek title
                </div>    
            </div>


            <div class="image-wrap">
                <div class="image-image">
                    obrazek
                </div>
                <div class="iamge-title">
                    obrazek title
                </div>    
            </div>

            <div class="image-wrap">
                <div class="image-image">
                    obrazek
                </div>
                <div class="iamge-title">
                    obrazek title
                </div>    
            </div>            

            <div class="image-wrap">
                <div class="image-image">
                    obrazek
                </div>
                <div class="iamge-title">
                    obrazek title
                </div>    
            </div>

            <div class="image-wrap">
                <div class="image-image">
                    obrazek
                </div>
                <div class="iamge-title">
                    obrazek title
                </div>    
            </div>            



        </div>

    <htmlpagefooter name="footer">
        <hr />
        <div id="footer">
            <table>
                <tr><td>Software Solutions</td><td>Mobile Solutions</td><td>Web Solutions</td></tr>
            </table>
        </div>
    </htmlpagefooter>
    <sethtmlpagefooter name="footer" value="on" />

</body>
</html>