<div class="wrap">
    <div id="poststuff">

        <h2><?php _e('Stats', $this->plugin_slug) ?>
            <a class="add-new-h2" href="/wp-admin/admin.php?page=recommendation_stat_by_product"><?php _e('By product', $this->plugin_slug) ?></a>
        </h2>

        <?php if (!empty($results)): ?>
            <table class="rec-list stat-table">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th><?php _e('User', $this->plugin_slug) ?></th>
                        <th><?php _e('User email', $this->plugin_slug) ?></th>
                        <th><?php _e('Recommendations', $this->plugin_slug) ?></th>
                        <th><?php _e('Downloads', $this->plugin_slug) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($results as $row):
                        $user_info = get_userdata($row->user_id);
                        ?>
                        <tr class="<?php echo 0 == $i % 2 ? 'even' : 'odd' ?>">
                            <td>
                                <a href="/wp-admin/user-edit.php?user_id=<?php echo (int) $row->user_id ?>" style="text-decoration: none;">
                                    <span class="wp-menu-image dashicons-before dashicons-admin-users"></span>
                                </a>
                                <?php echo $user_info->first_name ?> <?php echo $user_info->last_name ?>
                            </td>
                            <td>
                                <?php echo esc_sql($user_info->user_email) ?>
                            </td>
                            <td>
                                <a href="/wp-admin/admin.php?page=stat_user_detail_recommendation&user_id=<?php echo $row->user_id ?>"><?php echo (int) $row->emails ?></a>
                            </td>
                            <td>
                                <a href="/wp-admin/admin.php?page=stat_user_detail_download&user_id=<?php echo $row->user_id ?>"><?php echo (int) $row->download ?></a>
                            </td>
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