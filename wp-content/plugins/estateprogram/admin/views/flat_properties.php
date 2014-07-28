<?php
$tags = EstateProgram::$tags_apartment;
global $q_config;
$el = qtrans_getSortedLanguages();
?>
<div id="flat-properties">
    <?php foreach ($el as $lang): ?>
        <h2 style="text-transform: uppercase;"><?php echo $lang ?></h2>
        <div id="listproperties_<?php echo $lang ?>" class="listproperties">
            <?php
            $props = get_post_meta($post->ID, 'flat_props_' . $lang, true);

            if (!empty($props)) {
                ksort($props);
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

                        <?php
                        if ('youtube' == $key):
                            if (is_array($props[$key])):
                                ?>
                                <?php foreach ($props[$key] as $v): ?>
                                    <tr>
                                        <th class="textleft">
                                            <?php echo esc_attr($key) ?>
                                        </th>
                                        <td>
                                            <?php echo esc_attr($v) ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <th class="textleft">
                                        <?php echo esc_attr($key) ?>
                                    </th>
                                    <td>
                                        <?php echo esc_attr($val) ?>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            continue;
                        endif;
                        ?>
                        <tr>
                            <th class="textleft">
                                <?php echo esc_attr($key) ?>
                            </th>
                            <td>
                                <?php echo esc_attr($val) ?>
                            </td>
                        </tr>
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


