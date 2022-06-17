<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="AUTHOR" content="Ragini pandey"/>
        <meta name="PUBLISHER" content="Ragini pandey"/>
        <meta name="description" content="Everything You need to know About human proteins, interactions, domains, functional annotations"/>
        <meta name="keywords" content="Bioinformatics, Jake Chen, Systems Biology, Proteomics, Protein Interactomics,Domains"/>
        <title>HAPPI</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.dataTables.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#basicSearchTb').dataTable({
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "scrollX": true,
                    "scrollY": "900px",
                    "scrollCollapse": true,
                    "sPaginationType": "full_numbers",
                    "aoColumns": [
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null},
                        null
                    ]
                });
            });

        </script>
        <style type="text/css">
            #basicSearchTb{
                width: 90%;
                margin-bottom: 20px;
            }
            #basicSearchTb{
                width: 90%;
                margin-left: 20px;
            }
            #basicSearchTb td{
                text-align: left;
            }
        </style>

    </head>
    <body>
        <?php
        $happiDoc = include_once 'documents-location.php';
        include_once $happiDoc . 'templates/header_template.php';
        include_once $happiDoc . 'classes/dbutility.php';
        $srchTerm = '';
        if ((isset($_POST['searchProtein'])) || (isset($_GET['srcprotein']))) {
            if (isset($_GET['srcprotein'])) {
                $srchTerm = $_GET['srcprotein'];
            } else {
                $srchTerm = $_POST['searchProtein'];
            }
            $_SESSION['searchProteinList'] = $srchTerm;
        }
        $term_srcArry = dbutility::srch_term_map_counts($srchTerm);
        ?>
        <div id="container">
            <div id="mainContentPages" style="font-size: 0.8em">
                <div id="titleDiv">
                    <h1> Searched Term : &nbsp;&nbsp;</h1>
                    <p style="padding-left:15px;">
                        <b style="font-size: 18px;"><?php echo $srchTerm; ?></b><br/><br/><br/><br/>
                        <b style="font-size: 16px;">Proteins retrieved:</b>
                    </p>
                </div>
                <div style="margin:30px; font-size: 14px;">
                    <?php
                    $protein = $term_srcArry[0][0];
                    $gene = $term_srcArry[1][0];
                    $keyword = $term_srcArry[2][0];
                    ?>
                    <p><?php
                        if ($protein == 0) {
                            echo "By matched protein name : &nbsp;&nbsp;&nbsp;&nbsp;( <b>" . $protein . "</b> )<br/><br/>";
                        } else {
                            ?>
                            By matched protein name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( &nbsp;<b><a href="searchtermlist.php?getproteinlist=<?php echo $srchTerm; ?>" ><?php echo $protein; ?></a></b> &nbsp; )&nbsp;<br/><br/>
                            <?php
                        }
                        if ($gene == 0) {
                            echo "By matched gene symbol : &nbsp;&nbsp;&nbsp;&nbsp;( <b>" . $gene . "</b> )<br/><br/>";
                        } else {
                            ?>
                            By matched gene symbol : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( &nbsp;<b><a href="searchtermlist.php?getgenelist=<?php echo $srchTerm; ?>" ><?php echo $gene; ?></a> </b>&nbsp; )&nbsp;<br/><br/>
                            <?php
                        }
                        if ($keyword == 0) {
                            echo "By matched Protein Description : &nbsp;&nbsp;&nbsp;&nbsp;( <b>" . $keyword . "</b> )<br/><br/>";
                        } else {
                            ?>
                            By matched Protein Description : &nbsp;&nbsp;( &nbsp;<b><a href="searchtermlist.php?getwordlist=<?php echo $srchTerm; ?>" ><?php echo $keyword; ?></a></b> &nbsp; )&nbsp; <br/><br/>
                        <?php } ?>
                    </p>
                </div>
            </div><!-- End mainContentPages -->
            <br/>
        </div><!-- End Container -->
        <?php include_once $happiDoc . 'templates/footer_template.php'; ?>
    </body>
</html>