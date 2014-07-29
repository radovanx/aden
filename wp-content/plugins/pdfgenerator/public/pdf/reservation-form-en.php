<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $filename ?></title>
        <style>
            * {
                padding: 0;
                margin: 0;
            }
            body {
                font-family: arial;
                font-size: 11px;
                line-height: 1.5;
            }

            table {
                width: 100%;
                border-collapse:collapse;
            }

            table td, table th {
                vertical-align: top;
                background: white;
                padding: 1mm 2mm;
            }
            
            table thead td, 
            table thead th {
                vertical-align: middle;
            }

            .bordered {
                border-top: 1px solid black;
                border-left: 1px solid black;
            }
            .bordered td,
            .bordered th {
                border-bottom: 1px solid black;
                border-right: 1px solid black;
            }

            .color-blue {
                color: #00337e;
            }

            .color-red {
                color: #990033;
            }
            .text {

            }
            .block {
                margin-bottom: 6mm;
            }
            .w50 {
                width: 50%;
            }
            .w33 {
                width: 33%;
            }
            .w100 {
                width: 100%;
            }
            .vtop {
                vertical-align: top;
            }
            .text-right {
                text-align: right;
            }
            .text-left {
                text-align: left;
            }
            .text-center {
                text-align: center;
            }
            thead th, 
            thead td {
                background: #bfbfbf;
            }
            .small-title {
                font-size: 8px;                
            }
            .big-letter {
                font-size: 140%;
            }
            h1, h2, h3{
                line-height: 1;
            }
            .small {
                font-size: 10px;
            }
            .top-border {
                border-top: 1px solid silver;
            }
            .signature {
                margin-top: 80mm;
                margin-bottom: 10mm;
            }

            .main-title {
                font-size: 13px;
            }
            
            .width1 {
                width: 50mm;
            } 
            .width2 {
                width: 25mm;
            }             
            
            .nborder {               
                /*border-color:#ffffff;*/
            }
        </style>
    </head>
    <body>


        <?php
        $current_user = wp_get_current_user();
        ?>
        <div id="wrapper">

            <!--
            <table class="w100">
                <tr>
                    <td class="w50 vtop">
            <?php
            $attachment_id = get_user_meta(get_current_user_id(), 'logo', true);

            if (!empty($attachment_id)) {
                $atts = array(
                    'class' => 'fleft'
                );
                echo wp_get_attachment_image($attachment_id, 'pdf_logo', $atts);
            }
            ?>
                    </td>
                    <td class="w50 text-right text-block vtop">
                        <h3><?php echo get_user_meta(get_current_user_id(), 'company', true) ?></h3>
            <?php
            $location = array();

            $address = get_user_meta(get_current_user_id(), 'address', true);
            if (!empty($address)) {
                $location[] = $address;
            }

            $city = get_user_meta(get_current_user_id(), 'city', true);
            if (!empty($city)) {
                $location[] = $city;
            }

            if (!empty($location)) {
                echo implode(' | ', $location) . '<br>';
            }
            ?>
            <?php _e('tel:', $this->plugin_slug) ?>  <?php echo get_user_meta(get_current_user_id(), 'phone', true) ?><br>
                        <a class="color-red decoration-none" href="mailto:<?php echo $current_user->user_email ?>"><?php echo $current_user->user_email ?></a>
                    </td>
                </tr>
            </table>
            -->


            <form action="" method="post">

                <h2 class="main-title color-red"><span class="big-letter">R</span>ESERVIERUNGSVEREINBARUNG / <i><span class="big-letter">R</span>ESERVATION AGREEMENT</i></h2>

                <h3 class="small-title color-red"><span class="big-letter">Z</span>WISCHEN / <i><span class="big-letter">B</span>ETWEEN</i></h3>
                <table class="table block bordered">
                    <thead>
                        <tr>
                            <th>Kaufinteressentin / <i>Potential buyer</i></th>
                            <td><i>Erste(r) Interessentin / <br>Potential buyer</i></td>
                            <td><i>Ggf. zweite(r) Interessentin /<br> Second buyer</i></td>
                        </tr>
                    </thead>
                    <tr>
                        <td>Name, Vorname /<i> Name, Surname</i></td>
                        <td><input class="width1 nborder" type="text" name="buyer1"></td>
                        <td><input class="width1 nborder" type="text" name="buyer2"></td>
                    </tr>
                    <tr>
                        <td>Geburtsdatum / <i>Date of birth</i></td>
                        <td><input class="width1 nborder" type="text" name="birht1"></td>
                        <td><input class="width1 nborder" type="text" name="birth2"></td>
                    </tr>
                    <tr>
                        <td>Adresse / <i>Address</i></td>
                        <td><textarea class="nborder" rows="4" style="width: 52mm; " type="text" name="address1"></textarea></td>
                        <td><textarea class="nborder" rows="4" style="width: 52mm;" type="text" name="address2"></textarea></td>
                    </tr>
                    <tr>
                        <td>PLZ – Ort / <i>ZIP code - City</i></td>
                        <td><input class="width1 nborder" type="text" name="postcode1"></td>
                        <td><input class="width1 nborder" type="text" name="postcode2"></td>
                    </tr>
                    <tr>
                        <td>Land / <i>Country</i></td>
                        <td><input class="width1 nborder" type="text" name="country1"></td>
                        <td><input class="width1 nborder" type="text" name="country2"></td>
                    </tr>
                    <tr>
                        <td>Telefonnummer / <i>Phone number</i></td>
                        <td><input class="width1 nborder" type="text" name="phonenumber1"></td>
                        <td><input class="width1 nborder" type="text" name="phonenumber2"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input class="width1 nborder" type="text" name="email1"></td>
                        <td><input class="width1 nborder" type="text" name="email2"></td>
                    </tr>
                </table>


                <h3 class="small-title color-red"><span class="big-letter">U</span>ND / <i><span class="big-letter">A</span>ND</i></h3>

                <table class="table block bordered w100">
                    <thead>
                        <tr>
                            <th class="text-left">
                                Agentur / <i>The agency</i>
                            </th>
                        </tr>
                    </thead>>
                    <tr>
                        <td class="text-left">
                            ADEN Immo GmbH<br>
                            Mehringdamm 77<br>
                            10965 Berlin - Deutschland
                        </td>
                    </tr>
                </table>


                <h3 class="small-title color-red"><span class="big-letter">K</span>AUFOBJEKT / <i>CONCERNING THE <span class="big-letter">R</span>EAL ESTATE</i></h3>
                <table class="block bordered">
                    <thead>
                        <tr>
                            <th colspan="2"  class="text-left">Objektangaben / <i>Object data</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="w50">Referenznummer /<i> Reference number</i></td>
                            <td class="w50"><input type="text" name="refno"></td>
                        </tr>
                        <tr>
                            <td>Anschrift des Hauses / <i>Address of the object</i></td>
                            <td><input type="text" name="objectaddress"></td>
                        </tr>
                        <tr>
                            <td>PLZ – Ort / <i>ZIP code - City</i></td>
                            <td><input type="text" name="objectpostcode"></td>
                        </tr>
                        <tr>
                            <td>Land / <i>Country</i></td>
                            <td><input type="text" name="objectcountry"></td>
                        </tr>
                        <tr>
                            <td>Lage / <i>Description of the object</i></td>
                            <td><input type="text" name="objectdescription"></td>
                        </tr>
                        <tr>
                            <td>Größe in Qm / <i>Surface</i></td>
                            <td><input type="text" name="objectsurface"></td>
                        </tr>
                        <tr>
                            <td>Wohnungsnummer /<i> Number of the object</i></td>
                            <td><input type="text" name="objectnumber"></td>
                        </tr>
                        <tr>
                            <td>Kaufpreis /<i> Purchasing price</i></td>
                            <td><input type="text" name="objectpurchaseprice"></td>
                        </tr>
                        <tr>
                            <td>Reservierungsgebühr brutto /<i> Reservation fee (inkl. 19% Mwst.) / (incl. 19% VAT 19%)</i></td>
                            <td><input type="text" name="objectreservationprice"></td>
                        </tr>
                    </tbody>
                </table>


                <div class="text block">
                    1. Der Interessent beabsichtigt den Erwerb des Objektes zu o.g. Konditionen / <i><span class="color-blue"> The potential buyer intends the
                            purchase of the real estate under the conditions mentioned above.</span></i>
                </div>

                <div class="text block">
                    2. Der Interessent beauftragt die ADEN Immo GmbH (Vermittler) mit der Reservierung der Immobilie. Damit der
                    Interessent seine Kaufvorbereitungen treffen kann, wird ihm eine <strong class="color-red">Frist von 4 Wochen</strong> ab Unterzeichnung dieser
                    Vereinbarung eingeräumt. / <i><span class="color-blue">The potential buyer assigns the agent the reservation of the real estate. A period of <strong class="color-red">4
                                weeks</strong> is granted to the buyer starting from signing this agreement, so that he can proceed the necessary preparations
                            for a purchase.</span></i>
                </div>


                <div class="text block">
                    3. Während des o.g. Zeitraums versichert der Vermittler die Immobilie an keinen anderen Kunden zu veräußern /<i>
                        <span class="color-blue">During the above mentioned period the agent insures not to sell or offer the real estate to other clients.</span></i>
                </div>


                <div class="text block">
                    4. Der Vermittler erhält für diese Tätigkeit und für die Reservierung die o.g. Reservierungsgebühr (pauschal ) / <i><span class="color-blue">The
                            agent receives a reservation fee (overall) of the above mentionned value for this activity and for the reservation .</span></i>
                </div>

                <div class="text block">
                    Die Reservierungsgebühr ist innerhalb von 48 Std. zahlbar auf folgendes Konto: / <i><span class="color-blue">The reservation fee has to be paid to
                            the following account within 48 hours after acceptance of the reservation :</span></i>
                </div>


                <div class="text block text-center">
                    Account holder: ADEN Immo GmbH<br>
                    Bank: Deutsche Bank<br>
                    IBAN : DE91 100 700 240 9516717 00<br>
                    BIC : DEUT DE DBBER

                </div>


                <div class="text block">
                    5. Für den Abschluss eines Kaufvertrages übernehmen weder der Interessent noch der Verkäufer eine Garantie. /
                    <i><span class="color-blue">L’acquéreur potentiel et le vendeur n’endossent aucune garantie quant à la signature d’un contrat de vente.</span></i>
                </div>



                <div class="text block">
                    6. Sollte der Interessent von dem Kaufvertrag Abstand nehmen, aus einem Grund, der weder in der Verantwortung
                    des Verkäufers oder des Agents ist, wird die Reservierungsgebühr nicht erstattet. Bei Abschluss eines Kaufvertrages
                    wird die Reservierungsgebühr mit der dann fälligen Käuferprovision verrechnet. Sollte der Verkäufer von der
                    Beurkundung Abstand nehmen, ist die Reservierungsgebühr an den Käufer zurückzuzahlen. / <i><span class="color-blue">In the case that the
                            potential buyer takes distance from the sales contract, for a reason that is neither the responsibility of the seller nor
                            the agent, the reservation fee is not refunded. At the time of conclusion of a sales contract the reservation fee is
                            charged with the then due buyer commission. In the case that the salesman or agent takes distance from recording,
                            the reservation fee is to be paid back to the buyer</span></i>
                </div>


                <div class="text block">
                    7. Der notarielle Akt der Erstellung eines Kaufvertragsentwurfs verursacht Kosten. Sollte kein Kauf zustande
                    kommen sind diese Kosten von demjenigen zu tragen, der für das Nichtzustandekommen des Vertrages verantwortlich
                    ist. / <i><span class="color-blue">The notarial act of the preparing of a sales contract draft causes costs. In the case that a purchase is not achieved
                            these costs have to be carried buy the person which is responsible for the nonconclusion of the sales contract.                </span></i>
                </div>


                <div class="text block">
                    8. Für den Nachweis und die Vermittlung eines Kaufvertrages erhebt der Vermittler eine Provision von <strong class="color-red">6% des
                        Kaufpreises</strong> (7,14% inkl. Mwst.) zuzüglich der gesetzlichen Mehrwertsteuer, zahlbar nach Abschluss des
                    Kaufvertrages. / <i><span class="color-blue">For the proof and the switching of a sales contract the agent raises a commission of <strong class="color-red">6% of the
                                purchase price</strong> (7,14% incl. VAT) plus the legal value added tax, payable after conclusion of the sales contract.</span></i>

                </div>


                <div class="note block text-center" style="margin-top: 15mm;">
                    Der deutsche Text dieser Vereinbarung ist maßgebend. / <i><span class="color-blue"> The German version of this text shall prevail</span></i>
                </div>

                <table class="block signature">
                    <tr>
                        <td class="text-center top-border"><small>Ort, Datum, Unterschrift / <i><span class="color-blue">Place, Date, Signature potential buyer</span></i></small></td>
                        <td> </td>
                        <td class="text-center top-border">
                            <small>Ort, Datum, Unterschrift, Vertreter in ADEN Immo GmbH /
                            <i><span class="color-blue">Place, Date, Signature agent ADEN Immo GmbH</span></i></small>
                        </td>
                    </tr>
                </table>


                <div class="text block">
                    <strong>NB : Ausweiskopie in Anlage / Enclosed the potential buyer's ID:</strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="enclosed_yes" value="1"> Ja / Yes
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="enclosed_no" value="1"> Nein / No
                </div>

            </form>
        </div>

    </body>
</html>