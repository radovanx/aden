<?php

require_once 'SWL/Page/Admin/Page.php';

class SmartWatermarkPro_Page_Admin_Restore extends SWL_Page_Admin {
    
    public function __construct() {
        parent::__construct('Restore Originals', array('hide_title' => true));
    }
    
    public function initAssets() {
        parent::initAssets();
        $this->addScript(array('name' => 'smartwatermark-settings-restore', 'src' => plugins_url('assets/pro/js/smart-watermark-settings-restore.js', SMARTWATERMARK_PATH.'/dummy')));
    }
    
    public function render($print = true) {
    ?>
            <br />
            <div style="width:300px;border:1px #000 solid;height:20px;position:relative;"><div id="watermark_bulk_progressbar" style="background-color: blue;height:100%;width:1%;"></div><div id="watermark_bulk_progressbar_stat" style="position:absolute;left:150px;top:0px;">0%</div></div>
            <br />
            <input type="button" id="watermark_run_restore" class="button" value="Restore" />  
    <?php
    }
    
}