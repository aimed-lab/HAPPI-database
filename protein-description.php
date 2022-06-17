<?php
if (!isset($_SESSION)) {
    session_start();
}
$happiDoc = include_once 'documents-location.php';
include_once $happiDoc . 'classes/dbutility.php';
$protein = $_GET['protein'];
$interactions = dbutility::get_all_pro_interactions($protein);
$dataAry=array();
foreach ($interactions as $inter){
    array_push($dataAry,$inter[2]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Protein Description</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />

        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/d3.min.js"></script>
        <!--[if !IE 7]>
        <style type="text/css">
                #container {display:table;height:100%}
        </style>
        <![endif]-->
        <style>

            .chart2 {
              font: 10px sans-serif;
              padding-left: 60px;
            }

            .bar rect {
              fill: steelblue;
              shape-rendering: crispEdges;
            }

            .bar text {
              fill: #fff;
              font-size: 12px;
            }

            .axis path, .axis line {
              fill: none;
              stroke: #000;
              shape-rendering: crispEdges;
            }
            svg{
                padding-left: 50px;
                padding-bottom: 100px;
                //border: 1px;
                //border-style: solid;
            }
            
            svg text{
               font-size: 12px;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#noteprotein').html("All the links, unless otherwise specified, point to external database resources that may change without notice.");
                
                
                // Histogram
                //var values = d3.range(1000).map(d3.random.bates(10));
                var values = <?php echo json_encode($dataAry);?>;
                // A formatter for counts.
                var formatCount = d3.format(",.0f");

                var margin = {top: 10, right: 30, bottom: 30, left: 30},
                    width = 740 - margin.left - margin.right,
                    height = 200 - margin.top - margin.bottom;

                var x = d3.scale.linear()
                    .domain([0, 1])
                    .range([0, width]);

                // Generate a histogram using twenty uniformly-spaced bins.
                var data = d3.layout.histogram()
                    .bins(x.ticks(20))
                    (values);

                var y = d3.scale.linear()
                    .domain([0, d3.max(data, function(d) { return d.y; })])
                    .range([height, 0]);

                var xAxis = d3.svg.axis()
                    .scale(x)
                    .orient("bottom");

                //var svg = d3.select("body").append("svg")
                var svg = d3.select("div.chart").append("svg")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                  .append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                var bar = svg.selectAll(".bar")
                    .data(data)
                  .enter().append("g")
                    .attr("class", "bar")
                    .attr("transform", function(d) { return "translate(" + x(d.x) + "," + y(d.y) + ")"; });

                bar.append("rect")
                    .attr("x", 1)
                    .attr("width", x(data[0].dx) - 1)
                    .attr("height", function(d) { return height - y(d.y); });

                bar.append("text")
                    .attr("dy", ".75em")
                    .attr("y", 6)
                    .attr("x", x(data[0].dx) / 2)
                    .attr("text-anchor", "middle")
                    .text(function(d) { return formatCount(d.y); });

                svg.append("g")
                    .attr("class", "x axis")
                    .attr("transform", "translate(0," + height + ")")
                    .call(xAxis);

                svg.append("text")
                          .attr("class", "xlabel")
                          .attr("text-anchor", "middle")
                          .attr("x", width / 2)
                          .attr("y", height + margin.bottom+20)
                          .text("H Score");

                svg.append("g")
                          .attr("class", "y axis")
                          .attr("transform", "translate(0,0)")
                          .call(yAxis);
                    svg.append("text")
                          .attr("class", "ylabel")
                          .attr("y", 0 - margin.left) // x and y switched due to rotation
                          .attr("x", 0 - (height / 2))
                          .attr("dy", "1em")
                          .attr("transform", "rotate(-90)")
                          .style("text-anchor", "middle")
                          .text("# of fill-ups");
            });
        </script>
    </head>
    <body>
        <?php
            //$happiDoc = include_once 'documents-location.php';
            include_once ('templates/header_template.php');
        ?>
        <div style="float:left; margin-top: 15%; padding-left: 10px; width:14%; border: 2px; border-color: black;">
            <h1>Note:</h1>
            <hr size="2" width="50" align="left" noshade="noshade"/>
            <p style="padding-left: 2px; text-align:left;font-size:13px;" id="noteprotein"></p>
        </div>
        <div id="container">
            <div id="mainContentPages" >
                <?php
                //include_once $happiDoc . 'classes/dbutility.php';
                //$protein = $_GET['protein'];
                $proteinCnt = dbutility::get_pro_interaction_cnt($protein);
                $proteinDesc = dbutility::getProteinDesc($protein);
                $proteinCrossDB = dbutility::getProteinCrossDBId($protein);
                $proteinSequence = dbutility::getProteinSequence($protein);
                $proteinGoId = dbutility::getProteinGoId($protein);
                $proteinHPD = dbutility::getProteinHPDIds($protein);

                $allcnt = $proteinCnt[0];
                $highcnt = $proteinCnt[1];
                $acc = $proteinDesc['PRIMARY_ACCESSION'];
                $fullName = $proteinDesc['RECOMMENDED_NAME'];
                $geneName = $proteinDesc['GENENAME'];
                if (isset($proteinDesc['PROTEIN_FUNCTION'])) {
                    $proFunc = $proteinDesc['PROTEIN_FUNCTION'];
                } else {
                    $proFunc = '';
                }

                $seqLen = $proteinDesc['PROTEIN_LENGTH'];
                $checksum = $proteinDesc['CHECKSUM'];
                //$seq=$proteinDesc['PROTEIN_SEQUENCE'];
                if (isset($proteinDesc['PROTEIN_MOL_WT'])) {
                    $proMolWt = $proteinDesc['PROTEIN_MOL_WT'];
                } else {
                    $proMolWt = '';
                }
                if (isset($proteinDesc['MEDLINE_ID'])) {
                    $medline = $proteinDesc['MEDLINE_ID'];
                } else {
                    $medline = '';
                }
                if (isset($proteinDesc['PUBMED_ID'])) {
                    $pubmed = $proteinDesc['PUBMED_ID'];
                } else {
                    $pubmed = '';
                }
                if (isset($proteinDesc['SUBCELLULAR_LOCATION'])) {
                    $subLocal = $proteinDesc['SUBCELLULAR_LOCATION'];
                } else {
                    $subLocal = '';
                }
                if (isset($proteinDesc['SIMILARITY'])) {
                    $similar = $proteinDesc['SIMILARITY'];
                } else {
                    $similar = '';
                }

                //Cross References
                if (isset($proteinCrossDB['UNIPROT_ID'])) {
                    $proUniprot = $proteinCrossDB['UNIPROT_ID'];
                } else {
                    $proUniprot = '';
                }
                if (isset($proteinCrossDB['ENSEMBLID'])) {
                    $proEnsemb = $proteinCrossDB['ENSEMBLID'];
                } else {
                    $proEnsemb = '';
                }
                if (isset($proteinCrossDB['KEGGID'])) {
                    $proKegg = $proteinCrossDB['KEGGID'];
                } else {
                    $proKegg = '';
                }
                if (isset($proteinCrossDB['PHARMGKBID'])) {
                    $proPharma = $proteinCrossDB['PHARMGKBID'];
                } else {
                    $proPharma = '';
                }
                if (isset($proteinCrossDB['REFSEQID'])) {
                    $proRefseq = explode(',', $proteinCrossDB['REFSEQID']);
                } else {
                    $proRefseq = '';
                }
                if (isset($proteinCrossDB['IPIID'])) {
                    $proIpi = $proteinCrossDB['IPIID'];
                } else {
                    $proIpi = '';
                }
                if (isset($proteinCrossDB['UNIGENEID'])) {
                    $proUnigene = explode(',', $proteinCrossDB['UNIGENEID']);
                } else {
                    $proUnigene = '';
                }
                if (isset($proteinCrossDB['REACTOMEID'])) {
                    $proReactome = explode(',', $proteinCrossDB['REACTOMEID']);
                } else {
                    $proReactome = '';
                }
                if (isset($proteinCrossDB['PDBID'])) {
                    $proPDB = explode(',', $proteinCrossDB['PDBID']);
                } else {
                    $proPDB = '';
                }
                if (isset($proteinCrossDB['HGNCID'])) {
                    $proHgnc = explode(',', $proteinCrossDB['HGNCID']);
                } else {
                    $proHgnc = '';
                }
                if (isset($proteinCrossDB['DRUGBANKID'])) {
                    $proDrugBank = explode(',', $proteinCrossDB['DRUGBANKID']);
                } else {
                    $proDrugBank = '';
                }
                if (isset($proteinCrossDB['DISPROTID'])) {
                    $proDisprot = explode(',', $proteinCrossDB['DISPROTID']);
                } else {
                    $proDisprot = '';
                }
                if (isset($proteinCrossDB['PRODOMID'])) {
                    $proDom = explode(',', $proteinCrossDB['PRODOMID']);
                } else {
                    $proDom = '';
                }

                ?>
                <div id="titleDiv">
                    <h1>Quick fact for:&nbsp;&nbsp;&nbsp; <?php echo $protein; ?></h1>
                </div>
                <p style="line-height:2;padding-left: 25px;"><b style="text-decoration:underline;"><?php echo $highcnt; ?></b> (medium- to high-quality) out of <b style="text-decoration:underline;"><?php echo $allcnt; ?></b> (all quality) protein-protein interactions 
                    are found in HAPPI. <br/>
                </p>
                <br/>
                <div class="chart"></div>
                <div>
                    <table id ="proDescTable">
                        <thead>
                            <tr>
                                <th style="width:250px;">Category</th>
                                <th>Reference to External data Sources</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Uniprot ID</td>
                                <td><?php echo $protein; ?>&nbsp;&nbsp;<i>(Click <a href='searchResults.php?srcprotein=<?php echo $protein ?>'> here <a/> for interactions)</i></td>
                            </tr>
                            <tr>
                                <td>Uniprot Accession Number</td>
                                <td><?php echo $acc; ?></td>
                            </tr>
                            <tr>
                                <td>Full Name</td>
                                <td><?php echo $fullName; ?></td>
                            </tr>
                            <tr>
                                <td>Gene Symbol</td>
                                <td><a href='http://www.ncbi.nlm.nih.gov/gene/?term=<?php echo $geneName ?>' target="_blank"><?php echo $geneName ?></a></td>
                            </tr>
                            <tr>
                                <td>Function</td>
                                <td><?php echo $proFunc; ?></td>
                            </tr>
                            <tr>
                                <td>Sequence Length</td>
                                <td><?php echo $seqLen; ?></td>
                            </tr>
                            <tr>
                                <td>Molecular Weight</td>
                                <td><?php echo $proMolWt; ?></td>
                            </tr>
                            <tr>
                                <td>Primary References</td>
                                <td>MEDLINE = <?php echo $medline; ?><br/>PUBMED =<?php echo "<a href='http://www.ncbi.nlm.nih.gov/pubmed/$pubmed' target='_blank'>" . $pubmed . "</a>"; ?></td>
                            </tr>
                            <tr>
                                <td>Database Cross References</td>
                                <td>
                                    <?php
                                    echo "<b>UniprotID : </b><a href='http://www.uniprot.org/uniprot/$proUniprot' target='_blank'> $proUniprot</a>";

                                    if ($proEnsemb !== '') {
                                        echo "<br/><b>Ensembl : </b><a href='http://uswest.ensembl.org/Homo_sapiens/Gene/Summary?db=core;g=$proEnsemb' target='_blank'> $proEnsemb</a>";
                                    }
                                    if ($proKegg !== '') {
                                        echo "<br/><b>KEGG : </b><a href='http://www.genome.jp/dbget-bin/www_bget?$proKegg' target='_blank'> $proKegg</a>";
                                    }
                                    if ($proteinHPD !== '') {
                                        echo "<br/><b>HPD : </b>";
                                        foreach ($proteinHPD as $hpdId) {
                                            echo "<a href='http://discern.uits.iu.edu:8340/HPD/HPDPathwayInfo.php?pathway_id=$hpdId' target='_blank'> $hpdId</a> , ";
                                        }
                                    }
                                    if ($proPharma !== '') {
                                        echo "<br/><b>PharmGKB : </b><a href='http://www.pharmgkb.org/do/serve?objId=$proPharma&objCls=Gene' target='_blank'> $proPharma </a>";
                                    }
                                    if ($proRefseq !== '') {
                                        echo "<br/><b>RefSeq : </b>";
                                        foreach ($proRefseq as $refId) {
                                            echo "<a href='http://www.ncbi.nlm.nih.gov/entrez/viewer.fcgi?db=protein&amp;id= $refId ' target='_blank'>$refId</a>";
                                        }
                                    }
                                    if ($proIpi !== '') {
                                        echo "<br/><b>IPI : </b><a href='http://www.ebi.ac.uk/cgi-bin/dbfetch?db=IPI&id=$proIpi' target='_blank'> $proIpi</a>";
                                    }
                                    if ($proUnigene !== '') {
                                        echo "<br/><b>UniGene : </b>";
                                        foreach ($proUnigene as $unigeneId) {
                                            if ($unigeneId != '') {
                                                $uId = explode('.', $unigeneId);

                                                echo "<a href='http://www.ncbi.nlm.nih.gov/UniGene/clust.cgi?ORG=Hs&CID=$uId[1]' target='_blank'>" . $unigeneId . "</a> , ";
                                            }
                                        }
                                    }
                                    if ($geneName !== '') {
                                        echo "<br/><b>GeneCards : </b>";
                                        echo "<a href='http://www.genecards.org/cgi-bin/carddisp.pl?gene=$geneName' target='_blank'>" . $geneName . "</a> , ";
                                    }
                                    if ($proReactome !== '') {
                                        echo "<br/><b>Reactome : </b>";
                                        foreach ($proReactome as $reactId) {
                                            if ($reactId != '') {
                                                echo "<a href='http://www.reactome.org/cgi-bin/eventbrowser_st_id?ST_ID=$reactId' target='_blank'>" . $reactId . "</a> , ";
                                            }
                                        }
                                    }

                                    if ($proHgnc !== '') {
                                        echo "<br/><b>HGNC : </b>";
                                        foreach ($proHgnc as $hgncId) {
                                            if ($hgncId != '') {
                                                $hgId = explode(':', $hgncId);
                                                echo "<a href='http://www.genenames.org/data/hgnc_data.php?hgnc_id=$hgId[1]' target='_blank'>" . $hgncId . "</a> , ";
                                            }
                                        }
                                    }

                                    if ($proDrugBank !== '') {
                                        echo "<br/><b>DrugBank : </b>";
                                        foreach ($proDrugBank as $dbId) {
                                            if ($dbId != '') {
                                                echo "<a href='http://drugbank.ca/drugs/$dbId' target='_blank'>" . $dbId . "</a> , ";
                                            }
                                        }
                                    }
                                    if ($proDisprot !== '') {
                                        echo "<br/><b>Disprot : </b>";
                                        foreach ($proDisprot as $disprotId) {
                                            if ($disprotId != '') {
                                                echo "<a href='http://www.disprot.org/protein.php?id=$disprotId' target='_blank'>" . $disprotId . "</a> , ";
                                            }
                                        }
                                    }
                                    if ($proDom !== '') {
                                        echo "<br/><b>ProDom : </b>";
                                        foreach ($proDom as $domId) {
                                            if ($domId != '') {
                                                echo "<a href='http://prodom.prabi.fr/prodom/current/cgi-bin/request.pl?question=DBEN&query=$domId'  target='_blank'>" . $domId . "</a> , ";
                                            }
                                        }
                                    }
                                    if ($proteinGoId !== '') {
                                        echo "<br/><b>GoID : </b>";
                                        foreach ($proteinGoId as $goId) {
                                            if ($goId != '') {
                                                echo "<a href='http://www.ebi.ac.uk/QuickGO/GTerm?id=$goId' target='_blank'>" . $goId . "</a> , ";
                                            }
                                        }
                                    }
                                    if ($proPDB !== '') {
                                        echo "<br/><b>PDB : </b>";

                                        foreach ($proPDB as $pdbId) {
                                            if ($pdbId != '') {
                                                echo "<a href='http://www.rcsb.org/pdb/cgi/explore.cgi?pdbId=$pdbId' target='_blank'>" . $pdbId . "</a> , ";
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Protein Sequence</td>
                                <td>
                                    <?php
                                    foreach ($proteinSequence as $seq) {
                                        echo wordwrap($seq, 70, "<br />\n", TRUE);
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
<?php include_once ('templates/footer_template.php'); ?>
    </body>
</html>
