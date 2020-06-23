<?php
    echo '<title>Feedback</title>';
    include 'head.php';
?>
           <?php
                if(isset($_SESSION['id'])) {
                    include 'includes/nav2.inc.php';
                } else {
                    include 'includes/nav.inc.php';
                }
           ?>

        <br>
        <br>
        <br>
        
                    <div class="container col-lg-6 col-md-7 col-sm-8">
                    
                   
                    <!-- <h1>File extensions allowed for upload</h1> -->
                    <legend><h1 align = "center">Need some help?</h1></legend><br><br>    


                    <!-- <h3 align = "center"></h3><br>   -->

                    <div class="jumbotron"> 
                    <h4>Maximum filesize allowed per upload</h4><br>
                    <h4>1GB</h4>
                    </div>

                    <div class="jumbotron"> 
                    <h4>File extensions allowed for upload</h4><br>
                    <b>.PDF</b> - Portable Document Format<br>
                    <b>.TXT</b> - Plain Text File<br>
                    <b>.DOC</b> - Microsoft Word Document<br>
                    <b>.PPT</b> - Powerpoint Open Presentation<br>
                    <b>.PPS</b> - PowerPoint Slide Show<br>
                    </div>

                    <br />


                    <div class="jumbotron"> 
                    <b>.RAR</b> - Zip File<br>
                    <b>.RAR4</b> - Zip File<br>
                    <b>.ZIP</b> - Zip File<br>
                    <b>.7Z</b> - Zip File<br>
                    </div>

                    
                    <br />

                    <div class="jumbotron"> 
                    <b>.XLS</b> - Excel Spreadsheet<br>
                    <b>.XLR</b> - Works Spreadsheet<br>
                    <b>.LOG</b> - Log File<br>
                    <b>.MSG</b> - Outlook Mail Message<br>
                    <b>.PAGES</b> - Pages Document<br>
                    </div>

                    <br />
        
                    <div class="jumbotron">
                    <b>.RTF</b> - Rich Text Format File<br>
                    <b>.TEX</b> - LaTEX Source Document<br>
                    <b>.WPD</b> - WordPerfect Document<br>
                    <b>.WPS</b> - Microsoft Works Word Processor Document<br>
                    <b>.CSV</b> - Comma Seperated Values File<br>
                    </div>
                    
                    <br />

                    <div class="jumbotron">
                    <b>.DAT</b> - Data File<br>
                    <b>.ODT</b> - OpenDocument Text Document<br>
                    <b>.TEX</b> - LaTEX Source Document<br>
                    <b>.WPS</b> - Microsoft Works Word Processor Document<br>
                    <b>.CSV</b> - Comma Seperated Values File<br>
                    </div>

                    <br />
                    
                    <div class="jumbotron">
                    <b>.KEY</b> - Keynote Presentation<br>
                    <b>.SDF</b> - Standard Data File<br>
                    <b>.TAR</b> - Consolidated Unix File Archive<br>
                    <b>.TAX2016</b> - TurboTax 2016 Tax Return<br>
                    <b>.TAX2018</b> - TurboTax 2018 Tax Return<br>
                    </div>
                    
                    <br />
                    
                    <div class="jumbotron">
                    <b>.VCF</b> - vCard File<br>
                    <b>.INDD</b> - Adobe InDesign Document<br>
                    <b>.XLR</b> - Works Spreadsheet<br>
                    <b>.ODS</b> - Operational Data Store<br>
                    <br>
                    <span><i class = "material-icons left yellow-text text-darken-2 tiny">warning</i><a id = "ebook" href = "<?php echo ROOT_URL.'feedback?title=type'; ?>">I want to ask a question?</h5></span> 
                    </div>

                    </div>
                


                  

            <br><br>

                
    <br>
<?php
    include ('foot.php');
?>