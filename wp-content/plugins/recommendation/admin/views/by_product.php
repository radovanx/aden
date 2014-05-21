<div class="wrap">
    <div id="poststuff">

        <h2><?php _e('Stats', $this->plugin_slug) ?>
            <a class="add-new-h2" href="/wp-admin/admin.php?page=recommendation_stat"><?php _e('By users', $this->plugin_slug) ?></a>
        </h2>

        <?php if (!empty($results)): ?>
            <table class="rec-list stat-table">
                <colgroup>
                    <col width="255px;">
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th><?php _e('Product title', $this->plugin_slug) ?></th>
                        <th><?php _e('ref. no', $this->plugin_slug) ?></th>
                        <th><?php _e('Emails', $this->plugin_slug) ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($results as $row):
                        $user_info = get_userdata($row->user_id);

                        $props = unserialize($row->product);
                        ?>
                        <tr class="<?php echo 0 == $i % 2 ? 'even' : 'odd' ?>">
                            <td>
                                <?php echo esc_attr($props['freitexte|objekttitel']) ?>
                            </td>
                            <td>
                                <div class="color-brown">
                                    <?php echo esc_attr($props['verwaltung_techn|objektnr_extern']) ?>
                                </div>
                            </td>
                            <td><?php echo esc_attr($row->emails) ?></td>
                            <td><a href="/wp-admin/admin.php?page=recommentation_product_detail&product_id=<?php echo $row->product_id ?>"><?php _e('See details', $this->plugin_slug) ?></a></td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>