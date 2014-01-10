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
				
				<div class="nav-collapse">
					<ul class="nav pull-right">

						<li class="">						
							Ubah Tema : 
							<select id="theme" onchange="change_theme();" class="launcherClass ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icons">
								<?php foreach($themelist as $theme){ ?>
								<option value="<?php echo $theme->idtheme; ?>" <?php if($current_idtheme==$theme->idtheme){echo 'selected';} ?>><?php echo $theme->themename; ?></option>
								<?php } ?>
							</select>
						</li>

						<li class="">
							<div id="user_dropdown">
								<div id="launcher1_container">
									<button id="launcher1">
										<?php echo $name;?>
									</button>
								</div>
								<ul id="menu1">
									<?php if($userlevel == 'Administrator' || $userlevel == 'Manager'){ ?>
									<li>
										<a href="<?php echo base_url(); ?>index.php/home/admin" class="">
											<span class="ui-icon ui-icon-wrench"></span><span class="ui-button-text">Administrasi</span>
										</a>
									</li>
									<?php } ?>
									<li>
										<a href="<?php echo base_url(); ?>index.php/home" class="">
											<span class="ui-icon ui-icon-cart"></span><span class="ui-button-text">Kasir</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>index.php/home/change_password" class="">
											<span class="ui-icon ui-icon-arrowrefresh-1-s"></span><span class="ui-button-text">Ubah Password</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>index.php/home/backup" class="">
											<span class="ui-icon ui-icon-disk"></span><span class="ui-button-text">Backup Data</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>index.php/home/logout" class="">
											<span class="ui-icon ui-icon-power"></span><span class="ui-button-text">Keluar</span>
										</a>
									</li>
								</ul>		
							</div>
						</li>
				</ul>

				</div><!--/.nav-collapse -->

			</div> <!-- /container -->

		</div> <!-- /navbar-inner -->

	</div> <!-- /navbar -->
