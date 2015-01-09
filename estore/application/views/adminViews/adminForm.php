<?php 
	echo form_open('loginAdmin/login');
	echo form_fieldset('Admin Login');
?>
	<div class="form-group">
		<label for="login">Login</label>
		<input type="text" class="form-control" name="login" id="login" value="<?=set_value('login');?>" placeholder="Login">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" id="password" value="<?=set_value('password');?>" placeholder="Password">
	</div>
  	<button type="submit" class="btn btn-default">Submit</button>
<?php
	echo validation_errors('<p class="error">');
	echo form_fieldset_close();
	echo form_close();
?>
	<span class="error"><?=$errors;?></span>