<?php 
// FÖRSÖKTE HÄR ATT FÅ TILL EN SMIDIGARE SÖKFUNKTION MED AJAX. Jag lyckades dock inte så jag kör på den första versionen som finns i filen "view_search_results.php". Lämnar kvar koden dock. 
/*
include ('overall/top.php') ?>

<style type="text/css">
	#search_res{
		display: none;
	}
</style>
<script type="text/javascript">

$(function(){
 
  $('#search_box').keyup(function() {
    $("#search_res").show();
    
    var x = $(this).val();
    
    §.ajax(
    {
    	url: 'fetch.php',
    	dataType: "text json",
    	type: 'POST',
    	data: {q: x},
    	success:function(data)
    	{
    		$("#search_res").html(data);
    	}
    	error:function(data)
    	{
    		alert("faild");
    	}
    });     
  });
});

</script>

<div class="middle_header">
	<h4 class="middle_header_h4">Search topics</h4>
</div>

<input type="text" id="search_box"></input>

<div class="row" style="padding: 15px; ">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <h3 style="text-align: center;">You searched for "<?php echo $_GET['q']; ?>"</h3>
    </div>
    <div class="col-sm-2">
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8" id="search_res" style="border-radius: 2px; border: 1px solid grey; padding: 10px; text-align: center;">
   
    </div>
    <div class="col-sm-2" style=" display: inline-block; vertical-align: bottom";>
    </div>
</div>
<div class="row" style="padding: 0; margin: 0; margin-top: 100px;">
    <div class="col-xs-12" style="border-bottom: 1px solid rgba(0,0,0,0.2); margin-top: 25px;">
    </div>
</div>

<?php include ('overall/bottom.php') ?>