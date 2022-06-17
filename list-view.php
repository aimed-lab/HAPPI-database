<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Human Protein Interactions</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />

        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.dataTables.js"></script>
        
         <!--[if !IE 7]>
            <style type="text/css">
                    #container {display:table;height:100%}
            </style>
        <![endif]-->
        <style type="text/css">
            .dataTables_wrapper {
                width:600px;
            }
            #listInteractionTb_wrapper .fg-toolbar
            {
                font-size: 0.8em;
            }
            #listInteractionTb_length
            {
                width:20%;
            }
        </style>
        <script type="text/javascript">


			$(document).ready( function() {

				$('#listInteractionTb').dataTable( {
					//"bJQueryUI": true,
					"sPaginationType": "full_numbers",
                                        "aoColumns": [
                                                    { "bSortable": null },
                                                    null,
                                                    false
                                        ]
				} );

			} );
		</script>

    </head>
    <body>
        <?php
        if(!isset($_SESSION)){
            session_start();
        }
        $happiDoc=include_once 'documents-location.php';

        include_once $happiDoc.'templates/header_template.php';
        include_once $happiDoc.'classes/dbutility.php';
        
        if(isset($_SESSION['userId'])){
            $uid=$_SESSION['userId'];
        }else{
            $uid='';
        }
        if(isset($_SESSION['logged'])){
            $logged=$_SESSION['logged'];
        }else{
            $logged='False';
        }

        if(isset($_GET['lname'])){
            $listName=$_GET['lname'];

            $listInteractions=dbutility::getListInteractions($uid, $listName);
        }
?>
        <div id="container">

                    <div id="mainContentPages" style="font-size: 0.8em">
                        <div id="titleDiv">
                            <h2>List Details of <i><?php echo $listName; ?></i></h2>
                        </div>
                        <div style="padding-left:20px; padding-top: 30px;">
                            <table id="listInteractionTb" class='display' cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ProteinA</th>
                                        <th>ProteinB</th>
                                        <th>H_score</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($listInteractions as $interactors){
                                            $proteinA=$interactors[0];
                                            $proteinB=$interactors[1];
                                            $hscore=$interactors[2];
                                            echo "
                                                <tr>
                                                    <td>$proteinA</td>
                                                    <td>$proteinB</td>
                                                    <td>$hscore</td>
                                                </tr>
                                                ";
                                        }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
        </div>
        <?php include_once $happiDoc.'templates/footer_template.php'; ?>
    </body>
</html>