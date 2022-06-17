<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Family Proteins</title>
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
            $(document).ready(function(){
                $('#familyProteinTB').dataTable( {
                    //"bJQueryUI": true,
                    "bDestroy":true,
                    "bProcessing":true,
                    "iDisplayLength": 25,
                    "sPaginationType": "full_numbers"
                } );
                
            });
        </script>
        <style type="text/css">
            
            #familyProteinTB{
                //width: 650px;
                margin-bottom: 20px;
            }
            #familyProteinTB_wrapper{
                //width: 650px;
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
                    $familyStr = $_GET['pfamily'];
                    $familyStrAry=  explode(';', $familyStr);
                    $familyId=$familyStrAry[0];
                    $family=$familyStrAry[1];
                    //echo "id :".$familyStr[0]." name:".$familyStr[1];
                ?>
                <div id="titleDiv">
                    <h2>Proteins Involved in the family - <i><?php echo $family;?></i></h2><br/>
                    <i style="padding-left: 30px;"><b>Note:</b> Please click on the Uniprot Ids to get more details about the protein.</i><br/>
                    <br/>
                </div>
                
                    <table id ="familyProteinTB" class='display' cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Uniprot Id</th>
                                <th>Full Name</th>
                                <th>Gene Name</th>
                                <th>Interactions Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $familyProteins=dbutility::getPfamFamilyProteins($familyId);
                            foreach($familyProteins as $key){
                                $uniprot_id=$key[0];
                                $fullname=$key[1];
                                $genename='';
                                $count=0;
                                $highcount=0;
                                if(array_key_exists(2, $key)){
                                    $genename=$key[2];
                                }else{
                                    $genename='';
                                }
                                if(array_key_exists(3, $key)){
                                    $count=$key[3];
                                }else{
                                    $count=0;
                                }
                                if(array_key_exists(4, $key)){
                                    $highcount=$key[4];
                                }else{
                                    $highcount=0;
                                }
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
                                    <td>
                                        <?php echo "<a href='searchResults.php?srcprotein=$uniprot_id' target='_blank'>$highcount</a> (". $count. " )";?>
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
