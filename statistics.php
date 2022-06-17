<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>HAPPI Statistics</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <!--[if !IE 7]>
        <style type="text/css">
		#container {display:table;height:100%}
	</style>
    <![endif]-->
    </head>
    <body>
        <?php include_once 'templates/header_template.php'; ?>
        <div id="container">
            
            <div id="mainContentPages">
                <div>
                    <h2>Current Statistics of HAPPI database: </h2>
                    <table id="dataTable" align="center">
                        <thead>
                            <tr>
                                <th>Interaction Data</th>
                                <th>HAPPI 1.0</th>
                                <th>HAPPI 2.0</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Interactions</td>
                                <td>604,741</td>
                                <td>2,922,202</td>
                            </tr>
                            <tr>
                                <td>Interacting Proteins</td>
                                <td>13,601</td>
                                <td>23,060</td>
                            </tr>
                            <tr>
                                <td><span><img src="images/stars5-5.png" alt='5 star' height="10" width="50"/>(5-Star confidence)</span></td>
                                <td>37,754</td>
                                <td>175,476</td>
                            </tr>
                            <tr>
                                <td><span><img src="images/stars4-5.png" alt='4 star' height="10" width="50"/>(4-Star confidence)</span></td>
                                <td>33,733</td>
                                <td>167,123</td>
                            </tr>
                            <tr>
                                <td><span><img src="images/stars3-5.png" alt='3 star' height="10" width="50"/>(3-Star confidence)</span></td>
                                <td>71,036</td>
                                <td>298,149</td>
                            </tr>
                            <tr>
                                <td><span><img src="images/stars2-5.png" alt='2 star' height="10" width="50"/>(2-Star confidence)</span></td>
                                <td>189,150</td>
                                <td>854,189</td>
                            </tr>
                            <tr>
                                <td><span><img src="images/stars1-5.png" alt='1 star' height="10" width="50"/>(1-Star confidence)</span></td>
                                <td>273,068</td>
                                <td>1,427,265</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <h2>Version History</h2>
                    <p>HAPPI Database has been released into the following versions:</p>
                    <ul>
                        <li>Version 2.0 Release Date is June 30, 2014</li>
                        <li>Version 1.31 Release Date is November 18, 2009.</li>
                        <li>Version 1.3 Release Date is November 20, 2008.</li>
                        <li>Version 1.2 Release Date is August 10, 2006.</li>
                        <li>Version 1.1 Release Date is June 26, 2006.</li>
                        <li>Version 1.0 Release Date is May 8, 2006</li>
                    </ul>
                </div>
                <div>
                    <br/>
                    <h2>Change Log</h2>
                    <h4>Changes made in version 2.0:</h4>
                    <ol>
                        <li>Integrated new data sources and updated the scores taking into consideration the detection methods of the interactions.</li>
                    </ol>
                    <h4>Changes made in version 1.31:</h4>
                    <ol>
                        <li>Temporarily removed all confirmed functional associations (some may be strong) and 
                            two-way interactions to keep a lean subset of data. We will add back confirmed
                            interactions in release 2.0 expected in early 2010.</li>
                    </ol>
                    <h4>Changes made in version 1.3:</h4>
                    <ol>
                        <li>General user interface improvement. Fixed broken links to external databases and improved data grid appearance.</li>
                        <li>Tuned up query performance.</li>
                        <li>Literature co-citation now supports up to 10 most relevant co-cited abstract links.</li>
                        <li>Downloadable links now supports plain text, GML, and PSI-MI formats.</li>
                    </ol>
                    <h4>Changes made in version 1.2:</h4>
                    <ol>
                        <li>Added protein interaction data source information in the protein interaction summary page.</li>
                        <li>Tuned up performance by 10x for the initial search page by re-writing Oracle SQL scripts.</li>
                        <li>Updated literature co-citation references to up to 5 instead of the original 1 entry per interaction.</li>
                    </ol>
                    <h4>Changes made in version 1.1:</h4>
                    <ol>
                        <li>Integration of SafMap - Sequence Annotated Feature Mapping Tool into HAPPI DB.</li>
                        <li>Integration of current available interaction protein's PDB Structures into HAPPI DB .</li>
                    </ol>

                </div>
                <br/>
            </div>
        </div>
        <?php include_once 'templates/footer_template.php'; ?>
    </body>
    
</html>
