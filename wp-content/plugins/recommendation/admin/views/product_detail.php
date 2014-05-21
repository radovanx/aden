<div class="wrap">
    <div id="poststuff">
        <h2>
            <?php _e('Stats', $this->plugin_slug) ?>            
            <a class="add-new-h2" href="/wp-admin/admin.php?page=recommendation_stat_by_product"><?php _e('Back', $this->plugin_slug) ?></a>
        </h2>
        
        

        <table>
            <tr>
                <th><?php _e('User name', $this->plugin_slug) ?></th>
                <td><?php echo esc_attr($user_info->first_name) ?> <?php echo esc_attr($user_info->last_name) ?></td>
            </tr>    
            <tr>
                <th><?php _e('User email', $this->plugin_slug) ?></th>
                <td><?php echo esc_attr($user_info->user_email) ?></td>
            </tr>   
            <tr>
                <th><?php _e('Registered', $this->plugin_slug) ?></th>
                <td>
                    <?php
                    $user_data = get_userdata($user->ID);
                    $register_date = DateTime::createFromFormat('Y-m-d H:i:s', $user_info->user_registered);
                    ?>
                    <?php echo false != $register_date ? $register_date->format('j. n. Y H:i') : '' ?>                            
                </td>
            </tr>            
        </table>    

        <?php if (!empty($results)): ?>
            <table class="rec-list stat-table">
                <colgroup>
                    <col width="255px;">
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th><?php _e('To', $this->plugin_slug) ?></th>
                        <th><?php _e('Date', $this->plugin_slug) ?></th>
                        <th><?php _e('Product title', $this->plugin_slug) ?></th>
                        <th><?php _e('ref. no', $this->plugin_slug) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($results as $row):
                        ?>
                        <tr class="<?php echo 0 == $i % 2 ? 'even' : 'odd' ?>">
                            <?php
                            $props = unserialize($row->product);
                            ?>
                            <td><?php echo esc_attr($row->receiver) ?></td>
                            <td><?php echo esc_attr($row->when_sent) ?></td>
                            <td><?php echo esc_attr($props['freitexte|objekttitel']) ?></td>
                            <td><span class="color-brown"><?php echo esc_attr($props['verwaltung_techn|objektnr_extern']) ?></span></td>
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