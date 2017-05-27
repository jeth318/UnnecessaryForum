<!DOCTYPE html>
<html>
    <?php 
    session_start();
    error_reporting(0);
    include ('includes/head.php');
    
    ?>
    <body> 
        <div class="main-container">
         <div class="navigation-small">
         <?php 
                if(isset($_SESSION['username'])){

                            
                            include ('includes/navigation_small_logged_in.php');
                        }   
                        else{
                            
                            include ('includes/navigation_small.php');
                        }
                    ?>    
                    
            </div>
            
            <div class="top-container">
                <div class="header">
                    <a href="index.php"><img src="img/logotype.png" alt="Logo" class="logo" style="height: 70px;"></a>
                </div>
               
                <div class="navigation-links">
                    <?php 
                        if(isset($_SESSION['username'])){

                            include ('includes/nav_links_logged_in.php');
                            include ('includes/navigation_small_logged_in.php');
                        }   
                        else{
                            include ('includes/nav_links.php');
                            include ('includes/navigation_small.php');
                        }
                    ?>    
                </div>
                <div class="navigation">
                    <?php include ('includes/nav_thread.php') ?>
                </div>
            </div>
            <div class="middle-container">