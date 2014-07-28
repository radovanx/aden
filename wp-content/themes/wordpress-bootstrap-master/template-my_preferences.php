<?php
/*
 * Template Name: User preferences
 */
?>
<?php
redirect_if_cannot_see_detail();
get_header();
?>
<div class="container">
    <div id="content" class="clearfix row">
        <div class="col-md-6">
            <h1 class="border-left inline uppercase">
                <?php _e("My preferences", "wpbootstrap"); ?>
            </h1> 
        </div>
        <div class="col-md-3 hidden">
            <select name="sort_by_list" class="form-control input-lg">
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
                <option value="#"><?php _e("Sort by", "wpbootstrap"); ?></option>
            </select>
        </div>
        <div class="col-md-3 pull-right big_icons margin-top">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs"> 
                <a href="#list"  data-toggle="tab" class="active blue"><i class="fa fa-list"></i></a> 
                <a href="#table" data-toggle="tab" class="red"><i class="fa fa-th"></i></a>
            </ul> 
        </div> 
        <div id="main" class="col-sm-12 clearfix margin-top" role="main"> 
            <div class="tab-content">      
                <div class="tab-pane" id="table">  
                    <!-- reference list -->
                    <table id="favorite-table" class="apartment-list table table-bordered remove-favorite-row confirm-remove">
                        <thead>
                            <tr>
                                <th><?php _e("Favorite", "wpbootstrap"); ?></th>
                                <th><?php _e("Prg ref", "wpbootstrap"); ?></th>
                                <th><?php _e("Address", "wpbootstrap"); ?></th>
                                <th><?php _e("Flat n°", "wpbootstrap"); ?></th>
                                <th><?php _e("Rental status", "wpbootstrap"); ?></th>
                                <th><?php _e("Floor", "wpbootstrap"); ?></th>
                                <th><?php _e("Rooms", "wpbootstrap"); ?></th>
                                <th><?php _e("Surface", "wpbootstrap"); ?></th>
                                <th><?php _e("Price", "wpbootstrap"); ?></th>
                                <th><?php _e("Price/m²", "wpbootstrap"); ?></th>
                                <th><?php _e("Yield", "wpbootstrap"); ?></th>
                                <th><?php _e("Status", "wpbootstrap"); ?></th>
                            </tr>
                        </thead>
                        <?php
                        $lang = qtrans_getLanguage();
                        $flat_props = EstateProgram::user_preferences($lang)
                        ?>
                        <?php include TEMPLATEPATH . '/table_row.php'; ?> 
                    </table>
                </div>
                <div class="apartment-list col-md-12 column border tab-pane active remove-favorite-row confirm-remove" id="list">     
                    <?php
                    $lang = qtrans_getLanguage();
                    $flat_props = EstateProgram::user_preferences($lang);
                    include TEMPLATEPATH . '/row_row.php';
                    ?>  
                </div>   
            </div>    
        </div> <!-- end #main -->
    </div> <!-- end #content -->
</div> 
<div class="modal fade" id="removePreferenceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 class="modal-title"><?php echo the_title(); ?></h4>-->
            </div>
            <div class="modal-body"> 
                <?php _e("Do you really want to remove this preference?", "wpbootstrap"); ?> 
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Ok", "wpbootstrap"); ?></button>-->
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete"><?php _e('Yes', 'wpbootstrap') ?></button>
                <button type="button" data-dismiss="modal" class="btn"><?php _e('No', 'wpbootstrap') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php get_footer(); ?>
