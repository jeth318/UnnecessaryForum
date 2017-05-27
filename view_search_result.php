<?php
include ('overall/top.php');
include 'db/DatabaseClass.php';

$search_term = $_GET['search'];
$db = new Database;
?>

<script type="text/javascript">
    document.title = "View Profile";
</script>
<div class="middle_header">
    <h4 class="middle_header_h4">Search</h4>
</div>
<div class="row" style="padding: 15px; ">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <h3 style="text-align: center;">You searched for "<?php echo $search_term; ?>"</h3>
    </div>
    <div class="col-sm-2">
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" style="border-radius: 2px; border: 1px solid grey; padding: 10px; text-align: center;">
        <?php echo $db->Search($search_term); ?>    
    </div>
    <div class="col-sm-2" style=" display: inline-block; vertical-align: bottom";>
    </div>
</div>
<div class="row" style="padding: 0; margin: 0; margin-top: 100px;">
    <div class="col-xs-12" style="border-bottom: 1px solid rgba(0,0,0,0.2); margin-top: 25px;">
    </div>
</div>

<?php include ('overall/bottom.php') ?>