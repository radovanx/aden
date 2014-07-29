<table>

    <?php $langs = qtrans_getSortedLanguages(); ?>
    <?php foreach ($langs as $lang): ?>
        <tr>
            <td colspan="2"><h3 style="text-transform: uppercase;"><?php echo $lang ?></h3></td>
        </tr>
        <tr>
            <th class="textleft"><label for="_program_apartments"><?php _e('Apartments', $this->plugin_slug); ?></label></th>
            <td>
                <input id="_program_apartments" type="text" name="_program_apartments_<?php echo $lang ?>" value="<?php echo esc_attr(qtrans_use($lang, get_post_meta($post->ID, '_program_apartments', true), false)) ?>">
            </td>
        </tr>
    <?php endforeach; ?>

    <tr>
        <th colspan="2"><h3>&nbsp</h3></th>
</tr> 

<tr>
    <th class="textleft"><label for="_program_street"><?php _e('Street', $this->plugin_slug); ?></label></th>
    <td>
        <input id="_program_street" type="text" name="_program_street" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_street', true)) ?>">
    </td>
</tr>
<tr>
    <th class="textleft"><label for="_program_house_number"><?php _e('House number', $this->plugin_slug); ?></label></th>
    <td>
        <input id="_program_house_number" type="text" name="_program_house_number" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_house_number', true)) ?>">
    </td>
</tr>
<tr>
    <th class="textleft"><label for="_program_region"><?php _e('Region', $this->plugin_slug); ?></label></th>
    <td>
        <input id="_program_region" type="text" name="_program_region" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_region', true)) ?>">
    </td>
</tr>
<tr>
    <th class="textleft"><label for="_program_city"><?php _e('City', $this->plugin_slug); ?></label></th>
    <td>
        <input id="_program_city" type="text" name="_program_city" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_city', true)) ?>">
    </td>
</tr>
<tr>
    <th class="textleft"><label for="_program_postcode"><?php _e('Postcode', $this->plugin_slug); ?></label></th>
    <td>
        <input id="_program_postcode" type="text" name="_program_postcode" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_postcode', true)) ?>">
    </td>
</tr>

<tr>
    <th colspan="2"><h3>&nbsp</h3></th>
</tr>

<?php 
$_program_video = get_post_meta($post->ID, '_program_video', true);
for($i = 0; $i < 5; $i++): ?>
<tr>
    <th class="textleft"><label for="_program_video"><?php _e('Video url', $this->plugin_slug) ?></label></th>
    <td>
        <input id="_program_video" style="width:340px;" type="text" name="_program_video[<?php echo $i ?>]" value="<?php echo isset($_program_video[$i]) ? esc_attr($_program_video[$i]) : ''  ?>">
    </td>
</tr>
<?php endfor; ?>
<tr>
    <th colspan="2"><h3>&nbsp</h3></th>
</tr> 
<tr>
    <th class="textleft"><label for="_program_commission"><?php _e('Commission (incl. VAT)', $this->plugin_slug) ?></label></th>
    <td>
        <input id="_program_commission" type="text" name="_program_commission" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_commission', true)) ?>">
    </td>
</tr>
<tr>
    <th class="textleft"><label for="program-latitude"><?php _e('Program latitude', $this->plugin_slug); ?></label></th>
    <td>
        <input id="program-latitude" type="text" name="_program_latitude" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_latitude', true)) ?>">
    </td>
</tr>
<tr>
    <th class="textleft"><label for="program-longitude"><?php _e('Program longitude', $this->plugin_slug); ?></label></th>
    <td>
        <input id="program-longitude" type="text" name="_program_longitude" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_longitude', true)) ?>">
    </td>
</tr>
<tr>
    <td colspan="2">&nbsp</td>
</tr>
<tr>
    <th colspan="2" class="textleft"><?php _e('Price range (€)', $this->plugin_slug); ?></th>
</tr>
<tr>
    <td>
        <label for="range-from">
            <?php _e('from:', $this->plugin_slug); ?>
        </label>
    </td>
    <td>
        <input id="range-from" type="text" name="_program_price_from" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_price_from', true)) ?>">
        <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
    </td>
</tr>
<tr>
    <td>
        <label for="range-to">
            <?php _e('to:', $this->plugin_slug); ?>
        </label>
    </td>
    <td>
        <input id="range-to" type="text" name="_program_price_to" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_price_to', true)) ?>">
        <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
    </td>
</tr>
<tr>
    <td colspan="2">&nbsp</td>
</tr>
<!-- surface range -->
<tr>
    <th colspan="2" class="textleft"><?php _e('Surface range (m²)', $this->plugin_slug); ?></th>
</tr>
<tr>
    <td>
        <label for="range-from">
            <?php _e('from:', $this->plugin_slug); ?>
        </label>
    </td>
    <td>
        <input id="range-from" type="text" name="_program_surface_from" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)) ?>">
        <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
    </td>
</tr>
<tr>
    <td>
        <label for="range-to">
            <?php _e('to:', $this->plugin_slug); ?>
        </label>
    </td>
    <td>
        <input id="range-to" type="text" name="_program_surface_to" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)) ?>">
        <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
    </td>
</tr>
<!-- /surface range -->
<tr>
    <td colspan="2">&nbsp</td>
</tr>
<!--
<tr>
    <th class="textleft">
        <label for="elevator"><?php _e('Elevator', $this->plugin_slug); ?></label>
    </th>
    <td>
        <input id="elevator" type="checkbox" name="_program_elevator" value="1" <?php echo 1 == get_post_meta($post->ID, '_program_elevator', true) ? ' checked="checked"' : '' ?>>
    </td>
</tr>-->
</table>
