<?php // Noncename needed to verify where the data originated
echo '<input type="hidden" name="podcastmeta_noncename" id="podcastmeta_noncename" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
global $wpdb;

$strFile = get_post_meta( $post->ID, $key = 'podcast_file', true ); 

$strFilefr = get_post_meta( $post->ID, $key = 'podcast_filefr', true ); 

$strFilede = get_post_meta( $post->ID, $key = 'podcast_filede', true );

  
//$media_file = get_post_meta( $post->ID, $key = '_wp_attached_file', true );
 $media_file = '';
 

//if(!empty($media_file)) { $strFile = $media_file; }

?>
<script type="text/javascript">
         
// Uploading files
var file_frame; 

jQuery('#upload_image_button').live('click', function( podcast ){ 
podcast.preventDefault();

  

field=""; 
 
// If the media frame already exists, reopen it.
if ( file_frame ) {
file_frame.open();
return;
}
// Create the media frame.
file_frame = wp.media.frames.file_frame = wp.media({    
title: jQuery( this ).data( 'uploader_title' ),
button: {
text: jQuery( this ).data( 'uploader_button_text' ),
},
multiple: false // Set to true to allow multiple files to be selected
});

// When a file is selected, run a callback.
  
file_frame.on( 'select', function() {
// We set multiple to false so only get one image from the uploader 
attachment = file_frame.state().get('selection').first().toJSON();
// here are some of the variables you could use for the attachment; 
var url = attachment.url;  

field="";
field = document.getElementById("podcast_file"); 
field.value=url;   //set which variable you want the field to have  
}); 
// Finally, open the modal
file_frame.open();
});

 
jQuery('#upload_image_buttonfr').live('click', function( podcastfr ){
    
var file_framefr;     
    
podcastfr.preventDefault(); 

// If the media frame already exists, reopen it.
if ( file_framefr ) {
file_framefr.open();
return;
}
// Create the media frame.
file_framefr = wp.media.frames.file_framefr = wp.media({    
title: jQuery( this ).data( 'uploader_title' ),
button: {
text: jQuery( this ).data( 'uploader_button_text' ),
},
multiple: false // Set to true to allow multiple files to be selected
});

// When a file is selected, run a callback.

file_framefr.on( 'select', function() {
// We set multiple to false so only get one image from the uploader 

attachment = file_framefr.state().get('selection').first().toJSON();

// here are some of the variables you could use for the attachment; 
var urlfr = attachment.url;  

fieldfr="";
 
fieldfr = document.getElementById("podcast_filefr"); 

 
fieldfr.value=urlfr;   //set which variable you want the field to have 
});
  
// Finally, open the modal
file_framefr.open();
}); 

//for deutch version !!!

jQuery('#upload_image_buttonde').live('click', function( podcastde ){     
var file_framede;      
podcastde.preventDefault(); 

// If the media frame already exists, reopen it.
if ( file_framede ) {
file_framede.open();
return;
}
// Create the media frame.
file_framede = wp.media.frames.file_framede = wp.media({    
title: jQuery( this ).data( 'uploader_title' ),
button: {
text: jQuery( this ).data( 'uploader_button_text' ),
},
multiple: false // Set to true to allow multiple files to be selected
});

// When a file is selected, run a callback.

file_framede.on( 'select', function() {
// We set multiple to false so only get one image from the uploader 

attachment = file_framede.state().get('selection').first().toJSON();

// here are some of the variables you could use for the attachment; 
var urlde = attachment.url;  

fieldde="";
 
fieldde = document.getElementById("podcast_filede"); 

 
fieldde.value=urlde;   //set which variable you want the field to have 
});
  
// Finally, open the modal
file_framede.open();
}); 


</script>
<div>
<table>
    
<tr><label>EN</label></tr>  
<tr valign="top"> 
<td> 
    <input type="text" name="podcast_file" id="podcast_file" size="70" value="<?php echo $strFile; ?>" />
    <input id="upload_image_button" class="upload_image_button" data-button="en" type="button" value="Upload"> 
</td>
</tr>
</table>
<input type="hidden" name="img_txt_id" id="img_txt_id" value="" />
<table>
<tr valign="top">
 <tr><label>FR</label></tr>    
    
<td> 
    <input type="text" name="podcast_filefr" id="podcast_filefr" size="70" value="<?php echo $strFilefr; ?>" />  
    <input id="upload_image_buttonfr" class="upload_image_button" data-button="fr" type="button" value="Upload"> 
</td>
</tr>
</table>
<input type="hidden" name="img_txt_idfr" id="img_txt_idfr" value="" />
<table>
<tr><label>DE</label></tr>     
    
<tr valign="top">
<td> 
    <input type="text" name="podcast_filede" id="podcast_filede" size="70" value="<?php echo $strFilede; ?>" />
    <input id="upload_image_buttonde" class="upload_image_button" data-button="de" type="button" value="Upload"> 
</td>
</tr>
</table> 
<input type="hidden" name="img_txt_idde" id="img_txt_idde" value="" />
</div> 
<?php function admin_scripts()
{
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
}
function admin_styles()
{
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'admin_scripts');
add_action('admin_print_styles', 'admin_styles');
?>
