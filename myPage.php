<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>My Account</title>

        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        
         
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.bgiframe-2.1.2.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.mouse.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.button.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.draggable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.tabs.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.position.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.resizable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.effects.core.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.validate.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/flexigrid.js"></script>
         
        
        <script type="text/javascript">
            $(function() {

                $('#myAccounttabs').each(function() {
                    $(this).tabs();
                });
//                $('#saveInter').click(function(){
//                    $('input[id^="chk"]:checked').each(function(){
//                        alert("value = " + $(this).attr('id'));
//                    });
//                });

            });
        </script>
    </head>
    <body>
        <?php          
            $happiDoc=include_once 'documents-location.php';

            include_once $happiDoc.'templates/header_template.php';
            //if(!isset($_SESSION)){
            if(!session_id()) {
                    session_start();
            }
            $userEmail=$_SESSION['userEmail'];
            $first_name = $_SESSION['fname'];
            $userId=$_SESSION['userId'];
            $logged=$_SESSION['logged'];
        ?>
        <div id="container">
            <div id="mainContentPages" >
                <div id="titleDiv">
                <h4>Hello <?php echo $first_name;?></h4>
                </div>
                <div id="myAccounttabs" >
                        <ul>
                            <li><a href="subpages/account-details.php">Account Details</a></li>
                            <li><a href="subpages/reset-password.php">Reset Password</a></li>
                            <li><a href="subpages/my-lists.php" >My Lists</a></li>
                            <li><a href="subpages/downloadhappi.php" >Data Download</a></li>
                         </ul>
                  </div><!-- End mytabs -->
            </div>
        </div>
        <?php include_once $happiDoc.'templates/footer_template.php'; ?>
    </body>
</html>
