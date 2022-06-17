<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Human Protein Interactions</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" href="jquery/development-bundle/themes/ui-darkness/jquery.ui.all.css">-->
        <link href="jquery/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />

        <script src="jquery/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript">

            function reopenPDB(tt) {

                        alert(tt);
                if (tt == 'a') {
                    alert("A");
                    window.open("reopenPDB.php?pdbid=<?php echo $pdbid1; ?>&type=a", "WindowName", "width=630,height=650,top=100,left=100,resizable=no,scrollbars=no,menubar=no,toolbar=no,status=no,location=no");
                } else if (tt == 'b') {
                    window.open("reopenPDB.php?pdbid=<?php echo $pdbid2; ?>&type=b", "WindowName", "width=630,height=650,top=100,left=100,resizable=no,scrollbars=no,menubar=no,toolbar=no,status=no,location=no");
                }
            }
        </script>
    </head>
    <body>
        <?php
            $happiDoc=include_once 'documents-location.php';

            include_once $happiDoc.'templates/header_template.php';

            include_once $happiDoc.'classes/dbutility.php';
            include_once $happiDoc.'classes/utility.php';

            if(isset($_GET['PA'])){
                $protein1=$_GET['PA'];
            }
            if(isset($_GET['PB'])){
                $protein2=$_GET['PB'];
            }
            if (($protein1 != ' ') AND ($protein2 != ' ')) {
                $protein1_Description= dbutility::getProteinDesc($protein1);
                $acc1=$protein1_Description['PRIMARY_ACCESSION'];
                
                $protein2_Description= dbutility::getProteinDesc($protein2);
                $acc2=$protein2_Description['PRIMARY_ACCESSION'];

                if(isset($protein1_Description['GENENAME'])){
                        $geneName1=$protein1_Description['GENENAME'];
                }else{
                    $geneName1='';
                }

                if(isset($protein1_Description['GENENAME'])){
                    $geneName2=$protein2_Description['GENENAME'];
                }else{
                    $geneName2='';
                }
                //get Pathways
                $proteinPath1=dbutility::getPathways($acc1);
                $pathCNT1 = count($proteinPath1);
                $proteinPath2=dbutility::getPathways($acc2);
                $pathCNT2 = count($proteinPath2);
                $maxPaths=0;
                if ($pathCNT1 > $pathCNT2) {
                    $maxPaths = $pathCNT1;
                }
                else {
                    $maxPaths = $pathCNT2;
                }

                //get HPD pathways
                $proteinHPDPath1=dbutility::getProteinHPDIds($protein1);
                $proteinHPDPath2=dbutility::getProteinHPDIds($protein2);

                //get domains

                $proteinDomain1 =dbutility::getProteinDomains($protein1);
                $domainCNT1 = count($proteinDomain1);
                $proteinDomain2 = dbutility::getProteinDomains($protein2);
                $domainCNT2 = count($proteinDomain2);

                $maxdomains=0;
                if ($domainCNT1 > $domainCNT2) {
                    $maxdomains = $domainCNT1;
                }
                else {
                    $maxdomains = $domainCNT2;
                }
                $myFile1 = "pdba.pdb";
                $myFile2 = "pdbb.pdb";
                $pdbid1=dbutility::getPDBId($protein1);
                $pdbid2=dbutility::getPDBId($protein2);

                $pdbstr1=dbutility::getProteinStructure($pdbid1);
                utility::writeToFile($myFile1, $pdbstr1);

                $pdbstr2=dbutility::getProteinStructure($pdbid2);
                utility::writeToFile($myFile2, $pdbstr2);

                


            }
        ?>
        <div id="container">

            <div id="mainContentPages" style="font-size: 0.8em">
                <div id="titleDiv">
                    <h2>Interaction Description</h2>
                </div>
                    
                <table id="proDescTable" align="center">
                    <th colspan="3">Interacting Protein Ids</th>

                    <tr>
                        <td width="200px" ><img alt="HAPPI" src='images/HAPPI_DB.gif' style="width: 60px; height: 55px; " /></td>
                        <td width="350px"><a href='proteinDescription.php?protein=<?php echo $protein1 ?>'><?php echo $protein1 ?></a></td>
                        <td width="350px"><a href='proteinDescription.php?protein=<?php echo $protein2 ?>'><?php echo $protein2 ?></a></td>
                    </tr>
                    <th colspan="3">Protein Descriptions</th>
                    <tr>
                        <td width="200px" ><img alt="UNIPROT" src='images/uniprot.jpg' style="width: 90px; height: 35px; " /></td>
                        <td width="350px"><?php echo $protein1 ?></td>
                        <td width="350px"><?php echo $protein2 ?></td>
                    </tr>
                    <th colspan="3">Gene Symbols</th>
                    <tr>
                        <td width="200px" ><img alt="NCBI" src='images/ncbi.gif' style="width: 90px; height: 35px; " /></td>
                        <td width="350px"><?php echo $geneName1;?></td>
                        <td width="350px"><?php echo $geneName2 ?></td>
                    </tr>

                    <th colspan="3">KEGG Pathways</th>

                        <tr>
                            <td width="200px" ><img alt="KEGG" src='images/kegg.gif' style="width: 80px; height: 40px; " /></td>
                            <td width="350px" ><ul>
                                    <?php
                                    if(count($proteinPath1)>1){
                                      foreach($proteinPath1 as $proPath1) {
                                        foreach($proPath1 as $path1) {
                                            echo "<li><a href='http://www.genome.jp/dbget-bin/show_pathway?".$path1['PATHWAY_ID']."+".$path1['GENEID']."'>".$path1['PATHWAY_NAME']."</a></li>";
                                        }
                                      }
                                    }else{
                                        echo "Unknown";
                                    }

                                    ?>
                                </ul></td>

                            <td width="350px" ><ul>
                                    <?php
                                    if(count($proteinPath2)>1){
                                        foreach($proteinPath2 as $proPath2) {
                                            foreach($proPath2 as $path2) {
                                                echo "<li><a href='http://www.genome.jp/dbget-bin/show_pathway?".$path2['PATHWAY_ID']."+".$path2['GENEID']."'>".$path2['PATHWAY_NAME']."</a></li>";
                                            }
                                        }
                                    }else{
                                        echo "Unknown";
                                    }
                                    ?>
                                </ul></td>

                        </tr>
                        <th colspan="3">HPD Pathways</th>
                        <tr>
                            <td width="200px" >HPD </td>
                            <td width="350px" ><ul>
                                     <?php
                                        if(count($proteinHPDPath1)>1){
                                            foreach($proteinHPDPath1 as $hpd1) {
                                                echo "<li><a href='http://discern.uits.iu.edu:8340/HPD/HPDPathwayInfo.php?pathway_id=".$hpd1."'>".$hpd1."</a></li>";
                                            }
                                        }else{
                                            echo "Unknown";
                                        }
                                     ?>
                            </ul></td>
                            <td width="350px" ><ul>
                                     <?php
                                        if(count($proteinHPDPath2)>1){
                                            foreach($proteinHPDPath2 as $hpd2) {
                                                echo "<li><a href='http://discern.uits.iu.edu:8340/HPD/HPDPathwayInfo.php?pathway_id=".$hpd2."'>".$hpd2."</a></li>";
                                            }
                                        }else{
                                            echo "Unknown";
                                        }
                                     ?>
                            </ul></td>
                        </tr>

                        <th colspan="3">Protein Domains</th>
                        <tr>
                            <td width="200px" ><img alt="PFAM" src='images/pfam.gif' style="width: 90px; height: 35px; " /></td>
                            <td width="350px" ><ul>
                                    <?php
                                    if(count($proteinDomain1>1)){
                                        foreach($proteinDomain1 as $proDom1) {
                                            foreach($proDom1 as $domain1) {
                                                echo "<li><a href='http://pfam.sanger.ac.uk/family?entry=".$domain1['DOMAIN_ID']."'>".$domain1['DOMAIN_DESC']."</a></li>";
                                            }
                                        }
                                    }else{
                                        echo "Unknown";
                                    }
                                    ?>
                                </ul></td>

                            <td width="350px" ><ul>
                                    <?php
                                    if(count($proteinDomain2>1)){
                                        foreach($proteinDomain2 as $proDom2) {
                                            foreach($proDom2 as $domain2) {
                                                echo "<li><a href='http://pfam.sanger.ac.uk/family?entry=".$domain2['DOMAIN_ID']."'>".$domain2['DOMAIN_DESC']."</a></li>";
                                            }
                                        }
                                    }else{
                                        echo "Unknown";
                                    }
                                    ?>
                                </ul></td>
                        </tr>

                </table>
                <div id="seqAlign" align ="center">
                    <img alt="Saf Map" src='images/safmap.gif'style="width: 90px; height: 35px; "/>
                    <b>Sequence Feature Alignment Map</b>
                    <div align="center">
                         <?php echo "$geneName1($protein1) (<a target='_blank' href='http://discern.uits.iu.edu:8340/cgi-bin/safmapviz.pl?protein1=$protein1'>standalone window view</a>)";
                         ?>
                    </div>
                    <?php
echo "<br/>";
echo "<iframe id='myframe1' src='http://discern.uits.iu.edu:8340/cgi-bin/safmapviz.pl?protein1=$protein1' scrolling='no' marginwidth='0' marginheight='0' frameborder='0' style='overflow:visible; width:99%; display:none'></iframe>"; ?>

                    <div align="center"><?php echo "$geneName2($protein2) (<a target='_blank' href='http://discern.uits.iu.edu:8340/cgi-bin/safmapviz.pl?protein1=$protein2'>standalone window view</a>)"; ?>
                    </div>
                        <?php echo

                        "<iframe id='myframe1' src='http://discern.uits.iu.edu:8340/cgi-bin/safmapviz.pl?protein2=$protein2' scrolling='no' marginwidth='0' marginheight='0' frameborder='0' style='overflow:visible; width:99%; display:none'>
                            <p>Your browser does not support iframes.</p>
                        </iframe>"; ?>
                </div>
                <div id="proStruc" align ="center">
                    <table id ="interDescTable" align="center">
                        <tr>
                            <td colspan="3"><b>Protein Structures</b></td>
                        </tr>
                        <tr>
                            <td>
                                <img alt="Protein Structure" src='images/pdblogo.gif'style="width: 90px; height: 35px;"/>
                            </td>
                            <td >
                                <applet name='jmol' code='JmolApplet' archive='JmolApplet.jar' width='360'
                                                                  height='360' align='right'>
                                    <param name='load'    value='<?php echo $myFile1; ?>' />
                                    <param name='progressbar' value='true' />
                                    <param name='bgcolor' value='black'/>
                                    <param name='script' value='cartoons; color cartoon structure; spin off; spacefill 0' />
                                </applet>
                            </td>
                            <td>
                                <applet name='jmol' code='JmolApplet' archive='JmolApplet.jar' width='360'
                                        height='360' align='left'>
                                    <param name='load'    value='<?php echo $myFile2; ?>' />
                                    <param name='progressbar' value='true' />
                                    <param name='bgcolor' value='black'/>
                                    <param name='script' value='cartoons; color cartoon structure; spin off; spacefill 0' />
                                </applet>
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td align="center"><?php
                                if ($pdbid1 == "") {
                                    echo "No PDB structure found.";
                                } else {
                                    echo "<a href=\"http://www.rcsb.org/pdb/cgi/explore.cgi?pdbId=", $pdbid1, "\" target=\"_blank\">", $pdbid1,
                                    "</a> (<a href=\"javascript:reopenPDB('a');\">Zoomed Standalone View</a>)";
                                };
                                ?>
                            </td>
                            <td align="center"><?php
                                if ($pdbid2 == "") {
                                    echo "No PDB structure found.";
                                } else {
                                    echo "<a href=\"http://www.rcsb.org/pdb/cgi/explore.cgi?pdbId=", $pdbid2, "\" target=\"_blank\">", $pdbid2,
                                    "</a> (<a href=\"javascript:reopenPDB('b');\">Zoomed Standalone View</a>)";
                                };
                                ?>
                            </td>
                        </tr>
                    </table>

                </div>

        </div>
        </div>
        <?php include_once $happiDoc.'templates/footer_template.php'; ?>
    </body>
</html>
