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

            .text-block {
                font-size: 13px;
            }
            .text-center {
                text-align: center;
            }
            .block {
                margin-bottom: 10mm;
            }

            h3 {
                font-size: 14px;
            }

            .red-label {
                background: #990033;
                color: white;
                font-size: 22px;
                margin: 10px 0;
                padding: 2mm 10mm;
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
                margin-top: 5mm;
            }
            .vbottom {
                vertical-align: bottom;
            }

            .border-left {
                border-left: 3px solid #990033;
                padding-left: 15px;
            }
            .small-label {
                font-size: 18px;
            }
            table {
                border-collapse: collapse;
            }
            .features td {
                vertical-align: top;
                border-bottom: 1px solid #D8D8D8;
                margin-top: 3mm;
                margin-bottom: 3mm;
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
                background: #cdcdcd;
                text-align: center;
                vertical-align: middle;
                border: 1px solid red;
            }
            .image-wrap .in {
                height: 100mm;
                width: 100%;
            }
            .row {

            }
            .img {
                page-break-inside: avoid;
                -fs-fit-images-to-width: 6in; 
            }
        </style>
    </head>
    <body>


        <?php
        $current_user = wp_get_current_user();
        ?>
        <div id="wrapper">
            <table class="w100 big-border-bottom block">
                <tr>
                    <td class="w50">
                        <?php
                        $attachment_id = get_user_meta(get_current_user_id(), 'logo', true);

                        if (!empty($attachment_id)) {
                            $atts = array(
                                'class' => 'fleft'
                            );
                            echo wp_get_attachment_image($attachment_id, 'pdf_thumb', $atts);
                        }
                        ?>
                    </td>
                    <td class="w50 text-right text-block vbottom">
                        <h3><?php echo get_user_meta(get_current_user_id(), 'company', true) ?></h3>
                        <?php echo get_user_meta(get_current_user_id(), 'address', true) ?>  | <?php echo get_user_meta(get_current_user_id(), 'city', true) ?><br>
                        <?php _e('tel:', $this->plugin_slug) ?>  <?php echo get_user_meta(get_current_user_id(), 'phone', true) ?>
                    </td>
                </tr>
            </table>

            <div class="text-right text-block"><a class="red-color decoration-none" href="mailto:<?php echo $current_user->user_email ?>"><?php echo $current_user->user_email ?></a></div>

            <table class="w100 base-info">
                <tr>
                    <td class="w50 vbottom">
                        <?php _e('Ref:', $this->plugin_slug) ?> <span class="gray-color"><?php esc_attr_e($props['verwaltung_techn|objektnr_extern']) ?></span>
                    </td>
                    <td class="w50 right-head-box text-right">
                        <h2><?php _e('Loyer', $this->plugin_slug) ?> <span class="red-color"><?php esc_attr_e($props['preise|kaufpreis']) ?> <?php esc_attr_e($props['preise|waehrung|iso_waehrung']) ?></span></h2>
                        <?php esc_attr_e($props['geo|strasse']) ?> <?php esc_attr_e($props['geo|wohnungsnr']) ?>,
                        <?php esc_attr_e($props['geo|plz']) ?> <?php esc_attr_e($props['geo|ort']) ?> <?php echo empty($props['geo|regionaler_zusatz']) ? '' : ' - ' . $props['geo|regionaler_zusatz'] ?>
                    </td>
                </tr>
            </table>

            <div class="red-label text-center"><?php echo get_the_title($product->ID) ?></div>

            <h2 class="small-label border-left"><?php _e('Features', $this->plugin_slug) ?></h2>
            <table class="features w100 block">
                <tr>
                    <td class="w25"><?php _e('Ref:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right t2"></td>
                    <td class="w25 t3"><?php _e('Year of construction:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right"><?php echo esc_attr($props['zustand_angaben|baujahr']) ?></td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Purchase price /sm:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right t2"><?php
                        echo esc_attr($props['preise|kaufpreis_pro_qm']) . ' ';
                        echo esc_attr($props['preise|waehrung|iso_waehrung'])
                        ?></td>
                    <td class="w25 t3"><?php _e('Apartment type:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right"><?php echo EstateProgram::$apartment_type[$props['objektart|wohnung|wohnungtyp']] ?></td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Floor:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right t2"><?php echo esc_attr($props['geo|etage']) ?></td>
                    <td class="w25 t3"><?php _e('Number of floors:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right"></td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Rooms:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right t2"><?php echo (int) $props['flaechen|anzahl_zimmer']; ?></td>
                    <td class="w25 t3"><?php _e('Bathroom(s):', $this->plugin_slug) ?></td>
                    <td class="w25 text-right"><?php echo (int) $props['flaechen|anzahl_badezimmer'] ?></td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Elevator:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right t2"><?php echo isset($prop['ausstattung|fahrstuhl|PERSONEN']) ? __("YES", $this->plugin_slug) : __("NO", $this->plugin_slug); ?></td>
                    <td class="w25 t3"><?php _e('Type of heating system:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right"><?php echo EstateProgram::heatingSystem($props) ?></td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Garage / parking spot:', $this->plugin_slug) ?></td>
                    <td class="w25 text-right t2"></td>
                    <td class="w25 t3"><?php _e('Buyer commission (incl. VAT):', $this->plugin_slug) ?></td>
                    <td class="w25 text-right"><?php echo esc_attr($props['preise|aussen_courtage']) ?></td>
                </tr>
            </table>

            <?php if (!empty($props['freitexte|ausstatt_beschr'])): ?>
                <h2 class="small-label border-left"><?php _e('Description', $this->plugin_slug) ?></h2>
                <p class="text-block block"><?php echo $props['freitexte|ausstatt_beschr'] ?></p>
            <?php endif; ?>

            <?php if (!empty($props['freitexte|objektbeschreibung'])): ?>
                <h2 class="small-label border-left"><?php _e('Description', $this->plugin_slug) ?></h2>
                <p class="text-block block"><?php echo $props['freitexte|objektbeschreibung'] ?></p>
            <?php endif; ?>

            <?php if (!empty($props['freitexte|lage'])): ?>
                <h2 class="small-label border-left"><?php _e('Description surroundings', $this->plugin_slug) ?></h2>
                <p class="text-block block"><?php echo $props['freitexte|lage'] ?></p>
            <?php endif; ?>



                        <!--<div style="page-break-after:always;page-break-before:always;">-->
                        <?php
                        $images = & get_children(array(
                                    'post_parent' => $product->ID,
                                    'post_type' => 'attachment',
                                    'post_mime_type' => 'image'
                        ));

                        if (!empty($images)):
                            ?>
                            <div class="red-label text-center"><?php _e('Galerie des images', $this->plugin_slug) ?></div>

                            <?php
                            $i = 0;
                            foreach ($images as $attachment_id => $attachment):
                                ?>

                            <div style="position: relative;" class="image-wrap <?php echo $i % 2 == 0 ? 'fleft' : 'fright' ?>">
                                    <div style="page-break-inside: avoid; page-break-inside: avoid;" class="in">
                                        <?php echo wp_get_attachment_image($attachment_id, 'pdf_thumb') ?>
                                    </div>
                                    <div class="image-label"><?php echo get_the_title($attachment_id) ?></div>
                                </div>
                                <div class="clearfix"></div>
                                <?php
                                $i++;
                            endforeach;
                        endif;
                        ?>

            <!--</div>-->
        </div>



    </body>
</html>