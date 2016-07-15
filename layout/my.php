<?php
    $hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
    $hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
    $showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
    $showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

    $bodyclasses = array();
    if ($showsidepre && !$showsidepost) {
        if (!right_to_left()) {
            $bodyclasses[] = 'side-pre-only';
        } else {
            $bodyclasses[] = 'side-post-only';
        }
    } else if ($showsidepost && !$showsidepre) {
        if (!right_to_left()) {
            $bodyclasses[] = 'side-post-only';
        } else {
            $bodyclasses[] = 'side-pre-only';
        }
    } else if (!$showsidepost && !$showsidepre) {
        $bodyclasses[] = 'content-only';
    }

    /* Sidebar */
    if($showsidepre)
        $sidebar = "LEFT";
    else if($showsidepost)
        $sidebar = "RIGHT";
    else
        $sidebar = "NONE";

    echo $OUTPUT->doctype();
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en" <?php echo $OUTPUT->htmlattributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en" <?php echo $OUTPUT->htmlattributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en" <?php echo $OUTPUT->htmlattributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en" <?php echo $OUTPUT->htmlattributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $PAGE->title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php echo $OUTPUT->loadGoogleFont(); ?>
    
    <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>">
    
    <?php echo $OUTPUT->googleAnalytics() ?>
    <?php echo $OUTPUT->standard_head_html() ?>
    
    <noscript>
        <link rel="stylesheet" type="text/css" href="<?php echo $CFG->wwwroot;?>/theme/portal/css/nojs.css" />
    </noscript>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
    <?php echo $OUTPUT->standard_top_of_body_html(); ?>
    <?php include 'header.php'; ?>
    <?php echo $OUTPUT->slider('inside'); ?>

    <div id="contentarea" class="row">
        <div class="sklt-container">
            
            <?php 
                echo $OUTPUT->breadcrumb($PAGE);
            ?>

            <?php if($sidebar == "LEFT") { ?>
                <div class="four columns leftsidebar">
                    <div id="region-pre" class="block-region">
                        <div class="region-content if-rtl-flip">
                            <?php echo $OUTPUT->blocks_for_region('side-pre'); ?>
                        </div>
                    </div>
                </div>
            <?php } else if ($hassidepre) { 
                    echo $OUTPUT->blocks_for_region('side-pre'); 
                }
            ?>
            
            <?php
                /* Verifying current page and special my homepage */
                $specialPages[] = str_replace("http://", "", str_replace("https://", "", $CFG->wwwroot.'/my/'));
                $specialPages[] = str_replace("http://", "", str_replace("https://", "", $CFG->wwwroot.'/my/index.php'));
                $specialPages[] = str_replace("http://", "", str_replace("https://", "", $CFG->wwwroot.'/my'));
                $currentPage = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

                $currentPage = str_replace("http://", "", str_replace("https://", "", $currentPage));
            ?>

            <!-- If is MOODLE/my/ -->
            <?php if (in_array($currentPage, $specialPages)) { ?>
                <!-- Courses Header -->

                <div class="<?php echo (($sidebar == "NONE")?"sixteen":"twelve"); ?> columns">

                    <div class="<?php echo (($sidebar != "NONE")?"twelve":"sixteen"); ?> columns alpha if-rtl-flip" id="featuredCourses">
                        <div id="allCourses">
                            <p>
                                <?php echo get_string('mycourses','theme_portal');?>
                            </p>
                            <a class="btn btn-small" href="<?php echo $CFG->wwwroot; ?>/course/"><div><?php echo get_string('allcourses','theme_portal');?></div></a>
                        </div>
                    </div>
                    
                    <div class="<?php echo (($sidebar == "NONE")?"sixteen":"twelve"); ?> columns alpha omega sklt-container if-rtl-flip">
                        <!-- Courses List -->
                        <?php 
                            echo $OUTPUT->mycourses($CFG,$sidebar);
                        ?>
                    </div>

                </div>
            <!-- If is not -->
            <?php } else { ?>
                <div class="<?php echo (($sidebar == "NONE")?"sixteen":"twelve"); ?> columns if-rtl-flip">
                    <div id="page-wrapper">
                        <div id="page">
                            <div id="page-content">
                                <div id="region-main-box">
                                    <div id="region-pre-box">
                                        <div id="region-main">
                                            <div class="region-content">
                                                <?php if(isset($coursecontentheader)) echo $coursecontentheader; ?>
                                                <?php echo $OUTPUT->main_content() ?>
                                                <?php if(isset($coursecontentfooter)) echo $coursecontentfooter; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            <?php }?>

            <?php if($sidebar == "RIGHT") { ?>
                <div class="four columns omega rightsidebar">
                    <div id="region-post" class="block-region">
                        <div class="region-content if-rtl-flip">
                            <?php echo $OUTPUT->blocks_for_region('side-post'); ?>
                        </div>
                    </div>
                </div>
            <?php } else if ($hassidepost) { 
                    echo $OUTPUT->blocks_for_region('side-post'); 
                }
            ?>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>

<?php 
    echo "<div style='display: none;'>".$OUTPUT->main_content()."</div>"; 
    echo $OUTPUT->standard_end_of_body_html();
?>