<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>About Us</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <!--<link href="jquery/development-bundle/themes/blitzer/jquery.ui.all.css" rel="stylesheet" />

        <link href="jquery/development-bundle/themes/blitzer/jquery.ui.all.css" rel="stylesheet" />-->
        <!--[if !IE 7]>
        <style type="text/css">
		#container {display:table;height:100%}
	</style>
    <![endif]-->
    </head>
    <body>
        <?php include_once ('templates/header_template.php'); ?>
        <div id="container">
            <div id="mainContentPages">
                <div id="titleDiv">
                <h1>Acknowlegement</h1>
                </div>
                    <br/>
                <div style="padding-left: 30px;">
                <div id="acknowledge">
                    
                    <div>
                        <h2>HAPPI 2.0</h2>
                        <ul>
                            <li><b>Jake Yue Chen, Ph.D.</b> (Principle Investigator)</li>
                            <li><b>Ragini Pandey </b>(Database design, Web user interface design, data integration, HAPPI update )</li>
                            <li><b>Thanh Nguyen </b>(HAPPI data evaluation)</li>
                            <li><b>Zongliang Yue </b>(Site maintenance and technical support)</li>
                        </ul>
                        <br/>
                        <h2>HAPPI 1.0</h2>
                        <ul>
                            <li><b>Jake Yue Chen, Ph.D.</b> (Principle Investigator)</li>
                            <li><b>SudhaRani Mamidipalli </b>(Database design)</li>
                            <li><b>Tianxiao Huan </b>(HAPPI data evaluation)</li>
                        </ul>
                    </div>
                    <div>
                    <p>We would also like to thank the generous grant support from Indiana University - Purdue University Indianapolis,
                        and technical assistance from Indiana University High-performance Computing Group. We especially thank
                        Stephanie Burks and Nancy Long for providing Oracle 10g database administrator assistance, and
                        Joe Rinkovsky for configuring the Web server for us. We also thank Basil George for configuring PDB structure GUI
                        integration.</p>
                    </div><br/>
                </div>
                <div>
                		<h2>Citation HAPPI 2.0</h2>
                    <a href="https://bmcgenomics.biomedcentral.com/articles/10.1186/s12864-017-3512-1" target="_blank"><p><cite><b>Jake Y. Chen, Ragini Pandey, and Thanh Nguyen (2017) HAPPI-2: a Comprehensive and High-quality Map of Human Annotated and Predicted Protein Interactions,</b><i> BMC Genomics, 18(1):182. doi: 10.1186/s12864-017-3512-1.</i></cite></p></a>
                    
                    <h2>Old Version:</h2>
                    <a href="http://bmcgenomics.biomedcentral.com/articles/10.1186/1471-2164-10-S1-S16" target="_blank"><p><cite><b>Jake Y. Chen, SudhaRani Mamidipalli, and Tianxiao Huan (2009) HAPPI: an Online Database of Comprehensive Human Annotated and Predicted Protein Interactions,</b><i> BMC Genomics, Vol. 10, Suppl 1: S16</i></cite></p></a>

                    <h2>Contact</h2>
                    <p>Please email to Dr. Jake Chen, <a href="mailto:jakechen@uab.edu">jakechen@uab.edu </a>, should you have questions or comments about the database.</p>
                </div>
            </div>
            </div>
        </div>
        <?php include_once ('templates/footer_template.php'); ?>
    </body>
</html>
