<?php $tags = EstateProgram::$tags_apartment; ?>

<table>
    <?php foreach ($tags as $tag): ?>

        <?php
        $sql = "
        SELECT
            t2m.tag,
            t2m.meta_key,
            pm.meta_value
        FROM
            wp_postmeta AS pm
        JOIN
            tag2meta_key AS t2m
        ON
            t2m.meta_key = pm.meta_key
        WHERE
            t2m.tag = '" . esc_sql($tag) . "'
        AND
            pm.post_id = '" . (int) $post->ID . "'
        ";

        $properties = $wpdb->get_results($sql);

        //TODO jestli nemam naimportovany vlastnosti vemu defaultni


        if (!empty($properties)):

            $tag = $properties[0]->tag;

            foreach ($properties as $prop):

                if ($tag != $prev_tag):
                    ?>
                    <tr>
                        <td colspan="2">&nbsp</td>
                    </tr>
            <?php endif; ?>
                <tr>
                    <th class="textleft">
                        <label for="flat-price">
            <?php echo esc_attr($prop->meta_key) ?>
                        </label>
                    </th>
                    <td>
            <?php echo esc_attr($prop->meta_value) ?>
                    </td>
                <tr>
                    <?php
                    $prev_tag = $tag;
                endforeach;
            endif;
            ?>

<?php endforeach; ?>
</table>


<!--
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
-->




