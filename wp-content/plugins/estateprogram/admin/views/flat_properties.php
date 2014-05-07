<?php
$tags = EstateProgram::$tags_apartment;


/*
  global $q_config;

  $el = qtrans_getSortedLanguages();


  //qtrans_createTitlebarButton($parent, $language, $target, $id)
  //qtrans_createTitlebarButton('postexcerpt', $language, 'excerpt', 'qtrans_switcher_postexcerpt_'.$language);
  ?>
  <script>
  <?php
  foreach ($el as $language) {
  echo qtrans_createTitlebarButton('flat-properties', $language, 'properties', 'qtrans_properties_' . $language);
  //echo qtrans_createTextArea('postexcerpt', $language, 'excerpt', 'qtrans_switcher_postexcerpt_' . $language);
  }
  ?>
  </script> */

global $q_config;
$el = qtrans_getSortedLanguages();
?>
<script type="text/javascript">
<?php
echo $q_config['js']['qtrans_is_array'];
echo $q_config['js']['qtrans_split'];
echo $q_config['js']['qtrans_integrate'];
echo $q_config['js']['qtrans_switch_postbox'];
echo $q_config['js']['qtrans_use'];

foreach ($el as $language) {
    echo qtrans_createInfoTitlebarButton('flat_properties', $language, 'listproperties', 'qtrans_switcher_fl_' . $language);
    //echo qtrans_createTextArea('flat_properties', $language, 'listproperties', 'qtrans_switcher_postexcerpt_' . $language);
}
?>

    jQuery(document).ready(function() {
        //jQuery('.listproperties').hide();
        qtrans_switch_listpostbox('flat_properties', 'listproperties', '<?php echo $q_config['default_language'] ?>');
    });
</script>

<div id="flat-properties">
    <?php foreach ($el as $lang): ?>
        <div id="listproperties_<?php echo $lang ?>" class="listproperties">
            <?php
            $props = get_post_meta($post->ID, 'flat_props_' . $lang, true);
            
            
            

            if (!empty($props)) {
                //$props = unserialize($props);

                ksort($props);

                //$data = array();
                ?>

                <table>            
                    <?php
                    reset($props);
                    $key = key($props);
                    $splits = explode('|', $key);
                    $tag = $splits[0];

                    foreach ($props as $key => $val):

                        $splits = explode('|', $key);
                        $prev_tag = $splits[0];

                        if ($tag != $prev_tag):
                            ?>
                            <tr>
                                <td colspan="2">&nbsp</td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th class="textleft">                                    
                                <?php echo esc_attr($key) ?>                                    
                            </th>
                            <td>
                                <?php echo esc_attr($val) ?>
                            </td>
                        <tr>
                            <?php
                            $tag = $prev_tag;
                        endforeach;
                        ?>
                </table>

                <?php
            } else {
                // make default inputs
            }
            ?>
        </div>
    <?php endforeach; ?>
</div>

<?php /*
  <div id="flat-properties">
  <?php
  //$langs = EstateProgram::$langs;
  foreach ($el as $lang):
  ?>
  <div id="listproperties_<?php echo $lang ?>" class="listproperties">
  <table>
  <?php
  foreach ($tags as $tag):

  $sql = "
  SELECT
 *
  FROM
  postmeta_lang AS pml
  JOIN
  tag2meta_key AS t2m
  ON
  t2m.meta_key = pml.meta_key
  WHERE
  t2m.tag = '" . esc_sql($tag) . "'
  AND
  pml.post_id = '" . (int) $post->ID . "'
  AND
  pml.lang = '" . esc_attr($lang) . "'
  ";

  $properties = $wpdb->get_results($sql);

  if (!empty($properties)):

  $tag = $properties[0]->tag;

  foreach ($properties as $prop):

  if ($tag != $prev_tag):
  ?>
  <tr>
  <td colspan="2">&nbsp</td>
  </tr>
  <?php endif; ?>
  <tr>
  <th class="textleft">
  <label for="flat-price">
  <?php echo esc_attr($prop->meta_key) ?>
  </label>
  </th>
  <td>
  <?php echo esc_attr($prop->meta_value) ?>
  </td>
  <tr>
  <?php
  $prev_tag = $tag;
  endforeach;
  endif;


  endforeach;
  ?>
  </table>
  </div>
  <?php
  endforeach;
  ?>

  </div>



  <!--
  <table>
  <tr>
  <th class="textleft">
  <label for="flat-price">
  <?php _e('Price', $this->plugin_slug) ?>
  </label>
  </th>
  <td>
  <input id="flat-price" type="number" name="_flat_price" min="0" value="<?php echo esc_attr(get_post_meta($post->ID, '_flat_price', true)) ?>">
  </td>
  </tr>
  <tr>
  <th class="textleft">
  <label for="number-of-room"><?php _e('Number of room', $this->plugin_slug); ?></label>
  </th>
  <td>
  <input id="number-of-room" type="number" min="0" name="_flat_number_of_room" value="<?php echo esc_attr(get_post_meta($post->ID, '_flat_number_of_room', true)) ?>">
  </td>
  </tr>
  </table>
  -->

 */ ?>


