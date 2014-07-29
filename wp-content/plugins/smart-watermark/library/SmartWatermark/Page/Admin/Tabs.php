<?php
/**
 * <kbd>SmartWatermark_Page_Admin_Tabs</kbd> class file
 *
 * PHP version 5
 *
 * @category    SmartWatermark_Page_Admin
 * @package     SmartWatermark_Page_Admin_Tabs
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2013 SWL
 * @version     $Id$
 */

require_once 'SWL/Page/Admin/Tabs.php';

/**
 * Page with tabs class
 *
 * @category    SmartWatermark_Page_Admin
 * @package     SmartWatermark_Page_Admin_Tabs
 * @author      Alex Muravyov <alex.muravyov@gmail.com>
 * @copyright   2014 SmartWatermark
 * @version     0.0.1
 */
class SmartWatermark_Page_Admin_Tabs extends SWL_Page_Admin_Tabs {
    
    public function render($print = true) {
    ?>    
        <div class="wrap swl-page swl-tabs-page">
            <?php screen_icon(); ?>
            <h2><?php echo $this->title; ?><div style="display:inline-block;vertical-align: bottom;">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="display:inline-block">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="LJQTG6ZRNT972">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="vertical-align: middle;">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div></h2>
            
            <?php if (count($this->sidebarElements)): ?><div class="left-section"><?php endif; ?>
                <h2 class="nav-tab-wrapper"> 
                    <?php foreach ($this->tabs as $tabName => $tab): ?>
                        <a href="?page=<?php echo $this->page; ?>&tab=<?php echo $tabName; ?>" class="nav-tab<?php echo $this->currentTab==$tabName?' nav-tab-active':''; ?>"><?php echo $tab->getTitle(); ?></a>  
                    <?php endforeach; ?>
                </h2> 
                <?php if (isset($this->tabs[$this->currentTab])): ?>
                    <?php $this->tabs[$this->currentTab]->render(); ?>
                <?php endif; ?>
            <?php if (count($this->sidebarElements)): ?>
            </div>
            <div class="right-section">
                <?php 
                foreach ($this->sidebarElements as $element) {
                    $element->render();
                }
                ?>
            </div> 
            <?php endif; ?>
        </div>
    <?php     
    }  
    
}