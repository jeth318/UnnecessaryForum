<!-- DEN LJUSBLÅ MENYN SOM VISAR VILKEN ANVÄMNDARE SOM ÄR INLOGGAD BLAND ANNAT -->
<div class="row">
	<div class="col-sm-7">
		<div id="thread_div" style=""></div>	
	</div>
	<div class="col-sm-5">	
		<ul class="show_login_status">	
		  <?php

		  if(isset($_SESSION['username'])){

		    echo '<li class="user_info_top"> <h4 style="color: purple;">Welcome ';	    
		    echo $_SESSION['username'] . '</h4>';
		    echo '</li>
		    <li class="user_info_top">
		     <a href="db/log_out.php" id="log_out_link"><h5>Log out</h5></a>
		   </li>
		 ';

		} ?>
		</ul>
	</div>
</div>
