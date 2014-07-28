<?php
/*
Plugin Name: Smart Watermark
Plugin URI: 
Description: Add image watermark to images uploaded to media library 
Author: Alex Muravyov
Version: 3.0.1
*/



defined('SMARTWATERMARK_PATH') || define('SMARTWATERMARK_PATH', __DIR__);

set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    SMARTWATERMARK_PATH,
    SMARTWATERMARK_PATH.'/library', 
)));

defined('SWL') || require_once 'SWL/SWL.php';
require 'SmartWatermarkPro/SmartWatermarkPro.php';
$smartWatermark = new SmartWatermarkPro();
$smartWatermark->init();