<table>
    <tr>
        <th class="textleft"><label for="program-city"><?php _e('City', $this->plugin_slug) ?></label></th>
        <td>
            <input id="program-city" type="text" name="program_city" value="<?php echo esc_attr(get_post_meta($post->ID, 'program_city', true)) ?>">
        </td>
    </tr>
    <tr>
        <th class="textleft"><label for="program-city"><?php _e('Program district', $this->plugin_slug); ?></label></th>
        <td>
            <input id="program-district" type="text" name="program_district" value="<?php echo esc_attr(get_post_meta($post->ID, 'program_district', true)) ?>">
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
            <label>
                <?php _e('from:', $this->plugin_slug); ?>
            </label>
        </td>
        <td>
            <input id="range-from" type="number" name="range_from" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, 'range_from', true)) ?>">
            <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
        </td>
    </tr>
    <tr>
        <td>
            <label>
                <?php _e('to:', $this->plugin_slug); ?>
            </label>
        </td>
        <td>
            <input id="range-to" type="number" name="range_to" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, 'range_to', true)) ?>">
            <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
        </td>
    </tr>
</table>
