<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>User Registration</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
       <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.validate.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                //login form validation
                $("#frmRegister").validate({
                    rules:{
                        email: "required",
                        fname: "required",
                        lname: "required",
                        uInstitution: "required"
                    },
                    messages: {
                        email: "Email is required.",
                        fname: "First name is required.",
                        lname: "Last name is required.",
                        uInstitution: "Institution is required."
                    }
                });

                //check user credentials on submit
                $("#frmRegister").submit(function() {
                    var uemail = $("#email").val();
                    var fName = $("#fname").val();
                    var lName = $("#lname").val();
                    var uInstitution = $("#uInstitution").val();
                    //alert(uidval);
                    $.post("subpages/new-registration.php", { uemail:uemail, fName:fName,lName:lName,uInstitution:uInstitution },
                    function(data) {
                        var str = $.trim(data);
                        if(str == "logged"){
                            document.location='myPage.php';
                        }else{
                            //$("#messageDiv").html(data);
                            $("#messageDiv").html("You have successfully registered, please check your Email.");
                        }
                    });
                    return false;
                });
            });
       </script>
    </head>
    <body>
         <?php 
             $happiDoc=include_once 'documents-location.php';
             include_once $happiDoc.'templates/header_template.php'; 
         ?>
        <div id="container">
           
            <div id="mainContentPages" >
                <h2>New Registration</h2>
                <p>Registered users can annotate interactions as well as create their own customized list of interactions!!</p>
                <div id="registerFormDiv" >
                    <i>Remember the registered email will be your Login Email Id.</i>
                    <br/><br/><br/>
                    <form id="frmRegister" name="frmRegister" action="" method="POST" >
                        <div id="messageDiv"></div>
                            <label style="width:170px;margin-left: 50px;color:red">
                                **All Fields are required.**</label><br/><br/>
                            <label for="email" class="formlabel">Email:</label>
                            <input type="text" name="email" id="email" value="" class="textbox required email"/>

                            <br/>
                            <label for="fname" class="formlabel">First Name:</label>
                            <input type="text" name="fname" id="fname" value="" class="textbox required"/>

                            <br/>
                            <label for="lname" class="formlabel">Last Name:</label>
                            <input type="text" name="lname" id="lname" value="" class="textbox required"/>

                            <br/>
                            <label for="uInstitution" class="formlabel">Institution:</label>
                            <input type="text" name="uInstitution" id="uInstitution" value="" class="textbox required"/>

                            <input type="hidden" name="registerForm" value="1"/>
                            <br/>
                            <div style="margin-top: 10px;" >
                                <input id="btnRegister" type="submit" value="Register" style="" />
                                <input id="btnReset" type="reset" value="Reset" style="" />
                            </div>

                        
                    </form>
                </div>
            </div>
            
        </div>
        <?php include_once $happiDoc.'templates/footer_template.php'; ?>
    </body>
</html>
