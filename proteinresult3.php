<?php
include "/ip/biokdd/www/ProteinInteractions/dbconnect.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<title>HAPPI</title>
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
	   <font color=white face="Verdana, Arial, Helvetica, sans-serif" size="4">Human Annotated Protein-Protein Interaction database</font>
	 </td>
	</tr>
    </table>

	<br><br>
	<?php
	$protein=$_GET['protein'];

	/* search database for protein interactions */

	if ($protein != ' ')
	{

	    	/* Querying the nsudhara database: table human_proteing_uniprot for protein features */

		/* Select Data from the table */
	  		$selqry1 = OCIParse($conn, "select * from nsudhara.human_protein_uniprot where uniprot_id = '$protein'");
	  		OCIExecute($selqry1, OCI_DEFAULT);

	  		while (OCIFetch($selqry1))
	  		{
	    		$aminoacids1 = OCIResult($selqry1, "AMINO_ACIDS");
	    		$uniprotacc1 = OCIResult($selqry1, "UNIPROT_ACC");
	    		$uniprotacc1 = substr($uniprotacc1,0,6);

	    		$dateinfo1 = OCIResult($selqry1, "DATE_INFO");
	    		$proteindesc1 = OCIResult($selqry1, "PROTEIN_DESC");
	    		$gene1 = OCIResult($selqry1, "GENE");
	    		$organsim1 = OCIResult($selqry1, "ORGANISM");
	    		$taxonomyid1 = OCIResult($selqry1, "TAXONOMY_ID");
	    		$primaryrefid = OCIResult($selqry1, "PRIMARY_REF_ID");
	    		$medline = substr($primaryrefid,0,8);
	    		$medlineno = substr($primaryrefid,8,8);
	    		$pubmed = substr($primaryrefid,18,7);
				$pubmedno = substr($primaryrefid,25,7);

	    		$keywords1 = OCIResult($selqry1, "KEYWORDS");
	    		$molwt1 = OCIResult($selqry1,"MOL_WT");
	    		$checksum1 = OCIResult($selqry1, "CHECK_VALUE");

	    	}


	?>



	<table align= center border="0" width="60%" id="table1">

		<tr>
			<td valign=top width="159"><strong>UniprotID</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top wrap><?php echo "<a href='http://www.pir.uniprot.org/cgi-bin/upEntry?id=$protein'>".$protein."</a>"; ?></td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>PrimaryAccessionNo.</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $uniprotacc1 ?></td>
		</tr>
		<tr>
			<td valign=top width="159"><strong>Description</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top wrap><?php echo $proteindesc1; ?></td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>AminoAcids</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $aminoacids1; ?></td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>Gene</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $gene1; ?></td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>TaxonomyID</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $taxonomyid1 ?></td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>Keywords</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top>
			<?php if ($keywords1 != ''){echo $keywords1;}
			      else {echo "None";} ?>
			</td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>MolecularWeight</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $molwt1 ?></td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>CheckSum</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $checksum1 ?></td>

		</tr>
		<tr>
			<td valign=top width="159"><strong>DateInformation</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $dateinfo1 ?></td>

		</tr>
		<tr>
			<td valign=topwidth="159"><strong>PrimaryReferences</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top><?php echo $medline."<a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=search&db=Medline&term=$medlineno'>".$medlineno."</a>".
			"<br>".$pubmed.
			"<a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=search&db=PubMed&term=$pubmedno'>".$pubmedno."</a>"; ?></td>
		</tr>
		<tr>
			<td valign=top width="159"><strong>CrossReferences</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top>
			<?php
			$selqry2 = OCIParse($conn, "select DBMS_LOB.substr(DB_REF,4000,1) as DB1,
			DBMS_LOB.substr(DB_REF,4000,4001) as DB2
			from nsudhara.human_protein_uniprot where uniprot_id = '$protein'");
			OCIExecute($selqry2, OCI_DEFAULT);
			while (OCIFetch($selqry2))
			{
			   $DB1 = OCIResult($selqry2,"DB1");
			   $DB2 = OCIResult($selqry2,"DB2");

			   /* display database crossreferences */
			   $result1 = explode(".", $DB1);
			   $i=0;
			   $countpdb=0;$countgo=0;$countmim=0;$countpfam=0;$countprosite=0;$countsmart=0;

			   while ($i <= 100){
			   		if ($result1[$i] != ''){
			   			 $result= explode(";",$result1[$i]);

			   			 /* display and give hyperlink to PIR database cross reference id */
			   			 if ($result[0] == 'PIR'){
			   			 $result[2]=trim($result[2]);
			   			 echo "<strong>".$result[0]." : "."</strong>".$result[1].", "
			   			 ."<a href='http://pir.georgetown.edu/cgi-bin/nbrfget?uid=$result[2]'>".$result[2]."</a>"."<br>";
						 }

						 /* display and give hyperlink to PDB database cross reference id/ids */
						 if ($result[0] == 'PDB'){

						 	 if ($countpdb == 0){
							 	echo "<strong>".$result[0]." : "."</strong>"
						 		."<a href='http://www.rcsb.org/pdb/cgi/explore.cgi?pdbId=$result[1]'>".
						 		 $result[1]."</a>";
						 	 }
						 	 else {
						 	  	 echo ", "."<a href='http://www.rcsb.org/pdb/cgi/explore.cgi?pdbId=$result[1]'>".
						 	 		$result[1]."</a>";
						 	 }
						 	$countpdb++;
						 }

						 /* display and give hyperlink to Prosite database cross reference id/ids */
						 if ($result[0] == 'PROSITE'){

						 	 if ($countprosite == 0){
							 	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						 		."<a href='http://us.expasy.org/cgi-bin/nicesite.pl?$result[1]'>".
						 		 $result[1]."</a>";
						 	 }
						 	 else {
						 	  	 echo ", "."<a href='http://us.expasy.org/cgi-bin/nicesite.pl?$result[1]'>".
						 	 		$result[1]."</a>";
						 	 }
						 	$countprosite++;
						 }

						 /* display and give hyperlink to SMART database cross reference id/ids */
						 if ($result[0] == 'SMART'){

						 	 if ($countsmart == 0){
							 	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						 		."<a href='http://smart.embl-heidelberg.de/smart/do_annotation.pl?BLAST=DUMMY&DOMAIN=$result[1]'>".
						 		 $result[1]."</a>";
						 	 }
						 	 else {
						 	  	 echo ", "."<a href='http://smart.embl-heidelberg.de/smart/do_annotation.pl?BLAST=DUMMY&DOMAIN=$result[1]'>".
						 	 		$result[1]."</a>";
						 	 }
						 	$countsmart++;
						 }

						 /* display and give hyperlink to ENSEMBL database cross reference id */
						 if ($result[0] == 'Ensembl'){

						 	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						 	."<a href='http://pir.georgetown.edu/cgi-bin/nbrfget?uid=$result[1]'>".$result[1]."</a>";
						 }

						 /* display and give hyperlink to Reactome database cross reference id */
						 if ($result[0] == 'Reactome'){

						 	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						 	."<a href='http://www.reactome.org/cgi-bin/search?QUERY_CLASS=DatabaseIdentifier&QUERY=UniProt:$result[1]'>".$result[1]."</a>";
						 }

						 /* display and give hyperlink to HGNC database cross reference id */
						 if ($result[0] == 'HGNC'){

						  	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						  	.$result[1].", ".$result[2];
						 }

						 /* display and give hyperlink to IntAct database cross reference id */
						 if ($result[0] == 'IntAct'){

						  	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						  	.$result[1];
						 }

						 /* display and give hyperlink to PRINTS database cross reference id */
						 if ($result[0] == 'PRINTS'){

						  	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						  	."<a href='http://umber.sbs.man.ac.uk/cgi-bin/dbbrowser/PRINTS/DoPRINTS.pl?cmd_a=Display&qua_a=none&fun_a=Text&qst_a=$result[1]'>"
						  	.$result[1]."</a>";
						 }

						 /* display and give hyperlink to ProDom database cross reference id */
						 if ($result[0] == 'ProDom'){

						  	echo "<br>"."<strong>".$result[0]." : "."</strong>"
						  	."<a href='http://prodes.toulouse.inra.fr/prodom/current/cgi-bin/request.pl?question=DBEN&query=$result[1]'>"
						  	.$result[1]."</a>";
						 }

						 /* display and give hyperlink to Transfac database cross reference id */
						 if ($result[0] == 'TRANSFAC'){

						  	echo "<br>"."<strong>".$result[0]." : "."</strong>".$result[1];
						 }

						 /* display and give hyperlink to OMIM database cross reference id/ids */
						 if ($result[0] == 'MIM'){

						 	if ($countmim == 0){
						 		echo "<br>"."<strong>".$result[0]." : "."</strong>"
						 		."<a href='http://srs.ebi.ac.uk/srs7bin/cgi-bin/wgetz?-e+[omim-ID:$result[1]]'>".
						 		$result[1]."</a>";
						 	}
						 	else {
						 	  	 echo ", "."<a href='<a href='http://srs.ebi.ac.uk/srs7bin/cgi-bin/wgetz?-e+[omim-ID:$result[1]]'>".
						 		$result[1]."</a>";
						 	}
						 	$countmim++;
						 }

						 /* display and give hyperlink to Pfam database cross reference id/ids */
						 if ($result[0] == 'Pfam'){

						 	if ($countpfam == 0){
						 		echo "<br>"."<strong>".$result[0]." : "."</strong>"
						 		."<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$result[1]'>".
						 		$result[1]."</a>";
						 	}
						 	else {
						 	  	 echo ", "."<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$result[1]'>".
						 		$result[1]."</a>";
						 	}
						 	$countpfam++;
						 }

						 /* display and give hyperlink to GO database cross reference id/ids */
						 if ($result[0] == 'GO'){

						 	if ($countgo == 0){
						 		echo "<br>"."<strong>".$result[0]." : "."</strong>"
						 		."<a href='http://www.godatabase.org/cgi-bin/amigo/go.cgi?view=tree&query=$result[1]'>".
						 		$result[1]."</a>";
						 	}
						 	else {
						 	  	 echo ", "."<a href='http://www.godatabase.org/cgi-bin/amigo/go.cgi?view=tree&query=$result[1]'>".
						 		$result[1]."</a>";
						 	}
						 	$countgo++;
						 }


					  }
				      $i++;
			   }

			}
			?></td>
		</tr>
		<tr>
			<td valign=top width="159"><strong>Sequence</strong></td>
			<td valign=top width="20"><strong>:</strong></td>
			<td valign=top>
			<?php
			$selqry = OCIParse($conn, "select DBMS_LOB.substr(PROTEIN_SEQ,4000,1) as RES1,
			DBMS_LOB.substr(PROTEIN_SEQ,4000,4001) as RES2, DBMS_LOB.substr(PROTEIN_SEQ,4000,8001) as RES3,
			DBMS_LOB.substr(PROTEIN_SEQ,4000,12001) as RES4, DBMS_LOB.substr(PROTEIN_SEQ,4000,16001) as RES5,
			DBMS_LOB.substr(PROTEIN_SEQ,4000,20001) as RES6, DBMS_LOB.substr(PROTEIN_SEQ,4000,24001) as RES7,
			DBMS_LOB.substr(PROTEIN_SEQ,4000,28001) as RES8, DBMS_LOB.substr(PROTEIN_SEQ,4000,32001) as RES9,
			DBMS_LOB.substr(PROTEIN_SEQ,4000,36001) as RES10
			from nsudhara.human_protein_uniprot where uniprot_id = '$protein'");
			OCIExecute($selqry, OCI_DEFAULT);
			while (OCIFetch($selqry))
			{
			   echo OCIResult($selqry,"RES1").OCIResult($selqry,"RES2").OCIResult($selqry,"RES3")
			   .OCIResult($selqry,"RES4").OCIResult($selqry,"RES5").OCIResult($selqry,"RES6")
			   .OCIResult($selqry,"RES7").OCIResult($selqry,"RES8").OCIResult($selqry,"RES9")
			   .OCIResult($selqry,"RES10");
			}
			?></td>
		</tr>


</table>
<p>&nbsp;</p>
<?php } ?>

		<table width="100%" border="0" cellspacing="16" cellpadding="0" align="center">
		  <tr>
		    <td align="center"><br>
		      <!--<hr width=100% color=plum> -->
		      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Any questions,
		        please contact SudhaRani Mamidipalli, <a href="mailto:nsudhara@iupui.edu">nsudhara@iupui.edu</a></font></p>
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