<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<!-- Sidebar Menu -->
					<ul class="nav">

				<?php
				$a = 0;$b = 0;$c = 0;$d=0;
				$oto = "m".$this->session->userdata('oto');
				$main_menu = $this->db->order_by('idmenu', 'ASC')->get_where('ms_menu', array('is_parent' => 0,'is_active' => 1,$oto => 1));
					foreach ($main_menu->result() as $main) 
					{
						$sub_menu1 = $this->db->order_by('idmenu', 'ASC')->get_where('ms_menu', array('is_parent' => $main->idmenu,'is_active' => 1,$oto => 1));
						if ($sub_menu1->num_rows() > 0) 
						{
							echo "<li><a style='padding-left:15px' href='#subPages".$a."' data-toggle='collapse' class='collapsed'><i class='$main->icon'></i>$main->judul<span><span><i class='fa fa-angle-left pull-right'></i></span></a>";
							echo "<div id='subPages".$a."' class='collapse'>";
							echo "<ul class='nav'>";
							$a++;
							foreach ($sub_menu1->result() as $sub1) 
							{
								$sub_menu2 = $this->db->order_by('idmenu', 'ASC')->get_where('ms_menu',array('is_parent'=> $sub1->idmenu,'is_active'=>1,$oto => 1));
								if($sub_menu2->num_rows() > 0)
								{
									echo "<li><a style='padding-left:30px; font-size: 12px;' href='#subPagesChild".$b."' data-toggle='collapse' class='collapsed'><i class='$sub1->icon'></i>$sub1->judul<span><span><i class='fa fa-angle-left pull-right'></i></span></a>";
									echo "<div id='subPagesChild".$b."' class='collapse'>";
									echo "<ul class='nav'>";
									$b++;
									foreach ($sub_menu2->result() as $sub2)
									{
										$sub_menu3 = $this->db->order_by('idmenu', 'ASC')->get_where('ms_menu',array('is_parent'=> $sub2->idmenu,'is_active'=>1,$oto => 1));
										if($sub_menu3->num_rows()> 0){
											
											echo "<li><a style='padding: -1px; padding-left:45px; font-size: 12px;' href='#superChild".$c."' data-toggle='collapse' class='collapsed'><i class='lnr lnr-file-empty'></i>$sub2->judul<span><span><i class='fa fa-angle-left pull-right'></i></span></a>";
											echo "<div id='superChild".$c."' class='collapse'>";
											echo "<ul class='nav'>";	
											$c++;
											foreach ($sub_menu3->result() as $sub3)
											{
												$sub_menu4 = $this->db->order_by('idmenu', 'ASC')->get_where('ms_menu',array('is_parent'=>$sub3->idmenu,'is_active'=>1,$oto => 1));
												if($sub_menu4->num_rows()> 0){
													echo "<li><a style='padding-left: 60px;font-size: 12px; ' href='#childMenuThird".$d."' data-toggle='collapse' class='collapsed'><i class='lnr lnr-file-empty'></i>$sub3->judul<span><span><i class='fa fa-angle-left pull-right'></i></span></a>";
													echo "<div id='childMenuThird".$d."' class='collapse'>";
													echo "<ul class='nav'>";
													$d++;
													foreach ($sub_menu4->result() as $sub4)
													{
														echo "<li>" . anchor($sub4->link, '<i class="lnr lnr-file-empty"></i>' . $sub4->judul, 'style="padding-left:50px"; font-size: 12px;') . "</li>";	
													}
													echo"</ul></div></li>";
												}else{
													echo "<li>" . anchor($sub3->link, '<i class="lnr lnr-file-empty"></i>' . $sub3->judul, 'style=" padding-left:60px; font-size: 12px;"') . "</li>";	
												}
											}
											echo"</ul></div></li>";
										}else{
											echo "<li>" . anchor($sub2->link, '<i class="lnr lnr-file-empty"></i>' . $sub2->judul, 'style=" padding-left:45px; font-size: 12px;"') . "</li>";	
										}
										
									}
									echo"</ul></div></li>";
								}else{
									echo "<li>" . anchor($sub1->link, '<i class="' . $sub1->icon . '"></i>' . $sub1->judul, 'style=" padding-left: 30px; font-size: 12px;"') . "</li>";
								}
							}
							echo"</ul></div></li>";
						}else{
							echo "<li>".anchor($main->link, '<i class="'. $main->icon .'"></i>'. $main->judul, 'style=" padding-left: 15px;"')."</li>";
						}
						
					}
				?>
					</ul>
				</nav>
			</div>
		</div>