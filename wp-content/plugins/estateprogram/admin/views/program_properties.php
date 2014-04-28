<table>
    <tr>
        <th class="textleft"><label for="program-city"><?php _e('City', $this->plugin_slug) ?></label></th>
        <td>
            <input id="program-city" type="text" name="_program_city" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_city', true)) ?>">
        </td>
    </tr>
    <tr>
        <th class="textleft"><label for="program-city"><?php _e('Program district', $this->plugin_slug); ?></label></th>
        <td>
            <input id="program-district" type="text" name="_program_district" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_district', true)) ?>">
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp</td>
    </tr>
    <tr>
        <th colspan="2" class="textleft"><?php _e('Price range', $this->plugin_slug); ?></th>
    </tr>
    <tr>
        <td>
            <label for="range-from">
                <?php _e('from:', $this->plugin_slug); ?>
            </label>
        </td>
        <td>
            <input id="range-from" type="number" name="_program_range_from" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_range_from', true)) ?>">
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
            <input id="range-to" type="number" name="_program_range_to" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_range_to', true)) ?>">
            <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp</td>
    </tr>
    <!-- surface range -->
    <tr>
        <th colspan="2" class="textleft"><?php _e('Surface range', $this->plugin_slug); ?></th>
    </tr>
    <tr>
        <td>
            <label for="range-from">
                <?php _e('from:', $this->plugin_slug); ?>
            </label>
        </td>
        <td>
            <input id="range-from" type="number" name="_program_surface_from" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_surface_from', true)) ?>">
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
            <input id="range-to" type="number" name="_program_surface_to" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_program_surface_to', true)) ?>">
            <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
        </td>
    </tr>    
    <!-- /surface range -->
    <tr>
        <td colspan="2">&nbsp</td>
    </tr>    
    <tr>
        <th class="textleft">
            <label for="elevator"><?php _e('Elevator', $this->plugin_slug); ?></label>
        </th>
        <td>
            <input id="elevator" type="checkbox" name="_program_elevator" value="1" <?php echo 1 == get_post_meta($post->ID, '_program_elevator', true) ? ' checked="checked"' : '' ?>>
        </td>
    </tr>    
</table>
