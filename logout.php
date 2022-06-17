<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Logout</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />

        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
    </head>
    <body>
         <?php include_once 'templates/header_template.php'; ?>
        <div id="container">
           
            <div id="mainContentPages" >
                <?php
                    
                //if(!$_POST){
                    //header ("Location: userSignIn.php");
                //}else
                
                    if($_SESSION['logged']==true){
                        $_SESSION['logged']=false;
                        echo "<center><b><font-size = '16'>You are successfully logged out.</font-size></b></center>";
                        header ("Location: index.php");
                        //echo "<a href=\"javascript:location.reload(true)\">";
                    }else{
                        header ("Location: index.php");
                    }
                        ?>
            </div>
            <?php include_once 'templates/footer_template.php'; ?>
        </div>
    </body>
</html>


