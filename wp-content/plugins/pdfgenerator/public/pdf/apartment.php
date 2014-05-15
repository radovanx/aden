<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $filename ?></title>
        <style>
            * {
                padding: 0;
                margin: 0;
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
                margin-bottom: 20px;
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

        </style>
    </head>
    <body>
        <?php
        $current_user = wp_get_current_user();
        ?>
        <div id="wrapper">
            <table class="w100 big-border-bottom">
                <tr>
                    <td class="w50">
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


        </div>



    </body>
</html>