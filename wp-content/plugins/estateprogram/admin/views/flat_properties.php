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


</table>
