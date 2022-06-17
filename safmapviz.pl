#!/usr/bin/perl
#$ENV{'ORACLE_HOME'} = "/opt/oracleg/product/10.2.0";


use DBI;
use CGI;

print "Content-type: text/html\n";

print "\n";

#retrieve query string information
if($ENV{'REQUEST_METHOD'} eq "GET"){	
	$query = $ENV{'QUERY_STRING'};	
}
#print "\t", $query, "\n";
my ($pid, $protein) = split ('=', $query);
#$protein2 = substr($protein2, 9,length($protein2) - 9 );
#print "After splitting... ", "\t", $protein, "\n";

$user     = "web_access";
$passwd   = "web10g";
$dbname   = "BIO10G2";
$dbserver = "libra45.uits.iu.edu";
$port     = "1521";
$connection_string =   "DBI:Oracle:host=$dbserver;sid=$dbname;port=$port";

$ENV{'ORACLE_HOME'} = '/opt/oracleg/product/10.2.0';
#$ENV{'NLS_LANG'} = 'AMERICAN_AMERICA.WE8ISO8859P1';

$dbh = DBI->connect( $connection_string,
                         $user, $passwd,
                         {RaiseError =>1, LongReadLen=>100000,
                          LongTruncOk=>0}) || die "Couldn't open $dbname: $DBI::errstr\n";


#Retrieve TARGET_LENGTH LOCUSLINK_ID and REFSEQ_ID	
$query1 = qq{select REFSEQ_NM, MRNA_LENGTH, LOCUSLINK_ID from CURATION9.VW_UNIPRT_NM_GENE_LOCUS_MAP where UNIPROT_ID = '$protein'};
$sth2 = $dbh->prepare($query1);
$sth2->execute();

@row2 = $sth2->fetchrow();
$refseq_id = $row2[0];
$target_length = $row2[1];
$locuslink_id = $row2[2];
 $sth2->finish();	  	


#Retrieve features
$query = "select BEGIN_1, END_1, BEGIN_OP, QUALIFIER_STRING_VALUE, FEATURE_TYPE_NAME, QUALIFIER_TYPE_NAME
			  from SEQBANK9.SEQ_MISC_FEATURE_ALL
			  where REFSEQ_ID = '$refseq_id' and END_1 is not null
			  order by BEGIN_1";
$sth = $dbh->prepare("$query");
$sth->execute();
$feature_number = 0;
$only = 0;
$special = "AAA_CDS_AAA";
while(@row = $sth->fetchrow()){	
	if($row[2] eq ""){
		$row[2] = "null";
	}		
	
	if($row[4] eq "CDS"){		
		if($row[5] eq "translation"){
			next;
		}
		$cds_feature .= "<tr><td align=right valign=top width=90>$row[5]: </td><td valign=top>$row[3]</td></tr>";
		if($only){
			next;	
		}
		else{
			$only = 1;	
			$feature_number++;			
			$all_feature .= "$row[0]#$row[1]#$row[2]#$special#AAA_CDS#AAA_CDS*";
			next;
		}
	}
	
	if($row[0] != 1 && $row[2] != $target_length){
		$feature_number++;		
		$all_feature .= "$row[0]#$row[1]#$row[2]#$row[3]#$row[4]#$row[5]*";
	}	
	else{
		$full_feature .= "<tr><td align=right valign=top>$row[4], $row[5]: </td><td valign=top>$row[3]</td></tr>";	
	}	
}
if($full_feature){
	$full_feature = "<table>$full_feature</table>";	
}

$pos = index($all_feature, $special);
if($pos != -1){
	substr($all_feature, $pos, length($special)) = $cds_feature;
}

#header of HTML
print("<head>
	   <title>Visual Blast</title>	   
	   </head>");
		
#body of HTML
print("<body text=\"#000000\" leftmargin=\"0\" marginwidth=\"0\">
		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#000000\">
		  <tr>
			<td>
			  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#FFFFFF\">
				<tr> 
				  <td>");
	
	
print("</td>
		</tr>
		<tr>
		<td>");
	
		
print("</td>
		</tr>
		<tr>
		  <td>");  
		  		  
#####Blast Result 

#print "		
#<br>  
#<p align='center'><font face='Verdana, Arial, Helvetica, sans-serif' size='2'><b>
#	Visualization of Sequence Read Mapper</b></font><br><br>
#	<table width = 750><tr><td><font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
#	<font color=blue>Note:</font> If you cannot see the figure below, <a href='http://java.sun.com/j2se/1.4.2/download.html'>click here</a> to download and install Java Runtime Environment.
#	After installation, open an IE window, Tools -> Internet Options... -> Advanced -> Java (Sun), check \"Use Java 2 v1.4.2 for applet (required restart)\", and then restart your browser.
#	</font><br><br></td></tr></table>
#";

#Set up width and height of DIV and APPLET
$width = 772;
$divWidth = $width + 18;

$height = $feature_number * 27 + 20 + 110;
$divHeight = $height + 6;
if($divHeight > 500){
	$divHeight = 500;
}		
	           
$targetHeight = $feature_number * 20 + 20 + 15 + 15 + 10;
if($targetHeight < 38){
	$targetHeight = 38;
}
$targetDivHeight = $targetHeight + 7;

print "
<table width='100%' border='0' cellpadding='5' align='center'>	
<tr>
<td align='center'>
	<div style='overflow: auto; width: $divWidth; height: $targetDivHeight; 
	            border-left: 1px black solid; border-right: 1px black solid; border-top: 1px black solid; border-bottom: 1px black solid;
	            padding:0px; margin: 0px' align='left' valign='bottom'>
		<applet name='Target' code='Target.class' codebase='http://discover.uits.indiana.edu:8340/genetool/web/applet/' width='$width' height='$targetHeight'>	         			
			<param name='type' value='clean'>
			<param name='target_length' value='$target_length'>
			<param name='locuslink_id' value='$locuslink_id'>
			<param name='refseq_id' value='$refseq_id'>
			<param name='all_feature' value=\"$all_feature\">
			<param name='full_feature' value='$full_feature'>
			<param name='all_content' value='$all_content'>		
		</applet> 
	</div>
	
</td>
</tr>
</table><p>
";

#Close this window button
#print "
#	<div align='center'>
#		<input type='button' value='Close This Window' onClick='self.close();'>		
#	</div>
#";


#print "<p>";
			  
print("</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>");		
		
					  				
print("</body>");
