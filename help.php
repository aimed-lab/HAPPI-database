<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Help</title>
        <link href="stylesheets/basic.css" rel="stylesheet" type="text/css" />
        <!--[if !IE 7]>
        <style type="text/css">
		#container {display:table;height:100%}
	</style>
    <![endif]-->
        <!--<link rel="stylesheet" href="jquery/development-bundle/themes/ui-darkness/jquery.ui.all.css">-->
        <link href="jquery/jquery-ui-1.9.2/development-bundle/themes/custom-maroon/jquery.ui.all.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="jquery/jquery-ui-1.9.2/development-bundle/ui/jquery.ui.accordion.js"></script>
        <script type="text/javascript">
            $(function() {
                $( "#accordion" ).accordion({
                    collapsible: true,
                    autoHeight: false,
                    navigation: true
                });               
		
            });
        </script>
        <style type="text/css">
            #accordion h3{
               padding-left: 20px; 
            }
        </style>
    </head>
    <body>
        <?php include_once 'templates/header_template.php'; ?>
        <div id="container">
            <div id="mainContentPages">
                <h3 style="color:black; font-style: italic;"> Please click on the links below for the help topics</h3>
                <a href="subpages/download.php?download_file=HAPPI _10minGuide.pdf" style='float:left; font-size:14px;text-decoration: underline;color: #720003; padding-left: 30px;padding-top: 15px; font-weight: bold;'>Download User Guide</a>
                <div id="accordion">                    
                    <h3><a href="">What is HAPPI?</a></h3>
                    <p>
                        The Human Annotated and Predicted Protein Interaction  (HAPPI) Database is a free, open-access, and comprehensive  database collection
                        of computer annotated human protein-protein interactions from public data sources and computational predictions.
                        <br/>
                        The database was developed by exhaustively integrating publicly available human protein interaction data from BioGRID,I2D, IntnetDB, HPRD, and STRING
                        databases into a data warehouse powered by our Oracle 11g relational database server. In the data warehouse, various types of sequence, structure, pathway, and literature annotation data from
                        established bioinformatics resources such as NCBI, PubMed, UniProt, HUGO, EBI, PDB were also integrated. Our long-term goal is to develop a
                        new type of protein interaction database resource for biomedical scientists, who are interested in evaluating biological significant protein interactions,
                        developing disease pathway models, and identifying disease drug targets or diagnostic biomarkers.
                    </p>
                    <h3><a href="#">Why HAPPI?</a></h3>
                    <div>
                        <p>In the current release of the HAPPI database, users can examine protein interaction in many ways.
                        </p>
                        <ul>
                            <li>The database is very comprehensive, containing 2,922,202 non-redundant reliable human protein interaction pairs among 32,125 human proteins (identified by UniProt ID) as of released in November 2010. In  other major public protein interaction databases, the average reported human interaction pairs range from a count of 10,000 to 45,000.
                            </li>
                            <li>Each interaction in HAPPI is assigned a confidence score between 0 and 1 and a corresponding converted confidence
                                rank stars of 1, 2, 3, 4, and 5 (read the next section <a href="#ranking">here</a> for details). This scoring framework provides a unified framework for users to choose an appropriate reliability level (and therefore, a subset) of interactions for their own study. While &quot;total protein interactions&quot;
                                represented in the HAPPI databases at all star ranks exceeds 1.2 million entries, HAPPI database defines &quot;reliable interactions&quot; stringently, requiring a &quot;reliable interaction&quot; to have a score of 0.75 and above (4 or 5 rank stars) to be included.
                            </li>
                            <li>Each interaction in HAPPI is computationally annotated with bioinformatics data including biological pathway, gene function, protein family, protein structure, sequence features. The convenient convergence of these information enhances user's ability to examine the biological validity and significance of specific
                                interactions and their relevance to disease specific studies.
                            </li>
                        </ul>
                    </div>
                    <h3><a href="#">How to Cite this Work?</a></h3>
                    <div>
                        <p>For both in-depth technical details and citation of this work, please refer to the following article:</p>
                        <blockquote>
                            <p>Jake Y. Chen, SudhaRani Mamidipalli, and Tianxiao Huan  (2009) <b>HAPPI: an Online Database of Comprehensive Human Annotated and  Predicted Protein Interactions</b>, <i>BMC Genomics, Vol. 10, Suppl 1: </i>S16 (free access <a href="http://www.biomedcentral.com/qc/1471-2164/10/S1/S16">here</a>)</p>
                        </blockquote>
                    </div>
                    <h3><a href="#">System Architecture</a></h3>
                    <div>
                        <p> HAPPI database is developed as a classical 3-tier data-driven web application.</p>
                        <ul>
                            <li>In the <strong>database tier</strong>, we host the HAPPI data warehouse on a collection of schemas powered by the <a href="http://www.oracle.com/database/index.html">Oracle 10g release2</a> relational database server. All the protein interaction data and related annotation data are imported from public sources, loaded into our database, and managed locally within our data warehouse.  We used relational database views extensively to hide complexity of database queries. </li>
                            <li>In the <strong>application logic tier</strong>, we used predominately <a href="http://www.php.net/">PHP</a> as an extension to Apcahe web server functionality to manage data transformation logic (e.g., conversion of confidence score to confidence ranks on the fly), database connection, and data post-processing. To assist pdb structure viewer  at the next layer display protein structures correctly, we also used PHP to generate temporary protein structure files on the web server for the viewer Applet to use.  </li>
                            <li> In the <strong>presentation tier</strong>, we used html to display textual and hyperlinked data in a grid
                                and Java Applets to render dynamic database content in visual exploratory environment. The pdb structure viewer used is <a href="http://jmol.sourceforge.net/">JMOL</a>, an open-source Java applet. The sequence alignment viewer used is <a href="http://bio.informatics.iupui.edu/service/safmap.shtm">Safmap</a>, an Java applet developed internally. </li>
                        </ul>
                    </div>
                    <h3><a href="#">Interaction Data Source</a></h3>
                    <div>
                        <p>The majority of the human protein interaction data are extracted and integrated from <a href="http://www.hprd.org/">HPRD</a>, <a href="http://thebiogrid.org/">BioGRID</a>,
                            <a href="http://hanlab.genetics.ac.cn/IntNetDB.htm">IntNetDB</a>, <a href="http://string.embl.de/">STRING</a>,
                            and the <a href="http://ophid.utoronto.ca/">I2D</a> databases.
                            In particular, we adopted the data source naming standard from the I2D database (for a listing all possible data source values, read here).
                            For data integrated from HPRD, BioGrid we directly use the database names as the data source names..
                            In summary, the data sources are:
                        </p>
                        <table id="dataTable"align="center">
                            <th>Database</th>
                            <th>Description</th>
                            <tr>
                                <td width="75">BioGRID</td>
                                <td width="532">Database of Protein and Gene Interactions </td>
                            </tr>
                            <tr>
                                <td>HPRD</td>
                                <td>Human protein interactions found in the HPRD database</td>
                            </tr>
                            <tr>
                                <td>IntNetDB</td>
                                <td>Integrated protein interaction network database</td>
                            </tr>
                            <tr>
                                <td>(misc.)</td>
                                <td>Additional recent experimental high-throughput human protein interaction data found in published studies, including JonesErbB1, Pawson, StelzlLow, StelzlMedium, StelzlHigh, VidalHuman_core, and VidalHuman_non_core</td>
                            </tr>
                            <tr>
                                <td>STRING</td>
                                <td>Human protein interactions found in the STRING database</td>
                            </tr>
                            <tr>
                                <td>(other)</td>
                                <td>Human protein interactions computationally derived  and described in the I2D database. The various codes indicate the types of source interaction data used to derive human interaction data. These include: CORE_1, CORE_2, NON_CORE, LITERATURE, SCAFFOLD, INTEROLOG, and CE_DATA from <strong><em>C elegans</em></strong>; low, medium, high, and Krogran_Core from <strong>yeast</strong>; AfCS, Suzuki, RikenDIP, RikenLit, and RikenBIND from <strong>mouse</strong>; FlyHigh, FlyLow, and FlyCellCycle from <strong><em>D. melanogaster</em></strong>; and WranaHigh, WranaMedium, and WranaLow from <strong>LUMIER</strong>. </td>
                            </tr>
                        </table>
                    </div>
                    <h3><a href="#">Interaction Scoring  Method</a></h3>
                    <div>
                        <p> We developed a unified scoring model to assess the reliability of human
                            protein-protein interactions integrated from public  protein interaction databases. First, independent scoring
                            systems for individual protein interaction databases to be integrated were developed (after consulting with our collaborating biomedical scientists), primarily based on heuristic scoring of experimental or computational protocol categories. Each interaction pair under a specific experimental/computational derivation method from a given source is assigned a heuristic confidence score S<i>i</i>,
                            which provides an estimation how reliable or trustworthy interaction data from the method/source are. Therefore, the more trustworthy the experimental or computational protocols that generate the interaction data, the higher the confidence score S<i>i</i>.
                        </p>
                        <table id="dataTable" align="center">
                            <th>Score</th>
                            <th>Datasource</th>
                            <tr>
                                <td width="75">0.80</td>
                                <td width="532">Curated Human Protein Interactions found in HPRD, BIND, and MINT </td>
                            </tr>
                            <tr>
                                <td>0.75</td>
                                <td>High-throughput human protein interaction experimental data</td>
                            </tr>
                            <tr>
                                <td>0.70</td>
                                <td>Human protein interactions in I2D predicted from mouse and rats </td>
                            </tr>
                            <tr>
                                <td>0.65</td>
                                <td>High-quality human protein interactions in I2D predicted from drosophila </td>
                            </tr>
                            <tr>
                                <td>0.60</td>
                                <td>Medium-quality human protein interactions in I2D predicted from various mouse, rat, and drosophila projects </td>
                            </tr>
                            <tr>
                                <td>0.50</td>
                                <td>Human protein interaction data inferred from medium-to-high quality worm and yeast data; high-quality text mining results from STRING</td>
                            </tr>
                            <tr>
                                <td>0.40</td>
                                <td>Human protein interaction data inferred from low-quality worm or curated/high-quality yeast data (including those from MIPS yeast); medium-quality text mining results imported primarily from the STRING database </td>
                            </tr>
                            <tr>
                                <td>0.05-0.35</td>
                                <td>Human protein interaction data inferred from non-interaction data sources (indirect association evidence); low-to-medium-quality text mining results imported primarily from STRING database</td>
                            </tr>
                        </table>
                        <p>Then, we used a score combination formula (listed below) to combine the individual confidence scores into a final <i>h-score</i> for each interaction that are derived from multiple experimental and computational methods or from different data sources:</p>
                        <p align="center">&nbsp;<img src="images/scoring.gif" alt="score" height="50px"></p>
                        <p>In the above formula, N represents the total count of different data sources and conditions where an indepent assessment of protein interaction reliability score S<em>i</em> exist.</p>
                    </div>
                    <h3><a href="#">Interaction Ranking  Method</a></h3>
                    <div>
                        <p>We used a ranking method that works in principle by clustering the distribution of h-scores for all interactions managed in the HAPPI database. The distribution of <em>h-score</em> ranges from 0 to 1. Based on combined score distributions binned
                            properly (see figure below), a 5-star ranking model was developed, where the cutoff threshold is defined at the boundary of significant fall-off or rising bins measured by the &quot;sum of counted interaction&quot; value at the y-axis.
                        </p>
                        <center><img src="images/score_distr.gif" alt="score distribution" width="500" height="400" style="padding-top: 20px;"/></center>
                        <p>Therefore, based on the above binned <em>h-score</em> distribution, our ranking star ratings for each interaction in the HAPPI database is defined with the following threshold values of <em>h-scores</em>:</p><br/>

                        <table id="helpTable" align="center">
                            <tr>
                                <td width="75"><img src="images/stars-1-0.gif" alt="star 1" width="64" height="12"></td>
                                <td width="182"><em>h-score</em> &lt; 0.25 </td>
                                <td width="230">noisy and unsupported interactions</td>
                            </tr>
                            <tr>
                                <td><img src="images/stars-2-0.gif" alt="star 2" width="64" height="12"></td>
                                <td>0.25 &lt;= <em>h-score</em> &lt; 0.45 </td>
                                <td>very-low-confidence  interactions </td>
                            </tr>
                            <tr>
                                <td><img src="images/stars-3-0.gif" alt="star 3" width="64" height="12"></td>
                                <td>0.45 &lt;= <em>h-score</em> &lt; 0.75</td>
                                <td>low-confidence interactions </td>
                            </tr>
                            <tr>
                                <td><img src="images/stars-4-0.gif" alt="star 4" width="64" height="12"></td>
                                <td>0.75 &lt;= <em>h-score</em> &lt; 0.90 </td>
                                <td>medium-confidence interactions </td>
                            </tr>
                            <tr>
                                <td><img src="images/stars-5-0.gif" alt="star 5" width="64" height="12"></td>
                                <td>0.90 &lt;= <em>h-score</em> &lt;=1 </td>
                                <td>high-confidence interactions </td>
                            </tr>
                        </table>

                        <p>Note that while reporting HAPPI database stastics, we only
                            use interactions with h-score &gt;= 0.75 (ranked at 4 or 5 star ratings). We do not include plausible interactions in the h-score &lt;0.75 (ranked 1, 2, or 3 stars) in the statistics, although we do allow querying and retrieval of interactions at the rank of 3 star and above. Note that most of the interactions labelled as 3 stars and below are derived from STRING database or text mining methods, where often co-currence of gene/protein names were mentioned above certain frequencies in the same text. It remains uncertain how much interactions from this subset of data are real.
                            Therefore they are excluded from the statistics report of HAPPI database.
                        </p>
                    </div>
                    <h3><a href="#">Quality of HAPPI in comparison to other major public human protein interaction data sources</a></h3>
                    <div>
                        <p>
                            High-quality conserved gene co-expression profiles are used to assess  protein interaction quality for the HAPPI database. Many protein interaction  data set have been cross-validated with human gene co-expression profiles. While interacting proteins may share highly similar gene expression  profiles, it was sometimes suggested that such expected correlation between  protein interactions and
                            gene expression is weaker in human than in model  organisms. Tirosh and Barkai found out that, to improve the development of a  confidence measure for interacting proteins, the application of co-expression of  orthologs of interacting partners is a more reliable method for verifying  protein interactions where comprehensive expression profiles are difficult to  compile among all conditions
                            and the interactions may be transient [41]. This  is based on the assumption that evolutionary co-expression relationship is a  reliable predictor for how true protein interaction may have evolved and  conversed functionally. Therefore, it is more sensitive overall than using  information purely from the organism, e.g., simple co-expression, cellular  co-localization, and similarity in gene&rsquo;s
                            gene ontology functional annotations.  In a similar study, Bhardwaj and Lu also verified that reliable predictions of  interactions from heterogeneous data sources can be strengthened by  evolutionary preserved gene co-expression measurements [42]. Therefore, we choose to apply conserved evolutionary co-expression  pairs to the assessment and comparisons of PPI data qualities for different sources.
                        </p><p>
                            We evaluated the quality of a sufficiently large PPI data set based on  the degree of overlaps between protein interactions and evolutionary conserved  co-expressed genes found in the MetaGene data set, which consists of 22,163 evolutionary conserved co-expression gene pairs based on the  analysis of over 3182 published DNA microarray experiments by Stuart <i>et al</i> [43]. MetaGene  is a comprehensive
                            compilation of evolutionary conserved gene co-expression  pairs from a diverse set of DNA microarray experiments that were obtained from  four different organisms: 1,202 DNA microarrays from humans, 979 from worms,  155 from flies, and 643 from yeast. The relative quality of each PPI database, including  HAPPI, I2D, IntNetDB,  ProNet, UniHI, and HPRD, was estimated  as the percentage of overlap between
                            protein interactions in the PPI database  of interest and MetaGene pairs. The upper-bound of such overlap, is given by  counting unified set of PPIs from all these six human PPI databases that can be  mapped with MetaGene pairs&mdash;6,297 in all, or 6,145 PPIs from the largest  connected components of the network. The lower-bounder of such overlap, is  given by creating a random reference set of 37,000 PPIs
                            pairs comparable to the  size of PPIs in the HPRD database and comparing the mean degree of overlap  between a random sub-sample (size=1,000) of PPIs with MetaGene pairs  repetitively 1,000 times.
                            <br/>
                            Therefore, to assess the quality of HAPPI datasets at different  quality ranking levels, e.g., between 1-star and 5-star, we calculated the  overlap between PPIs at a given quality ranking level from HAPPI and MetaGene  pairs.
                        </p>
                        <center>
                            <img  src="images/hap1-hap2-compare.png" alt="HAPPI_OTHER_FINAL_frequncy" width="450" height="291" style="float:left;">
                            <img  src="images/hap2-compare.png" alt="happi_star_covert_frenquncy" width="300" height="281">
                        </center>
                        <p><b>Degree  of overlaps between randomly selected protein interaction pairs in selected protein  interaction databases and MetaGene pairs. </b>We randomly selected 1,000 protein-protein  interactions, and count the numbers of protein interaction pairs overlapped with  conserved co-expression pairs in the MetaGene database. This randomization and  MetaGene overlap counting was repeated for 1000 time for each protein
                            interaction database, and the resulting distribution is show as profiles on the  graph. The scale of x-axis  is normalized to  make overlapping of all possible 6145 MetaGenes to be 100%. <b>Panel A and B</b> shows a comparison of distributions of MetaGene overlap counts for randomized samples of HAPPI-1 and HAPPI-2 database subsets.
                        </p>
                        <center><img width="300" height="291" src="images/hap1-degree-distribution.png" style="float:left;"><img width="300" height="291" src="images/hap2-degree-distribution.png"></center>
                        <p><b>A comparison of protein network degree distribution between HAPPI-1 and HAPPI-2.</b>The two sets of data showed similar intercept and R2 for the linear function in the node degree distributions plotted using log-log scales, with HAPPI-2 
                            having slightly flatter slopes thus showing the trend for the updated HAPPI-2 to have 'network hubs' with higher degree of connectivity than HAPPI-1 data as the data coverage expands. .
                        </p>
                    </div>
                    <h3><a href="#">Web Database Site Map</a></h3>
                    <div>
                        <center><a href="images/interface.bmp"></a><img src="images/interface.bmp" ></center>
                    </div>
                    <h3><a href="#">User Guide</a></h3>
                    <div>

                        <p>  Our's is a web-based query interface for searching the interactions in HAPPI database. Users can then
                            download the interactions or save them by for further analysis.
                        <ol>
                            <li>
                                <b>Search protein interaction using a protein's UniProtID or Gene Name </b> <a name="searchProteinID"></a><br>
                                Enter the query protein's UniProtID/Gene Name, and press &quot;Enter&quot;. You could enter multiple ids delimited by comma or semicolon.
                                <br/><font style="font-size: 12px; font-style: italic">Examples: 1) TNF 2) BRCA1_HUMAN; FOXA1_HUMAN 3) brca1,tnf,atm,pcna </font>
                                <br/><center><img src="images/basic_query2.JPG" width="623" height="140" style="padding-top: 10px;"> </center><br/>
                                <p>In order to search interactions using other ids use the <a name="advSearchID">Advanced Search </a> link.</p>
                            </li>
                            <li>
                                <b>Search protein interaction using different ids. </b> <a name="advSearchID"></a><br>
                                First select the id type (examples od ids will be provided). Then either enter the id list (multiple ids should be delimited by comma or semicolon)
                                or upload a file with each id on seperate lines.
                                <br/><center><img src="images/adv_search.JPG" width="600" height="200" style="padding-top: 10px;"> </center><br/>

                            </li>
                            <li>
                                <b>Browse protein interactions involving the query protein and its interacting partners</b><a name="relsymbol"></a> <br/>
                                After a query protein is submited, a list of interacting proteins that interact with the query proteins is retrieved into a data grid, along with each protein's descriptions, source of interactions, and a ranking star rating on a scale of 1 to 5 (see discussion of Interaction Ranking Method above for details). The interacting proteins are sorted according to the rank level, with the one ranked at 5 stars listed first, then 4 stars, and so on. The user may click on protein's UniProt IDs to navigator to the &quot;Protein
                                Summary of Facts&quot; page (list #5 below), or click on the relationship symbol <img src='images/interact.gif' style='width: 17px; height: 10px;'/> to the left of each interacting protein to navigate to the &quot;Protein Interaction Detail&quot; page (see list #4 below). The relationship symbols, although currently only implemented as &lt;=&gt; bi-directional, have been reserved to be uni-direcional ('=&gt;', query protein recruits partner proteins in interaction; or, &quot;&lt;=&quot;, partner protein
                                recruits query protein in interaction).<br/>

                            </li>
                            <li>
                                <b>Browse protein interaction detailed reports</b><br/>
                                In the &ldquo;Protein Interaction Pair Detailed Report&rdquo; page,  users can further examine  biological relationship evidence that may exist between interacting proteins. For  example, previously in the &ldquo;Protein Interaction List&rdquo; page, users can find out that INS_HUMAN (insulin precursor protein) and INSR_HUMAN (insulin receptor  precursor protein) interact with each other with high confidence (a 5-star  ranking). In this page, aided
                                by protein annotation information shown side-by-side for both INS_HUMAN and INSR_HUMAN proteins, users can further conclude that this interaction fits into the &ldquo;peptide ligand -  receptor&rdquo;  binding model, and that the controlled binding of the two proteins play essential roles in several shared common pathways including insulin signaling pathways, type II diabetes, and the DLPRA disease process.
                                <br/><br/>
                                Various annotation information of the interacting proteins are  available and presented within the same page. In the current release, the annotation information includes: Protein Description from the  UniProt database, corresponding gene symbols from the NCBI GENE database (with hyperlinks  to the original gene entry at NCBI), top literature abstract co-citation  references where the names or synonyms of both genes/proteins are mentioned in  the same abstract (with hyperlinks to the PubMed abstract), top molecular  pathways in the KEGG database associated with each of the proteins (with  hyperlinks to the KEGG pathways), representative protein PDB structures for both proteins whenever available displayed immmediately next to each other, and gene/mRNA sequence feature alignment/annotations.
                                <br/><br/>
                                In particular, the display of two prontein PDB structures side-by-side along with their mRNA/gene sequence feature and alignment maps, are considered highly innovative. To activate the structure exploration window, a user should first left-click on the JMOL Java applet, and then right-click to reveal the structure exploration menu.  In our current release, it is also possible to directly navigate to corresponding PDB record pages through the hyperlink, or to explore a zoomed-in version of the JMOL structure viewer in a standalone explorer window. To activate and examine what each aligned line segments represents, click on the SafMap feature alignment Java applet first, then move the mouse over to read/access to the line segment of interest to reveal comment box.
                                <br/><br/>
                                <center><img src="images/interaction_detail_new.jpg" width="800" height="500"></center><br/>
                                <center><img src="images/pdb_r_new.jpg" width="800" height="600"></center><br/>
                            </li>
                            <li style="padding-top: 30px">
                                <b>Browse protein quick facts</b><br/>
                                In this page, users are provided with a glimpse of a protein's name, gene name, description,  cross-reference of sequence identifiers, and so on. Whenvever external database identifier reference is available, a hypertext link that allows the user to navigate to the original database web pages will be provided as much as possible.
                                <br/><br/>
                                <center><img src="images/protein_fact_new.jpg" width="800" height="600"> </center><br/>
                            </li>
                            <li style="padding-top: 30px">
                                <b>Annotate Interactions</b><a name="annotateInter"></a><br/>
                                In this page the registered users can add new annotation to the interactions, rank as well as provide directionality to the specific interaction.

                            </li>
                            <li>
                                <b>Create and Save list of selected protein interactions</b><a name="saveList"></a><br/>
                                To create list and to save interactions you must be a registered user.<br/>
                                Customized list of interactions could be created by selecting the resulting interactions of their searched proteins
                                and press 'Save to List' button. The users can then name the list and the interactions will be saved in the respective list.<br/>
                                The List and the interactions can be viewed from the users 'My page' once logged in.
                            </li>
                            <li>
                                <b>Browse new protein interactions</b><br/>
                                Different ways to browse new protein interactions-
                                <ul>
                                    <li>HAPPI home page</li>
                                    <li>HAPPI Advanced Search page</li>
                                    <li>Go to an interacting protein's &quot;Protein Quick Facts&quot; annotation and click on the protein entry name</li>
                                    <li>Once logged in, select the list name (if created any) to view the interactions in those list and select the proteins to futher search interactions.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            
        </div>
        <?php include_once 'templates/footer_template.php'; ?>
    </body>
</html>
