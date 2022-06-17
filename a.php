<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

	<title>Human Protein Interactions</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	

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
	   <font color=white face="Verdana, Arial, Helvetica, sans-serif" size="4">Human Protein Interactor</font>
	 </td>
	</tr>
    </table>

	<br><br>

<?php

/* Connect to BIO10G database */
$db =  "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)
	(HOST = inquire-g.uits.indiana.edu)(PORT = 1522)) ) (CONNECT_DATA = (SID = BIO10G) ) )"; 




    if ($conn=OCILogon("schiluku","sai",$db)){
       	   echo "<B>SUCCESS ! Connected to BIO10G database<B>\n"; 
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

$myFile = "pdbfile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");




$protein=$_GET["protein"];
strtoupper($protein);

//qry attempt
$countqry1=OCIParse($conn,"select PDBID  from UNIPDB WHERE UNIPROTID='$protein'");
				OCIExecute($countqry1,OCI_DEFAULT);
				while (OCIFetch($countqry1)){
					$pdbstr= OCIResult($countqry1,"PDBID");
echo $pdbstr;
echo "<&nbsp>";
echo $protein;
				}






fwrite($fh, $pdbstr  );

fclose($fh); 

?>


<applet name="jmol" code="JmolApplet" archive="JmolApplet.jar"
	width="350" height="350" align="center">
	<param name="load"    value="buzz\<?php echo $pdbstr ?>.pdb">
	<param name='progressbar' value='true' /> 
	<param name="bgcolor" value="navy"/>
	<param name="script" value="cartoons; color cartoon yellow; spin on" />
       
	


	
	
        </applet>

	</body>
      </html>