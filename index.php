<!-- 

ALLMÄN INFORMATION:

Jag har satsat på VG i php, men även försökt få med så mycket av övriga modulers VG-krav.

-->
<?php
include ('overall/top.php');
include ('db/DatabaseClass.php');
$db = new Database;
?>
<script type="text/javascript">
    document.title = "Index";

</script>

<div class="container"> 
    <div class="row">
        <div class="middle_header col-sm-12">
            <table class="categories_top_row">
                <tr>
                    <td id='td_catagory'>
                        <h4> Category </h4>
                    </td>
                    <td id='td_creator'>
                        <h4> Creator </h4>
                    </td>
                    <td id='td_time'>
                        <h4> Posted on </h4>
                    </td>
                </tr>
            </table>      
        </div>  
    </div> 
    <div class="row">
        <!-- NÄSSLAD LOOP SOM PRINTAR DATABAS-INNEHÅLLET (Categories med tillhörande topics) -->
        <?php

        $tableName_topics = "forum_topics";
        $tableName_categories = "categories";

        $result_topics = $db->selectAllFrom($tableName_topics);    
        $result_categories = $db->selectAllFrom($tableName_categories);

        while($row_category = mysqli_fetch_assoc($result_categories)){

            $category = $row_category['category_name'];
            $topic_category = "topic_category";

            echo "<div class='print'><h4 class='categories'> ".$category. "</h4></div>";
            echo '<table class="index_table">';

            $selectRelatedTopics = $db->selectOneFrom($tableName_topics, $topic_category, $category);

            while ($row_specific_topic = mysqli_fetch_assoc($selectRelatedTopics)){

                $topic_category = $row_specific_topic['topic_category'];      
                $topic_title = $row_specific_topic['topic_title'];
                $topic_creator = $row_specific_topic['topic_creator'];
                $topic_time = $row_specific_topic['topic_time'];
                $topic_id = $row_specific_topic['topic_id'];

                echo '
                    <tr>
                     <td class="td_topic_title"><a href="view_topic.php?id='.$topic_id.'" class="topic_links">'. $topic_title .'</a></td>
                     <td class="td_topic_creator"><a href="view_profile.php?member='.$topic_creator.'" class="topic_links_creator">'. $topic_creator .'</a></td>

                     <td class="td_topic_time" style="text-align: right;">'.$topic_time.'</td>
                    </tr>';
                    
                } // END INNER-LOOP
                echo '</table>';          
            } // END OUTER-LOOP
        ?>
    </div>  <!-- END ROW -->
</div>  <!-- END CONTAINER -->

<?php include ('overall/bottom.php'); ?>