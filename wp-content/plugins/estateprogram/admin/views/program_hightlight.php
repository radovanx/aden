<p>Use <strong>semicolon</strong> as delimiter</p>
<?php
$langs = qtrans_getSortedLanguages();

foreach ($langs as $lang):
    ?>
    <h2 style="text-transform: uppercase;"><?php echo $lang ?></h2>
    
    <textarea name="_program_hightlight_<?php echo $lang ?>" style="width: 100%;" rows="8"><?php echo esc_attr(qtrans_use($lang, get_post_meta($post->ID, '_program_hightlight', true), false)) ?></textarea>
<?php endforeach; ?>
