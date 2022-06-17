<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Browse</title>
        
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.treeview.css" rel="stylesheet" type="text/css" />
         <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <!--[if !IE 7]>
        <style type="text/css">
		#container {display:table;height:100%}
	</style>
        <![endif]-->
       
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript"  src="jquery/jquery-ui-1.9.2/js/jquery.bgiframe-2.1.2.js"></script>
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

        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/diQuery-collapsiblePanel.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/visualize.jQuery.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.busy.min.js" ></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.treeview.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#busy').hide(); //initially hide the loading icon
 
                $('#busy').ajaxStart(function(){
                    $(this).show();
                });
                $("#busy").ajaxStop(function(){
                    $(this).hide();
                }); 
                $('#mybrowsetabs').each(function() {
                    $(this).tabs({
                        "activate": function(event, ui) {
                            $( $.fn.dataTable.tables( true ) ).DataTable().columns.adjust();
                        }
                    });
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
            <div id="mainContentPages" style="font-size: 0.8em">
                <div id="titleDiv">
                    <h2>Browse Proteins</h2>
                    <i style="font-size: 13px; padding-left: 20px;">All the HAPPI database proteins could be browsed based on the following categories.</i><br/>
                    
                    <center><div id="busy"><img src="images/loading.gif" alt="loading"/></div></center>
                </div>
                <div id="mybrowsetabs">
                    <ul>
                        <li><a href="subpages/browseFamilies.php">By Protein Family</a></li>
                        <li><a href="subpages/browseDisease.php">By Disease</a></li>
                    </ul>

                </div><!-- End mytabs -->
            </div>
        </div>
        <div id="spacer" style="height:30px;"></div>
         <?php include_once $happiDoc.'templates/footer_template.php'; ?>

    </body>
</html>
