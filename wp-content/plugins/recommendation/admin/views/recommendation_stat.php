<div class="wrap">
    <div id="poststuff">
        <?php

        ?>

        <?php if (!empty($results)): ?>
            <table class="rec-list stat-table">
                <colgroup>
                    <col width="255px;">
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th><?php _e('User', $this->plugin_slug) ?></th>
                        <th><?php _e('Receiver', $this->plugin_slug) ?></th>
                        <th><?php _e('Date', $this->plugin_slug) ?></th>
                        <th><?php _e('ref. no', $this->plugin_slug) ?></th>
                        <th><?php _e('Object title', $this->plugin_slug) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($results as $row):

                        $props = unserialize($row->product);
                        $user_info = get_userdata($row->user_id);
                        ?>
                        <tr class="<?php echo 0 == $i % 2 ? 'even' : 'odd' ?>">
                            <td>
                                <a href="/wp-admin/user-edit.php?user_id=<?php echo (int) $row->user_id ?>" style="text-decoration: none;">
                                    <span class="wp-menu-image dashicons-before dashicons-admin-users"></span>
                                </a>
                                <?php echo $user_info->user_email ?>
                            </td>
                            <td><?php echo esc_attr($row->receiver) ?></td>
                            <td><?php echo esc_attr($row->fdate) ?></td>
                            <td class="color-brown"><?php echo esc_attr($props['verwaltung_techn|objektnr_extern']) ?></td>
                            <td><?php echo esc_attr($props['freitexte|objekttitel']) ?></td>
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