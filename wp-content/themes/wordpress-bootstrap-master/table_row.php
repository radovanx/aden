<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<tbody>
    <?php
    $i = 0;
    if (!empty($flat_props)):
        foreach ($flat_props as $key => $val):
            $prop = unserialize($val->prop);
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($val->ID), 'flat-small');
            $url_image = $thumb['0'];
            $url = get_permalink($val->ID);
            $city = !empty($prop['geo|ort']) ? esc_attr($prop['geo|ort']) : "-";
            $district = !empty($prop['geo|regionaler_zusatz']) ? esc_attr($prop['geo|regionaler_zusatz']) : "-";
            $area = !empty($prop['flaechen|wohnflaeche']) ? esc_attr($prop['flaechen|wohnflaeche']) : 0;
            $rooms = !empty($prop['flaechen|anzahl_zimmer']) ? esc_attr($prop['flaechen|anzahl_zimmer']) : 0;
            $hnumber = !empty($prop['geo|hausnummer']) ? esc_attr($prop['geo|hausnummer']) : 0;
            $floor = !empty($prop['geo|etage']) ? esc_attr($prop['geo|etage']) : 0;
            $street = !empty($prop['geo|strasse']) ? esc_attr($prop['geo|strasse']) : "-";
            $zip = !empty($prop['geo|plz']) ? esc_attr($prop['geo|plz']) : 0;
            $pricem = !empty($prop['preise|kaufpreis_pro_qm']) ? esc_attr($prop['preise|kaufpreis_pro_qm']) : 0;
            $price = !empty($prop['preise|kaufpreis']) ? esc_attr($prop['preise|kaufpreis']) : 0;
            $name = !empty($prop['freitexte|objekttitel']) ? esc_attr($prop['freitexte|objekttitel']) : "-";
            $rental_status = isset($prop['verwaltung_objekt|vermietet']) ? esc_attr($prop['verwaltung_objekt|vermietet']) : "free"; 
            $status = statusL($prop);
            $reference = isset($prop['verwaltung_techn|objektnr_extern']) ? esc_attr($prop['verwaltung_techn|objektnr_extern']) : "-";
            $flat_num = !empty($prop['geo|wohnungsnr']) ? esc_attr($prop['geo|wohnungsnr']) : "-"; 
            $price = (int) $price;
            $pricem = (int) $pricem; 
             if( $status == 'OFFEN' )
               {
               $status = '';
               } 
              if($rental_status == 1)
                { 
                $rental_status = 'rented';
                } 
            ?>
            <tr class="apartment-row-<?php echo $val->ID ?> apartment-row <?php echo $i % 2 ? 'background' : 'no-background'; ?>">
                <td><a class="add-to-preference" data-toggle="modal"  data-flat_id="<?php echo $val->ID ?>" href="#myModal"><i class="fa <?php echo $val->is_favorite == 0 ? 'blue fa-star-o' : 'red fa-star' ?>"></i><span class="small-text hidden"><?php echo $val->is_favorite; ?></span></a>
                </td>
                <td> <?php echo $reference; ?>
                </td>
                <td><a href="<?php echo $url; ?>" class="blue"><?php echo $street; ?> <?php echo $hnumber; ?> , <?php echo $city; ?>, <?php echo $district; ?> <?php echo $zip; ?> </a>
                </td>
                <td><?php echo $flat_num; ?>       
                </td>
                <td>
                    <?php echo $rental_status; ?> 
                </td>
                <td>
                    <?php echo $floor; ?>          
                </td>
                <td>
                    <?php echo (int) $rooms; ?>
                </td>
                <td>
                    <?php echo $area; ?> m²
                </td>
                <td>
                    <?php echo price_format($price); ?>&euro;
                </td>
                <td>
                    <?php echo price_format($pricem); ?>&euro;  
                </td>
                <td>
                    
                </td>
                <td>
                    <?php echo $status; ?>
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
    endif;
    ?>
</tbody>