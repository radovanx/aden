<div class="wrap">
    <div id="poststuff">

        <h2><?php _e('User download stats', $this->plugin_slug) ?>
            <a class="add-new-h2" href="/wp-admin/admin.php?page=aden_stat"><?php _e('Back', $this->plugin_slug) ?></a>
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
                    $register_date = DateTime::createFromFormat('Y-m-d H:i:s', $user_info->user_registered);
                    ?>
                    <?php echo false != $register_date ? $register_date->format('j. n. Y H:i') : '' ?>                            
                </td>
            </tr>            
        </table>         

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
                        <th><?php _e('Product title', $this->plugin_slug) ?></th>
                        <th><?php _e('Ref. no', $this->plugin_slug) ?></th>
                        <th><?php _e('Date', $this->plugin_slug) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($results as $row):                        
                        ?>
                        <tr id="row-<?php echo $row->stat_id ?>" class="<?php echo 0 == $i % 2 ? 'even' : 'odd' ?>">
                            <td>
                                <?php echo esc_sql($row->title) ?>
                            </td>
                            <td>
                                <span class="color-brown"><?php echo esc_sql($row->ref_no) ?></span>
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
        <?php endif; ?>
    </div>
</div>