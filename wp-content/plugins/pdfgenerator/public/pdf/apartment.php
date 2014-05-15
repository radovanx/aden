<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $filename ?></title>
        <style>
            .fleft {
                float: left;
            }

            .fright {
                float: right;
            }
            .w100 {
                width: 100%;
            }
            .w50{
                width: 50%;
            }
            .tright {
                text-align: right;
            }

            #wrapper
            {
                width:180mm;
                margin:0 15mm;
            }

        </style>
    </head>
    <body>
        <div id="wrapper">            
            <table class="w100">
                <tr>
                    <td class="w50">
                        <?php 
                        $attachment_id = get_user_meta(get_current_user_id(), 'logo', true);
                        
                        
                        
                        ?>
                    </td>
                    <td class="w50 tright">
                        <p>
                            Aden Immo GmbH<br>                
                            Mehringdamm 77 | D-10965 Berlin<br>                
                            tel: +49 30 6616 115 | fax: +49 30 616 75 114
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <hr>


    </body>
</html>