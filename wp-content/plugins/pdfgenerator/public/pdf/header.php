<?php
$current_user = wp_get_current_user();
?>
<div style="height: 30mm; width: 100%; background: white;">
    <table style="width: 168mm; margin: 0 0 0 3mm; font-family: arial; font-size: 13px;">
        <tr>
            <td style="width:50%; vertical-align: top;">
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
            <td style="text-align: right; width: 50%;  vertical-align: top;">
                <h3 style="font-weight: bold; font-size: 14px;"><?php echo get_user_meta(get_current_user_id(), 'company', true) ?></h3>
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
                <a style="color: #990033; text-decoration: none;" href="mailto:<?php echo $current_user->user_email ?>"><?php echo $current_user->user_email ?></a>
            </td>
        </tr>
    </table>
</div>