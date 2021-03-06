<script>

    var element_array = [];
    var sorted_elements = [];

    function load_xml(index) {

        if (index >= sorted_elements.length) {
            sorted_elements = [];
            return;
        } else {
            var id = index;
            
            var element = jQuery(sorted_elements[index]);

            var filename = element.text();
            var dir = element.attr('data-dir');
            
            var url = ajaxurl;
            
            var data = {
              'action' : 'backend_parse_xml',
              'file' : filename, 
              'dir' : dir  
            }

            var xhr = jQuery.ajax({
                type: 'POST',
                url: url,
                data: data,
                //timeout: 300000, 
                beforeSend: function(xhr) {
                    jQuery('#parse-xml').attr('disabled', 'disabled');
                    jQuery('#parse-state').append('<div id="processing"><p><strong>Processing: </strong>' + dir + '/' + filename + '</p><img src="<?php echo $this->plugin_url ?>assets/img/712.gif"></div>');
                }
            }).done(function(response) {
                if ('ok' == response) {
                    element.closest('tr').remove();
                } if('double'){
                    element.closest('tr').remove();
                    //element.css('color', 'orange');
                } else {
                    jQuery('#error-list').append('<div class="error below-h2"><p>Error: import <strong>' + filename + '</strong></p></div>');
                }
            }).fail(function(response, status, error) {            
                console.log(response);
                console.log(status);
                //console.log(error);
                jQuery('#error-list').append('<div class="error below-h2"><p>Error: import <strong>' + filename + '</strong></p></div>');
            }).always(function() {
                jQuery('#parse-xml').removeAttr('disabled');
                jQuery('#parse-state').html('');

                load_xml(++index);

                //setTimeout(load_xml(++index), 3000);
                
            });
            
            /*
            jQuery.when(xhr).always(function(xhr){
                //console.log('xhr done');
                load_xml(++index);
            });*/
        }
    }

    jQuery(document).ready(function() {
        jQuery('#parse-xml').click(function() {

            /*
            jQuery('.source-xml').each(function(i) {
                sorted_elements.push(jQuery(this));
            });*/


            // zjistim kolik je nejvic souboru v nekterym z adresaru
            var max_files = 0;

            var directories = [];
            
            sorted_elements = [];

            jQuery('.directory-table').each(function(i) {

                var rows = jQuery(this).find('.source-xml'); 
                if (max_files < rows.length) {
                    max_files = rows.length;
                }
                directories.push(rows);
            });
 
            for (i = 0; i < max_files; i++) {
                jQuery(directories).each(function(j) {
                    sorted_elements.push(directories[j][i]);
                });
            }            
            
            sorted_elements = jQuery.grep(sorted_elements,function(n){ return(n) });
           
           //console.log(sorted_elements);
           
            //console.log(sorted_elements);            
            load_xml(0); 
            return false;
        }); 
    });
</script>
<div class="wrap">
    <div id="poststuff"> 
        <button type="button" id="parse-xml" class="parse-button button button-primary "><?php _e('Parse XML') ?></button> 
        <div id="parse-state"></div> 
        <div class="clearfix"></div> 
        <div id="error-list"></div> 
        <?php
        $langs = EstateProgram::$langs;

        foreach ($langs as $dir => $lang):

            $source_dir = ABSPATH . $dir . '/';
            ?>
            <table class="directory-table">
                <thead>
                    <tr>
                        <td></td>
                        <td>Zip directory: <strong><?php echo $dir ?></strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $mam = false;

                    if ($handle = opendir($source_dir)) {
                        $i = 1;
                        while (false !== ($entry = readdir($handle))) {

                            $file = $source_dir . DIRECTORY_SEPARATOR . $entry;
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                            if ('zip' != strtolower($ext)) {
                                continue;
                            }

                            $mam = true;
                            ?>
                            <tr>
                                <td><?php echo $i ?>.</td>
                                <td  class="source-xml" data-dir="<?php echo $dir ?>"><?php echo esc_attr(basename($file)); ?></td>
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
