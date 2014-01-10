							<div class="span9">
								<?php
									//$err_msg='test';
									if(isset($err_msg) && $err_msg != ''){
								?>
								<div class="alert alert-error">
									<?php echo $err_msg; ?>
								</div>
								<?php } ?>
								<div class="data-container">
									<h3>Data Barang & Harga</h3>
									<div id="tabs_barang">
										<ul>
											<li><a href="<?php echo base_url(); ?>index.php/barang">List Barang</a></li>
											<!--li><a href="#tabs-a">List Barang</a></li-->
											<li><a href="<?php echo base_url(); ?>index.php/barang/barang_baru">Tambah/Edit Data Barang</a></li>
											<li><a href="#tabs-b">Tambah Data Harga Barang</a></li>
											<li><a href="#tabs-c">Cari Data Barang</a></li>
										</ul>
									</div>
								</div> <!-- /error-container -->			
							
							</div> <!-- /span9 -->
							
						</div> <!-- /row -->
						
					</div> <!-- /container -->
		   
				</div> <!-- /content -->
				</div> <!-- /widget-content -->
				</div> <!-- /widget -->
			</div> <!-- /span12 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->
