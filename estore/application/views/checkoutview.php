<?php 
	echo form_open('checkout/verify');
	echo form_fieldset('Payment Information');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/registration.css">
	
                
    <div class="form-group">
		<label for="name">Card Holder's Name</label>
		<input type="text" class="form-control" name="name" id="name" value="<?=set_value('name');?>" placeholder="Enter name as on credit card">
	</div>
                
	<div class="form-group">
		<label for="credit">Credit Card Number</label>
		<input type="number" class="form-control" name="credit" id="credit" placeholder="Enter credit card number">
	</div>
	
	<div class="form-group">
		<label for="expiry">Credit Card Expiry Date</label>
		<div class="controls">
                    <div class="row">
                        <div class="col-md-9">
                            <select class="form-control" name="expmonth" >
                                <option value="01">01 - January</option>
                                <option value="02">02 - February</option>
                                <option value="03">03 - March</option>
                                <option value="04">04 - April</option>
                                <option value="05">05 - May</option>
                                <option value="06">06 - June</option>
                                <option value="07">07 - July</option>
                                <option value="08">08 - August</option>
                                <option value="09">09 - September</option>
                                <option value="10">10 - October</option>
                                <option value="11">11 - November</option>
                                <option value="12">12 - December</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="expyear"> 
                            	<option>2014</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>
                                <option>2029</option>
                                <option>2030</option>
                            </select>
                        </div>
                    </div>
                </div>
	</div>
	
	<div class="form-group">
		<label for="securitycode">Credit Card Security Code</label>
		<input type="text" class="form-control" name="securitycode" id="securitycode" value="<?=set_value('securitycode');?>" placeholder="Enter credit card security code">
	</div>
	
	<button type="submit" class="btn btn-success">Submit</button>
	
	<br>
	<br>
  	
  	<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="active"><?=anchor('store/', ' Back to Store')?></li>			     
				<li role="presentation" class="active"><?=anchor('logout/', 'Logout')?></li>
			</ul>
<?php
	echo validation_errors('<p class="error">');
	echo form_fieldset_close();
	echo form_close();
?>



