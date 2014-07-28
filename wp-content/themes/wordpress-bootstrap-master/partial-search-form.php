  <form role="form" class="border background clearfix searchform col-md-12">
                <div class="col-md-6 column">  
                    <div class="row margin-top padding-top">                        
                        <div class="form-group col-md-6"> 
                        </div>
                        <div class="form-group col-md-6">                            
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="Pricef"><?php _e("Price from:", "wpbootstrap"); ?></label><input name="Pricef" class="form-control input-lg" id="Pricef" type="text" placeholder="Price from:" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Pricet"><?php _e("Price to:", "wpbootstrap"); ?></label><input  name="Pricet" class="form-control input-lg" id="Pricet" type="text" placeholder="Price to:" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="References"><?php _e("References:", "wpbootstrap"); ?></label><input name="References" class="form-control input-lg" id="References" type="text" placeholder="References:" />
                    </div> 
                 <div class="form-group"> 
                        <label for="City"><?php _e("City:", "wpbootstrap"); ?></label>
                        <div class="row"> 
                            <div class="col-md-12">
                            <!-- cities from taxonomy -->                    
                            <?php
                            $args = array(
                                'taxonomy' => 'location',
                                'hide_empty' => true,
                                'parent' => 0
                            );
                            $cities = get_categories($args);
                            foreach ($cities as $key => $value):                                  
                                ?>  
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox-<?php echo $value->name; ?>" name="cities" data-myAttri="<?php _e($value->term_id); ?>" class="city-checkbox" value="<?php _e($value->name); ?>"><?php _e($value->name); ?>
                                </label>
                            <?php endforeach; ?>
                            <!-- /cities from taxonomy -->
                        </div>
                        </div>                
                    </div>                     
                     <div class="form-group"> 
                        <label><?php _e("Disctrict:", "wpbootstrap"); ?></label>
                        <div id="district-list"></div>
                        <!--<label for="Disctrict"></label><input name="Disctrict" class="form-control input-lg" id="Disctrict" type="text" placeholder="Disctrict:"/>-->
                        <!-- district from ajax --> 
                        <!-- /district from ajax -->
                    </div>
                </div>
                <div class="col-md-6 column">
                       <div class="form-group">  
                            <label for="accommodation"><?php _e("Type of accommodation:", "wpbootstrap"); ?></label>                                                 
                        <div class="">  
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox-<?php _e("Rented apartment", "wpbootstrap"); ?>" name="type" data-myAttri="<?php _e("Rented apartment", "wpbootstrap"); ?>" class="type-checkbox" value="<?php _e("Rented apartment", "wpbootstrap"); ?>"><?php _e("Rented apartment", "wpbootstrap"); ?>
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox-<?php _e("Apartment", "wpbootstrap"); ?>" name="type" data-myAttri="<?php _e("Apartment", "wpbootstrap"); ?>" class="type-checkbox" value="<?php _e("Apartment", "wpbootstrap"); ?>"><?php _e("Apartment", "wpbootstrap"); ?>
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox-<?php _e("Commercial Unit", "wpbootstrap"); ?>" name="type" data-myAttri="<?php _e("Commercial Unit", "wpbootstrap"); ?>" class="type-checkbox" value="<?php _e("Commercial Unit", "wpbootstrap"); ?>"><?php _e("Commercial Unit", "wpbootstrap"); ?>
                            </label>  
                            
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox-<?php _e("Building", "wpbootstrap"); ?>" name="type" data-myAttri="<?php _e("Building", "wpbootstrap"); ?>" class="type-checkbox" value="<?php _e("Building", "wpbootstrap"); ?>"><?php _e("Building", "wpbootstrap"); ?>
                            </label>  
                        </div>        
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Areaf"><?php _e("Area from (m2):", "wpbootstrap"); ?></label><input name="Areaf" class="form-control input-lg" id="Areaf" type="text" placeholder="Area from:" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Areat"><?php _e("Area to (m2):", "wpbootstrap"); ?></label><input name="Areat" class="form-control input-lg" id="Areat" type="text" placeholder="Area to:" />
                        </div>
                    </div>    
                    <div class="row">    
                        <div class="form-group col-md-6">
                            <label for="Roomsf"><?php _e("Rooms from:", "wpbootstrap"); ?></label> 
                            <select class="form-control input-lg" name="Roomsf" > 
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option> 
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option> 
                            </select>     
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="Roomst"><?php _e("Rooms to:", "wpbootstrap"); ?></label>
                            <select class="form-control input-lg" name="Roomst" > 
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option> 
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12" selected>12</option>
                            </select>    
                        </div> 
                        <div class="form-group col-md-6 col-md-offset-6">  
                            <button type="submit" class="btn btn-primary btn-lg btn-block searchbutton margin-button"><i class="fa fa-search"></i><?php _e("Search", "wpbootstrap"); ?></button>
                        </div>   
                    </div>       
                </div>
            </form>