<div class="wrap">
    <div id="poststuff">

        <?php include 'stat-top_nav.php'; ?>

        <h2><?php _e('Stats by user', $this->plugin_slug) ?></h2>

        <?php if (!empty($results)): ?>
            <table class="rec-list stat-table wp-list-table widefat fixed posts">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>

                        <th id="user-name" class="manage-column column-title sortable <?php echo $this->order_class('um.meta_value') ?>">
                            <a href="<?php echo $this->order_link('aden_stat', 'um.meta_value') ?>">
                                <span><?php _e('User', $this->plugin_slug) ?></span><span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th id="user-email" class="manage-column column-title sortable <?php echo $this->order_class('u.user_email') ?>">
                            <a href="<?php echo $this->order_link('aden_stat', 'u.user_email') ?>">
                                <span><?php _e('User email', $this->plugin_slug) ?></span><span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th id="user-recommendations" class="manage-column column-title sortable <?php echo $this->order_class('emails') ?>">
                            <a href="<?php echo $this->order_link('aden_stat', 'emails') ?>">
                                <span><?php _e('Recommendations', $this->plugin_slug) ?></span><span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th id="user-downloads" class="manage-column column-title sortable <?php echo $this->order_class('download') ?>">
                            <a href="<?php echo $this->order_link('aden_stat', 'download') ?>">
                                <span><?php _e('Downloads', $this->plugin_slug) ?></span><span class="sorting-indicator"></span>
                            </a>
                        </th>
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
        <?php else: ?>
            <p><?php _e('No entry', $this->plugin_slug) ?></p>
        <?php endif; ?>
    </div>
</div>