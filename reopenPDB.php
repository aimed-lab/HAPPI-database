<?php
include "/ip/biokdd/www/ProteinInteractions/dbconnect.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<title>HAPPI Database</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="AUTHOR" content="Jake Chen">
	<meta name="PUBLISHER" content="Jake Chen">
	<meta name="description" content="Everything You need to know About human proteins, interactions, domains, functional annotations">
	<meta name="keywords" content="Bioinformatics, Jake Chen, Systems Biology, Proteomics, Protein Interactomics,Domains, Sudharani Mamidipalli">
	<script type="text/javascript" src="/js/iframes.js"></script></head>

<body bgColor=white >

	<?php

	$pdbid=$_GET['pdbid'];
	$ptype=$_GET['type']; // must be either a or b
	$myFile = "pdb".$ptype.".pdb";	?>
<p>        Loading Structure, please wait... (When done, click the graph to activate controls.)</p>
    <h1><center><?php echo $pdbid; ?> </center></h1>
    <?php
				//qry attempt
				if ( ! fopen ($myFile, 'r') ) {
				//echo "recreating file...";
				$stmt=OCIParse($conn,"select STUCTURE  from PDB.PDBSTR WHERE PDBID='$pdbid'");

				OCIexecute($stmt);
				while ( OCIFetch($stmt))
					{ $lob = OCIResult($stmt,1);
						$pdbstr = $lob->load();
					}

				OCIFreeStatement($stmt);

				$pdbstr = str_replace("|", "\n", $pdbstr);

					$fh = fopen($myFile, 'w') or die("can't open file");
					fwrite($fh, $pdbstr  );
					fclose($fh);
				}
				?>
        <applet name='jmol' code='JmolApplet' archive='JmolApplet.jar' width='650'
					height='630' align='center'>
          <param name='load'    value='<?php echo $myFile ?>'>
          <param name='progressbar' value='true' />
          <param name='bgcolor' value='black'/>
          <param name='script' value='cartoons; color cartoon yellow; spin off' />
      </applet>


</body>
</html>