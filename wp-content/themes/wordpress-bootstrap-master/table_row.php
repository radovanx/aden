<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<tr class="<?php echo $i % 2 ? 'background' : 'no-background'; ?>">
<td>
<a class = "add-to-preference" data-toggle = "modal" data-flat_id = "<?php echo $val->ID ?>" href = "#myModal"><i class = "fa <?php echo $val->is_favorite == 0 ? 'blue fa-star-o' : 'red fa-star' ?>"></i><?php echo $val->is_favorite;
?></a>
</td>
<td>
    <?php echo esc_attr($prop['verwaltung_techn|objektnr_extern']) ?>
</td>
<td>
    <a href="<?php echo $url; ?>" class="blue"><?php echo $street; ?> <?php echo $hnumber; ?> , <?php echo $city; ?>, <?php echo $district; ?> <?php echo $zip; ?> </a>
</td>
<td>
    <?php echo $flat_num; ?>       
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
    <?php echo esc_attr($prop['flaechen|wohnflaeche']) ?>
</td>
<td>
    <?php echo $price; ?>
</td>
<td>
    <?php echo $pricem; ?>
</td>
<td>   

</td>
<td>
    <?php echo $status; ?>
</td>
</tr>
