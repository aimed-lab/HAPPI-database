<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Drugs</title>

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
                $('#drugProteinTB').dataTable({
                    //"bJQueryUI": true,
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "sPaginationType": "full_numbers"
                });
            });
        </script>
        <style type="text/css">
            #drugProteinTB{
                margin-bottom: 20px;
            }
            #drugProteinTB_wrapper{
                margin-left: 7%;
                margin-right: 5%;
            }
            #drugProteinTB td,th{
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
                    <h2>Druglist for Target protein - <i><?php echo $target_protein; ?></i></h2><br/>
                    <i style="padding-left: 30px; font-size: 14px;"><b>Note:</b> Please click on the Drug name to get more details.</i><br/><br/>
                    <br/>
                </div>
                <div>
                    <table id ="drugProteinTB" class='display' cellspacing="0" width="100%" >
                        <thead>
                            <tr>
                                <th>Drug Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $drugProteins = dbutility::getProteinDrugList($target_protein);
                            $generic_name = '';
                            $desc = '';
                            $category = '';
                            $type = '';
                            $id = '';
                            foreach ($drugProteins as $key) {
                                $generic_name = $key[0];
                                if (array_key_exists(1, $key)) {
                                    $desc = $key[1];
                                } else {
                                    $desc = '';
                                }

                                if (array_key_exists(2, $key)) {
                                    $category = $key[2];
                                } else {
                                    $category = '';
                                }
                                if (array_key_exists(3, $key)) {
                                    $type = $key[3];
                                } else {
                                    $type = '';
                                }
                                $id = $key[4];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo "<a href='http://drugbank.ca/drugs/$id' target='_blank'>" . $generic_name . "</a>" ?>
                                    </td>
                                    <td>
                                        <?php echo $desc; ?>
                                    </td>
                                    <td>
                                        <?php echo $category; ?>
                                    </td>
                                    <td>
                                        <?php echo $type; ?>
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
