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
                font-size: 11px;
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
        </style>
    </head>
    <body>


        <?php
        //$lang = qtrans_getLanguage();
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
            <h2 class="small-label border-left"><?php _e('Features', 'wpbootstrap') ?></h2>
            <table class="features w100 small-block text-block">
                <tr>
                    <td class="w25"><?php _e('Ref:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right t2"><?php esc_attr_e($props['verwaltung_techn|objektnr_extern']) ?></td>
                    <td class="w25 t3"><?php _e("Year of construction: ", "wpbootstrap"); ?></td>
                    <td class="w25 text-right"><?php echo esc_attr($props['zustand_angaben|baujahr']) ?></td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Purchase price /sm:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right t2"><?php
                        echo esc_attr(price_format($props['preise|kaufpreis_pro_qm'])) . ' €';
                        ?></td>
                    <td class="w25 t3"><?php _e('Apartment type:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right">
                        <?php echo apartmentTypeL($props) ?>
                    </td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Floor:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right t2"><?php echo esc_attr($props['geo|etage']) ?></td>
                    <td class="w25 t3"><?php _e('Number of floors:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right">
                        <?php
                        if ($props['geo|anzahl_etagen']):
                            echo (int) $props['geo|anzahl_etagen'];
                        endif;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Rooms:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right t2"><?php echo (int) $props['flaechen|anzahl_zimmer']; ?></td>
                    <td class="w25 t3"><?php _e('Bathroom(s):', 'wpbootstrap') ?></td>
                    <td class="w25 text-right">
                        <?php if (!empty($props['flaechen|anzahl_badezimmer'])): ?>
                            <?php echo (int) $props['flaechen|anzahl_badezimmer'] ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Elevator:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right t2"><?php echo isset($prop['ausstattung|fahrstuhl|PERSONEN']) ? __("YES", 'wpbootstrap') : __("NO", 'wpbootstrap'); ?></td>
                    <td class="w25 t3"><?php _e('Type of heating system:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right"><?php echo heatingSystemL($props) ?></td>
                </tr>
                <tr>
                    <td class="w25"><?php _e('Garage / parking spot:', 'wpbootstrap') ?></td>
                    <td class="w25 text-right t2"><?php echo 0 == (int) ($props['preise|stp_sonstige|stellplatzmiete']) ? __('No', 'wpbootstrap') : __('Yes', 'wpbootstrap'); ?></td>
                    <td class="w25 t3"><?php _e('Buyer commission (incl. VAT):', 'wpbootstrap') ?></td>
                    <td class="w25 text-right"><?php echo esc_attr($props['preise|aussen_courtage']) ?></td>
                </tr>
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
                                                <?php echo qtrans_use($lang, $attachment->post_title); ?>
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
                                                echo qtrans_use($lang, $attachment->post_title);
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
        </div>

    </body>
</html>
