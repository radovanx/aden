<div class="wrap">
    <div id="poststuff">

        <?php include 'stat-top_nav.php'; ?>
        
        <h2><?php _e('Product downloads', $this->plugin_slug) ?>
            <a class="add-new-h2" href="/wp-admin/admin.php?page=stat_by_product"><?php _e('Back', $this->plugin_slug) ?></a>
        </h2>

        <table class="headline-tab">
            <tr>
                <th><?php _e('Product', $this->plugin_slug) ?></th>
                <td><?php echo esc_attr($props['freitexte|objekttitel']) ?></td>
            </tr>
            <tr>
                <th><?php _e('ref. no', $this->plugin_slug) ?></th>
                <td><?php echo esc_attr($props['verwaltung_techn|objektnr_extern']) ?></td>
            </tr>
        </table>

        <?php if (!empty($results)): ?>
            <table class="rec-list stat-table wp-list-table widefat fixed posts">
                <colgroup>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th><?php _e('Partner name', $this->plugin_slug) ?></th>
                        <th><?php _e('Email', $this->plugin_slug) ?></th>                        
                        <th><?php _e('Date', $this->plugin_slug) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($results as $row):
                        
                        $user_info = get_userdata($row->user_id);
                        
                        ?>
                        <tr id="row-<?php echo $row->stat_id ?>" class="<?php echo 0 == $i % 2 ? 'even' : 'odd' ?>">
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
                                <?php echo esc_sql($row->fdate) ?>
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