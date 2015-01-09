<?php 
	echo form_open('loginUser/login/');
	echo form_fieldset('Login');
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
  	<span class="error"><?=$errors;?></span>
  	<br>
  	<br>
  	
  	<ul class="nav nav-pills back" role="tablist">
			<li role="presentation" class="active"><?=anchor('store/', 'Back to Store')?></li>			     
	</ul>
  	
  	
<?php
	echo validation_errors('<p class="error">');
	echo form_fieldset_close();
	echo form_close();
?>
	
	<br>
	
	<div id="registerOption">
		<p>Don't have an account?</p>
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" class="active"><?php echo anchor("registerUser/",'Register')?></li>			     
		</ul>
	</div>