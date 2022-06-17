<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Protein Disease</title>

        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <!--[if !IE 7]>
        <style type="text/css">
                #container {display:table;height:100%}
        </style>
        <![endif]-->
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.dataTables.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#diseaseProteinTB').dataTable({
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "sPaginationType": "full_numbers"
                });
            });
        </script>
        <style type="text/css">
            #diseaseProteinTB{
                margin-bottom: 20px;
            }
            #diseaseProteinTB_wrapper{
                margin-left: 7%;
                margin-right: 5%;
            }
            #diseaseProteinTB td,th{
                text-align: left;
            }

        </style>
    </head>
    <body>
        <?php
        $happiDoc = include_once 'documents-location.php';
        include_once ('templates/header_template.php');
        ?>
        <div id="container">
            <div id="mainContentPages" >
                <?php
                include_once $happiDoc . 'classes/dbutility.php';
                $target_protein = $_GET['protein'];
                ?>
                <div id="titleDiv">
                    <h2>Disease List for Target protein - <i><?php echo $target_protein; ?></i></h2><br/>
                    <i style="padding-left: 30px; font-size: 14px;"><b>Note:</b> Please click on the Disease name to get more details.</i><br/><br/>
                    <br/>
                </div>
                <div>
                    <table id ="diseaseProteinTB" class='display' cellspacing="0" width="100%" >
                        <thead>
                            <tr>
                                <th>Disease Name</th>
                                <th>Protein Counts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $diseases = dbutility::get_DiseaseProtein_cnt($target_protein);

                            foreach ($diseases as $key) {
                                $disease = '';
                                $diseaseStr = $key[0];
                                $strpos = strpos($diseaseStr, '(');
                                if ($strpos > 0) {
                                    $disease = substr($diseaseStr, 0, $strpos - 1);
                                } else {
                                    $disease = $diseaseStr;
                                }
                                $protein_count = $key[1];
                                echo "<tr>"
                                . "<td><a href='diseaseProteins.php?dis=$diseaseStr' target=_blank>$disease</a></td>"
                                . "<td><a href='diseaseProteins.php?dis=$diseaseStr' target=_blank>$protein_count</a></td>"
                                . "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="spacer" style="height:30px;"></div>
        <?php include_once ('templates/footer_template.php'); ?>
    </body>
</html>
