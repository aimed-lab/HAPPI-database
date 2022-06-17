<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Human Protein Interactions</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            $(document).ready(function() {
                $('#frmAnnotate').submit(function() {
                    //alert("submitted");
                    var errortxt = '';
                    var directSelectValue = $('#directionSelect').val();
                    var typeSelectValue = $('#typeSelect').val();
                    var experimentValue = $('#newExperiment').val();
                    var referenceValue = $('#newReference').val();
                    var annotateProtein = $('#annotateStr').val();
                    alert(experimentValue.length);
                    //alert(experimentValue);
                    if ((directSelectValue === 'Not') && (typeSelectValue === 'Not') && (experimentValue === '') && (referenceValue === '')) {
                        errortxt = errortxt + "Please add the values to annotate.";
                    }else if(experimentValue.length > 255){
                        errortxt = errortxt + "The experiment details is more than 255 words.";
                    }
                    if (errortxt !== '') {
                        $("#statusdiv").html(errortxt);
                    } else {
                            $.post("subpages/add-new-annotation.php", {annotateProtein:annotateProtein,direction: directSelectValue, type: typeSelectValue, experiment: experimentValue, reference:referenceValue},
                            function(data) {
                                $('#statusdiv').html(data);
                            });
                        }
                    return false;
                });

                
            });
        </script>
    </head>
    <body>
        <?php
        $proteinA='';
        $proteinB='';
        $logged=false;
        
        $happiDoc=include_once 'documents-location.php';
        include_once $happiDoc.'classes/dbutility.php';
        include_once $happiDoc.'templates/header_template.php';
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['userId'])){
            $uid=$_SESSION['userId'];
        }else{
            $uid='';
        }
        if(isset($_SESSION['logged'])){
            $logged=$_SESSION['logged'];
        }else{
            $logged=false;
        }
        if(isset($_GET['PA'])){
            $proteinA=$_GET['PA'];
        }
        if(isset($_GET['PB'])){
            $proteinB=$_GET['PB'];
        }
        $proteinsStr = $proteinA."$".$proteinB;
        $dbsrc = dbutility::getDataSrc($proteinA,$proteinB);  
        $dbsrcStr=$dbsrc[0];
        $dbsrcStr=  str_replace('|', ', ', $dbsrcStr);
        $dbsrcStr=  str_replace('hap1', 'HAPPI1', $dbsrcStr);
        $dbsrcStr=  str_replace('HAPPI1_eSTR', 'HAPPI1', $dbsrcStr);
        $dbsrcStr=  str_replace('HAPPI1_pSTR', 'HAPPI1', $dbsrcStr);
        $dbsrcStr=  str_replace('HAPPI1_BIND', 'HAPPI1', $dbsrcStr);
        $pubmedAry = dbutility::getPubmed($proteinA,$proteinB); 
        $pubmedStr=  join('; ', $pubmedAry);
        //echo $pubmedStr;
        ?>
        <div id="container">

            <div id="mainContentPages" style="font-size: 0.8em">
                <div id="titleDiv">
                    <h2>Annotate Interactions</h2>
                    <?php 
                        if(!$logged){
                            echo "<p style='font-size:14px;'><i style='color:red;'>You are not currently logged in!!</i><br/><br/>
                                Please <a href='signIn.php' style='color:blue; text-decoration:underline'>LOGIN</a> OR <a href='register.php' style='color:blue; text-decoration:underline'>Register</a> to annotate interactions.</p>";
                        }
                    ?>
                    <i style='font-size:14px;'>&nbsp;&nbsp;Please add the missing annotations.</i><br/>
                    
                    <div id="statusdiv" style="color:red;font-size: 14px;"></div><br/>
                    <div id="annotateFormDiv" style="padding-left: 10px;">
                        <form id="frmAnnotate" name="frmAnnotate" action="" method="POST" >
                            <div style="font-size:13px;line-height: 2;">
                            <b>Protein A :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $proteinA;?> <br/>
                            <b>Protein B :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $proteinB;?> <br/>
                            <b>Data Source :</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dbsrcStr;?> <br/>
                            <b>Publications :</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pubmedStr;?> <br/>
                            <br/>
                            
                            <input type="hidden" id="annotateStr" value="<?php echo $proteinsStr;?>"/>
                            <b>Direction</b><br/>
                            <input type="radio" id="directionSelect" name="directionSelect"  value="Not" checked >Not Sure</input>
                            <input type="radio" id="directionSelect" name="directionSelect"  value="activation">Activation</input>
                            <input type="radio" id="directionSelect" name="directionSelect"  value="inhibition">Inhibition</input>
                                <br/>
                            <b>Interaction Mode</b><br/>
                            
                            <input type="radio" id="typeSelect" name="typeSelect"  value="Not" checked >Not Sure</input>
                            <input type="radio" id="typeSelect" name="typeSelect"  value="reaction">Reaction</input>
                            <input type="radio" id="typeSelect" name="typeSelect"  value="binding">Binding</input>
                            <input type="radio" id="typeSelect" name="typeSelect"  value="expression">Expression</input>
                            <input type="radio" id="typeSelect" name="typeSelect"  value="catalysis">Catalysis</input>
                                <br/><br/>

                            <b>New Experiment Details</b><br/>
                            <textarea id="newExperiment" cols="25" rows="4"> </textarea><br/><br/>
                            <b>New Pubmed Reference</b><br/>
                            <i>http://www.ncbi.nlm.nih.gov/pubmed/</i><input id="newReference" type="text" size="10" /><br/>

                            </div><br/>
                            <div style="margin-top: 10px;" >
                                    <input id="btnAddReference" name="btnAddReference" type="submit" value="Save" style="" />
                                    <input id="btnReset" type="reset" value="Reset" style="" />
                            </div>
                         </form>
                    </div>

                    
                </div>
            </div>
        </div>
        <?php include_once $happiDoc.'templates/footer_template.php'; ?>
    </body>
</html>
