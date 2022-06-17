 <?php
    $db="(DESCRIPTION =
		(ADDRESS = (PROTOCOL = TCP)(HOST = watson.informatics.uab.edu)(PORT = 1521))
		(CONNECT_DATA =
			(SID = BIODB)
		)
	)";/*SERVICE_NAME=orcl*/
    $conn='';
    
    if ($conn= ocilogon("HAPPI2","happi2014",$db)){
      	   #echo "<B>SUCCESS ! Connected to BIO10G database<B>\n";
           return $conn;
    }
    else{
	   $err = OCIError();
  	   var_dump($err);
           print "\nError code = "     . $err[code];
  	   print "\nError message = "  . $err[message];
  	   print "\nError position = " . $err[offset];
       	   print "\nSQL Statement = "  . $err[sqltext];
    	   echo "<B>Failed :-( Could not connect to BIO11g database:<B>\n";
    	   exit();
    }?>
	
