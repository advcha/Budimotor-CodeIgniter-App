	<div class="account-container">
	
		<div class="content clearfix">
			<?php 
				$attributes = array('class'=>'form-horizontal');
				echo form_open('barang/verifybarang',$attributes); 
				
				//if(validation_errors()){
			?>
			<div id="result_msg" style="display:hidden;">
				<?php //echo validation_errors(); ?>
			</div>
			<?php //} ?>
			<br/>
			<fieldset>
										
				<div class="control-group">											
					<label class="control-label" for="kode">Kode Barang</label>
					<div class="controls">
						<input type="text" class="span2" id="kode" name="kode" value="" maxlength="10">
						&nbsp;&nbsp;&nbsp;Nama Barang&nbsp;&nbsp;&nbsp;
						<input type="text" class="span6" id="nama" name="nama" value="" maxlength="50">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="jenis">Jenis Barang</label>
					<div class="controls">
						<select id="jenis" name="jenis">
							<option value="0"></option>	
							<?php
							foreach($jenis as $row){
								echo '<option value="'.$row->idjenis.'">'.$row->jenis_barang.'</option>';
							}
							?>
						</select>
						&nbsp;&nbsp;&nbsp;Lokasi Barang&nbsp;&nbsp;&nbsp;
						<select id="lokasi" name="lokasi">
							<option value="0"></option>	
							<?php
							foreach($lokasi as $row){
								echo '<option value="'.$row->idlokasi.'">'.$row->lokasi_barang.'</option>';
							}
							?>
						</select>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="satuan">Satuan Barang</label>
					<div class="controls">
						<select id="satuan" name="satuan">
							<?php
							foreach($satuan as $row){
								echo '<option value="'.$row->idsatuan.'">'.$row->satuan.' ('.$row->satuan_abbr.')</option>';
							}
							?>
						</select>
						&nbsp;&nbsp;&nbsp;Stock Awal&nbsp;&nbsp;&nbsp;
						<input type="text" class="span2" id="stockawal" name="stockawal" value="0" maxlength="10">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="hargabeli">Harga Beli (Rp.)</label>
					<div class="controls">
						<input type="text" class="span3" id="hargabeli" name="hargabeli" value="0" maxlength="20">
						&nbsp;&nbsp;&nbsp;Harga Jual (Rp.)&nbsp;&nbsp;&nbsp; 
						<input type="text" class="span3" id="hargajual" name="hargajual" value="0" maxlength="20">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="control-group">											
					<label class="control-label" for="harga">Harga Mulai Berlaku Dari</label>
					<div class="controls">
						<input type="text" class="span2" id="mulai_berlaku" name="mulai_berlaku" value="" maxlength="10"> s/d 
						<input type="text" class="span2 disabled" id="sampai_berlaku" name="sampai_berlaku" value="" maxlength="10" disabled> 
						<label class="checkbox inline">
							<input type="checkbox" id="chk_smp" name="chk_smp" value="seterusnya" checked>seterusnya
						</label>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="form-actions">
					<button type="submit" class="btn btn-primary" id="simpan">Simpan</button> 
					<button class="btn" id="batal">Batal</button>
				</div> <!-- /form-actions -->
				<script type="text/javascript">
					$(function() {
						//ajax submit form 
						$('form.form-horizontal').on('submit',function(e){
							e.preventDefault();
							var obj = $(this),
							url = obj.attr('action'),
							method = obj.attr('method'),
							data = {};
							
							var form_data = {
								kode: $('#kode').val(),
								nama: $('#nama').val(),
								jenis: $('#jenis').val(),
								lokasi: $('#lokasi').val(),
								satuan: $('#satuan').val(),
								hargabeli: $('#hargabeli').val(),
								hargajual: $('#hargajual').val(),
								mulai_berlaku: $('#mulai_berlaku').val(),
								sampai_berlaku: $('#sampai_berlaku').val(),
								stockawal: $('#stockawal').val(),
								edit_data: edit_data
							};
							if($('#chk_smp').is(':checked'))
								form_data['chk_smp'] = $('#chk_smp').val();
							else
								form_data['chk_smp'] = '';
								
							$.ajax({
								url: url,
								type: method,
								data: form_data,
								dataType: 'json',
								success: function(data){
									var result = '';
									var iserror = false;
									$.each(data, function(key,value){
										//result += key + ' : ' + value;
										if(key == 'error'){
											if(value == 'true')
												iserror = true;
										}else{
											result += value;
										}
									});
									$('#result_msg').html(result);
									$('#result_msg').removeClass();
									$('#result_msg').removeAttr('style');
									if(iserror)
										$('#result_msg').addClass('alert alert-error');
									else{
										$('#result_msg').addClass('alert alert-success');
										//empty form
										$('#kode').val('');
										$('#nama').val('');
										$('#hargabeli').val('0');
										$('#hargajual').val('0');
										$('#stockawal').val('0');
										$('#mulai_berlaku').val();
										$('#sampai_berlaku').val();
										$('#chk_smp').val();
										
										//scroll to top
										$('html, body').animate({scrollTop:0},600);
										$('#kode').focus();
										
										//hide the message after 5 seconds
										$('#result_msg').hide('blind',{},4000,removeMsg);
										
										if(edit_id > 0){//if edit with id
											$('#tabs_barang').tabs('option','active',0);//show list
										}
									}
								}
							});
						});
						
						//alert(edit_id);
						if(edit_id > 0){
							$.ajax({
								url: '<?php echo base_url(); ?>index.php/barang/barang_edit/'+edit_id,
								type: 'POST',
								//data: {},
								dataType: 'json',
								success: function(data){
									data = JSON.stringify(data);
									data = JSON.parse(data);
									//check if there is any sales data and if so, display some warnings like 'Cant change the price,etc'
									$.each(data[0], function(key,value){
										switch(key){
											case 'kode':
												$('#kode').val(value);
												break;
											case 'nama':
												$('#nama').val(value);
												break;
											case 'harga_beli':
												$('#hargabeli').val(value);
												$('#hargabeli').trigger('keydown');
												break;
											case 'harga_jual':
												$('#hargajual').val(value);
												$('#hargajual').trigger('keydown');
												break;
											case 'idjenis':
												$('#jenis').val(value);
												break;
											case 'idlokasi':
												$('#lokasi').val(value);
												break;
											case 'awal_berlaku':
												$('#mulai_berlaku').val(value);
												break;
										}
									});
								}
							});
						}

						$('#batal').click(function(){
							if(edit_id > 0){
								$('#tabs_barang').tabs('option','active',0);//show list
							}else{
								$('#kode').val('');
								$('#nama').val('');
								$('#hargabeli').val('0');
								$('#hargajual').val('0');
								$('#stockawal').val('0');
								
								$('#kode').focus();
							}
							
						});
						function removeMsg(){
							setTimeout(function(){
								$('#result_msg').removeClass('alert alert-success').hide().fadeIn();
								$('#result_msg').empty();
							},8000);
						};
						//focus and prevent submit on enter key
						$('#kode').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode  
								$('#nama').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#nama').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#jenis').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#jenis').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#lokasi').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#lokasi').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#satuan').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#satuan').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#stockawal').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#stockawal').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#hargabeli').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#hargabeli').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#hargajual').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#hargajual').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#mulai_berlaku').focus();
								e.preventDefault();
								return false;
							 }
						});
						$('#mulai_berlaku').bind('keydown', function(e) {
							var code = e.keyCode || e.which;
							 if(code == 13 || code == 9) { //Enter or Tab keycode
								$('#simpan').focus();
								e.preventDefault();
								return false;
							 }
						});
						
						$('#mulai_berlaku').datepicker({
							/*inline: true,*/
							dateFormat: 'dd-mm-yy',
							showOn: "button",
							buttonImage: '<?php echo base_url(); ?>bootstrap/img/calendar.gif',
							buttonImageOnly: true
						});
						$('#mulai_berlaku').datepicker('setDate', new Date());
						
						$('#sampai_berlaku').datepicker({
							dateFormat: 'dd-mm-yy',
							showOn: "button",
							buttonImage: '<?php echo base_url(); ?>bootstrap/img/calendar.gif',
							buttonImageOnly: true
						});
						$('#hargabeli').priceFormat({
							prefix: '',
							thousandsSeparator: '.',
							centsLimit: 0
						});
						$('#hargajual').priceFormat({
							prefix: '',
							thousandsSeparator: '.',
							centsLimit: 0
						});
						$('#stockawal').priceFormat({
							prefix: '',
							thousandsSeparator: '.',
							centsLimit: 0
						});
						$('#chk_smp').click(function(){
							if($('#chk_smp').is(':checked')){
								$('#sampai_berlaku').attr('disabled','sampai_berlaku');
								$('#sampai_berlaku').addClass('disabled');
								$('#sampai_berlaku').next('img').hide();
							}else{
								$('#sampai_berlaku').removeAttr('disabled');
								$('#sampai_berlaku').removeClass('disabled');
								$('#sampai_berlaku').next('img').show();
							}
						});
						
						$('#kode').focus();
						$('#sampai_berlaku').next('img').hide();

					});
				</script>
				</fieldset>
			</form>
   
		</div> <!-- /content -->
	
	</div> <!-- /account-container -->
