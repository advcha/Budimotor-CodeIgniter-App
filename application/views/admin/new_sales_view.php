	<div class="account-container">
	
		<div class="content clearfix">
			<?php 
				//$attributes = array('class'=>'form-sales');
				$attributes = array('class'=>'form-horizontal new-sales');
				echo form_open('barang/verifysales',$attributes); 
				
				//if(validation_errors()){
			?>
			<div id="result_msg" style="display:hidden;">
				<?php //echo validation_errors(); ?>
			</div>
			<?php //} ?>
			<br/>
			<fieldset>
										
				<div class="control-group">											
					<label class="control-label" for="kode">No. Pol.</label>
					<div class="controls">
						<input type="text" class="span2" id="nopol" name="nopol" value="" maxlength="10">
						&nbsp;&nbsp;&nbsp;Pemilik&nbsp;&nbsp;&nbsp;
						<input type="text" class="span4" id="pemilik" name="pemilik" value="" maxlength="50">
						&nbsp;&nbsp;&nbsp;Jenis Kendaraan&nbsp;&nbsp;&nbsp;
						<select id="jenis" name="jenis">
							<option value="0"></option>	
							<?php
							foreach($jenis as $row){
								echo '<option value="'.$row->idjenis.'">'.$row->jenis_kendaraan.'</option>';
							}
							?>
						</select>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				
				<div class="">
					<table id="sales_grid"></table>
					<div id="sales_pager"></div>
					<script type="text/javascript">
						//edit_id = 0;
						var lastSel = -1;
						$("#sales_grid").jqGrid({
							//url:'<?php echo base_url(); ?>index.php/barang/get_list_sales',
							datatype: "json",
							mtype: "POST",
							height: "auto",
							//harus disesuaikan dengan var $arr yang ada di model
							colNames:['ID', 'Kode', 'Nama Barang', 'Jumlah', 'Harga', 'Total'],
							colModel:[
								//harus disesuaikan dengan controlle crud pada fungsi get_json_data
								{name:'idbarang', key:true, index:'b.idbarang', width:1, hidden:true, search:false},
								{name:'kode', index:'b.kode', width:25, editable:true},
								{name:'nama',index:'b.nama', width:70, editable:true},
								{name:'qty',index:'s.sisa', width:20, editable:true, align:'right', formatter:'integer', formatoptions:{thousandsSeparator:'.'}},
								{name:'harga_beli',index:'h.harga_beli', width:30, editable:true, align:'right', formatter:'currency', formatoptions:{decimalSeparator:',',thousandsSeparator:'.',decimalPlaces:0,prefix:''}},
								{name:'harga_jual',index:'h.harga_jual', width:30, editable:true, align:'right', formatter:'currency', formatoptions:{decimalSeparator:',',thousandsSeparator:'.',decimalPlaces:0,prefix:''}}
							],
							rowNum:10,
							rowList:[10,20],
							rownumbers:true,
							//#pager merupakan div id pager
							pager: '#sales_pager',
							sortname: 'b.idbarang',
							viewrecords: true,
							sortorder: "asc",
							width: 900,
							height: "100%",
							//memanggil controller jqgrid yang ada di controller crud
							//editurl: "jqgrid/crud",
							cellEdit: true,
							onSelectRow: function(id){ 
								if(id && id!==lastsel){ 
									$('#sales_grid').jqGrid('restoreRow',lastsel); 
									$('#sales_grid').jqGrid('editRow',id,true); 
									lastsel=id; 
								} 
							},
							editurl: "jqgrid/crud",
							caption:" List Barang"
						});
						$("#sales_grid").jqGrid('navGrid','#sales_pager',{edit:true,add:true,del:true,
							addfunc: function(id){
								$('#tabs_barang').tabs('option','active',1);
							},
							editfunc: function(id){
								edit_id = id;
								$('#tabs_barang').tabs('option','active',1);
							}
						});
						
						for(var i=0;i<8;i++){
							$("#sales_grid").jqGrid('addRowData',i,{});
						}
						
						/*$("#sales_grid").jqGrid(
							'editRow',
							1, 
							keys : true, 
							oneditfunc: function() {
								alert ("edited"); 
							}
						});*/
					</script>
		   
				</div> <!-- /content -->
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary" id="simpan">Simpan</button> 
					<button class="btn" id="batal">Batal</button>
				</div> <!-- /form-actions -->
				<script type="text/javascript">
					$(function() {
						//ajax submit form 
						/*$('form.form-horizontal').on('submit',function(e){
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
						*/
					});
				</script>
				</fieldset>
			</form>
   
		</div> <!-- /content -->
	
	</div> <!-- /account-container -->
