<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Human Protein Interactions</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <!--[if !IE 7]>
        <style type="text/css">
                #container {display:table;height:100%}
        </style>
        <![endif]-->
        <link href="stylesheets/diQuery-collapsiblePanel.css" rel="stylesheet"/>
        <link href="stylesheets/visualize.css" rel="stylesheet"/>

        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
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
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/diQuery-collapsiblePanel.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/visualize.jQuery.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.busy.min.js" ></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/dataTables.tableTools.min.js"></script>

        <style type="text/css">
            //body { font-size: 90%; }
            //label, input { display:block; }
            input.text { margin-bottom:12px; width:95%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:25px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            div#users-contain { width: 350px; margin: 20px 0; }
            div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
            div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
            .ui-dialog .ui-state-error { padding: .3em; }
            .validateTips { border: 1px solid transparent; padding: 0.3em; }

        </style>
        <script type="text/javascript">
            $(function() {
                $(".collapsibleContainer").collapsiblePanel();
                $('div[id^="mytabs"]').each(function() {
                    $(this).tabs();
                });
                $("#retInter").click(function() {
                    $('#notep').html("You may click on any of the protein ids to explore protein annotation information.<br/>Checked interactions could be saved in a list.<br/>Retrieved Interaction Stats could be viewed on respective tab.");
                });
                $("#statInter").click(function() {
                    $('#notep').html("*&nbsp;Medium-to-high quality rating data count (all-quality rating data count)");

                });
                $('#notep').html("You may click on any of the protein ids to explore protein annotation information.<br/>Checked interactions could be saved in a list.<br/>Retrieved Interaction Stats could be viewed on respective tab.");

            });
        </script> 
    </head>
    <body>
        <?php
        $happiDoc = include_once 'documents-location.php';
        include_once $happiDoc . 'templates/header_template.php';
        if (isset($_SESSION['userId'])) {
            $uid = $_SESSION['userId'];
        } else {
            $uid = '';
        }
        if (isset($_SESSION['logged'])) {
            $logged = $_SESSION['logged'];
        } else {
            $logged = 'False';
        }
        // Process Input id
        include_once $happiDoc . 'classes/dbutility.php';
        include_once $happiDoc . 'classes/utility.php';

        $interaction_srcArry = array();
        $proteinList = array();
        if ((isset($_POST['searchProtein'])) || (isset($_GET['srcprotein']))) {
            if (isset($_GET['srcprotein'])) {
                $searchProteinList = $_GET['srcprotein'];
            } else {
                $searchProteinList = $_POST['searchProtein'];
            }
            $searchProteinList = strtoupper(chop($searchProteinList));
            if (utility::checkDelimit($searchProteinList)) {
                $searchProteinList = utility::replaceDelimiter($searchProteinList);
                $interaction_srcArry = array_filter(explode(',', $searchProteinList));
            } else 
            {
                array_push($interaction_srcArry, $searchProteinList);
            }
            $interaction_srcArry = dbutility::map_gene_protein($interaction_srcArry);
            $searchedList = implode(',', $interaction_srcArry);
            $_SESSION['searchProteinList'] = $interaction_srcArry;
    ?>
            <div style="float:left; margin-top: 10%; padding-left: 10px; width:12%; border: 2px; border-color: black;">
                <h1>Note:</h1>
                <hr size="2" width="50" align="left" noshade="noshade"/>
                <p style="padding-left: 2px; text-align:left; font-size:13px;" id="notep">
                </p>
            </div>
            <div id="container">
                <div id="mainContentPages" style="font-size: 0.8em">
                    <div id="titleDiv">
                        <h4 style="font-size:18px;">Query Protein: <?php echo $searchProteinList; ?></h4><br/>
                        <h2>HAPPI Retrieved Interactions</h2>
                    </div>
                    <div id="logstatusDiv"></div>

                    <div id="tabsContainer">
                        <div id="mytabs">
                            <ul>
                                <li><a href="subpages/searchResult-interactions.php?srcprotein=<?php echo $searchedList ?>" id="retInter">Retrieved Interactions</a></li>
                                <li><a href="subpages/interaction_stats.php?srcprotein=<?php echo $searchedList; ?>" id="statInter">Interacting Protein Stats</a></li>
                            </ul>
                        </div><!-- End mytabs -->

                        <div style="padding:5px;"></div>
                        <?php
                            }
                            $_SESSION['searchInteractionList'] = $proteinList;
                        ?>
                </div>
            </div><!-- End mainContentPages -->
            <br/>
        </div><!-- End Container -->
        <?php include_once $happiDoc . 'templates/footer_template.php'; ?>
    </body>
</html>
