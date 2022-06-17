

<html>
	<title>Example 2</title>
	<body> 
<?php

/* Connect to BIO10G database */
$db =  "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)
	(HOST = inquire-g.uits.indiana.edu)(PORT = 1522)) ) (CONNECT_DATA = (SID = 

BIO10G) ) )"; 




    if ($conn=OCILogon("pdb","d3structure",$db))
	{
       	   //echo "<B>SUCCESS ! Connected to BIO10G database<B>\n"; 
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



/*
*/
$protein1=$_GET["protein1"];
strtoupper($protein1);

$stmt1=OCIParse($conn,"select PDBID  from UNIPDB WHERE UNIPROTID='$protein1'");
				OCIExecute($stmt1,OCI_DEFAULT);
if (OCIFetch($stmt1))
{$pdbid= OCIResult($stmt1,"PDBID");}
OCIFreeStatement($stmt1);

//qry attempt
$stmt=OCIParse($conn,"select STUCTURE  from PDBSTR WHERE PDBID='$pdbid'");

OCIexecute($stmt);

    /*IF ( $row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_LOBS) ) 
    {$pdbstr=$row['STUCTURE'];}*/
 while ( OCIFetch($stmt)) 
      { 
       
         
        $lob = OCIResult($stmt,1);
        
        $pdbstr = $lob->load();
       }
   
    
OCIFreeStatement($stmt);
  

$pdbstr = str_replace("|", "\n", $pdbstr);
print $pdbstr ;
print "done";


writefile($pdbstr, 'a');

writehtml();






?>

<?php
function writefile($pdbstr, $flag_ab)
  {  $myFile = "pdb".$flag_ab.".pdb";
     $fh = fopen($myFile, 'w') or die("can't open file");
     fwrite($fh, $pdbstr  );
     fclose($fh); 
  }
?>

<?php
function writehtml()
{
 print("<applet name='jmol' code='JmolApplet' archive='JmolApplet.jar'width='350' 
      height='350' align='center'>
      <param name='load'    value='pdba.pdb'>
      <param name='progressbar' value='true' /> 
      <param name='bgcolor' value='navy'/>
      <param name='script' value='cartoons; color cartoon yellow; spin on' />");
}
?>

	</body>
</html>