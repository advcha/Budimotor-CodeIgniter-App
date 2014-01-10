	<script type="text/javascript">
		$(function() {
			baseurl = "<?php echo base_url(); ?>";
			$( "#accordion" ).accordion({
				header: 'h3',
				/*heightStyle: 'content',*/
				heightStyle: 'fill',
				collapsible: true,
				/*active : 0,*/
				active : false,
				activate: function (e, ui) {
					url = $(ui.newHeader[0]).children('a').attr('href');
					if(url != '#'){
						$.get(baseurl+'index.php'+url, function (data) {
								$(ui.newHeader[0]).next().html(data);
						});
					}
				},
				create: function (e, ui) {
					$( "#accordion" ).accordion('option','active',0);
				}
			});
			
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
	</script>

 </head>
 <body>
	 <?= $contents ?>
	
	<div class="container-fluid">
	
		<div class="row-fluid">
			
			<div class="span3">
				<div class="well sidebar-nav">
					<div id="accordion">
						<div>
							<h3><a href="/sales/today_sales">Penjualan Hari Ini</a></h3>
							<div>
								<p>
									Loading... Please wait.
								</p> 
							</div>
						</div>
						<div>
							<h3><a href="#">Cari Data Penjualan</a></h3>
							<div>Second Accordion Content.</div>
						</div>
					</div>
				</div> <!-- /well sidebar-nav -->			
			
			</div> <!-- /span3 -->
			
			<div class="span9">
				<?php
					if(isset($err_msg) && $err_msg != ''){
				?>
				<div class="alert alert-error">
					<?php echo $err_msg; ?>
				</div>
				<?php } ?>
				<div class="data-container">
					<!--h3>Data Barang & Harga</h3-->
					<h3><button id="add_tab">Tambah Data Penjualan</button></h3>
					<div id="tabs_sales">
						<ul>
							<li><a href="<?php echo base_url(); ?>index.php/sales/new_sales">Penjualan 1</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
						</ul>
					</div>
				</div> <!-- /data-container -->			
				<style>
					#tabs_sales .account-container { height:400px; overflow-y:scroll; }
					#tabs_sales li .ui-icon-close { float: left; margin: 0.4em 0.2em 0 0; cursor: pointer; }
					.new-sales .control-label {width:70px;text-align:left;}
					.new-sales .controls {margin-left:70px;}
				</style>
				<script type="text/javascript">
					$(function() {
						var tabContent = $( "#tab_content" ),
							tabTemplate = "<li><a href='<?php echo base_url(); ?>index.php/sales/new_sales'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",
							tabCounter = 2;
						var tabs = $('#tabs_sales').tabs({
							beforeLoad: function( event, ui ) {
								ui.jqXHR.error(function() {
									ui.panel.html(
									"<div class='alert alert-error'>Data tidak bisa ditampilkan</div>" );
								});
							}
						});
						// actual addTab function: adds new tab using the input from the form above
						function addTab() {
							var label = "Penjualan " + tabCounter,
								id = "tabs-" + tabCounter,
								li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
								tabContentHtml = tabContent.val() || "";
							tabs.find( ".ui-tabs-nav" ).append( li );
							tabs.append( "<div id='" + id + "'><p>" + tabContentHtml + "</p></div>" );
							tabs.tabs( "refresh" );
							tabCounter++;
						}
						// addTab button: just create a new tab
						$( "#add_tab" ).click(function() {
							addTab();
							$('#tabs_sales').tabs('option','active', tabCounter-2);
						});						
						// close icon: removing the tab on click
						tabs.delegate( "span.ui-icon-close", "click", function() {
							var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
							$( "#" + panelId ).remove();
							tabs.tabs( "refresh" );
						});
						tabs.bind( "keyup", function( event ) {
							if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
								var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
								$( "#" + panelId ).remove();
								tabs.tabs( "refresh" );
							}
						});
					});
				</script>
			</div> <!-- /span9 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->


