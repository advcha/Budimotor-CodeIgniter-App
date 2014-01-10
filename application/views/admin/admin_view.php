	<script type="text/javascript">
		var edit_id = 0;
		$(function() {
			$('#user_dropdown').jui_dropdown({
				launcher_id: 'launcher1',
				launcher_container_id: 'launcher1_container',
				menu_id: 'menu1',
				containerClass: 'container1',
				menuClass: 'menu1',
				launcherUIPrimaryIconClass: 'ui-icon-home'
			});
			
			$('#tabs_barang').tabs({
				beforeLoad: function( event, ui ) {
					ui.jqXHR.error(function() {
						ui.panel.html(
						"<div class='alert alert-error'>Data tidak bisa ditampilkan</div>" );
					});
				}
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
	
	<div class="container-fluid admin">
	
		<div class="row-fluid">
			
			<div class="span12">
				<div class="widget ">
					<div class="widget-header">
	      				<h3>Administrasi</h3>
	  				</div> <!-- /widget-header -->
	  				<div class="widget-content">
