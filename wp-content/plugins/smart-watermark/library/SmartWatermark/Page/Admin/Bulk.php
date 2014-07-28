<?php

require_once 'SWL/Page/Admin/Page.php';

class SmartWatermark_Page_Admin_Bulk extends SWL_Page_Admin {
    
    public function __construct() {
        parent::__construct('Bulk Update', array('hide_title' => true));
    }
    
    public function initAssets() {
        parent::initAssets();
        $this->addScript(array('name' => 'smartwatermark-settings-bulk', 'src' => plugins_url('assets/default/js/smart-watermark-settings-bulk.js', SMARTWATERMARK_PATH.'/dummy')));
    }
    
    public function render($print = true) {
    ?>
            <br />
            <div style="width:300px;border:1px #000 solid;height:20px;position:relative;"><div id="watermark_bulk_progressbar" style="background-color: blue;height:100%;width:1%;"></div><div id="watermark_bulk_progressbar_stat" style="position:absolute;left:150px;top:0px;">0%</div></div>
            <br />
            <input type="button" id="watermark_run_bulk" class="button" value="Proceed Old Images" />  
    <?php
    }
    
}