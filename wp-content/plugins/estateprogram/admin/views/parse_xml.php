<script>

    var element_array = Array();

    function load_xml(index) {

        if (index >= element_array.length) {
            return;
        } else {

            var element = element_array[index];

            var filename = element.text();
            var dir = element.attr('data-dir');
            var url = ajaxurl + '?action=backend_parse_xml&file=' + filename + '&dir=' + dir;

            /*
             jQuery.post(url, function(response) {
             //jQuery()
             console.log(response);
             if ('ok' == response) {
             element.remove();
             }
             })*/

            jQuery.ajax({
                type: 'POST',
                url: url,
                beforeSend: function(xhr) {
                    jQuery('#parse-xml').attr('disabled', 'disabled');
                    jQuery('#parse-state').append('<p><strong>Processing: </strong>'+filename+'</p><img src="<?php echo plugins_url(__FILE__) ?>assets/img/103.gif">');
                }
                //data: data,
                //success: success
                //dataType: dataType
            }).done(function(response) {
                if ('ok' == response) {
                    element.remove();
                }
            }).fail(function() {
                //alert( "error" );
            }).always(function() {
                jQuery('#parse-xml').removeAttr('disabled');
                //console.log('always');                
                //load_xml(++index);
            });
        }
    }

    jQuery(document).ready(function() {
        jQuery('#parse-xml').click(function() {
            jQuery('.source-xml').each(function(i) {
                element_array.push(jQuery(this));
            });
            load_xml(0);
        });

    });
</script>
<div class="wrap">
    <div id="poststuff">

        <button type="button" id="parse-xml" class="parse-button button button-primary "><?php _e('Parse XML') ?></button>

        <div id="parse-state"></div>

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
                        $i = 0;
                        while (false !== ($entry = readdir($handle))) {

                            $file = $source_dir . DIRECTORY_SEPARATOR . $entry;
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                            if ('zip' != strtolower($ext)) {
                                continue;
                            }

                            $mam = true;
                            ?>
                            <tr>
                                <td id="row-<?php echo $i ?>" class="source-xml" data-dir="<?php echo $dir ?>"><?php echo esc_attr(basename($file)); ?></td>
                            </tr>
                            <?php
                            $i++;
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