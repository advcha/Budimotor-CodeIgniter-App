	<div class="account-container">
	
		<div class="content clearfix">
			<table id="barang_grid"></table>
			<div id="barang_pager"></div>
			<script type="text/javascript">
				edit_id = 0;
				$("#barang_grid").jqGrid({
					url:'<?php echo base_url(); ?>index.php/barang/get_list_barang',
					datatype: "json",
					mtype: "POST",
					height: "auto",
					//harus disesuaikan dengan var $arr yang ada di model
					colNames:['ID', 'Kode', 'Nama', 'Jenis', 'Lokasi', 'Harga Beli', 'Harga Jual', 'Stock'],
					colModel:[
						//harus disesuaikan dengan controlle crud pada fungsi get_json_data
						{name:'idbarang', key:true, index:'b.idbarang', width:1, hidden:true, search:false},
						{name:'kode', index:'b.kode', width:15, search:true},
						{name:'nama',index:'b.nama', width:60, search:true},
						{name:'jenis_barang',index:'j.jenis_barang', width:40, search:true},
						{name:'lokasi_barang',index:'l.lokasi_barang', width:40, search:true},
						{name:'harga_beli',index:'h.harga_beli', width:40, search:true, align:'right', formatter:'currency', formatoptions:{decimalSeparator:',',thousandsSeparator:'.',decimalPlaces:0,prefix:''}},
						{name:'harga_jual',index:'h.harga_jual', width:40, search:true, align:'right', formatter:'currency', formatoptions:{decimalSeparator:',',thousandsSeparator:'.',decimalPlaces:0,prefix:''}},
						{name:'stock',index:'s.sisa', width:40, search:true, align:'right', formatter:'integer', formatoptions:{thousandsSeparator:'.'}}
					],
					rowNum:20,
					rowList:[20,50,100],
					rownumbers:true,
					//#pager merupakan div id pager
					pager: '#barang_pager',
					sortname: 'b.idbarang',
					viewrecords: true,
					sortorder: "asc",
					width: 920,
					height: "100%",
					//memanggil controller jqgrid yang ada di controller crud
					//editurl: "jqgrid/crud",
					editurl: "jqgrid/crud",
					caption:" List Barang" 
				});
				$("#barang_grid").jqGrid('navGrid','#barang_pager',{edit:true,add:true,del:true,
					addfunc: function(id){
						$('#tabs_barang').tabs('option','active',1);
					},
					editfunc: function(id){
						edit_id = id;
						$('#tabs_barang').tabs('option','active',1);
					}
				});
 
			</script>
   
		</div> <!-- /content -->
	
	</div> <!-- /account-container -->
