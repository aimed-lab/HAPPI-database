  <?php
    $db="(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = inquire-g.uits.indiana.edu)(PORT = 1522)) ) (CONNECT_DATA = (SID = BIO10G) ) )";
    if ($conn=OCILogon("nsudhara","nsudhara",$db)){
       	 //  echo "<B>SUCCESS ! Connected to BIO10G database<B>\n";
    }
    else{
	   $err = OCIError();
  	   var_dump($err);
           print "\nError code = "     . $err[code];
  	   print "\nError message = "  . $err[message];
  	   print "\nError position = " . $err[offset];
       	   print "\nSQL Statement = "  . $err[sqltext];
    	   echo "<B>Failed :-( Could not connect to BIO10G database:<B>\n";
    	   die();
    }
		

		/* Fetch description and accession number of user input protein from human_protein_uniprot table */

		$countqry = OCIParse($conn, "select distinct sp_trembl_id, sp_trembl_id2, a.hgnc_symbol, ncbi_gene_id,refseq_nm from from vw_swissprot_all_gene_all_map a, vw_genesym_refseqnm_map b where a.hgnc_symbol = b.hgnc_symbol");
		OCIExecute($countqry, OCI_DEFAULT);
		OCIFetch($countqry);
		     $descresults = OCIResult($countqry, "REFSEQ_NM");
		echo $descresults;

		

	?>
