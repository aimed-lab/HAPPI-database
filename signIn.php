<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>User Login</title>
        
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.validate.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                //login form validation
                $("#frmLogin").validate({
                    rules:{password: "required"},
                    messages: {
                        password: "Password is required.",
                        loginEmail: "Login email is required."
                    }
                });

                //check user credentials on submit
                $("#frmLogin").submit(function() {
                    var uemail = $("#loginEmail").val();
                    var pwordval = $("#password").val();
                    //alert(uemail);
                    $.post("subpages/login.php", { userEmail:uemail, password:pwordval },
                    function(data) {
                        var str = $.trim(data);
						//alert(uemail);
                        //var lastStr= str.substr(0,4);
                        //alert(str);
                        //alert(lastStr);
                        if(str === "logged"){
                            document.location='myPage.php';
                        }else{
                            $("#messageDiv").html(data);
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
			//echo "Documents :".$happiDoc;
			//echo "  Document Root:-".$_SERVER['DOCUMENT_ROOT'];
			//echo " Server Root:-".$_SERVER['SERVER_ROOT']
        ?>
        <div id="container">
            <div id="mainContentPages" >
                <h2>Sign In</h2>
                <p>Signed in users can annotate interactions as well as create their own customized list of interactions!!</p>

                <center>
                    <div id="loginForm" >
                        <i>Remember the registered email is your Login Id.</i>
                        <br/><br/>
                        <form id="frmLogin" name="frmLogin" method="POST" action="" >
                            <div id="messageDiv"></div>
                            <div>
                            <br/><label for="loginId" style="width:20px;text-align: left;float:left;padding-top: 5px;">Email:</label>
                            <input id="loginEmail" name="loginEmail" type="text" class="textbox email required"/>

                            <br/><label for="password" style="width:20px;text-align: left; ;float:left;">Password:</label>
                            <input id="password" name="password" type="password" class="textbox required"/><br/><br/>
                            </div>
                            <input type="hidden" name="loginForm" value="1"/>

                            <div style="margin-top:10px; margin-left:109px;margin-bottom:30px;float: left;">
                                <input id="loginBtn" type="submit" value="Login"/>
                                <br/><br/>
                                <a href="retrieve-credentials.php" style="text-decoration:underline;font-size: 12px;">Forgot password</a>
                                <br/><br/>
                                <a href="register.php" style="text-decoration: underline;font-size: 12px;">Create a new account</a>
                            </div>
                        </form>
                    </div>
                </center>
            </div>
        </div>
        <?php include_once 'templates/footer_template.php'; ?>

    </body>
</html>
