<?php 
	echo form_open('registerUser/register');
	echo form_fieldset('Register Account');
?>

	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input type="text" class="form-control" name="firstname" id="firstname" value="<?=set_value('firstname');?>" placeholder="Firstname">
	</div>
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input type="text" class="form-control" name="lastname" id="lastname" value="<?=set_value('lastname');?>" placeholder="Lastname">
	</div>
	<div class="form-group">
		<label for="login">Login</label>
		<input type="text" class="form-control" name="login" id="login" value="<?=set_value('login');?>" placeholder="Login">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" id="password" value="<?=set_value('password');?>" placeholder="Password">
	</div>
	<div class="form-group">
		<label for="email">Email address</label>
		<input type="email" class="form-control" name="email" id="email" value="<?=set_value('email');?>" placeholder="Enter email">
	</div>
  	<button type="submit" class="btn btn-default">Submit</button>
<?php
	echo validation_errors('<p class="error">');
	echo form_fieldset_close();
	echo form_close();
?>
