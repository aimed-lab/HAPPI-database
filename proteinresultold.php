<?php
include "dbconnect.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<title>Human Annotated Protein Protein Interaction Database (HAPPI DB)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="AUTHOR" content="Sudharani Mamidipalli">
	<meta name="PUBLISHER" content="Sudharani Mamidipalli">
	<meta name="description" content="Everything You need to know About human proteins, interactions, domains, functional annotations">
	<meta name="keywords" content="Bioinformatics, Jake Chen, Systems Biology, Proteomics, Protein Interactomics,Domains, Sudharani Mamidipalli">

</head>

<body bgColor=white >

	<table border="0">
	  <tr>
		<td width="100%"><img src="http://discover.uits.indiana.edu:8340/genetool/images/IUPUI_group_logo.gif" alt="" name="IUPUI_Seal" border="0"> </td>
	  </tr>
	</table>

	<table width=100% border=0>
	<tr>
	  <td align="center" valign="center" bgcolor="plum" width="100%" height="20">
	   <a href='index.htm' style="text-decoration:none">
	   <font color=white face="Verdana, Arial, Helvetica, sans-serif" size="4">HAPPI DB </font></a>	 </td>
	</tr>
    </table>

	<br><br>
	<?php

		/* Drop old rani display table */
		$dropqry1 = OCIParse($conn, "drop table ranidisplay");
		OCIExecute($dropqry1, OCI_DEFAULT);

		/* Create new rani display table */
		$createqry1 = OCIParse($conn, "CREATE TABLE ranidisplay(proteinid VARCHAR2(200),score VARCHAR2(100) )");
		OCIExecute($createqry1, OCI_DEFAULT);

		/* Drop old ophid temporary table */
		$dropqry2 = OCIParse($conn, "drop table ophidtmp");
		OCIExecute($dropqry2, OCI_DEFAULT);

		/* Create new ophid temporary table... */
		$createqry2 = OCIParse($conn, "create table ophidtmp (ophid_score varchar2(5),ophid_source varchar2(100),ophid_uniprotid varchar2(30))");
		OCIExecute($createqry2, OCI_DEFAULT);

		/* Retrieve user input protein in the form of uniprot id */
		$protein1=$_GET['protein1'];

		/* Fetch description and accession number of user input protein from human_protein_uniprot table */

		$countqry = OCIParse($conn, "select count(*) as descresults from nsudhara.human_protein_uniprot where uniprot_id = '$protein1'");
		OCIExecute($countqry, OCI_DEFAULT);
		while (OCIFetch($countqry))
		{
		     $descresults = OCIResult($countqry, "DESCRESULTS");
		}

		if ($descresults > 0) {

		$selqry1 = OCIParse($conn, "select * from nsudhara.human_protein_uniprot where uniprot_id = '$protein1'");
		OCIExecute($selqry1, OCI_DEFAULT);
		while (OCIFetch($selqry1))
		{
		     $protein1desc = OCIResult($selqry1, "PROTEIN_DESC");
		     $protein1acc = OCIResult($selqry1, "UNIPROT_ACC");
		     $protein1acc = substr($protein1acc,0,6);
		}

	?>
		<table style="border:0px solid plum; border-collapse: collapse;" align= center border="0" id="table2">
		<tr>
			<td style="border:0px solid plum; border-collapse: collapse;" width="159"valign=top><?php echo
		 "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresult3.php?protein=$protein1'>".$protein1."</a>" ?><br>
		<font size=2><?php echo $protein1desc; ?></font></td>

	<?php

	/* Fetch interaction datasource and interactors of user input protein from table ophid_human_interactions */
	$oprating = 'null';
	$selqry2 = OCIParse($conn, "select unique(swissprot_acc2), dataset from ophid_human_interactions where swissprot_acc1 = '$protein1acc'");
	OCIExecute($selqry2, OCI_DEFAULT);
	while (OCIFetch($selqry2))
	{
		$ophidsource = OCIResult($selqry2,"DATASET");
		$ophidinteractor_acc = OCIResult($selqry2, "SWISSPROT_ACC2");

		/* Fetch uniprotids of ophid accession numbers from table human_protein_uniprot */
		$selqry3 = OCIParse($conn, "select * from human_protein_uniprot where uniprot_acc like '$ophidinteractor_acc%'");
		OCIExecute($selqry3, OCI_DEFAULT);

		while (OCIFetch($selqry3))
		{

		   $ophidinteractor_id = OCIResult($selqry3, "UNIPROT_ID");

		   if( ($ophidsource == 'HPRD') or ($ophidsource == 'MINT') or ($ophidsource == 'BIND') )
		   	{$opscore = '0.8';}

		   if( ($ophidsource == 'JonesErbB1') or ($ophidsource == 'Pawson') or ($ophidsource == 'StelzlLow') or
		   	($ophidsource == 'StelzlMedium') or ($ophidsource == 'StelzlHigh') or ($ophidsource == 'VidalHuman_core')
		   	or ($ophidsource == 'VidalHuman_non_core') )
		   	{$opscore = '0.75';}

		   if( ($ophidsource == 'Mouse') or ($ophidsource == 'RikenDIP') or ($ophidsource == 'RikenBIND') )
		    {$opscore ='0.7';}

		   if($ophidsource == 'FlyHigh')
		    {$opscore ='0.65';}

		   if( ($ophidsource == 'INTEROLOG') or ($ophidsource == 'AfCS') OR ($ophidsource == 'Suzuki') or
		    ($ophidsource == 'RikenLit') or ($ophidsource == 'FlyCellCycle') )
		    {$opscore='0.6';}

		   if( ($ophidsource == 'CORE_1') or ($ophidsource == 'CORE_2') or ($ophidsource == 'LITERATURE')
		     OR ($ophidsource == 'SCAFFOLD') or ($ophidsource == 'CE_DATA') or ($ophidsource == 'FlyLow') )
		    {$opscore = '0.5';}

		   if( ($ophidsource == 'NON_CORE') or ($ophidsource == 'high') or ($ophidsource == 'MIPS')
		    or ($ophidsource == 'WranaHigh') or ($ophidsource == 'WranaMedium') or ($ophidsource == 'WranaLow') )
		    {$opscore = '0.4';}

		   if($ophidsource == 'medium')
		    {$opscore = '0.35';}

		   if($ophidsource == 'low')
		    {$opscore = '0.3';}


		/* Insert ophid interaction data into table...*/
		  $insertqry1 = OCIParse($conn, "insert into ophidtmp values ('$opscore','$ophidsource','$ophidinteractor_id')");
		  OCIExecute($insertqry1, OCI_DEFAULT);
	    }
	}

	/* Fetch ensembl protein id of input protein from table string_identifiers_proteins  */
	$selqry4 = OCIParse($conn, "select protein_ensemblid from nsudhara.string_identifiers_proteins where uniprot_id = '$protein1'");
	OCIExecute($selqry4, OCI_DEFAULT);
	while (OCIFetch($selqry4))
	{
		$ensemblid1 = OCIResult($selqry4, "PROTEIN_ENSEMBLID");
	}

	/* Fetch ensembl protein interactors and scores from table human_prot_string_interactions */
	$selqry5 = OCIParse($conn, "select * from nsudhara.human_prot_string_interactions where protein_id_a = '$ensemblid1' order by COMBINED_SCORE desc");
	OCIExecute($selqry5 , OCI_DEFAULT);

	while (OCIFetch($selqry5 ))
	{
	   	$interactor = OCIResult($selqry5 , "PROTEIN_ID_B");
	   	$dbscore = OCIResult($selqry5, "DATABASE_SCORE");
		$dbscore = $dbscore/1000;
		$bestscore = OCIResult($selqry5, "COMBINED_SCORE");
		$bestscore =$bestscore/1000;

		/* Fetch uniprot id of each interactor from table string_identifiers_proteins */
	  	$selqry6 = OCIParse($conn, "select * from nsudhara.string_identifiers_proteins where protein_ensemblid = '$interactor'");
		OCIExecute($selqry6, OCI_DEFAULT);
		while (OCIFetch($selqry6))
		{
		    $uniprotid = OCIResult($selqry6, "UNIPROT_ID");
    		if ($uniprotid != ' ')
    		{
				/* Count interactors from table ophidtmp */
				$countqry1=OCIParse($conn,"select count(*) as num_entries from nsudhara.ophidtmp where ophid_uniprotid = '$uniprotid'");
				OCIExecute($countqry1,OCI_DEFAULT);
				while (OCIFetch($countqry1)){
					$ophidrows = OCIResult($countqry1,"NUM_ENTRIES");
				}
				/* Fetch uniprot interactors, source and score from table ophidtmp */
				if ($ophidrows > 0){
					$selqry7 = OCIParse($conn, "select distinct ophid_uniprotid from nsudhara.ophidtmp where ophid_uniprotid = '$uniprotid'");
					OCIExecute($selqry7, OCI_DEFAULT);
					while (OCIFetch($selqry7))
					{
						$opid     = OCIResult($selqry7, "OPHID_UNIPROTID");
					}
						$selqryd = OCIParse($conn,"select * from nsudhara.ophidtmp where ophid_uniprotid = '$opid'");
						OCIExecute($selqryd, OCI_DEFAULT);
						while (OCIFetch($selqryd))
						{
							$opsource = OCIResult($selqryd, "OPHID_SOURCE");
							$ophscore = OCIResult($selqryd, "OPHID_SCORE");
						}

					  	/* interaction exists in both string and ophid databases */
					  	/* if source of string score is dbscore, then take string score as total score */
					  	if ($dbscore > 0)
					  		{$totalscore =$bestscore;}

						/* if source of ophid score is string database, then take string score as total score */
						if (($opsource == 'low') or ($opsource =='medium') or ($opsource == 'high') or ($opsource == 'MIPS'))
						    {$totalscore = $bestscore;}
					  	else
					  	    { $totalscore = 1 - ( (1-$bestscore) * (1-$ophscore) ); }

						/* delete ophid interactor record as it also exists in string database */
						$delqry1=OCIParse($conn,"delete from nsudhara.ophidtmp where ophid_uniprotid = '$uniprotid'");
						OCIExecute($delqry1,OCI_DEFAULT);

						/* Insert final display interaction data(both string and ophid data) into table */
						$insertqry2 = OCIParse($conn, "insert into ranidisplay values ('$opid','$totalscore')");
		    			OCIExecute($insertqry2, OCI_DEFAULT);


				}
				else{
					/* if interaction exists in only string database, then take string score as total score */
					$totalscore=$bestscore;

					/* Insert final display interaction data(only string data) into table */
					$insertqry3=OCIParse($conn, "insert into ranidisplay values ('$uniprotid','$totalscore')");
		    		OCIExecute($insertqry3,OCI_DEFAULT);
				}
			}
		 }
		}

		/* Count non-redundant interactors that exist only in table ophidtmp */
		$countqry2 = OCIParse($conn,"select count(distinct(ophid_uniprotid)) as num_entries from nsudhara.ophidtmp");
		OCIExecute($countqry2,OCI_DEFAULT);
		while (OCIFetch($countqry2)){
			$ophidnrows = OCIResult($countqry2,"NUM_ENTRIES");
		}

		/* Fetch interactions from ophid database but not from string database */
		if ($ophidnrows > 0){
			$selqry8 = OCIParse($conn, "select unique(ophid_uniprotid),ophid_score from nsudhara.ophidtmp");
			OCIExecute($selqry8, OCI_DEFAULT);
			while (OCIFetch($selqry8))
			{
				$ophscore = OCIResult($selqry8, "OPHID_SCORE");
				$opid     = OCIResult($selqry8, "OPHID_UNIPROTID");

				/* Insert final display interaction data(only ophid data) into table */
				$insertqry4 = OCIParse($conn, "insert into ranidisplay values ('$opid','$ophscore')");
				OCIExecute($insertqry4, OCI_DEFAULT);
			}
		}

		/* display results to user */
		$countqry3=OCIParse($conn,"select count(*) as num_entries from nsudhara.ranidisplay");
		OCIExecute($countqry3,OCI_DEFAULT);
		while (OCIFetch($countqry3)){
			$resultrows = OCIResult($countqry3,"NUM_ENTRIES");
		}

		/* display message if there are no interactions */
		if($resultrows == 0){ ?>
		<td width="59" valign=top><strong><font size=4>
		&lt;=&gt;</font></strong></td>

		<td width="300" valign=top>&nbsp;
		<?php echo "No interactions reported" ?> </font>
	    </td><tr>
		<?php }

		/* display results if there are interactions */
		if($resultrows > 0)
		{
		$selqry9= OCIParse($conn,"select * from ranidisplay order by score desc");
		OCIExecute($selqry9, OCI_DEFAULT);
		$counter=1;
		while (OCIFetch($selqry9))
		{
			$prot_display      = OCIResult($selqry9, "PROTEINID");
			$protscore_display = OCIResult($selqry9, "SCORE");

			/* fetch protein description of resultprotein */
			$selqry10= OCIParse($conn,"select uniprot_id, protein_desc from human_protein_uniprot where uniprot_id = '$prot_display'");
			OCIExecute($selqry10, OCI_DEFAULT);
			while (OCIFetch($selqry10))
			{
				$protdesc_display = OCIResult($selqry10, "PROTEIN_DESC");
			}

			if ($counter > 1){ ?>
			<tr>
				<td width="159" valign=top>&nbsp;</td>

				<td width="59" valign=top><strong><font size=4>
				<?php echo "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresult2.php?protein1=$protein1&amp;protein2=$prot_display' style='text-decoration:none'>"?>
				&lt;=&gt;</a></font></strong></td>

				<td width="300" valign=top>&nbsp;
			    <?php echo "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresult3.php?protein=$prot_display'>".$prot_display."</a>".
			    "<br>"."<font size=2>".$protdesc_display; ?></font>
			    </td>

				<td width="19" valign=top>&nbsp;</td>

				<td width="59" valign=top>

				<?php if ($protscore_display > 0.9) { ?>
				<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-5-0.gif" border="0">
				<?php }

				elseif ($protscore_display > 0.7) { ?>
				<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-4-0.gif" border="0">
				<?php }

				elseif ($protscore_display > 0.32) { ?>
				<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-3-0.gif" border="0">
				<?php }

				elseif ($protscore_display > 0.2) { ?>
				<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-2-0.gif" border="0">
				<?php }

				elseif ($protscore_display < 0.2) { ?>
				<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-1-0.gif" border="0">
				<?php } ?>

				</td>
			</tr>
            <?php } else{ ?>

			<td width="59" valign=top><strong><font size=4>
			<?php echo "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresult2.php?protein1=$protein1&amp;protein2=$prot_display' style='text-decoration:none'>"?>
				&lt;=&gt;</a>
			</font></strong></td>

			<td width="300" valign=top>&nbsp;
			<?php echo "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresult3.php?protein=$prot_display'>".$prot_display."</a>".
			"<br>"."<font size=2>".$protdesc_display; ?> </font>
	        </td>

			<td width="19" valign=top>&nbsp;</td>

			<td width="59" valign=top>

			<?php if ($protscore_display > 0.9) { ?>
			<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-5-0.gif" border="0">
			<?php }

			elseif ($protscore_display > 0.7) { ?>
			<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-4-0.gif" border="0">
			<?php }

			elseif ($protscore_display > 0.32) { ?>
			<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-3-0.gif" border="0">
			<?php }

			elseif ($protscore_display > 0.2) { ?>
			<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-2-0.gif" border="0">
			<?php }

			elseif ($protscore_display < 0.2) { ?>
			<img src="http://discover.uits.indiana.edu:8340/ProteinInteractions/images/stars-1-0.gif" border="0">
			<?php } ?>

			</td></tr>

	<?php	$counter++;} }}

		?>
	</table>
	   	<p>&nbsp;</p>
	   	<?php } else {echo "<center>"."No protein reported with the given name $protein1"."</center>";}

	   		/* Commit to save changes */
	   		OCICommit($conn);

	   		/* Logoff from Oracle */
	   		OCILogoff($conn);
	   	?>

<p>&nbsp;</p>


		<table width="100%" border="0" cellspacing="16" cellpadding="0" align="center">
		  <tr>
		    <td align="center"><br>
		      <!--<hr width=100% color=plum> -->
		      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Any questions,
		        please contact SudhaRani Mamidipalli, <a href="mailto:sranin@yahoo.com">sranin@yahoo.com</a></font></p>
		      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
		        <a href="http://bio.informatics.iupui.edu">Discovery Informatics and Computing Group</a><br>
		        Informatics and Technology Complex (IT), Room #476, Indianapolis, IN 46202
			  </font></p>
		      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="1">All Rights
		        Reserved. Copyright &copy; 2006.</font></p>
		    </td>
		  </tr>
		</table>


</body>
</html>