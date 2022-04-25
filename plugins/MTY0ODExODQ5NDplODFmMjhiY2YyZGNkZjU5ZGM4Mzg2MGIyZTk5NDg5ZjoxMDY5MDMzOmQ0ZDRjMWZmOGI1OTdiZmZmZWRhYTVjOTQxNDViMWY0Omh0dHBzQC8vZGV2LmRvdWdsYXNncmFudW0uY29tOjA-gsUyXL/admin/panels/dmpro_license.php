<?php
$license_exist = check_license();
?>
    <div class="tab-wrap">
	    <div class="toolbox ico-trigger">
		    <div class="box-title">
			    <h3>License key</h3>
			    <div class="box-descr"><p><?php echo $description = ($license_exist)? 'Divi Modules Pro is active': 'Please enter the license key to activate the <b>Divi Modules Pro</b>' ?></p>
			    </div>
		    </div>
		    <div class="box-content minibox">
			    <div class="input">
			        <?php if($license_exist) { ?> 
			        <input name="dmpro_deactivate_license" type="hidden" value="">
			        <?php } ?>
				    <input name="dmpro_license_key" type="text" <?php echo $show_license = ($license_exist)? 'value="***********************" disabled':'';?>>
			    </div>
		    </div>
	    </div>
	
    </div>
    
    
