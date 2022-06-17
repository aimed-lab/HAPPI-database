<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Retrieve Credentials</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
         <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
    </head>
    <body>
        <?php include_once 'templates/header_template.php'; ?>
        <div id="container">            
            <div id="mainContentPages" >               
                 <h2>Retrieve Password</h2>
                <form id="rPasswordForm" name="rPasswordForm" action="mail-password.php" method="POST">
                    <center>
                        <div style="width: 300px; margin: 40px;">
                            <i>Please enter your registered email id</i>
                            <br/><br/><br/>
                            <label for='rEmail'>Email:</label>
                            <input type="text" id="rEmail" name="rEmail" class="textbox" />
                            <br/><br/>
                            <input id="rPassBtn" type="submit" value="Submit" class="button"/>
                        </div>
                    </center>

                </form>
            </div>
            
        </div>
        <?php include_once 'templates/footer_template.php'; ?>
    </body>
</html>

