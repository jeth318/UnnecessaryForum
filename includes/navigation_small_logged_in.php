<!-- ÖVERMENYN SOM VISAS OM MAN EJ ÄR INLOGGAD -->
<div class="row small_nav_not_logged_in">
	<div class="col-xs-2 menu_buttons_div">	
		<h4><a href="index.php" style="color: white"> UF</a></h4>
	</div>
	<div class="col-xs-10 menu_buttons_div">		
		<button type="button" id="menu_button"> <span class="glyphicon glyphicon-menu-hamburger"></span></button>
	</div>
	<div class="row nav-links-small-row_logged_in">
		<div class="col-xs-12">
			<ul class="nav-links-small">
			<?php 
	                if (isset($_SESSION['username'])) {
	                    if ($_SESSION['username'] == "admin") {
	                        echo '<br><li style="background-color: orange; color: white;">
			                <a href="admin_page.php">CRUD-tools</a>
			            </li>';
			                }
			            }
	             	?>
	            <li>
	                <a href="index.php#categories" >Categories</a>
	                <hr class="line_small_menu">
	            </li>
	            <li>
	                <a href="post_topic.php" >Create topic</a>
	                <hr class="line_small_menu">
	            </li>
	            <li>
	                <a href="profile.php" >My profile</a>
	                <hr class="line_small_menu">
	            </li>
	            <li>
	                <a href="db/log_out.php" >Log out</a>
	                
	            </li>
		            
	        </ul>
		</div>
	</div>
</div>