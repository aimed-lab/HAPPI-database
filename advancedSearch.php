<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Advanced Search</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <!--[if !IE 7]>
        <style type="text/css">
		#container {display:table;height:100%}
	</style>
    <![endif]-->
        <!--<link href="jquery/development-bundle/themes/ui-darkness/jquery.ui.all.css" rel="stylesheet" />-->
        <link href="jquery/development-bundle/themes/blitzer/jquery.ui.all.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" src="jquery.bgiframe-2.1.2.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.mouse.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.button.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.draggable.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.position.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.resizable.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" src="jquery/development-bundle/ui/jquery.effects.core.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){

                $( "#adv_search_help_dialog" ).dialog({
                    autoOpen: false,
                    height:250,
                    width:450,
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
                $("#search_help_image").click(function() {
                    $( "#adv_search_help_dialog" ).dialog( "open" );
                });
            });
        </script>
    </head>
    <body>
        <div id="adv_search_help_dialog" title="Advanced Search Help" style="font-size:1em">
            <p style="font-size:.8em">
                Please select the type of id to search and then enter the values. The values
                could be single or delimited by comma/semicolon.<br/>
                Users can also upload the file with the ids seperated by line breaks.
            </p>
        </div>
        <?php include_once 'templates/header_template.php'; ?>
        <div id="container">
            <div id="mainContentPages" >
                <div id="advForm">
                    <form name="advSearchForm"  method="post" enctype="multipart/form-data" action="searchResults.php">
                        <fieldset style="border: solid; border-width:1px;">
                            <legend style="color: maroon; font-weight: bold;">Advanced Search <img id="search_help_image" src="images/Help_question_red.png" alt="Help" style="height:15px; vertical-align:middle" /></legend>
                            <label for="ddIdSelect">Input Id Type:</label>
                            <select name="ddIdSelect" id="ddIdSelect" >
                                <option selected value="">Please select the id type</option>
                                <option value="uniprotID" >Uniprot Id</option>
                                <option value="gName" >Gene Name</option>
                                <option value="geneID" >Gene Id</option>
                                <option value="swissID" >Swissprot id</option>
                                <option value="goID" >GO Id</option>
                            </select>
                            <span id="showExample" class="red" ></span><br/>
                            <label for="idTypeText">Input Id:</label>
                            <input type="text" name="idTypeText" id="idTypeText" />
                            <br/>
                            <label for="file">Choose a file to upload:</label>
                            <input type="file" name="file" id="file" size="20"/>
                            <input type="button" value="File format"  />
                            <input type='reset' value='Reset' style='margin-top:30px; width:80px; float:right'/>
                            <input type="submit" value="Enter" style="margin-top: 30px; float: right; margin-right: 5px; padding-right: 20px" />

                        </fieldset>
                    </form>
                </div>                
            </div>

        </div>
        <?php include_once 'templates/footer_template.php'; ?>
    </body>
</html>
