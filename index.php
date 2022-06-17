<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="AUTHOR" content="Ragini pandey"/>
        <meta name="PUBLISHER" content="Ragini pandey"/>
        <meta name="description" content="Everything You need to know About human proteins, interactions, domains, functional annotations"/>
        <meta name="keywords" content="Bioinformatics, Jake Chen, Systems Biology, Proteomics, Protein Interactomics,Domains"/>
        <title>HAPPI</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favion.ico" type="image/x-icon" />

        <!--<link href="jquery/development-bundle/themes/ui-darkness/jquery.ui.all.css" rel="stylesheet" />-->
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery.cycle.all.js"></script>
        <script type="text/javascript"  src="jquery/jquery-ui-1.9.2/js/jquery.bgiframe-2.1.2.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.mouse.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.button.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.draggable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.tabs.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.position.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.resizable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.effects.core.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#queryForm').submit(function() {

                    var searchValue = $('#searchProtein').val();
                    if (searchValue == 'example:- INS_HUMAN Or INS or DNA' || searchValue == '') {
                        return false;
                    }
                    return true;
                });
                $('#searchProtein').focus(function() {
                    if ($(this).val() == 'e.g., BRCA1 or DNA repair') {
                        $(this).val("");
                    }
                });
                $("#search_help_dialog").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 550,
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $(this).dialog("close");
                        }
                    }
                });
                $("#search_help_image")
                        .click(function() {
                            $("#search_help_dialog").dialog("open");
                        });


                $('.slideshow').cycle({
                    fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
                });
            });

        </script>  
    </head>
    
<body>
	<?php
    $myFile = "subpages/all-searched-happi-interactions.txt";
    if (file_exists($myFile)) {
        unlink($myFile);
    }
    ?>
    <?php include_once('templates/header_template.php'); ?>
   <?php
                    if (isset($_SESSION['searchedInteractions'])) {
                        unset($_SESSION['searchedInteractions']);
                    }
    ?>  
<div id="indexContainer">

    <div id="indexContent">
       
      <div class="slideshow">
        <p>HAPPI database v2.0 contains 640,798 physical and functional human protein-protein interactions, perfect for network biology and network medicine studies.</p>
        <p>In HAPPI, each protein interaction is given a physical binding confidence rating between 1 and 5, based on our computerized assessment.</p>
        <p>In HAPPI, you can personalize the searches by adding personal annotation notes and
        saving results for the future.</p>
        <p>As a HAPPI user, you can build and save customized list of PPIs for future analysis.</p>
      </div>
      
    </div>
 
    <div id="homeSearchBar">
        <div id="homeSearchBarContent">

              <div id="homeSearchBarSearch">
              <p>Enter a gene/protein's ID or its descriptions</p>
                <div id="searchField">
                        <form id="queryForm" action="basic_search.php" style ="margin-top: 0em;" method="post">
                     	  <div class="searchFieldText"> 
                            <input 
                            type="text" 
                            name="searchProtein" 
                            id="searchProtein" 
                            style="color: grey; margin-left: 20px; height: 30px; width:350px" 
                            value="e.g., BRCA1 or DNA repair" 
                            onfocus="this.value='';"/>
  					      </div>
                          <div class="searchFieldImg"> 
                            <input 
                            type="image" 
                            name="submitSearchBtn" 
                            id="submitSearchBtn" 
                            src="images/search.png" 
                            alt="Submit"  
                            width = "50"
                            height="30"/>
                          </div>
                         </form>
                     <p> 
                       <a href='advSearch.php'><b style="color:whitesmoke;float: right;padding-top: 8px; font-size:11px">Go Advanced</b></a>
                     </p>
                  </div>
                </div>
         
          </div>
       </div>
  
</div>
        
        <?php include_once 'templates/footer_template.php'; ?>
</body>
</html>



