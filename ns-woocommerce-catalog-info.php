<?php

function ns_woocommerce_catalog_info(){
    if(get_option('wcf_show_more_info_button') == 'on'){
    ?>
    <div class="ns-modal-wc-layer"><!-- layer -->
        
        <div class="ns-modal-wc">
            
                
            <div id="ns-close-modal">
                <i class="fas fa-times fa-2x"></i>
            </div>
            
            
                <div class="ns-div-success ns-div-response">
                    <img src="<?php echo plugin_dir_url( __FILE__ ).'img/ns-checked.svg';?>" width="100" class="ns-div-image-done">
                    <br><br>
                    <div class="ns-margin">
                        <span><?php _e('Your message was successfully sent!', 'ns-woocommerce-catalog');?></span>
                    </div>
                    
                </div>
                <div class="ns-div-error ns-div-response">
                    <img src="<?php echo plugin_dir_url( __FILE__ ).'img/ns-error.svg';?>" width="100" class="ns-div-image-done">
                    <br><br>
                    <span><?php _e('An error occurred! Please check your inputs.', 'ns-woocommerce-catalog');?></span><br><br>
                    <input type="button" value="try again" class="ns-try-again ns-margin">
                    
                </div>
                <?php
                    if(is_user_logged_in()){
                        $user_info = get_userdata(get_current_user_id());
                        $ns_input_mail_content = "value=\"".$user_info->user_email."\"";
                        $ns_input_name_content = "value=\"".$user_info->first_name."\"";
                    
                    }else{
                        $ns_input_mail_content = "placeholder=\"JohnDoe@nsthemes.com\"";
                        $ns_input_name_content = "placeholder=\"John\"";
                    }
                ?>
                <div class="ns-textarea-size">
                    <span><b><?php _e('Your name:', 'ns-woocommerce-catalog');?></b></span>
                    <input type="text" id="ns-your-name" name="name" <?php echo $ns_input_name_content;?>>

                    <span><b><?php _e('Your E-mail (required):', 'ns-woocommerce-catalog');?></b></span>
                    <input type="text" id="ns-your-email" name="name" <?php echo $ns_input_mail_content;?> >

                    <span><b><?php _e('Subject:', 'ns-woocommerce-catalog');?></b></span>
                    <input type="text" id="ns-subject" name="name" value="<?php _e('I am writing to enquire about', 'ns-woocommerce-catalog');?><?php echo get_the_title( $_POST['productid'] );?>" >

                    <span><b><?php _e('E-mail body:', 'ns-woocommerce-catalog');?></b></span>
                
                    <textarea name="testo" class="ns-textarea-dialog" rows="5" placeholder="<?php _e('Explain your request here...', 'ns-woocommerce-catalog');?>"></textarea>
                </div>
                <div class="ns-div-share-now">
                    <input type="button" id="ns-share-now" name="share" value="<?php _e('Send now!', 'ns-woocommerce-catalog');?>">
                </div>
        </div>
    </div>
    
    <?php
    }
}
add_action('wp_footer', 'ns_woocommerce_catalog_info');
?>