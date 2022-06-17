<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Family Proteins</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/css/demo_table.css" rel="stylesheet" type="text/css" />
        <link href="jquery/css/demo_table_jui.css" rel="stylesheet" type="text/css" />
        <link href="jquery/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <!--[if !IE 7]>
        <style type="text/css">
		#container {display:table;height:100%}
	</style>
    <![endif]-->
        <script src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script src="jquery/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function(){
                $('#familyProteinTB').dataTable( {
                    "bJQueryUI": true,
                    "bDestroy":true,
                    "bProcessing":true,
                    "iDisplayLength": 25,
                    "sPaginationType": "full_numbers"
                } );
                
            });
        </script>
        <style>
            
            #familyProteinTB{
                width: 650px;
                margin-bottom: 20px;
            }
            #familyProteinTB_wrapper{
                width: 650px;
                margin-left: 7%;
                margin-right: 5%;
            }
            #familyProteinTB td,th{
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
                    $family = $_GET['pfamily'];
                ?>
                <div id="titleDiv">
                    <h2>Proteins Involved in the family - <i><?php echo $family;?></i></h2>
                    <i>Note: Please click on the Uniprot Ids to get more details about the protein.</i><br/>
                    <br/>
                </div>
                    <table id ="familyProteinTB" class='display' cellspacing="0">
                        <thead>
                            <tr>
                                <th>Uniprot Id</th>
                                <th>Full Name</th>
                                <th>Gene Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $familyProteinsInteractions=dbutility::getPfamFamilyProtInteractions($family);
                            foreach($familyProteinsInteractions as $key){
                                $uniprot_a=$key[0];
                                $uniprot_b=$key[1];
                                $h_score=$key[2];
                                //echo $hpdName."<br/>";

                            ?>
                                <tr>
                                    <td>
                                        <?php echo "<a href='protein-description.php?protein=$uniprot_a'>$uniprot_a</a>";?>
                                    </td>
                                    <td>
                                        <?php echo $uniprot_b;?>
                                    </td>
                                    <td>
                                        <?php echo $h_score;?>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    </div>
                    
                

            </div>
        
        <div id="spacer" style="height:30px;"></div>
        <?php include_once ('templates/footer_template.php'); ?>
    </body>
</html>
