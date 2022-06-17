<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Disease Proteins</title>

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
                $('#pathProteinTB').dataTable({
                    //"bJQueryUI": true,
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "sPaginationType": "full_numbers"
                });
            });
        </script>
        <style type="text/css">
            #pathProteinTB{
                margin-bottom: 20px;
            }
            #pathProteinTB_wrapper{
                margin-left: 7%;
                margin-right: 5%;
            }
            #pathProteinTB td,th{
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
                $diseaseStr = $_GET['dis'];
                $disease = '';
                $strpos = strpos($diseaseStr, '(');
                if ($strpos > 0) {
                    $disease = substr($diseaseStr, 0, $strpos - 1);
                } else {
                    $disease = $diseaseStr;
                }
                ?>
                <div id="titleDiv">
                    <h2>Proteins Involved in disease - <i><?php echo $diseaseStr; ?></i></h2><br/>
                    <i style="padding-left: 30px; font-size: 14px;"><b>Note:</b> Please click on the Uniprot Ids to get more details about the protein.</i><br/><br/>
                    <br/>
                </div>
                <div>
                    <table id ="pathProteinTB" class='display' cellspacing="0" width="100%" >
                        <thead>
                            <tr>
                                <th>Uniprot Id</th>
                                <th>Full Name</th>
                                <th>Gene Name</th>
                                <th>No. of Interactions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $diseaseProteins = dbutility::getOmimDiseaseProteinsNew($diseaseStr);
                            $fullname = '';
                            $genename = '';
                            foreach ($diseaseProteins as $key) {
                                $uniprot_id = $key[0];
                                if (array_key_exists(1, $key)) {
                                    $fullname = $key[1];
                                } else {
                                    $fullname = '';
                                }
                                if (array_key_exists(2, $key)) {
                                    $genename = $key[2];
                                } else {
                                    $genename = '';
                                }

                                $interaction_cnt = $key[3];
                                $highinter_cnt = $key[4];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo "<a href='protein-description.php?protein=$uniprot_id'>$uniprot_id</a>"; ?>
                                    </td>
                                    <td>
                                        <?php echo $fullname; ?>
                                    </td>
                                    <td>
                                        <?php echo $genename; ?>
                                    </td>
                                    <td>
                                        <?php echo "<a href='searchResults.php?srcprotein=$uniprot_id' target='_blank'>$highinter_cnt</a> (" . $interaction_cnt . " )"; ?>
                                    </td>
                                </tr>
                                <?php
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
