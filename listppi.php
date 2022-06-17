<?php
include "dbconnect.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<title>HAPPI Database</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="AUTHOR" content="Jake Chen">
	<meta name="PUBLISHER" content="Jake Chen">
	<meta name="description" content="HAPPI Database: the most comprehensive online public database on human protein-protein interactions with functional annotations">
	<meta name="keywords" content="Bioinformatics, Jake Chen, Systems Biology, Proteomics, Protein Interactomics,Domains, Protein Interactions">
	<meta http-equiv="pragma" content="nocache">
</head>

<body bgColor=white >

	<table border="0">
	  <tr>
    <td width="85%"><a href="http://bio.informatics.iupui.edu/"><img src="/img/IUPUI_group_logo.gif" alt="" name="IUPUI_Seal"  border="0"></a> </td>
            <td> <a href="http://bio.informatics.iupui.edu/HAPPI/" ><img src="images/HAPPI_DB.gif" alt="" name="HAPPI" height="100" border="0"></a></td>
	  </tr>
	</table>

	<table width=100% border=0 bgcolor="plum">
	<tr>
	  <td align="center" valign="center" bgcolor="plum" width="100%" height="20">
	   <a href='http://bio.informatics.iupui.edu/HAPPI/' style=text-decoration:none>
	   <font color=white face="Verdana, Arial, Helvetica, sans-serif" size="4">
HAPPI Database - List of Retrieved Interacting Proteins </font></a>	 </td>

      <td align=right height=20><font color=white face="Verdana, Arial, Helvetica, sans-serif" size="2">
	 <?php $protein1=$_GET['protein1'];
	 echo "<a href='http://bio.informatics.iupui.edu/HAPPI/'>".Back."&nbsp;".to."&nbsp;".Search."</a>"
	 ?>
	 </td>

	</tr>
    </table>

	<p><br>
  <strong>Note</strong>: You may click on any of the protein UniProt ID to explore protein annotation information, or click on the Relationship Symbol to explore detailed report of each pair of interactions (between query protein and interacting protein).</p>

	  <?php
		/* Retrieve user input protein in the form of uniprot id */
		$protein1=$_POST['protein1'];
		$protein1= strtoupper($protein1);

		if ($protein1 == ''){ $protein1=$_GET['protein1'];}

		/* Fetch description and accession number of user input protein from human_protein_uniprot table */



		$countqry = OCIParse($conn, "select count(*) as descresults from curation9.human_protein_uniprot where uniprot_id = '$protein1'");
		OCIExecute($countqry, OCI_DEFAULT);
		while (OCIFetch($countqry))
		{
		     $descresults = OCIResult($countqry, "DESCRESULTS");
		}



		if ($descresults > 0) {

		$selqry1 = OCIParse($conn, "select * from curation9.human_protein_uniprot where uniprot_id = '$protein1'");
		OCIExecute($selqry1, OCI_DEFAULT);
		while (OCIFetch($selqry1))
		{
		     $protein1desc = OCIResult($selqry1, "PROTEIN_DESC");
		     //$protein1acc = OCIResult($selqry1, "UNIPROT_ACC");
		     //$protein1acc = substr($protein1acc,0,6);
		}

	/* Getting the taskId of the STRING website to be able to link the interactions to it */
	 if(!function_exists('http_build_query')) {
   function http_build_query( $formdata, $numeric_prefix = null, $key = null ) {
       $res = array();
       foreach ((array)$formdata as $k=>$v) {
           $tmp_key = urlencode(is_int($k) ? $numeric_prefix.$k : $k);
           if ($key) {
               $tmp_key = $key.''.$tmp_key.'';
           }
           if ( is_array($v) || is_object($v) ) {
               $res[] = http_build_query($v, null, $tmp_key);
           } else {
               $res[] = $tmp_key."=".urlencode($v);
           }
       }
       return implode("&", $res);
   }
}

	$stateCode =  $_GET['state'];
	$incomingURL = "http://string.embl.de/newstring_cgi/show_input_page.pl";
	$remotefile = fopen($incomingURL, "r");
	$rawdata = file_get_contents($incomingURL);

	//get the user id
	$startpoint = strpos($rawdata, '<input name=\'UserId\'');
	$rawdata = substr($rawdata, $startpoint);
	$startpoint = strpos($rawdata, 'value=\'');
	$UserId = substr($rawdata, $startpoint+7, 12);
	//echo $UserId, '\n';

	//get the session id
	$startpoint = strpos($rawdata, '<input name=\'sessionId\'');
	$rawdata = substr($rawdata, $startpoint);
	$startpoint = strpos($rawdata, 'value=\'');
	$sessionId = substr($rawdata, $startpoint+7, 12);
	//building query

	$selquery12= OCIParse($conn, "select ENSEMBL_PID from curation9.uniprot_gene_ensembl_map where UNIPROT_ID = '$protein1'");
	OCIExecute($selquery12, OCI_DEFAULT);
	if (OCIFetch($selquery12))
	{
		$prot_ensembl_a = OCIResult($selquery12, "ENSEMBL_PID");
	}
	else
	{
		$prot_ensembl_a = "NULL";
	}

	$data = array('identifier'=>$prot_ensembl_a,
             'UserId'=> $UserId,
             'sessionId'=>$sessionId,
			 'input_query_species'=>"9606",
			 limit =>25
			 );
	//echo $prot_ensembl_a, "\n";
	//echo $UserId, "\n";
	//echo $sessionId, "\n";

    //Assessing the protein summary url that has the task id
	$nextURL = "http://string.embl.de/newstring_cgi/show_network_section.pl?".http_build_query($data, '', '&amp;');
	$nextfile = fopen($nextURL, "r");
	$rawdata = file_get_contents($nextURL);

	//getting the task id
	$startpoint = strpos($rawdata, 'taskId=');
	$taskId = substr($rawdata, $startpoint+7, 12);
	 //echo $protein1;
      //echo "taskId=$taskId\n";

	?>
    </p>
        <?php

		/* display results to user */
		$countqry3=OCIParse($conn,"select count(*) as num_entries from curation9.happi_2way_rank_updated where uniprot_a = '$protein1' and interaction_type is null");
		OCIExecute($countqry3,OCI_DEFAULT);
		while (OCIFetch($countqry3)){
			$resultrows = OCIResult($countqry3,"NUM_ENTRIES");
		}

		$countqry4=OCIParse($conn,"select count(*) as num_display from curation9.happi_2way_rank_updated where uniprot_a = '$protein1' and h_score >=0.45 and interaction_type is null");
		OCIExecute($countqry4,OCI_DEFAULT);
		while (OCIFetch($countqry4)){
			$displayrows = OCIResult($countqry4,"NUM_DISPLAY");
		}

		/* display message if there are no interactions */
		if($resultrows == 0){ ?>
         <font color="#FF0000" size="+1"><?php echo "No interactions found!" ?></font>
       <?php }

		if($displayrows == 0){ ?>
 		<font color="#FF0000" size="+1"><?php echo "No interactions above the minimal confidence rating threshold found!" ?></font>
        <?php }

		/* display results if there are interactions */
		if($displayrows > 0){ ?>
		<center><p><font color="#FF00FF" ><?php echo $resultrows." total interactions involving ".$protein1." are found. ".$displayrows." of them with minimal confidence rating 3 star and above are shown below." ?></font></p></center>

	<table style="border:1px solid plum; border-collapse: collapse;" width=80% align="center" cellpadding="0" cellspacing="0" border="1" >
      <tr>
        <td valign=top bgcolor="#FFCCFF">&nbsp;<em><strong>Query Protein</strong></em></td>
        <td valign=top bgcolor="#FFCCFF">&nbsp;<em><strong>Relationship Symbol <a href="help.html#relsymbol"><img src="../img/BulbWB.gif" width="11" height="18" border="0"></a></strong></em></td>
        <td valign=top bgcolor="#FFCCFF">&nbsp;<em><strong> Interacting Protein</strong></em></td>
        <td valign=top bgcolor="#FFCCFF">&nbsp;<em><strong> Interaction Source <a href="help.html#source"><img src="images/BulbWB.gif" width="11" height="18" border="0"></a></strong></em></td>
        <td valign=top bgcolor="#FFCCFF">&nbsp;<em><strong>Confidence Rating <a href="help.html#ranking"><img src="images/BulbWB.gif" width="11" height="18" border="0"></a></strong></em></td>
      <tr>
        <td width="180" valign=top rowspan="<?php echo $displayrows ?>" ><?php echo
		 "<a href='proteinresult3.php?protein=$protein1'>".$protein1."</a>" ?><br>
            <font size=2><?php echo $protein1desc; ?></font></td>

        <?php }

		{



		$selqry9= OCIParse($conn,"select * from curation9.happi_2way_rank_updated where uniprot_a = '$protein1' and h_score >= 0.45 and interaction_type is null order by h_score desc");
                OCIExecute($selqry9, OCI_DEFAULT);

		$counter=1;

		$txtoutfile="ppi_txtout.txt";
		$fp=fopen($txtoutfile,"w");

		while (OCIFetch($selqry9))
		{

                        $prot_A            = OCIResult($selqry9, "UNIPROT_A");
                        $prot_display      = OCIResult($selqry9, "UNIPROT_B");
  					 fwrite($fp,"$prot_A\t$prot_display\n");
			$int_data_source   = OCIResult($selqry9, "DATA_SOURCE_DESC");
			$protscore_display = OCIResult($selqry9, "H_SCORE");


			/* Fetch Ensembl ids of the proteins to create the link to the STRING source of the interaction */


			$selquery13= OCIParse($conn, "select  ENSEMBL_PID from curation9.uniprot_gene_ensembl_map where UNIPROT_ID = '$prot_display'");
			OCIExecute($selquery13, OCI_DEFAULT);
			if (OCIFetch($selquery13))
			{
				$prot_ensembl_b = OCIResult($selquery13, "ENSEMBL_PID");
			}
			else
			{
				$prot_ensembl_b = "NULL";
			}



			/* fetch protein description of resultprotein */
			$selqry10= OCIParse($conn,"select uniprot_id, protein_desc from curation9.human_protein_uniprot where uniprot_id = '$prot_display'");
			OCIExecute($selqry10, OCI_DEFAULT);
			while (OCIFetch($selqry10))
			{
				$protdesc_display = OCIResult($selqry10, "PROTEIN_DESC");
			}

			if ($counter > 1){ ?>
      <tr>
        <td width="59" align="center" valign="middle"><strong><font size=4> <?php echo "<a href='proteinresult2.php?protein1=$protein1&amp;protein2=$prot_display' style='text-decoration:none'>"?> &lt;=&gt;</font></strong></td>
        <td width="300" valign="middle">&nbsp; <?php echo "<a href='proteinresult3.php?protein=$prot_display'>".$prot_display."</a>".
			    "<br>"."<font size=2>".$protdesc_display; ?> </td>
        <td width="15" valign="middle">&nbsp; <?php echo $int_data_source?> <?php
		if (($node1 != "NULL") && ($node2 != "NULL"))
			echo "<br> <a href='http://string.embl.de/newstring_cgi/show_network_section.pl?taskId=$taskId&node1=$prot_ensembl_a&node2=$prot_ensembl_b'>LinkToSTRINGSource</a>"?></td>
        <td width="60" align="center" valign="middle"><?php if ($protscore_display >= 0.90) { ?>
            <img src="images/stars-5-0.gif" border="0">
            <?php }

				elseif ($protscore_display >= 0.75) { ?>
            <img src="images/stars-4-0.gif" border="0">
            <?php }

				elseif ($protscore_display >= 0.45) { ?>
            <img src="images/stars-3-0.gif" border="0">
            <?php }

				elseif ($protscore_display >= 0.25) { ?>
            <img src="images/stars-2-0.gif" border="0">
            <?php }

				else  { ?>
            <img src="images/stars-1-0.gif" border="0">
            <?php } ?>
        </td>
      </tr>
      <?php } else{ ?>
  <td width="59" align="center" valign="middle"><strong><font size=4> <?php echo "<a href='proteinresult2.php?protein1=$protein1&amp;protein2=$prot_display' style='text-decoration:none'>"?> &lt;=&gt; </font></strong></td>
      <td width="300" valign=top>&nbsp; <?php echo "<a href='proteinresult3.php?protein=$prot_display'>".$prot_display."</a>".
			"<br>"."<font size=2>".$protdesc_display; ?> </td>
    <td width="19" valign="middle">&nbsp; <?php echo $int_data_source?> <?php
	if (($node1 != "NULL") && ($node2 != "NULL"))
		echo "<br><a href='http://string.embl.de/newstring_cgi/show_network_section.pl?taskId=$taskId&node1=$prot_ensembl_a&node2=$prot_ensembl_b'>LinkToSTRINGSource</a>"?></td>
    <td width="59" align="center" valign="middle"><?php if ($protscore_display >= 0.9) { ?>
          <img src="images/stars-5-0.gif" border="0">
          <?php }

			elseif ($protscore_display >= 0.75) { ?>
          <img src="images/stars-4-0.gif" border="0">
          <?php }

			elseif ($protscore_display >= 0.45) { ?>
          <img src="images/stars-3-0.gif" border="0">
          <?php }

			elseif ($protscore_display >= 0.25) { ?>
          <img src="images/stars-2-0.gif" border="0">
          <?php }

			else { ?>
          <img src="images/stars-1-0.gif" border="0">
          <?php } ?>
      </td>
  </tr>
  <?php	$counter++;} }}

	fclose($fp);
		?>
    </table>
	<p>&nbsp;</p>
	   	<?php } else {echo "<center>"."No protein reported with the given name $protein1"."</center>";}

	   		/* Commit to save changes */
	   		OCICommit($conn);

	   		/* Logoff from Oracle */
	   		OCILogoff($conn);
	   	?>

<?php
$psioutfile = "ppi_psiout.xml";
$gmloutfile = "ppi_gmlout.gml";

system("perl xmlMakerFlattener/xmlMakerFlattener/simplexmlmaker.pl $txtoutfile $psioutfile &");
system ("perl gml_code.pl $txtoutfile $gmloutfile &");
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>Download the query results in <a href=<?php echo $txtoutfile ?>>TAB-delimited TEXT format</a>, <a href=<?php

echo $gmloutfile; ?>>GML format</a> or <a href=<?php echo $psioutfile; ?>>PSI MI format</a>.</b>

<p>&nbsp;</p>
<center>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><a href="index.html">Home</a>&nbsp;- <a href="dbstatistics.html">Logs &amp;  Statistics</a>&nbsp;- <a href="help.html">Help</a>&nbsp;- <a href="aboutus.html">About Us</a> </font>- <a href="term.html">Terms &amp; Conditions</a><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> </font></p>
</center>

		<table width="100%" border="0" cellspacing="16" cellpadding="0" align="center">
		  <tr>
		    <td align="center"><br>
		      <!--<hr width=100% color=plum> -->

		      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="1">All Rights
	          Reserved. Copyright &copy; 2006-8 by <a href="http://bio.informatics.iupui.edu/">Discovery Informatics and Computing Group</a>, Indiana University.</font></p>
	        </td>
		  </tr>
		</table>

</body>
</html>