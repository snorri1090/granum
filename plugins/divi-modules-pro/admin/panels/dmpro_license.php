<?php
$license_exist = check_license();
?>
    <div class="tab-wrap">
	    <div class="toolbox ico-trigger">
		    <div class="box-title">
			    <h3><?php esc_html_e('License key', DMPRO_TEXTDOMAIN ) ?></h3>
			    <div class="box-descr"><p><?php echo $description = ($license_exist)? esc_html('Divi Modules Pro is active', DMPRO_TEXTDOMAIN ) : htmlspecialchars_decode( esc_html('Please enter the license key to activate the &lt;b&gt;Divi Modules Pro&lt;/b&gt;', DMPRO_TEXTDOMAIN ) ) ?></p>
			    </div>
		    </div>
		    <div class="box-content minibox">
			    <div class="input">
			        <?php if( $license_exist !== FALSE) { ?> 
			        <input name="dmpro_deactivate_license" type="hidden" value="">
			        <?php } ?>
				    <input name="dmpro_license_key" type="text" <?php echo $show_license = ( $license_exist !== FALSE )? 'value="***********************" disabled':'';?>>
			    </div>
		    </div>
	    </div>
	
    </div>
    
    
