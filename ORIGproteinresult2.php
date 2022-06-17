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

	<table width=100% border=0 bgcolor="plum">
	<tr>
	  <td align=right valign="center" height="20">
	  <a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/index.html'style="text-decoration:none">
	   <font color=white face="Verdana, Arial, Helvetica, sans-serif" size="4">HAPPI Database
	   </font></a></td>

	  <td align=right height=20><font color=white face="Verdana, Arial, Helvetica, sans-serif" size="2">
	 <?php $protein1=$_GET['protein1'];
	 echo "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresultold.php?protein1=$protein1'>".Back."&nbsp;".to."&nbsp;".Interactions."</a>"
	 ?></font>
	 </td>

	</tr>
    </table>

	<br><br>
	<?php

	$protein1=$_GET['protein1'];
	$protein2=$_GET['protein2'];

	/* search database for protein interactions */

	if (($protein1 != ' ') AND ($protein2 != ' '))
	{

	    	/* count the number of records retrieved */
			$s6_count = OCIParse($conn,"select count(*) from nsudhara.human_protein_domain_swisspfam where uniprot_id LIKE '$protein1%'");
	  		OCIExecute ($s6_count);

	  		if (OCIFetch($s6_count)){
				$num_rows6 = OCIResult($s6_count,1);}
			else {
				$num_rows6 = 0;
			}

			if ($num_rows6 > 0) {

			$s6 = OCIParse($conn, "select * from nsudhara.human_protein_domain_swisspfam where uniprot_id LIKE '$protein1%'");

	  		OCIExecute($s6, OCI_DEFAULT);


	  		while (OCIFetch($s6))
	  		{
	    		$domaindesc11 = OCIResult($s6, "DOMAIN1_DESC");
				$domaindesc12 = OCIResult($s6, "DOMAIN2_DESC");
				$domaindesc13 = OCIResult($s6, "DOMAIN3_DESC");
				$domaindesc14 = OCIResult($s6, "DOMAIN4_DESC");
				$domaindesc15 = OCIResult($s6, "DOMAIN5_DESC");
				$domaindesc16 = OCIResult($s6, "DOMAIN6_DESC");
				$domaindesc17 = OCIResult($s6, "DOMAIN7_DESC");
	    		$domaindesc18 = OCIResult($s6, "DOMAIN8_DESC");

	    		$domainid11    = OCIResult ($s6, "DOMAIN1_ID");
	    		$domainid11    = substr($domainid11,0,7);
				$domainid12    = OCIResult ($s6, "DOMAIN2_ID");
				$domainid12    = substr($domainid12,0,7);
				$domainid13    = OCIResult ($s6, "DOMAIN3_ID");
				$domainid13    = substr($domainid13,0,7);
				$domainid14    = OCIResult ($s6, "DOMAIN4_ID");
				$domainid14    = substr($domainid14,0,7);
				$domainid15    = OCIResult ($s6, "DOMAIN5_ID");
				$domainid15    = substr($domainid15,0,7);
				$domainid16    = OCIResult ($s6, "DOMAIN6_ID");
				$domainid16    = substr($domainid16,0,7);
				$domainid17    = OCIResult ($s6, "DOMAIN7_ID");
				$domainid17    = substr($domainid17,0,7);
				$domainid18    = OCIResult ($s6, "DOMAIN8_ID");
				$domainid18    = substr($domainid18,0,7);
	    		} }


	    	/* count the number of records retrieved */
			$s7_count = OCIParse($conn, "select count(*) from nsudhara.human_protein_domain_swisspfam where uniprot_id LIKE '$protein2%'");
			OCIExecute ($s7_count);

			if (OCIFetch($s7_count)){
				$num_rows7 = OCIResult($s7_count,1);}
			else {
				$num_rows7 = 0;
			}


			if ($num_rows7 > 0) {

			$s7 = OCIParse($conn, "select * from nsudhara.human_protein_domain_swisspfam where uniprot_id LIKE '$protein2%'");

	  		OCIExecute($s7, OCI_DEFAULT);

	  		while (OCIFetch($s7))
	  		{
	    		$domaindesc21 = OCIResult($s7, "DOMAIN1_DESC");
				$domaindesc22 = OCIResult($s7, "DOMAIN2_DESC");
				$domaindesc23 = OCIResult($s7, "DOMAIN3_DESC");
				$domaindesc24 = OCIResult($s7, "DOMAIN4_DESC");
				$domaindesc25 = OCIResult($s7, "DOMAIN5_DESC");
				$domaindesc26 = OCIResult($s7, "DOMAIN6_DESC");
				$domaindesc27 = OCIResult($s7, "DOMAIN7_DESC");
	    		$domaindesc28 = OCIResult($s7, "DOMAIN8_DESC");

				$domainid21    = OCIResult ($s7, "DOMAIN1_ID");
				$domainid21    = substr($domainid21,0,7);
				$domainid22    = OCIResult ($s7, "DOMAIN2_ID");
				$domainid22    = substr($domainid22,0,7);
				$domainid23    = OCIResult ($s7, "DOMAIN3_ID");
				$domainid23    = substr($domainid23,0,7);
				$domainid24    = OCIResult ($s7, "DOMAIN4_ID");
				$domainid24    = substr($domainid24,0,7);
				$domainid25    = OCIResult ($s7, "DOMAIN5_ID");
				$domainid25    = substr($domainid25,0,7);
				$domainid26    = OCIResult ($s7, "DOMAIN6_ID");
				$domainid26    = substr($domainid26,0,7);
				$domainid27    = OCIResult ($s7, "DOMAIN7_ID");
				$domainid27    = substr($domainid27,0,7);
				$domainid28    = OCIResult ($s7, "DOMAIN8_ID");
				$domainid28    = substr($domainid28,0,7);
	    		}
			}



			$selqry= OCIParse($conn,"select uniprot_id, protein_desc,gene from human_protein_uniprot where uniprot_id = '$protein1'");
			OCIExecute($selqry, OCI_DEFAULT);
			while (OCIFetch($selqry))
			{
				$prot1_desc = OCIResult($selqry, "PROTEIN_DESC");
				$prot1_gene = OCIResult($selqry, "GENE");
			}

			$selqry2= OCIParse($conn,"select uniprot_id, protein_desc,gene from human_protein_uniprot where uniprot_id = '$protein2'");
			OCIExecute($selqry2, OCI_DEFAULT);
			while (OCIFetch($selqry2))
			{
				$prot2_desc = OCIResult($selqry2, "PROTEIN_DESC");
				$prot2_gene = OCIResult($selqry2, "GENE");
			}

			$prot2_path_mod = 0;
			/* check whether there is a pathway for the second gene */
			$cntqryg2 = OCIParse($conn,"select count(*) from kegg_human_pathway where gene_name = '$prot2_gene'");
			OCIExecute ($cntqryg2);
			if (OCIFetch($cntqryg2)){
				$prot2_path = OCIResult($cntqryg2,1);}
			else {
				$prot2_path = 0;
			}

			if ($prot2_path > 0){
			$selqryg3= OCIParse($conn,"select * from kegg_human_pathway where gene_name = '$prot2_gene'");
			OCIExecute($selqryg3, OCI_DEFAULT);
			while (OCIFetch($selqryg3))
			{
				$prot2_pathway = OCIResult($selqryg3, "PATHWAY");
				$result2 = explode(",", $prot2_pathway);
			}}


			if ($prot2_path == 0){
				$cntqryg3_mod = OCIParse($conn,"select count(*) from kegg_human_pathway where gene_synonyms like '%$prot2_gene%'");
				OCIExecute ($cntqryg3_mod);
				if (OCIFetch($cntqryg3_mod)){
					$prot2_path_mod = OCIResult($cntqryg3_mod,1);}
				else {
					$prot2_path_mod = 0;
				}



				if ($prot2_path_mod > 0){
				$selqryg3_mod= OCIParse($conn,"select * from kegg_human_pathway where gene_synonyms like '%$prot2_gene%'");
				OCIExecute($selqryg3_mod, OCI_DEFAULT);
				while (OCIFetch($selqryg3_mod))
				{
					$prot2_pathway = OCIResult($selqryg3_mod, "PATHWAY");
					$result2 = explode(",", $prot2_pathway);
				}}

				if ($prot2_path_mod == 0){$result2[0] = '';}
			}

			$prot1_path_mod = 0;
			/* check whether there is a pathway for the first gene */
			$cntqry3 = OCIParse($conn,"select count(*) from kegg_human_pathway where gene_name = '$prot1_gene'");
			OCIExecute ($cntqry3);
			if (OCIFetch($cntqry3)){
				$prot1_path = OCIResult($cntqry3,1);}
			else {
				$prot1_path = 0;
			}

			if ($prot1_path > 0){
			$selqry3= OCIParse($conn,"select * from kegg_human_pathway where gene_name = '$prot1_gene'");
			OCIExecute($selqry3, OCI_DEFAULT);
			while (OCIFetch($selqry3))
			{
				$prot1_pathway = OCIResult($selqry3, "PATHWAY");
				$result1 = explode(",", $prot1_pathway);
			}}


			if ($prot1_path == 0){
				$cntqry3_mod = OCIParse($conn,"select count(*) from kegg_human_pathway where gene_synonyms like '%$prot1_gene%'");
				OCIExecute ($cntqry3_mod);
				if (OCIFetch($cntqry3_mod)){
					$prot1_path_mod = OCIResult($cntqry3_mod,1);}
				else {
					$prot1_path_mod = 0;
				}



				if ($prot1_path_mod > 0){
				$selqry3_mod= OCIParse($conn,"select * from kegg_human_pathway where gene_synonyms like '%$prot1_gene%'");
				OCIExecute($selqry3_mod, OCI_DEFAULT);
				while (OCIFetch($selqry3_mod))
				{
					$prot1_pathway = OCIResult($selqry3_mod, "PATHWAY");
					$result1 = explode(",", $prot1_pathway);
				}}

				if ($prot1_path_mod == 0){$result1[0] = '';}
			}



			$i=0;$j=0;
			while (substr($result1[$i],0,8) != ''){
			$prot1_keggid[$i] = substr($result1[$i],0,8);
			$prot1_path[$i] = substr($result1[$i],9);
			$i++;}



			while (substr($result2[$j],0,8) != ''){
			$prot2_keggid[$j] = substr($result2[$j],0,8);
			$prot2_path[$j] = substr($result2[$j],9);
			$j++;}



			$totalpathways=0;
			if ($i > $j){
				$totalpathways = $i;}
			else{
				$totalpathways = $j;}

	/* Fetch ensembl protein id of input protein from table string_identifiers_proteins  */
	$selqryp4 = OCIParse($conn, "select protein_ensemblid from nsudhara.string_identifiers_proteins where uniprot_id = '$protein1'");
	OCIExecute($selqryp4, OCI_DEFAULT);
	while (OCIFetch($selqryp4))
	{
		$ensemblid1 = OCIResult($selqryp4, "PROTEIN_ENSEMBLID");
	}

	/* Fetch pubmed ids of input protein and insert into a view */
	$viewqry1 = OCIParse($conn, "create or replace view prot1_abstracts as select * from string_human_prot_abstracts where ensembl_proteinid like '$ensemblid1'");
	OCIExecute($viewqry1, OCI_DEFAULT);

	/* Fetch ensembl protein id of interacting protein from table string_identifiers_proteins  */
	$selqryp = OCIParse($conn, "select protein_ensemblid from nsudhara.string_identifiers_proteins where uniprot_id = '$protein2'");
	OCIExecute($selqryp, OCI_DEFAULT);
	while (OCIFetch($selqryp))
	{
		$ensemblid2 = OCIResult($selqryp, "PROTEIN_ENSEMBLID");
	}

	/* Fetch pubmed ids of interacting protein and insert into a view */
	$viewqry2 = OCIParse($conn, "create or replace view prot2_abstracts as select * from string_human_prot_abstracts where ensembl_proteinid like '$ensemblid2'");
	OCIExecute($viewqry2, OCI_DEFAULT);

	$disqry = OCIParse($conn, "select * from prot1_abstracts, prot2_abstracts where prot1_abstracts.abstract_id = prot2_abstracts.abstract_id");
	OCIExecute($disqry, OCI_DEFAULT);
	OCIFetch ($disqry);
	$pubmed_id = OCIResult($disqry, "ABSTRACT_ID");

	/* Fetch ncbi geneid for gene symbols of interacting proteins */
	$prot1_gene_mod = explode(";", "$prot1_gene");
	$viewqry3=OCIParse($conn, "select ncbi_gene_id from curation9.vw_swissprot_all_gene_all_map where hgnc_symbol like '%$prot1_gene_mod[0]' and rownum = 1");
	OCIExecute($viewqry3,OCI_DEFAULT);
	OCIFetch ($viewqry3);
	$ncbi_geneid1 = OCIResult($viewqry3, "NCBI_GENE_ID");

	$prot2_gene_mod = explode(";", "$prot2_gene");
	$viewqry4=OCIParse($conn, "select ncbi_gene_id from curation9.vw_swissprot_all_gene_all_map where hgnc_symbol like '%$prot2_gene_mod[0]' and rownum = 1");
	OCIExecute($viewqry4,OCI_DEFAULT);
	OCIFetch ($viewqry4);
	$ncbi_geneid2 = OCIResult($viewqry4, "NCBI_GENE_ID");
	?>

	<table style="border:1px solid plum; border-collapse: collapse;" width=70% align="center" cellpadding="0" cellspacing="0" border="0">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>&nbsp;&nbsp;<font><strong>Interactions</strong></font></td>
	</tr>
	<tr>
		<td width=5%>&nbsp;</td>
		<td valign=top width=45%>
		<?php echo "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresult3.php?protein=$protein1'>".$protein1."</a>"; ?>
		</td>

		<td valign=top width=45%>
		<?php echo "<a href='http://discover.uits.indiana.edu:8340/ProteinInteractions/proteinresult3.php?protein=$protein2'>".$protein2."</a>"; ?>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>&nbsp;&nbsp;<font><strong>Descriptions</strong></font></td>
	</tr>
	<tr>
		<td width=5% valign=top>&nbsp;
		<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/uniprot.jpg' width=70 height=24 border=0>
		</td>

		<td valign=top width=48%>
		<?php echo $prot1_desc; ?>
		</td>

		<td valign=top width=47%>
		<?php echo $prot2_desc; ?>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>&nbsp;&nbsp;<font><strong>Genes</strong></font></td>
	</tr>
	<tr>
		<td width=5%>&nbsp;
		<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/ncbi.gif' width=70 height=24 border=0>
		</td>
		<td valign=top width=48%>
		<?php echo "<a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?db=gene&cmd=Retrieve&dopt=full_report&list_uids=$ncbi_geneid1'>".
		$prot1_gene."</a>"; ?>
		</td>

		<td valign=top width=47%>
		<?php echo "<a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?db=gene&cmd=Retrieve&dopt=full_report&list_uids=$ncbi_geneid2'>".
		$prot2_gene."</a>"; ?>
		</td>
	</tr>

	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>&nbsp;&nbsp;<font><strong>Co-citation</strong></font></td>
	</tr>
	<tr>
		<td width=5% valign=top>&nbsp;
		<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/pubmed_rose.jpg' width=70 height=24 border=0>
		</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=pubmed&dopt=Abstract&list_uids=$pubmed_id'>".
		 $pubmed_id."</a>"; ?>
		</td>

		<td valign=top width=47%>
		<?php echo "<a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Retrieve&db=pubmed&dopt=Abstract&list_uids=$pubmed_id'>".
		$pubmed_id."</a>"; ?>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>&nbsp;&nbsp;<font><strong>Pathways</strong></font></td>
	</tr>

	<?php $k=0;
	while ($totalpathways > $k){?>

	<tr>
                <?php if ($k == 0){ ?>
                <td width=5% valign=top>&nbsp;
		<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/kegg.gif' width=70 height=24 border=0>
		</td> <?php } else { ?>
		<td width=5% valign=top>&nbsp;</td> <?php } ?>

		<td valign=top width=48%>
		<?php echo "<a href='http://www.genome.ad.jp/dbget-bin/show_pathway?$prot1_keggid[$k]+3630'>".substr($result1[$k],9)."</a>"; ?>
		</td>

		<td valign=top width=47% >
		<?php echo "<a href='http://www.genome.ad.jp/dbget-bin/show_pathway?$prot2_keggid[$k]+3630'>".substr($result2[$k],9)."</a>"; ?>
		</td>
	</tr> <?php $k++; } ?>

	<? if ($totalpathways == 0){ ?>
		<td width=5% valign=top>&nbsp;
		<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/kegg.gif' width=70 height=24 border=0>
		</td>

		<td valign=top width=48%>None</td>

		<td valign=top width=47% >None</td>
		<?php } ?>

	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>&nbsp;&nbsp;<font><strong>Domains/Families</strong></font></td>
	</tr>

	<?php if (($domaindesc11 != NULL) OR ($domaindesc21 != NULL)) {?>

	<tr>
		<td width=5%>&nbsp;
		<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/pfam.gif' width=70 height=24 border=0>
		</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid11'>".$domaindesc11."</a>" ;?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid21'>".$domaindesc21."</a>" ;?>
		</td>
	</tr>
	<?php }

	if (($domaindesc12 != NULL) OR ($domaindesc22 != NULL)) {?>
	<tr>
		<td width=5%>&nbsp;</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid12'>".$domaindesc12."</a>" ;?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid22'>".$domaindesc22."</a>" ;?>
		</td>
	</tr> <?php }

	if (($domaindesc13 != NULL) OR ($domaindesc23 != NULL)){ ?>
	<tr>
		<td width=5%>&nbsp;</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid13'>".$domaindesc13."</a>" ;?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid23'>".$domaindesc23."</a>" ;?>
		</td>
	</tr>  <?php }

	if (($domaindesc14 != NULL)OR ($domaindesc24 != NULL)) { ?>
	<tr>
		<td width=5%>&nbsp;</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid14'>".$domaindesc14."</a>" ;?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid24'>".$domaindesc24."</a>"; ?>
		</td>
	</tr> <?php }

	if (($domaindesc15 != NULL) OR ($domaindesc25 != NULL)) { ?>
	<tr>
		<td width=5%>&nbsp;</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid15'>".$domaindesc15."</a>"; ?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid25'>".$domaindesc25."</a>"; ?>
		</td>
	</tr><?php }

	if (($domaindesc16 != NULL) OR ($domaindesc26 != NULL)) { ?>
	<tr>
		<td width=5%>&nbsp;</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid16'>".$domaindesc16."</a>";?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid26'>".$domaindesc26."</a>";?>
		</td>

	</tr><?php }

	if (($domaindesc17 != NULL) OR ($domaindesc27 != NULL)) { ?>
	<tr>
		<td width=5%>&nbsp;</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid17'>".$domaindesc17."</a>"; ?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid27'>".$domaindesc27."</a>" ;?>
		</td>
	</tr><?php }

	if (($domaindesc18 != NULL) OR ($domaindesc28 != NULL)) { ?>
	<tr>
		td width=5%>&nbsp;</td>
		<td width=48% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid18'>".$domaindesc18."</a>";?>
		</td>

		<td width=47% valign=top>
		<?php echo "<a href='http://www.sanger.ac.uk/cgi-bin/Pfam/getacc?$domainid28'>".$domaindesc28."</a>"?>
		</td>
	</tr><?php }?>
	<tr><td>&nbsp;</td></tr>

	<tr>
			<td>&nbsp;&nbsp;<font><strong>Structures</strong></font></td>
		</tr>
		<tr>
			<td width=5% valign=top>&nbsp;
			<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/pdblogo.gif' width=70 height=24 border=0>
			</td>

			<td valign=top width=48%>
			<?php echo "put your code here for pdb structure of protein1"; ?>
			</td>

			<td valign=top width=47%>
			<?php echo "put your code here for pdb structure of protein2"; ?>
			</td>
		</tr>

<tr><td>&nbsp;</td></tr>
	<tr>
			<td>&nbsp;&nbsp;<font><strong>SequenceMapping</strong></font></td>
		</tr>
		<tr>
			<td width=5% valign=top>&nbsp;
			<img src='http://discover.uits.indiana.edu:8340/ProteinInteractions/images/safmap.gif' width=100 height=24 border=0>
			</td></tr>

		<tr>

			<td valign=top width=48%><strong>
			<?php echo $protein1; ?></strong>
			</td>

			<td>
			<img src='http://discover.uits.indiana.edu:8340/cgi-bin/genetool/visualization.pl?5'>
			</td>

		</tr>

	<tr><td>&nbsp;&nbsp;</td></tr><br>
		<tr>

					<td valign=top width=48%><strong>
					<?php echo $protein2; ?></strong>
					</td>
		</tr>

	<tr><td>&nbsp;</td></tr>
</table>

<p>&nbsp;</p>
<?php } ?>

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