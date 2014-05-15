<script>
    jQuery(document).ready(function() {

        jQuery('#parse-xml').click(function() {
            jQuery('.source-xml').each(function(i, e) {
                console.log(this.html());
            });
        });

    });
</script>
<div class="wrap">
    <div id="poststuff">

        <button type="button" id="parse-xml" class="parse-button button button-primary "><?php _e('Parse XML') ?></button>



        <div class="clearfix"></div>

        <?php
        $langs = EstateProgram::$langs;


        foreach ($langs as $dir => $lang):

            $source_dir = ABSPATH . $dir . '/';
            ?>
            <table class="directory-table">
                <thead>
                <td>Zip directory: <strong><?php echo $dir ?></strong></td>
                </thead>
                <tbody>
                    <?php
                    $mam = false;

                    if ($handle = opendir($source_dir)) {

                        while (false !== ($entry = readdir($handle))) {

                            //var_dump($entry);

                            $file = $source_dir . DIRECTORY_SEPARATOR . $entry;
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                            //var_dump($ext);

                            if ('zip' != strtolower($ext)) {
                                continue;
                            }

                            $mam = true;
                            ?>
                            <tr>
                                <td class="source-xml"><?php echo esc_attr(basename($file)); ?></td>
                            </tr>
                            <?php
                        }
                    }

                    if (false == $mam):
                        ?>
                        <tr>
                            <td>
                                <?php _e('No entry') ?>
                            </td>
                        </tr>
                    <?php endif; ?>        
                </tbody>
            </table>

        <?php endforeach; ?>

    </div>        
</div>



