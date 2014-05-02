<label>
    <?php _e('program:', $this->plugin_slug); ?>

    <select name="flat2program">
        <option value="">---</option>
        <?php
        if (!empty($programs)):
            foreach ($programs as $p):
                ?>
                <option value="<?php echo $p->ID ?>"><?php echo get_the_title($p->ID) ?></option>
                <?php
            endforeach;
        endif;
        ?>
    </select>
</label>


