<div class="wrap">
    <div id="poststuff">

        <h2><?php _e('Stats by product', $this->plugin_slug) ?>
            <a class="add-new-h2" href="/wp-admin/admin.php?page=aden_stat"><?php _e('By user', $this->plugin_slug) ?></a>
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
                        <th><?php _e('Product title', $this->plugin_slug) ?></th>
                        <th><?php _e('Ref. no', $this->plugin_slug) ?></th>
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
                                <?php echo esc_sql($row->title) ?>
                            </td>
                            <td>
                                <?php echo esc_sql($row->ref_no) ?>
                            </td>
                            <td>
                                <a href="/wp-admin/admin.php?page=product_detail_recommendation&product_id=<?php echo $row->product_id ?>"><?php echo esc_sql($row->emails) ?></a>
                            </td>
                            <td>
                                <a href="/wp-admin/admin.php?page=product_detail_download&product_id=<?php echo $row->product_id ?>"><?php echo esc_sql($row->download) ?></a>
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