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
            }
            .fleft {
                float: left;
            }

            .fright {
                float: right;
            }
            .w100 {
                width: 100%;
            }
            .w50{
                width: 50%;
            }
            .w25 {
                width: 25%;
            }
            .text-right {
                text-align: right;
            }


            .big-border-bottom {
                border-bottom: 1px solid #e8e8e8;
            }
            .red-color {
                color: #990033;
            }
            .gray-color {
                color: gray;
            }
            .decoration-none {
                text-decoration: none;
            }

            .text-center {
                text-align: center;
            }
            .block {
                margin-bottom: 6mm;
            }
            .small-block {
                margin-bottom: 2mm;
            }

            h3 {
                font-size: 13px;
            }

            .red-label {
                background: #990033;
                color: white;
                font-size: 18px;
                margin: 6px 0;
                padding: 2mm 6mm;
            }
            .clearfix {
                clear: both;
            }
            /*
            #wrapper
            {
                width:180mm;
                margin:0 15mm;
            }*/

            .base-info {
                margin-bottom: 5mm;
                margin-top: 3mm;
            }
            .vbottom {
                vertical-align: bottom;
            }

            .vtop {
                vertical-align: top;
            }

            .border-left {
                border-left: 3px solid #990033;
                padding-left: 15px;
            }
            .small-label {
                font-size: 15px;
            }
            table {
                border-collapse: collapse;
            }
            .features td {
                vertical-align: top;
                border-bottom: 1px solid #D8D8D8;
                padding-top: 1mm;
                padding-bottom: 1mm;
            }
            .features .t2 {
                padding-right: 2mm;
            }
            .features .t3 {
                padding-left: 2mm;
            }

            /**/
            .image-wrap {
                width: 87mm;
                margin-bottom: 6mm;
                text-align: center;
                vertical-align: middle;
                /*border: 1px solid red;*/
            }
            .image-wrap .in {
                height: 74mm;
                /*border: 1px solid red;*/
                width: 100%;
            }
            .row {

            }
            .gallery-table td {
                text-align: center;
                vertical-align: middle;
            }

            .gallery-table .t1,
            .gallery-table .t2 {
                border-bottom: 6mm solid white;
            }

            .gallery-table .t1 {
                border-right: 3mm solid white;
            }

            .gallery-table .t2 {
                border-left: 3mm solid white;
            }

            .img-title {
                border-top: 1px solid white;
            }

            .background-gray {
                background: #f3f3f3;
            }

            .right-head-box  {
                font-size: 9px;
            }
            .headline-label {
                font-size: 17px;
            }

            .text-block,
            #legal_condition {
                font-size: 11px;
            }
            #legal_condition h1 {
                font-size: 15px;
                border-left: 3px solid #990033;
                padding-left: 15px;
            }

            #legal_condition h2 {
                font-size: 14px;
                border-left: 3px solid #990033;
                padding-left: 15px;
            }

            #legal_condition h3,
            #legal_condition h4,
            #legal_condition h5 {
                font-size: 13px;
                border-left: 3px solid #990033;
                padding-left: 15px;
            }

        </style>
    </head>
    <body>
        <?php
        $current_user = wp_get_current_user();
        ?>
        <div id="wrapper">
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
                        <?php _e('tel:', 'wpbootstrap') ?>  <?php echo get_user_meta(get_current_user_id(), 'phone', true) ?><br>
                        <a class="red-color decoration-none" href="mailto:<?php echo $current_user->user_email ?>"><?php echo $current_user->user_email ?></a>
                    </td>
                </tr>
            </table>

            <table class="w100 base-info">
                <tr>
                    <td colspan="2" class="w50 right-head-box text-right">
                        <h2 class="headline-label"> <?php _e('Purchase price:', 'wpbootstrap') ?> <span class="red-color"><?php esc_attr_e(price_format($props['preise|kaufpreis'])) ?> €</span></h2>

                        <?php if (!empty($props['flaechen|wohnflaeche'])): ?>
                            <h2 class="headline-label"> <?php _e('Living area:', 'wpbootstrap') ?> <span class="red-color"> <?php esc_attr_e($props['flaechen|wohnflaeche']) ?> m²</span></h2>
                        <?php endif; ?>

                        <?php /* if (!empty($props['flaechen|wohnflaeche'])): ?>
                          <h2 class="headline-label"> <?php _e('Rooms:', 'wpbootstrap') ?> <span class="red-color"> <?php echo (int) $props['flaechen|anzahl_zimmer'] ?></span></h2>
                          <?php endif; */ ?>
                    </td>
                </tr>
                <tr>
                    <td class="w50">
                        <?php _e('Ref:', 'wpbootstrap') ?> <span class="gray-color"><?php esc_attr_e($props['verwaltung_techn|objektnr_extern']) ?></span>
                    </td>
                    <td class="w50 text-right">
                        <?php esc_attr_e($props['geo|strasse']) ?> <?php esc_attr_e($props['geo|wohnungsnr']) ?>,
                        <?php esc_attr_e($props['geo|plz']) ?> <?php esc_attr_e($props['geo|ort']) ?> <?php echo empty($props['geo|regionaler_zusatz']) ? '' : ' - ' . $props['geo|regionaler_zusatz'] ?>
                    </td>
                </tr>
            </table>

            <div class="red-label text-center small-block"><?php echo $props['freitexte|objekttitel'] ?></div>

            <!-- featrues -->
            <?php
            $cells = array();

            if (!empty($props['verwaltung_techn|objektnr_extern'])) {
                $cells[] = array(
                    __('Ref:', 'wpbootstrap'),
                    esc_attr($props['verwaltung_techn|objektnr_extern'])
                );
            }

            if (!empty($props['zustand_angaben|baujahr'])) {
                $cells[] = array(
                    __("Year of construction: ", "wpbootstrap"),
                    esc_attr($props['zustand_angaben|baujahr'])
                );
            }

            if (!empty($props['preise|kaufpreis_pro_qm'])) {
                $cells[] = array(
                    __('Purchase price /sm:', 'wpbootstrap'),
                    esc_attr(price_format($props['preise|kaufpreis_pro_qm'])) . ' €'
                );
            }

            if (!empty($props['objektart|wohnung|wohnungtyp'])) {
                $cells[] = array(
                    __('Apartment type:', 'wpbootstrap'),
                    apartmentTypeL($props)
                );
            }

            if (!empty($props['geo|etage'])) {
                $cells[] = array(
                    __('Floor:', 'wpbootstrap'),
                    esc_attr($props['geo|etage'])
                );
            }

            if (!empty($props['geo|anzahl_etagen'])) {
                $cells[] = array(
                    __('Number of floors:', 'wpbootstrap'),
                    (int) $props['geo|anzahl_etagen']
                );
            }

            if (!empty($props['flaechen|anzahl_zimmer'])) {
                $cells[] = array(
                    __('Rooms:', 'wpbootstrap'),
                    (int) $props['flaechen|anzahl_zimmer']
                );
            }

            if (!empty($props['flaechen|anzahl_badezimmer'])) {
                $cells[] = array(
                    __('Bathroom(s):', 'wpbootstrap'),
                    (int) $props['flaechen|anzahl_badezimmer']
                );
            }

            if (!empty($props['ausstattung|fahrstuhl|PERSONEN'])) {
                $elevator = isset($props['ausstattung|fahrstuhl|PERSONEN']) ? __("Yes", 'wpbootstrap') : __("No", 'wpbootstrap');

                $cells[] = array(
                    __('Elevator:', 'wpbootstrap'),
                    $elevator
                );
            }

            $hs = heatingSystemL($props);
            if (!empty($hs)) {
                $cells[] = array(
                    __('Type of heating system:', 'wpbootstrap'),
                    heatingSystemL($props)
                );
            }

            if (!empty($props['preise|stp_sonstige|stellplatzmiete'])) {
                $parking = 0 == (int) ($props['preise|stp_sonstige|stellplatzmiete']) ? __('No', 'wpbootstrap') : __('Yes', 'wpbootstrap');
                $cells[] = array(
                    __('Garage / parking spot:', 'wpbootstrap'),
                    $parking
                );
            }

            if (!empty($props['preise|aussen_courtage'])) {
                $cells[] = array(
                    __('Buyer commission (incl. VAT):', 'wpbootstrap'),
                    esc_attr($props['preise|aussen_courtage'])
                );
            }

            if (!empty($props['preise|hausgeld'])) {
                $cells[] = array(
                    __('Charges:', 'wpbootstrap'),
                    $props['preise|hausgeld']
                );
            }

            if (!empty($props['preise|warmiete'])) {
                $cells[] = array(
                    __('Loyer CC  (charges comprises):', 'wpbootstrap'),
                    $props['preise|warmiete']
                );
            }

            if (!empty($props['preise|kaltmiete'])) {
                $cells[] = array(
                    __('Loyer HC (Hors charges):', 'wpbootstrap'),
                    $props['preise|kaltmiete']
                );
            }

            if (!empty($props['energiepass|epart'])) {
                $cells[] = array(
                    __('Type de passeport:', 'wpbootstrap'),
                    epartL($props)
                );
            }

            if (!empty($props['energiepass|gueltig_bis'])) {

                $date = DateTime::createFromFormat('Y-m-d', $props['energiepass|gueltig_bis']);

                $cells[] = array(
                    __('Valable jusqu’à:', 'wpbootstrap'),
                    $date->format("d.m.Y")
                );
            }

            if (!empty($props['energiepass|energieverbrauchkennwert'])) {
                $cells[] = array(
                    __('Consommation énergétique finale:', 'wpbootstrap'),
                    $props['energiepass|energieverbrauchkennwert']
                );
            }

            if (!empty($props['preise|kaufpreis']) && !empty($props['preise|mieteinnahmen_ist']) && ((int) $props['preise|kaufpreis']) > 0) {
                $cells[] = array(
                    __('Calcul automatique du Yield:', 'wpbootstrap'),
                    round($props['preise|mieteinnahmen_ist'] / $props['preise|kaufpreis'], 5) . ' ' . periodeL($props)
                );
            }

            $yield = get_the_excerpt();
            
            if (!empty($yield)) {
                $cells[] = array(
                    __(" Yield:", "wpbootstrap"),
                    $yield
                );
            }
            ?>

            <h2 class="small-label border-left"><?php _e('Features', 'wpbootstrap') ?></h2>
            <table class="features w100 small-block text-block">
                <?php
                $i = 1;
                foreach ($cells as $cell):
                    if (0 != $i % 2):
                        ?>
                        <tr>
                            <td style="width:32%">
                                <?php echo $cell[0] ?>
                            </td>
                            <td style="width:18%" class="text-right t2">
                                <?php echo $cell[1] ?>
                            </td>
                        <?php else: ?>
                            <td class="t3"  style="width:32%">
                                <?php echo $cell[0] ?>
                            </td>
                            <td style="width:18%" class="text-right">
                                <?php echo $cell[1] ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php
                    $i++;
                endforeach;
                ?>

                <!--
                <tr>
                    <td class="w25">
                <?php _e('Ref:', 'wpbootstrap') ?>
                    </td>
                    <td class="w25 text-right t2">
                <?php esc_attr_e($props['verwaltung_techn|objektnr_extern']) ?>
                    </td>
                    <td class="w25 t3">
                <?php _e("Year of construction: ", "wpbootstrap"); ?>
                    </td>
                    <td class="w25 text-right">
                <?php echo esc_attr($props['zustand_angaben|baujahr']) ?>
                    </td>
                </tr>
                -->
            </table>
            <!-- /featrues -->

            <?php
            $images = & get_children(array(
                        'post_parent' => $product->ID,
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image'
            ));
            ?>

            <!-- feature image + first from gallery -->
            <?php
            $first_images = array();

            $post_thumbnail_id = get_post_thumbnail_id($product->ID);

            if (!empty($post_thumbnail_id)) {
                $first_images[$post_thumbnail_id] = get_post($post_thumbnail_id);
            }

            if (!empty($images)) {
                $img = array_pop($images);
                $first_images[$img->ID] = $img;
            }

            if (count($first_images) < 3) {
                $img = array_pop($images);
                $first_images[$img->ID] = $img;
            }

            if (!empty($first_images)):
                ?>
                <table class="gallery-table">
                    <tbody>
                        <tr>
                            <?php
                            $i = 1;
                            foreach ($first_images as $attachment_id => $attachment):
                                ?>
                                <td style="width: 90mm;" class="<?php echo 0 == $i % 2 ? 't2' : 't1'; ?>">
                                    <table class="img-table-in" style="width: 90mm;">
                                        <tr>
                                            <td class="background-gray" style="width: 100%; height: 258px; min-height: 258px !important;">
                                                <?php echo wp_get_attachment_image($attachment_id, 'pdf_thumb') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 90mm; height:6mm;" class="vbottom img-title">
                                                <?php echo _e($attachment->post_title); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <?php
                                //echo 0 == $i % 2 ? '</tr></tbody></table><table class="gallery-table"  style="page-break-inside: avoid;"><tbody><tr>' : '';
                                $i++;
                            endforeach;
                            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="clear:both"></div>
            <?php endif; ?>
            <!-- /feature image + first from gallery -->

            <div style="">
                <?php if (!empty($props['freitexte|ausstatt_beschr'])): ?>
                    <h2 class="small-label border-left"><?php _e('Description', 'wpbootstrap') ?></h2>
                    <p class="text-block small-block"><?php echo $props['freitexte|ausstatt_beschr'] ?></p>
                <?php endif; ?>

                <?php if (!empty($props['freitexte|objektbeschreibung'])): ?>
                    <h2 class="small-label border-left"><?php _e('Description of the building', 'wpbootstrap') ?></h2>
                    <p class="text-block small-block"><?php echo $props['freitexte|objektbeschreibung'] ?></p>
                <?php endif; ?>

                <?php if (!empty($props['freitexte|lage'])): ?>
                    <h2 class="small-label border-left"><?php _e('Description surroundings', 'wpbootstrap') ?></h2>
                    <p class="text-block small-block"><?php echo $props['freitexte|lage'] ?></p>
                <?php endif; ?>
            </div>

            <?php if (!empty($images)): ?>
                <div style="page-break-before:always;" class="red-label text-center"><?php _e('Gallery', 'wpbootstrap') ?></div>
                <table class="gallery-table"  style="page-break-inside: avoid;">
                    <tbody>
                        <tr>
                            <?php
                            $i = 1;
                            foreach ($images as $attachment_id => $attachment):
                                ?>
                                <td style="width: 90mm;" class="<?php echo 0 == $i % 2 ? 't2' : 't1'; ?>">
                                    <table class="img-table-in" style="width: 90mm;">
                                        <tr>
                                            <td class="background-gray" style="width: 100%; height: 258px; min-height: 258px !important;">
                                                <?php echo wp_get_attachment_image($attachment_id, 'pdf_thumb') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 90mm; height:6mm;" class="vbottom img-title">
                                                <?php
                                                _e($attachment->post_title);
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <?php
                                echo 0 == $i % 2 ? '</tr></tbody></table><table class="gallery-table"  style="page-break-inside: avoid;"><tbody><tr>' : '';
                                $i++;
                            endforeach;
                            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php endif; ?>



            <?php if (!empty($legal_condition)): ?>
                <div id="legal_condition" style="page-break-before:always;">
                    <?php
                    echo $legal_condition;
                    ?>
                </div>
            <?php endif; ?>
        </div>

    </body>
</html>
