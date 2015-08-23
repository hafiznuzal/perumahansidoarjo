	<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Laporan Pembangunan Kabupaten Siodarjo</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class ="row">
				<div class ="col-lg-11">

					<div id="addSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert" >&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil ditambahkan
					</div>
					 <div id="delSuccess" class="alert alert-success"style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil dihapus
					</div>
					 <div id="editSuccess" class="alert alert-success"style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil disunting
					</div>
					<!-- /.success notification-->

					<div class ="panel panel-primary">
						<div class="panel-heading">

							<i class="fa fa-list"></i> Rekap Pembangunan Kabupaten Sidoarjo
						</div>
				
						
							
						
						<div class="panel-body">
							<div class="form-group panel-default">
								<div class="row">
									<div class="col-md-2">
									

									<label>Tahun:</label> 
									<select class="form-control form-inline" id="tahunOpt" name="tahun">
							    		<option disabled selected>Tahun</option>
									    <?php  for ($i=$tahun-3; $i <$tahun ; $i++) { ?> 
									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>	
									    
									 <option value="<?php echo $tahun; ?>" selected><?php echo $tahun; ?></option>
									    <?php  for ($i=$tahun+1; $i <$tahun+3; $i++) { ?> 
									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>

									</select>
									</div> 
									
									<!-- <div class="col-md-2"> 
							
									<label>Triwulan:</label> 
									<select class="form-control form-inline" id="periodeOpt" name="periode">
									 	<option disabled selected>Periode</option>
									    <option value="1" <?php if($bulan==1) echo "selected";?>>1</option>
									    <option value="2" <?php if($bulan==2) echo "selected";?>>2</option>
									    <option value="3" <?php if($bulan==3) echo "selected";?>>3</option>
									    <option value="4" <?php if($bulan==4) echo "selected";?>>4</option>
									</select>
									</div> -->

									<div class="col-md-3 pull-right"> 
										
										<a href="#" class="pull-right" id="excelPemDownload">Download Excel <img src="<?php  echo site_url()?>assets/img/excel.png"></a>
										<br>
										<a href="#" class="pull-right" id="pdfPemDownload">Download PDF <img src="<?php  echo site_url()?>assets/img/pdf.png"></a>

									</div>
								</div>
							</div>
							<div class ="table">
								<table id="pembangunanAll" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th style="min-width: 50px;">No</th>
											<th style="min-width: 100px;">Kecamatan</th>
											<th style="min-width: 100px;">Perusahaan</th>
											<th style="min-width: 150px;">Nama Perumahan</th>
											<th style="min-width: 100px;">Nama Lokasi</th>
											<th style="min-width: 100px;">Rencana RSS</th>
											<th style="min-width: 100px;">Rencana RS</th>
											<th style="min-width: 100px;">Rencana RM</th>
											<th style="min-width: 100px;">Rencana MW</th>
											<th style="min-width: 100px;">Rencana Ruko</th>
											<th style="min-width: 100px;">Realisasi RSS</th>
											<th style="min-width: 100px;">Realisasi RS</th>
											<th style="min-width: 100px;">Realisasi RM</th>
											<th style="min-width: 100px;">Realisasi MW</th>
											<th style="min-width: 100px;">Realisasi Ruko</th>
											<th style="min-width: 100px;">Catatan</th>
											
										</tr>
									</thead>
									<tbody>
										<?php $c=1;foreach ($pembangunan as $i) {?>
										<tr class="odd gradeX">
											<td><?php echo $c?></td>
											<td><?php echo $i['nama_kecamatan']?></td>
											<td><?php echo $i['nama_perusahaan']?></td>
											<td><?php echo $i['nama_perumahan']?></td>
											<td><?php echo $i['nama_lokasi']?></td>
											<td><?php echo $i['renc_rss']?></td>
											<td><?php echo $i['renc_rs']?></td>
											<td><?php echo $i['renc_rm']?></td>
											<td><?php echo $i['renc_mw']?></td>
											<td><?php echo $i['renc_ruko']?></td>
											<td><?php echo $i['real_rss']?></td>
											<td><?php echo $i['real_rs']?></td>
											<td><?php echo $i['real_rm']?></td>
											<td><?php echo $i['real_mw']?></td>
											<td><?php echo $i['real_ruko']?></td>
											<td><?php echo $i['catatan']?></td>
											
										</tr>
										<?php $c++;} ?>
									</tbody>
								</table>
							</div>
							<!-- /.table -->
						</div>
						<!-- /.panel-body -->

					</div>
					<!-- /.panel -->
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
	</div>


<script type="text/javascript">

$(document).ready(function(){
	$('#pembangunanAll').DataTable( {
			"scrollX": true,
			"scrollY": "400px"
	});			

	$('#excelPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>report/printout_report_pembangunan_excel/"+$('#tahunOpt').val();
	})

	$('#pdfPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>create_pdf/report_pembangunan_pdf/"+$('#tahunOpt').val();
	})
	function changeDataPem()
	{
		
		window.location="<?php echo site_url() ?>report/report_pembangunan/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
		
	}
	$('#tahunOpt').change(function(){
		
		changeDataPem()
	});
	



});
	
</script>