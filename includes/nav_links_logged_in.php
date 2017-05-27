<div class="row">
    <div class="col-sm-7"> 
        <ul class="nav-links">
            <?php
            // KONTROLLERAR OM DEN INLOGGADE ANVÄNDAREN ÄR ADMIN. Om så är fallet, visas en CRUD-vertyg-knapp.
                if (isset($_SESSION['username'])) {
                    if ($_SESSION['username'] == "admin") {
                        echo '<li style="background-color: orange; color: white;">
                                 <a href="admin_page.php">CRUD-tools</a>
                             </li>';
                    } else {
                        echo '<li id="create_topic">
                                <a href="index.php" >Categories</a>
                            </li>';
                    }
                }
             ?>
            <li id="create_topic">
                <a href="post_topic.php" >Create topic</a>
            </li>
            <li id="my_profile">
                <a href="profile.php" >My profile</a>
            </li>
            
        </ul>
    </div>

    <!-- SEARCH FORM -->

    <div class="col-sm-5">
        <form action="view_search_result.php" method="get">
            <ul class="nav-search">            
                <li>
                    <input type="text" class="search-bar" name="search" placeholder="Search topics"/>
                </li>
                 <li>
                    <input type="submit" value="GO!" id="search_button" style="width: auto;"/>
                </li>       
            </ul>
        </form>
    </div>
</div>