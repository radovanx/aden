<?php

/*
  Plugin Name: W4A Program
  Description: Program management
  Version: 1.0
  Author: a.
  Author URI: http://www.web-4-all.cz/
  Text Domain: w4a-program
 */

class W4aProgram {

    /**
     * 
     */
    public function __construct() {

        include 'modul/Building.php';
        include 'modul/Flat.php';

        if (is_admin()) {

            add_action('admin_menu', array(&$this, 'register_menu_page'));

            include 'modul/AdminBuilding.php';
            include 'modul/AdminFlat.php';
        }
    }

    /**
     * 
     */
    public function register_menu_page() {
        //add_menu_page('Report', 'Report', 'manage_options', 'order_overview', array($this, 'report_all'));
        add_menu_page('Program', 'Program', 'manage_options', 'program_overview', array(&$this, 'program_overview'));
        //add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
        add_submenu_page( 'program_overview', 'Cities', 'Cities', 'manage_options', 'xxxx', array($this, 'report_credit'));
        add_submenu_page('program_overview', 'Kredity', 'Kredity','manage_options', 'report-credit', array($this, 'report_credit'));
    }

    public function report_credit(){

    }
    
    /**
     * 
     */
    public function program_overview(){
        echo '';
    }
}

$w4a_program = new W4aProgram();