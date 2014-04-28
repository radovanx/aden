<table>
    <tr>
        <th class="textleft">
            <label for="flat-price">
                <?php _e('Price', $this->plugin_slug) ?>
            </label>
        </th>
        <td>
            <input id="flat-price" type="number" name="_flat_price" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_flat_price', true)) ?>">
        </td>
    </tr>
    <tr>
        <th class="textleft">
            <label for="number-of-room"><?php _e('Number of room', $this->plugin_slug); ?></label>
        </th>
        <td>
            <input id="number-of-room" type="number" min="0" name="_flat_number_of_room" value="<?php echo esc_attr(get_post_meta($post->ID, '_flat_number_of_room', true)) ?>">
        </td>
    </tr>
    <tr>
        <th class="textleft">
            <label for="elevator"><?php _e('Elevator', $this->plugin_slug); ?></label>
        </th>
        <td>
            <input id="elevator" type="checkbox" name="_flat_elevator" value="1" <?php echo 1 == get_post_meta($post->ID, '_flat_elevator', true) ? ' checked="checked"' : '' ?>>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp</td>
    </tr>
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
            <input id="range-from" type="number" name="_flat_surface_from" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_flat_surface_from', true)) ?>">
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
            <input id="range-to" type="number" name="_flat_surface_to" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_flat_surface_to', true)) ?>">
            <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
        </td>
    </tr>
</table>
