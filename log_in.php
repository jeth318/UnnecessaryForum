<!-- SIDA SOM VISAR INLOGGNINGSFORMULÄRET -->
<?php include ('overall/top.php') ?>

<script type="text/javascript">
    document.title = "Log in";

if($(window).width() > 768) {

  $(function(){
    $('#login_div').animate({
          left: '200'
      });
});
}

</script>

<div class="middle_header">
    <h4 class="middle_header_h4">Log in</h4>
</div>

<div class="row" style="padding: 15px; ">
<div class="col-sm-2"></div>
            
    <div class="col-sm-8 center-block" id="login_div">
        <table class="log_in center-table">
            <tr>
                <td>
                    <h5>Username: </h5>
                </td>
                <td>
                    <input type="text" name="username" placeholder="username" id="username">
                </td>
            </tr> 
            <tr>
                <td>
                    <h5>Password: </h5>
                </td>
                <td>
                    <input type="password" name="password" placeholder="password" id="password">         
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                   <button type="button" id="login_button" class="submit_button">Log in</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="errorMessage" id="login_message"></span>
                </td>
            </tr>
        </table>
        </div>
        <div class="col-sm-2"></div>
        </div>

<?php include ('overall/bottom.php') ?>