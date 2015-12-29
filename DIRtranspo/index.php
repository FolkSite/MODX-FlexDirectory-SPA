<?php
include_once("php/lib/bootstrap.php");

if(isset($_COOKIE["WPTranspoFile"])){$xmlFileName = $_COOKIE["WPTranspoFile"];}

//xml upload
include_once('php/xml-review.php');
$File_Section = new File_Section;
$filesuccess = $File_Section->upload_file($_POST);

//import categories
include_once('php/import-categories.php');
$Category_Section = new Category_Section;
$CateSuccess = $Category_Section->cate_import($_POST, $xmlFileName);

//import resources
include_once('php/import-resources.php');
$Resources_Section = new Resources_Section;
$ResSuccess = $Resources_Section->res_import($_POST, $xmlFileName);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DIRtranspo</title>
    <link href="http://fonts.googleapis.com/css?family=Raleway:700,300" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/prettify.css">
</head>

<body>
    <nav>
        <div class="container">
            <h1>DIRtranspo</h1>
            <div id="menu">
                <ul class="toplinks">
                    <li><a href="https://github.com/dubrod/MODX-FlexDirectory-SPA" target="_blank">Github Repo</a></li>
                </ul>
            </div>
            <a id="menu-toggle" href="#" class=" ">&#9776;</a> </div>
    </nav>
    <header>
        <div class="container">
            <h2 class="docs-header">Start Listing</h2>
        </div>
    </header>
    <section>
        <div class="container">
            <ul class="docs-nav" id="menu-left">
                <li>
                    <strong>Getting Started</strong>
                </li>
                <li><a href="#setup" class=" ">Setup</a></li>
                <li><a href="#review" class=" ">Review XML</a></li>
                <li><a href="#import-cate" class=" ">Category Import</a></li>
                <li><a href="#import-res" class=" ">Resource Import</a></li>
                <li class="separator"></li>
                <li><small><?php if(isset($_COOKIE["WPTranspoFile"])){ echo "You have set your XML File! <em>".$_COOKIE["WPTranspoFile"]; } ?></em></small></li>
            </ul>
            <div class="docs-content">
                <h2> Getting Started</h2>
                <h3 id="setup">Setup</h3>
                <p>In order for this to work the following must be <strong>TRUE</strong>:</p>
                <ul>
                    <li>You have installed MODX Revolution, and this package is on the server with it.</li>
                    <li>You have updated "php/lib/config.php" with the Database Credentials</li>
                    <li>You are logged in to the manager, or have an open session.</li>
                    <li>You have a Content XML file in the "<strong>xml</strong>" folder.</li>
                </ul>

                <hr>

                <h3 id="review">Review XML</h3>
                <p>Open your
                    <strong>Directory XML File</strong> and make sure you have no errors and you do want to import ALL that data.</p>
                <p>If it needs trimming, now would be the time. We will be importing or assigning the below to MODX:</p>
                <ul>
                    <li>Pages as Parent Categories</li>
                    <li>Grid Resources</li>
                    <li>Assigning Parent Relationships</li>
                    <li>Assigning Published Values</li>
                    <li>Assigning Tags</li>
                </ul>

                <h4>Enter your XML filename and lets review it</h4>
                <div id="xml-review">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#xml-review">
                        <label for="xml-file">File Name: (sample.xml)</label><br>
                        <input type="text" name="xml-file" id="xml-file">
                        <button id="xmlreviewsubmit" name="xmlreviewsubmit">REVIEW</button>
                    </form>
                </div>
                <div class="response-section"><?php echo $filesuccess; ?></div>

                <hr>

                <h3 id="import-res">Import Resources</h3>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#res-section">
                    <div id="res-section">
                        <p><strong>Template Assignment</strong><br><em>Templates are automagically set</em><br>Pages to "2" and Posts to "3". Base Template is still 1.</p>

                        <p>Next, lets decide if you want to <strong>Respect Publish Settings</strong>.</p>
                        <div class="config--div">
                            <label for="tplPublish">Use Publish values?</label>
                            <input type="checkbox" name="tplPublish" id="tplPublish" value="1" checked>Yes
                            <br>
                            <small>"Draft" will be set to "Unpublished".</small>
                        </div>

                        <p>Press the button to import your posts and pages as MODX Resources.</p>

                        <button id="ressubmit" name="ressubmit">IMPORT</button>
                    </div>
                </form>
                <div class="response-section"><?php echo $ResSuccess; ?></div>

                <hr>


                <br><br>

            </div>
        </div>
    </section>
    <section class="vibrant centered">
        <div class="container">
            <p>Made with snippets from <a href="https://github.com/jgulledge19/importX" target="_blank">Josh Gulledge</a> and my Evo2Revo Tutorial.</p>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>

    <script type="text/javascript" src="js/prettify/prettify.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css&skin=sunburst"></script>
    <script src="js/layout.js"></script>
    <script src="js/jquery.localscroll-1.2.7.js" type="text/javascript"></script>
    <script src="js/jquery.scrollTo-1.4.3.1.js" type="text/javascript"></script>
</body>

</html>
