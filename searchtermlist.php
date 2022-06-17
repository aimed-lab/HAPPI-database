<?php
    if(!isset($_SESSION)){
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
                $('#exactTb').dataTable({
                    //"bJQueryUI": true,
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "scrollCollapse": true,
                    //"serverSide": true,
                    "sPaginationType": "full_numbers",
                    "aoColumns": [
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null}
                    ]
                });
                $('#nearTb').dataTable({
                    //"bJQueryUI": true,
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "scrollX": true,
                    "scrollCollapse": true,
                    //"serverSide": true,
                    "sPaginationType": "full_numbers",
                    "aoColumns": [
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null}
                    ]
                });
                $('#exactKeyTb').dataTable({
                    //"bJQueryUI": true,
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "scrollCollapse": true,
                    //"serverSide": true,
                    "sPaginationType": "full_numbers",
                    "aoColumns": [
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null}
                    ]
                });
                $('#nearKeyTb').dataTable({
                    //"bJQueryUI": true,
                    "bDestroy": true,
                    "bProcessing": true,
                    "iDisplayLength": 25,
                    "scrollX": true,
                    "scrollCollapse": true,
                    //"serverSide": true,
                    "sPaginationType": "full_numbers",
                    "aoColumns": [
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null},
                        {"bSortable": null}
                    ]
                });
            });
        </script>
        <style type="text/css">
            #nearTb{
                width: 80%;
                //margin-bottom: 20px;
            }
            #nearTb_wrapper{
                width: 80%;
                margin-left: 5%;
                margin-right: 5%;
            }
            #nearTb td,th{
                text-align: left;
            }
            #nearKeyTb{
                width: 80%;
            }
            #nearKeyTb_wrapper{
                width: 80%;
                margin-left: 5%;
                margin-right: 5%;
            }
            #nearKeyTb td,th{
                text-align: left;
            }
            #exactTb{
                width: 80%;
                min-height: 50px;
            }
            #exactTb_wrapper{
                width: 80%;
                margin-left: 5%;
                margin-right: 5%;
            }
            #exactTb td,th{
                text-align: left;
            }
            #exactKeyTb{
                width: 80%;
                min-height: 50px;
            }
            #exactKeyTb_wrapper{
                width: 80%;
                margin-left: 5%;
                margin-right: 5%;
            }
            #exactKeyTb td,th{
                text-align: left;
            }
        </style>
    </head>
    <body>
        <?php
        $happiDoc = include_once 'documents-location.php';
        include_once $happiDoc . 'templates/header_template.php';
        include_once $happiDoc . 'classes/dbutility.php';
        $srchProtein = '';
        $srchGene = '';
        $srchKeyword = '';
        if ((isset($_POST['getproteinlist'])) || (isset($_GET['getproteinlist']))) {

            if (isset($_GET['getproteinlist'])) {
                $srchProtein = $_GET['getproteinlist'];
                $termMatch_proteinArry = dbutility::srch_term_protein_match($srchProtein);
                $termLike_proteinArry = dbutility::srch_term_protein_like($srchProtein);
            } else {
                $srchProtein = $_POST['getproteinlist'];
                $termMatch_proteinArry = dbutility::srch_term_protein_match($srchProtein);
                $termLike_proteinArry = dbutility::srch_term_protein_like($srchProtein);
            }
        }
        if ((isset($_POST['getgenelist'])) || (isset($_GET['getgenelist']))) {

            if (isset($_GET['getgenelist'])) {
                $srchGene = $_GET['getgenelist'];
                $termMatch_geneArry = dbutility::srch_term_gene_match($srchGene);
                $termLike_geneArry = dbutility::srch_term_gene_like($srchGene);
            } else {
                $srchGene = $_POST['getgenelist'];
                $termMatch_geneArry = dbutility::srch_term_gene_match($srchGene);
                $termLike_geneArry = dbutility::srch_term_gene_like($srchGene);
            }
        }
        if ((isset($_POST['getwordlist'])) || (isset($_GET['getwordlist']))) {

            if (isset($_GET['getwordlist'])) {
                $srchKeyword = $_GET['getwordlist'];
                $termMatch_KeywordArry = dbutility::srch_term_Keyword_match($srchKeyword);
                $termLike_KeywordArry = dbutility::srch_term_Keyword_like($srchKeyword);
            } else {
                $srchKeyword = $_POST['getwordlist'];
                $termMatch_KeywordArry = dbutility::srch_term_Keyword_match($srchKeyword);
                $termLike_KeywordArry = dbutility::srch_term_Keyword_like($srchKeyword);
            }
        }
        ?>
        <div id="container">
            <div id="mainContentPages" style="font-size: 0.8em">
                <div id="titleDiv">
                    <h2> Search Term : &nbsp;&nbsp;
                        <?php
                        if ($srchProtein != '') {
                            echo $srchProtein;
                        } elseif ($srchGene != '') {
                            echo $srchGene;
                        } elseif ($srchKeyword != '') {
                            echo $srchKeyword;
                        }
                        ?>
                    </h2><br/>
                </div>
                <p style="font-size: 14px; color:blue;"><b style="padding-left:22px;">Exact Match:</b><br/><br/>
                    <?php
                    if ($srchProtein != '') {
                        $cnt = count($termMatch_proteinArry);
                        if ($cnt == 0) {
                            echo "<p> No Exact Match found. </p>";
                        } else {
                            echo "<table id='exactTb' class='display' cellspacing='0' >"
                            . "<thead><tr>"
                            . "<td>Uniprot Name</td>"
                            . "<td>Gene Name</td>"
                            . "<td> Acession Id</td>"
                            . "<td>Protein Recommended Full Name</td></tr>"
                            . "</thead><tbody>";
                            foreach ($termMatch_proteinArry as $protein) {
                                $genename = '';
                                $accession = '';
                                $desc='';
                                if (array_key_exists(1, $protein)) {
                                    $genename = $protein[1];
                                } else {
                                    $genename = '';
                                }
                                if (array_key_exists(2, $protein)) {
                                    $accession = $protein[2];
                                } else {
                                    $accession = '';
                                }
                                if (array_key_exists(2, $protein)) {
                                    $desc = $protein[3];
                                } else {
                                    $desc = '';
                                }
                                echo "<tr>"
                                . "<td>";
                                echo "<a href='searchResults.php?srcprotein=$protein[0]'>" . $protein[0] . "</a>"
                                . "</td>"
                                . "<td>" . $genename . "</td>"
                                . "<td>" . $accession . "</td>"
                                . "<td>" . $desc . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                    } elseif ($srchGene != '') {
                        $cnt = count($termMatch_geneArry);
                        if ($cnt == 0) {
                            echo "<p> No Exact Match found. </p>";
                        } else {
                            echo "<table id='exactTb' class='display' cellspacing='0' ><thead><tr>"
                            . "<td>Uniprot Name</td>"
                            . "<td>Gene Name</td>"
                            . "<td>Accession Id</td>"
                            . "<td>Protein Recommended Full Name</td></tr>"
                            . "</thead><tbody>";
                            foreach ($termMatch_geneArry as $gene) {
                                $genename = '';
                                $accession = '';
                                $desc='';
                                        
                                if (array_key_exists(1, $gene)) {
                                    $genename = $gene[1];
                                } else {
                                    $genename = '';
                                }
                                if (array_key_exists(2, $gene)) {
                                    $accession = $gene[2];
                                } else {
                                    $accession = '';
                                }
                                if (array_key_exists(2, $gene)) {
                                    $desc = $gene[3];
                                } else {
                                    $desc = '';
                                }
                                echo "<tr>"
                                . "<td>";
                                echo "<a href='searchResults.php?srcprotein=$gene[0]'>" . $gene[0] . "</a>"
                                . "</td>"
                                . "<td>" . $genename . "</td>"
                                . "<td>" . $accession . "</td>"
                                . "<td>" . $desc . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                    } elseif ($srchKeyword != '') {
                        $cnt = count($termMatch_KeywordArry);
                        if ($cnt == 0) {
                            echo "<p> No Exact Match found. </p>";
                        } else {
                            echo "<table id='exactKeyTb' class='display' cellspacing='0' ><thead><tr>"
                            . "<td>Uniprot Name</td>"
                            . "<td>Gene Name</td>"
                            . "<td>Accession Id</td>"
                            . "<td>Protein Recommended Full Name</td></tr>"
                            . "</thead><tbody>";
                            foreach ($termMatch_KeywordArry as $keyword) {
                                $genename = '';
                                $accession = '';
                                $desc='';
                                if (array_key_exists(1, $keyword)) {
                                    $genename = $keyword[1];
                                } else {
                                    $genename = '';
                                }
                                if (array_key_exists(2, $keyword)) {
                                    $accession = $keyword[2];
                                } else {
                                    $accession = '';
                                }
                                if (array_key_exists(3, $keyword)) {
                                    $desc = $keyword[3];
                                } else {
                                    $desc = '';
                                }
                                echo "<tr>"
                                . "<td>";
                                echo "<a href='searchResults.php?srcprotein=$keyword[0]'>" . $keyword[0] . "</a>"
                                . "</td>"
                                . "<td>" . $genename . "</td>"
                                . "<td>" . $accession . "</td>"
                                . "<td>" . $desc . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                    }
                    ?>
                </p>
                <br/><br/>
                <p style="font-size: 14px;color:blue;"><b style="padding-left:22px;">Near Match:</b><br/><br/>
                    <?php
                    if ($srchProtein != '') {
                        $cnt = count($termLike_proteinArry);
                        if ($cnt == 0) {
                            echo "<p> No Near Match found. </p>";
                        } else {
                            echo "<table id='nearTb' class='display' cellspacing='0' ><thead><tr>"
                            . "<td>Uniprot Name</td>"
                            . "<td>Gene Name</td>"
                            . "<td>Acession Id</td>"
                            . "<td>Protein Recommended Full Name</td></tr>"
                            . "</thead><tbody>";
                            foreach ($termLike_proteinArry as $protein) {
                                $genename = '';
                                $accession = '';
                                $desc='';
                                if (array_key_exists(1, $protein)) {
                                    $genename = $protein[1];
                                } else {
                                    $genename = '';
                                }
                                if (array_key_exists(2, $protein)) {
                                    $accession = $protein[2];
                                } else {
                                    $accession = '';
                                }
                                if (array_key_exists(2, $protein)) {
                                    $desc = $protein[3];
                                } else {
                                    $desc = '';
                                }
                                echo "<tr>"
                                . "<td>";
                                echo "<a href='searchResults.php?srcprotein=$protein[0]'>" . $protein[0] . "</a>"
                                . "</td>"
                                . "<td>" . $genename . "</td>"
                                . "<td>" . $accession . "</td>"
                                . "<td>" . $desc . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                    } elseif ($srchGene != '') {
                        $cnt = count($termLike_geneArry);
                        if ($cnt == 0) {
                            echo "<p> No Exact Match found. </p>";
                        } else {
                            echo "<table id='nearTb' class='display' cellspacing='0' ><thead><tr>"
                            . "<td>Uniprot Name</td>"
                            . "<td>Gene Name</td>"
                            . "<td>Accession Id</td>"
                            . "<td>Protein Recommended Full Name</td></tr>"
                            . "<tbody>";
                            foreach ($termLike_geneArry as $gene) {
                                $genename = '';
                                $accession = '';
                                $desc='';
                                        
                                if (array_key_exists(1, $gene)) {
                                    $genename = $gene[1];
                                } else {
                                    $genename = '';
                                }
                                if (array_key_exists(2, $gene)) {
                                    $accession = $gene[2];
                                } else {
                                    $accession = '';
                                }
                                if (array_key_exists(3, $gene)) {
                                    $desc = $gene[3];
                                } else {
                                    $desc = '';
                                }
                                echo "<tr>"
                                . "<td>";
                                echo "<a href='searchResults.php?srcprotein=$gene[0]'>" . $gene[0] . "</a>"
                                . "</td>"
                                . "<td>" . $genename . "</td>"
                                . "<td>" . $accession . "</td>"
                                . "<td>" . $desc . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                    } elseif ($srchKeyword != '') {
                        $cnt = count($termLike_KeywordArry);
                        if ($cnt == 0) {
                            echo "<p> No Near Match found. </p>";
                        } else {
                            echo "<table id='nearKeyTb' class='display' cellspacing='0' ><thead><tr>"
                            . "<td>Uniprot Name</td>"
                            . "<td>Gene Name</td>"
                            . "<td>Accession Id</td>"
                            . "<td>Protein Recommended Full Name</td></tr>"
                            . "</thead><tbody>";
                            foreach ($termLike_KeywordArry as $keyword) {
                                $genename = '';
                                $accession = '';
                                $desc='';
                                if (array_key_exists(1, $keyword)) {
                                    $genename = $keyword[1];
                                } else {
                                    $genename = '';
                                }
                                if (array_key_exists(2, $keyword)) {
                                    $accession = $keyword[2];
                                } else {
                                    $accession = '';
                                }
                                if (array_key_exists(3, $keyword)) {
                                    $desc = $keyword[3];
                                } else {
                                    $desc = '';
                                }
                                echo "<tr>"
                                . "<td>";
                                echo "<a href='searchResults.php?srcprotein=$keyword[0]'>" . $keyword[0] . "</a></td>"
                                . "<td>" . $genename . "</td>"
                                . "<td>" . $accession . "</td>"
                                . "<td>" . $desc . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                    }
                    ?>
                </p>
                <br/>
                <div style="margin:30px; font-size: 12px;">
                </div>
            </div><!-- End mainContentPages -->
            <br/>
        </div><!-- End Container -->
        <?php include_once $happiDoc . 'templates/footer_template.php'; ?>
    </body>
</html>