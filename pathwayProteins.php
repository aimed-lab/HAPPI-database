<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Pathway Proteins</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/css/demo_table.css" rel="stylesheet" type="text/css" />
        <link href="jquery/css/demo_table_jui.css" rel="stylesheet" type="text/css" />
        <link href="jquery/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <!--[if !IE 7]>
        <style type="text/css">
		#container {display:table;height:100%}
	</style>
    <![endif]-->
        <script src="jquery/js/jquery-1.4.4.min.js"></script>
        <script src="jquery/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function(){
                $('#pathProteinTB').dataTable( {
                    "bJQueryUI": true,
                    "bDestroy":true,
                    "bProcessing":true,
                    "iDisplayLength": 25,
                    "sPaginationType": "full_numbers"
                } );
            });
        </script>
        <style>
            #pathProteinTB{
                width: 650px;
                margin-bottom: 20px;
            }
            #pathProteinTB_wrapper{
                width: 650px;
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
        $happiDoc=include_once 'documents-location.php';
        include_once ('templates/header_template.php');
            ?>
        <div id="container">

            <div id="mainContentPages" >
                <?php
                    include_once $happiDoc.'classes/dbutility.php';
                    $pathId = $_GET['path'];
                    //echo "Protein Description".$protein;
                    //$pathProteins=dbutility::getHPDPathwayProteins($pathId);

                    //echo $pathId."<br/>";
                    $pathName=dbutility::getHPDPathwayName($pathId);
                ?>
                <div id="titleDiv">
                    <h2>Proteins Involved in pathway - <i><?php echo $pathName;?></i></h2>
                    <i>Note: Please click on the Uniprot Ids to get more details about the protein.</i><br/>
                    <br/>
                </div>
                <div>
                    <table id ="pathProteinTB">
                        <thead>
                            <tr>
                                <th>Uniprot Id</th>
                                <th>Full Name</th>
                                <th>Gene Name</th>
                            </tr>                        
                        </thead>
                        <tbody>
                            <?php
                             $pathProteins=dbutility::getHPDPathwayProteins($pathId);
                            foreach($pathProteins as $key){
                                $uniprot_id=$key[0];
                                $fullname=$key[1];
                                $genename=$key[2];
                                //echo $hpdName."<br/>";

                            ?>
                                <tr>
                                    <td>
                                        <?php echo "<a href='protein-description.php?protein=$uniprot_id'>$uniprot_id</a>";?>
                                    </td>
                                    <td>
                                        <?php echo $fullname;?>
                                    </td>
                                    <td>
                                        <?php echo $genename;?>
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
