	<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#"><img src="<?php echo base_url('assets/img/logo.PNG') ?>" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<!--<span class="badge bg-danger">5</span>-->
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Bantuan</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="fa fa-book"></i><span>Manual Book</span></a></li>
								<li><a href="#"><i class="fa fa-user-secret"></i><span>Kontak Admin</span></a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url('assets/img/user.png'); ?>" class="img-circle" alt="Avatar"> <span><?php echo $this->session->userdata('nm_user');?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('utilitas/C_config') ?>"><i class="fa fa-user-o"></i> <span>Profil Saya</span></a></li>
								<li><a class="auto" href="<?php echo base_url('utilitas/C_pengguna') ?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
								<li><a class="auto" href="<?php echo base_url('utilitas/C_otorisasi') ?>"><i class="fa fa-cog"></i> <span>Otorisasi</span></a></li>
								<li><a href="<?php echo base_url('Auth/logout') ?>"><i class="fa fa-power-off"></i> <span>Keluar</span></a></li>
							</ul>
						</li>
			
					</ul>
				</div>
			</div>
		</nav>
			<script>
			$(document).ready(function(){
				var oto = '<?php echo $this->session->userdata('oto');?>';
				if(oto=='01'){
					$('.auto').show();
				}else{
					$('.auto').hide();
				}
				
			});
			</script>
		<!-- END NAVBAR -->