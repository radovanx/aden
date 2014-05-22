<div class="wrap">
    <div id="poststuff">

        <?php include 'stat-top_nav.php'; ?>

        <h2><?php _e('Stats by product', $this->plugin_slug) ?>
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
                        <th><?php _e('Product', $this->plugin_slug) ?></th>
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
                                <a href="/wp-admin/post.php?post=<?php echo (int) $row->product_id ?>&action=edit"><?php echo esc_sql($row->title) ?></a>
                            </td>
                            <td>
                                <span class="color-brown"><?php echo esc_sql($row->ref_no) ?></span>
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
        <?php else: ?>
            <p><?php _e('No entry', $this->plugin_slug) ?></p>
        <?php endif; ?>
    </div>
</div>