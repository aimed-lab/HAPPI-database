<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <!--[if !IE 7]>
        <style type="text/css">
                #container {display:table;height:100%}
        </style>
        <![endif]-->
        <link href="jquery/development-bundle/themes/blitzer/jquery.ui.all.css" rel="stylesheet" />
        <title>Advanced Search</title>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript"  src="jquery/jquery-ui-1.9.2/js/jquery.bgiframe-2.1.2.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.mouse.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.button.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.draggable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.position.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.resizable.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.effects.core.js"></script>

        <script>
            $(document).ready(function() {
                $('#advSearchForm').submit(function() {
                    var errortxt = '';
                    var ddIdSelectValue = $('#ddIdSelect').val();
                    var idTextValue = $('#idText').val();
                    var fileValue = $('#file').val();
                    var interValue = $('#inter').val();
                    if ((fileValue === '') && (idTextValue === '')) {
                        errortxt = errortxt + "Please either enter Ids or upload a comma seperated Id file.<br>";
                    }
                    if (ddIdSelectValue === '') {
                        errortxt = errortxt + "Please select the id type.<br>";

                    }
                    if (interValue === '') {
                        errortxt = errortxt + "Please select the interaction type.<br>";

                    }
                    if (errortxt !== '') {
                        $("#statusdiv").html(errortxt);
                        return false;
                    }
                    return true;
                });

                $("#adv_search_help_dialog").dialog({
                    autoOpen: false,
                    height: 250,
                    width: 450,
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $(this).dialog("close");
                        }
                    }
                });
                $("#search_help_image").click(function() {
                    $("#adv_search_help_dialog").dialog("open");
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
                <div id="titleDiv">
                    <h2>Advanced Search</h2>
                </div>
                <div id="advForm">
                    <div>
                        <i style="font-size: 14px;">**Filters are preferred for faster results**.</i>
                    </div>
                    <br/><br/>
                    <div id="statusdiv" class="error"> </div>
                    <form name="advSearchForm" id="advSearchForm"  method="post" enctype="multipart/form-data" action="advSrcResults.php">
                        <div>
                            <label for="ddIdSelect" class="formlabel">Id Type:</label>
                            <span style="color:red;"><select name="ddIdSelect" id="ddIdSelect" class="advSearchFormTextbox" style="width:170px;">
                                    <option selected value="">Select Id type</option>
                                    <option value="uniprotID" >Uniprot Id</option>
                                    <option value="swissID" >Uniprot Accession No</option>
                                    <option value="genesymbl" >Gene Symbol</option>
                                </select><b style="padding-left:10px;">*</b></span>
                        </div>
                        <span id="showExample" class="red" ></span><br>
                        <div>
                            <i style="padding-left: 20px;">Please provide a comma separated list for Input Id.<br/> Upto 1000 id's could be entered for within interactions.</i><br/><br/>
                            <label for="idText" class="formlabel">Input Id:</label>
                            <textarea name="idText" id="idText" cols="41" rows="15"></textarea>
                        </div>
                        <br>
                        <h4 style="padding-left: 130px;">OR</h4><br>
                        <div>
                            <label for="file" class="formlabel">Upload File:</label>
                            <input type="file" name="file" id="file" class="advSearchFormTextbox"/>
                        </div>
                        <br><br><br>
                        <div>
                            <b>Select interactions to be retrieved</b><br/>
                            <input type="radio" name="inter" value="within">Interactions only within the input proteins<br>
                            <input type="radio" name="inter" value="other">All Interactions
                        </div>
                        <br><br><br>
                        <div>
                            <b>Filter by Rank</b><br/>

                            <input type="radio" name="rankSelect" value="5star">5 Star<br>
                            <input type="radio" name="rankSelect" value="4star">4 Star<br>
                            <input type="radio" name="rankSelect" value="3star">3 Star<br>
                            <input type="radio" name="rankSelect" value="2star">2 Star<br>
                            <input type="radio" name="rankSelect" value="1star">1 Star<br>


                            <div>
                                <input type="submit" value="Search" style="margin-top: 30px; margin-right: 5px; padding-right: 50px" />
                                <input type='reset' value='Cancel' style='margin-top:30px; width:80px; '/>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
        <?php include_once 'templates/footer_template.php'; ?>
    </body>
</html>
