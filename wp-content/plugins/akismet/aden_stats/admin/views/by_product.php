<div class="wrap">
    <div id="poststuff">

        <?php include 'stat-top_nav.php'; ?>

        <h2><?php _e('Stats by product', $this->plugin_slug) ?>
        </h2>

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
                        <th class="manage-column column-title sortable <?php echo $this->order_class('l.title') ?>">
                            <a href="<?php echo $this->order_link('stat_by_product', 'l.title') ?>">
                                <span><?php _e('Product', $this->plugin_slug) ?></span>
                                <span class="sorting-indicator"></span>
                            </a>
                        </th>
                        <th class="manage-column column-title sortable <?php echo $this->order_class('s.ref_no') ?>">
                            <a href="<?php echo $this->order_link('stat_by_product', 's.ref_no') ?>">
                                <span><?php _e('Ref. no', $this->plugin_slug) ?></span>
                                <span class="sorting-indicator"></span>
                            </a>                                                        
                        </th>
                        <th class="manage-column column-title sortable <?php echo $this->order_class('emails') ?>">
                            <a href="<?php echo $this->order_link('stat_by_product', 'emails') ?>">
                                <span><?php _e('Recommendations', $this->plugin_slug) ?></span>
                                <span class="sorting-indicator"></span>
                            </a>                                                        
                        </th>
                        <th class="manage-column column-title sortable <?php echo $this->order_class('download') ?>">
                            <a href="<?php echo $this->order_link('stat_by_product', 'download') ?>">
                                <span><?php _e('Downloads', $this->plugin_slug) ?></span>
                                <span class="sorting-indicator"></span>
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
                                <a href="/wp-admin/post.php?post=<?php echo (int) $row->product_id ?>&action=edit"><?php echo esc_sql($row->title) ?></a>
                            </td>
                            <td>
                                <span class="color-brown"><?php echo esc_sql($row->ref_no) ?></span>
                            </td>
                            <td>
                                <a href="/wp-admin/admin.php?page=product_detail_recommendation&product_id=<?php echo $row->ref_no ?>"><?php echo esc_sql($row->emails) ?></a>
                            </td>
                            <td>
                                <a href="/wp-admin/admin.php?page=product_detail_download&product_id=<?php echo $row->ref_no ?>"><?php echo esc_sql($row->download) ?></a>
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