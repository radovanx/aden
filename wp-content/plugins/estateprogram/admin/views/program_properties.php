<table>
    <tr>
        <th class="textleft"><label for="program-city"><?php _e('City', $this->plugin_slug) ?></label></th>
        <td><input id="program-city" type="text" name="program_city" value=""></td>
    </tr>
    <tr>
        <th class="textleft"><label for="program-city"><?php _e('Program district', $this->plugin_slug); ?></label></th>
        <td><input id="program-district" type="text" name="program_district" value="" ></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp</td>
    </tr>    
    <tr>
        <th colspan="2" class="textleft"><?php _e('Price range', $this->plugin_slug); ?></th>
    </tr>
    <tr>
        <td>
            <label>
                <?php _e('from:', $this->plugin_slug); ?>
            </label>
        </td>
        <td>
            <input id="range-from" type="number" name="range_from" min="0" value="">
            <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
        </td>
    </tr>
    <tr>
        <td>
            <label>
                <?php _e('to:', $this->plugin_slug); ?>
            </label>
        </td>
        <td>
            <input id="range-to" type="number" name="range_to" min="0" value="">
            <span class="input-info"><?php _e('Please enter a number', $this->plugin_slug); ?></span>
        </td>
    </tr>
</table>
