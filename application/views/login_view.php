 <body>
	<div class="navbar navbar-fixed-top">
		
		<div class="navbar-inner">
			
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<a class="brand" href="#">
					Budi Motor				
				</a>		

			</div> <!-- /container -->

		</div> <!-- /navbar-inner -->

	</div> <!-- /navbar -->
	
	<div class="account-container">
	
		<div class="content clearfix">
			<?php echo form_open('verifylogin'); ?>
			<h1>Login Pengguna</h1>
			<?php
				if(validation_errors()){
			?>
			<div class="alert alert-error">
				<?php echo validation_errors(); ?>
			</div>
			<?php } ?>
			<div class="login-fields">
				
				<div class="field">
					<label for="username">Pengguna</label>
					<input type="text" id="username" name="username" value="" placeholder="Pengguna" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
									
				<button class="button btn btn-success btn-large">Masuk</button>
				
			</div> <!-- .actions -->
			</form>
			<script type="text/javascript">
				$(function(){
					$('#username').focus();
				});
			</script>
		</div> <!-- /content -->
	
	</div> <!-- /account-container -->
