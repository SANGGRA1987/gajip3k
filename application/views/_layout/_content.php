		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo @$judul;?></h3>
									<?php
									  $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
									  $hr = $array_hr[date('N')];
									  $tgl= date('j');
									  $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
									  $bln = $array_bln[date('n')];
									  $thn = date('Y');
									?> 
							<p class="panel-subtitle" ><?php echo $hr . ", " . $tgl . " " . $bln . " " . $thn;?> <span id="clock"></span>
							</p>
						</div>
						<div class="panel-body" style="padding: 0 20px 20px 20px">
							<?php echo @$_mainContent;?>
						</div>
					</div>
					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		