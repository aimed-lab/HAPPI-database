<?php
if (!isset($_SESSION)) {
    session_start();
}
$idSelect = '';
$idText = '';
$rankSelect = '';
$minscore = '';
$maxscore = '';
$type = '';

$happiDoc = include_once 'documents-location.php';
include_once $happiDoc . 'classes/dbutility.php';

$interactionFile = $happiDoc . "downloadFiles/all-searched-happi-interactions.txt";
$interactionStr = "Protein a\tProtein b\tConfidence\tDirectionality". PHP_EOL;
$psiFile = $happiDoc . "downloadFiles/all-searched-happi-psi.xml";

if ((isset($_POST['ddIdSelect'])) || (isset($_GET['ddIdSelect']))) {
    if (isset($_GET['ddIdSelect'])) {
        $idSelect = $_GET['ddIdSelect'];
    } else {
        $idSelect = $_POST['ddIdSelect'];
    }
}
if ((isset($_POST['idText'])) || (isset($_GET['idText']))) {
    if (isset($_GET['idText'])) {
        $idText = $_GET['idText'];
    } else {
        $idText = $_POST['idText'];
    }
}
if ((isset($_POST['rankSelect'])) || (isset($_GET['rankSelect']))) {
    if (isset($_GET['rankSelect'])) {
        $rankSelect = $_GET['rankSelect'];
    } else {
        $rankSelect = $_POST['rankSelect'];
    }
}

function trim_all($str, $what = NULL, $with = '') {
    if ($what === NULL) {
//  Character      Decimal      Use
//  "\0"            0           Null Character
//  "\t"            9           Tab
//  "\n"           10           New line
//  "\x0B"         11           Vertical Tab
//  "\r"           13           New Line in Mac
        //  " "            32           Space
//$what   = "\\x00-\\x20";    //all white-spaces and control chars
        $what = " ";
    }
//return trim( preg_replace( "/[".$what."]+/" , $with , $str ) , $what );
    $value = preg_replace('/\s+/', '|', $str);
//     $value = preg_replace('/\s+/', '', $str);
    return $value;
}
// $idText = trim_all($idText);
// $idtextarray=explode('|', $idText);
// $idText = str_replace(';', ',', $idText);
// $idText = str_replace("\t", ',', $idText);
// $idText = str_replace(' ', ',', $idText);
// $idText = trim_all($idText);
// $idtextarray=explode('|', $idText);





if ((isset($_POST['inter'])) || (isset($_GET['inter']))) {
    if (isset($_GET['inter'])) {
        $type = $_GET['inter'];
    } else {
        $type = $_POST['inter'];
    }
}
// Where the file is going to be placed 
$target_path = "upload/";
$filename = '';
$filestr = '';

/* Add the original filename to our target path.  
  Result is "uploads/filename.extension" */
if ($_FILES) {
    $filename = basename($_FILES['file']['name']);
    if ($filename != '') {
        $target_path = $target_path . $filename;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            $idText = file_get_contents($target_path, true);
			
        } else {
            echo "There was an error uploading the file, please try again!";
        }
    }
}

$idText = trim_all($idText);
$idtextarray=explode('|', $idText);

//$interactions = dbutility::geAdvInteraction($idSelect, $idtextarray, $rankSelect, $type);
 $interactions = dbutility::geAdvInteraction($idSelect, $idText, $rankSelect, $type);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Advanced Search</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />
        <!--[if !IE 7]>
            <style type="text/css">
                    #container {display:table;height:100%}
            </style>
        <![endif]-->
        <link href="jquery/development-bundle/themes/blitzer/jquery.ui.all.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript"  src="jquery/jquery-ui-1.9.2/js/jquery.bgiframe-2.1.2.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.mouse.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.button.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.draggable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.position.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.resizable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.effects.core.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/dataTables.tableTools.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#busy').hide(); //initially hide the loading icon
 
                $('#busy').ajaxStart(function(){
                    $(this).show();
                });
                $("#busy").ajaxStop(function(){
                    $(this).hide();
                }); 
                
                $('#advSearchedInteractionTb').dataTable({
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "scrollCollapse": true,
                    "sPaginationType": "full_numbers",
                    dom: 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "jquery/jquery-ui-1.9.2/js/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            {
                                "sExtends": "csv",
                                "sButtonText": "Download",
                                "mColumns": [0, 1, 2,3,4,5]
                            }
                        ]
                    },
                    "aoColumns": [
                        {"bSortable": null},
                        null,
                        null,
                        null,
                        null,
                        null
                    ]
                });
            });
        </script>
    </head>
    <body>
        <?php include_once 'templates/header_template.php'; ?>
        <div id="container">
            <div id="mainContentPages" >
                <div id="titleDiv">
                    <h2>Advanced Search</h2>
                    <i style="font-size: 12px;">Only 4000 or less interactions will be retrieved due to display limitations. Please use the download link to get bulk data.</i>
                </div>
                <center><div id="busy"><img src="images/loading.gif" alt="loading"/></div></center>
                <div>
                    <table id="advSearchedInteractionTb" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr style='text-align:left;'>
                                <th>Protein A</th>
                                <th>Protein B</th>
                                <th>Rank</th>
                                <th>Data Source</th>
                                <th style="width:35px;">Known Type</th>
                                <th style="width:35px;">Effect</th>
								<th style="width: 10px;">directionality</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                foreach ($interactions as $inter) {
                                    $proteinA = $inter[0];
                                    $proteinB = $inter[1];
                                    $star = trim($inter[3]);
                                    $datasrc = '';
									$flag = 'u';
									$pubmedList = array();

                                    if (array_key_exists(2, $inter)) {
                                        $datasrc = $inter[2];
                                        $datasrc = str_replace('|', ', ', $datasrc);
                                        $datasrc = str_replace('hap1', 'HAPPI1', $datasrc);
                                        $datasrc = str_replace('HAPPI1_eSTR', 'HAPPI1', $datasrc);
                                        $datasrc = str_replace('HAPPI1_pSTR', 'HAPPI1', $datasrc);
                                    } else {
                                        $datasrc = 'null';
                                    }
                                    if (array_key_exists(4, $inter)) {
                                        $mode = $inter[4];
                                    } else {
                                        $mode = 'association';
                                    }
                                    if (array_key_exists(5, $inter)) {
                                        $action = $inter[5];
                                    } else {
                                        $action = 'unknown';
                                    }
									if (array_key_exists ( 7, $inter )) {
										$flag = $inter [7];
									} else {
										$flag = 0;
									}
									if (array_key_exists ( 8, $inter )) {
										$pubmedString = $inter [8];
										$pubmedList = explode( ',', $pubmedString );
										
										$pIndex = 0;
		
										foreach ( $pubmedList as $pid ) {
										$pIndex = $pIndex + 1;
										$datasrc = $datasrc . ", <a href = 'http://www.ncbi.nlm.nih.gov/pubmed/" . $pid [0] . "'>Pubmed " . $pIndex . "</a>";
										// $datasrc = $datasrc.", ".$pid[0];
										;
										}
									}
									$directionStr = '?';
									if ($flag == 'a') {
										$directionStr = '->';
									} else if ($flag == 'b') {
										$directionStr = '<-';
									} else if ($flag == 'ab') {
										$directionStr = '<->';
									}
									$interactionStr = $interactionStr . $proteinA . "\t" . $proteinB . "\t" .$star."\t". $directionStr . PHP_EOL;									
                                    //fwrite($fp,"$proteinA\t$proteinB\n");
                                    ?>
                                <tr>
                                    <td><?php echo "<a href='protein-description.php?protein=$proteinA'>$proteinA</a>"; ?></td>
                                    <td><?php echo "<a href='protein-description.php?protein=$proteinB'>$proteinB</a>"; ?></td>
                                    <td>
                                        <?php
                                        if ($star == '5_STAR') {
                                            echo "<img src='images/stars5-5.png' alt='5-star' width='45px'/>";
                                        } else if ($star == '4_STAR') {
                                            echo "<img src='images/stars4-5.png' alt='4-star' width='45px' />";
                                        } else if ($star == '3_STAR') {
                                            echo "<img src='images/stars3-5.png' alt='3-star' width='45px'/>";
                                        } else if ($star == '2_STAR') {
                                            echo "<img src='images/stars2-5.png' alt='2-star' width='45px'/>";
                                        } else if ($star == '3_STAR') {
                                            echo "<img src='images/stars1-5.png' alt='1-star' width='45px'/>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $datasrc; ?></td>
                                    <td><?php echo $mode; ?></td>
                                    <td><?php echo $action; ?></td>
									<td>
										<?php
		
											if ($flag == 'a') {
												echo "<img src='images/a.png' alt='a' width='22px'/>";
											} else if ($flag == 'b') {
												echo "<img src='images/b.png' alt='b' width='22px'/>";
											} else if ($flag == 'ab') {
												echo "<img src='images/ab.png' alt='ab' width='22px'/>";
											} else if ($flag == 'u') {
												echo "<img src='images/u.png' alt='u' width='22px'/>";
											}
									?></td>
                                </tr>
                                        <?php
                                    }
									utility::writeInteractionFile ( $interactionFile, $interactionStr, $psiFile );
                                    ?>
                        </tbody>
                    </table>
					<p>
						<span> <?php
						if ($logged) {
							echo "<input type='image' id='saveInterTrue' src='images/savetoaccount.png' style='float:left' width='50' height='50' alt='Save to Account' title='Save to Account'/>";
						} else {
							echo "<input type='image' id='saveInterFalse' src='images/savetoaccount.png' style='float:left' width='50' height='50' alt='Save to Account' title='Save to Account'/>";
						}
						?> 
						</span> &nbsp;&nbsp; <span> <a
							href="subpages/download.php?download_file=all-searched-happi-interactions.txt"><img
							src="images/download.png" alt="Download PPI" height="50" width="50"
							style="float: left" title="Download PPI Table"></a>
						</span>
					</p>
                </div>
            </div>
        </div>
        <?php include_once 'templates/footer_template.php'; ?>
    </body>
</html>