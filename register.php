<!-- REGISTRERING -->
<?php
error_reporting(0);
include ('overall/top.php') 
?>

</style>
<script type="text/javascript">
    document.title = "Register";

if($(window).width() > 768) {

  $(function(){
    $('#register_div').animate({
          left: '200'
      });
});
}

</script>

<div class="middle_header">
    <h4 class="middle_header_h4">Become a member</h4>
</div>
<div class="row" style="padding: 15px;">
<div class="col-sm-2"></div>
<div class="col-sm-8" id="register_div">
<table class="log_in center-table">
    <tr>
        <td>
            <h5>Username: </h5>
        </td>
        <td>
            <input type="text" name="username" id="reg_username"> <span id="user-availability-status" class="errorMessage"></span> <br> <span class="errorMessage" id="error_username"></span>
        </td>
    </tr> 
    <tr>
        <td>
            <h5>Password: </h5>
        </td>
        <td>
            <input type="password" name="password" id="reg_password"> <br> <span class="errorMessage" id="error_password"></span>
        </td>
    </tr>
    <tr>
        <td>
            <h5>Confirm Password: </h5>
        </td>
    <td>
        <input type="password" name="password" id="reg_confirm_password"> <br> <span class="errorMessage" id="error_confirm_password"></span>
    </td>
    </tr>
    <tr>
        <td>
            <h5>E-mail: </h5>
        </td>
        <td>
            <input type="text" name="email" id="reg_email"> <br> <span class="errorMessage" id="error_email"></span>
        </td>
    </tr>
    <tr>
        <td>
            <h5>Name: </h5>
        </td>
        <td>
            <input type="text" name="firstname" id="reg_firstname"> <br> <span class="errorMessage" id="error_firstname"></span>
        </td>
    </tr>
    <tr>
        <td>
            <h5>Lastname: </h5>
        </td>
        <td>
         <input type="text" name="lastname" id="reg_lastname"> <br> <span class="errorMessage" id="error_lastname"></span>
     </td>
    </tr>

    <tr>
        
        <td colspan="2" style="text-align: right;">
            <button type="button" id="reg_button" class="submit_button">Join</button>
            <br>
            <span class="errorMessage" id="error_submit"> <br> </span>
        </td>
    </tr>
</table>
</div>
<div class="col-sm-2"></div>
</div>

<?php include ('overall/bottom.php') ?>