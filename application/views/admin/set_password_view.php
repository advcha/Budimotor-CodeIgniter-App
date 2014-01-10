	<script type="text/javascript">
		$(function() {
			$('#user_dropdown').jui_dropdown({
				launcher_id: 'launcher1',
				launcher_container_id: 'launcher1_container',
				menu_id: 'menu1',
				containerClass: 'container1',
				menuClass: 'menu1',
				launcherUIPrimaryIconClass: 'ui-icon-home'
			});
		});
		
		function change_theme(){
			baseurl = "<?php echo base_url(); ?>";
			idtheme = $('#theme').val();
			theme_name = $('#theme option[value="'+idtheme+'"]').text();
			$.ajax({
				type:"POST",
				url:baseurl+"index.php/home/change_theme",
				data:{theme: idtheme, iduser: <?php echo $iduser; ?>},
				dataType:"text",
				cache:false,
				success:function(data){
					//newtheme = baseurl + data;
					//$('ui-theme-css').attr('href',baseurl+'bootstrap/css/style.'+theme_name+'.css');
					//$('ui-theme').attr('href',newtheme);
					location.reload();
				}
			});
		}
		
		function check_password(){
			if($('#oldpassword').val() == ""){
				
			}
		}
		
		function batal(){
			document.location.href="<?php echo base_url(); ?>index.php/home";
			return false;
		}
	</script>

 </head>
 <body>
	 <?= $contents ?>
	
	<div class="container-fluid">
	
		<div class="row-fluid">
			
			<div class="span12">
				<div class="widget ">
					<div class="widget-header">
	      				<h3>Ubah Password</h3>
	  				</div> <!-- /widget-header -->
	  				<div class="widget-content">
				<div class="content clearfix">
					<?php echo form_open('newpassword'); ?>
					
					<?php
						if(validation_errors()){
					?>
					<div class="alert alert-error">
						<?php echo validation_errors(); ?>
					</div>
					<?php } ?>
					<div class="login-fields">
						
						<div class="field">
							<label for="username">Password lama</label>
							<input type="password" id="oldpassword" name="oldpassword" value="" placeholder="Isi Password Lama" class="login password-field" />
						</div> <!-- /field -->
						
						<div class="field">
							<label for="password">Password Baru:</label>
							<input type="password" id="newpassword" name="newpassword" value="" placeholder="Isi Password Baru" class="login password-field"/>
						</div> <!-- /password -->
						
						<div class="field">
							<label for="password">Password Baru (Lagi):</label>
							<input type="password" id="newpasswordagain" name="newpasswordagain" value="" placeholder="Isi Password Baru (Lagi)" class="login password-field"/>
						</div> <!-- /password -->
						
					</div> <!-- /login-fields -->
					
					<div class="login-actions">
											
						<button class="button btn btn-success" onclick="return check_password();">Simpan</button>
						<button class="button btn" onclick="return batal();">Batal</button>
						
					</div> <!-- .actions -->
					</form>
		   
				</div> <!-- /content -->
				</div> <!-- /widget-content -->
				</div> <!-- /widget -->
			</div> <!-- /span12 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->

