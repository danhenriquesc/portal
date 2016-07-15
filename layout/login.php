<?php
    if(isloggedin())
        redirect ($CFG->wwwroot);
    echo $OUTPUT->doctype();

    $hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
    $hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
    $showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
    $showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);
    $courseheader = $coursecontentheader = $coursecontentfooter = $coursefooter = '';
    if (empty($PAGE->layout_options['nocourseheaderfooter'])) {
        $courseheader = $OUTPUT->course_header();
        $coursecontentheader = $OUTPUT->course_content_header();
        if (empty($PAGE->layout_options['nocoursefooter'])) {
            $coursecontentfooter = $OUTPUT->course_content_footer();
            $coursefooter = $OUTPUT->course_footer();
        }
    }
    
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

    global $errormsg;
    $showLoginSummary = get_config('theme_portal', 'showLoginSummary');
    $loginSummaryText = get_config('theme_portal', 'loginSummaryText');
?>
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

    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme'); ?>">
    
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
        <div class="sklt-container" id="loginContainer">
            <div class="<?php echo ((!$showLoginSummary)?'sixteen':'eight'); ?> columns if-rtl-flip">
                <div class="loginbox">
                    <form method="post"  action="<?php echo $CFG->wwwroot; ?>/login/index.php">
                        <div class="inputarea">
                            <div>
                                <label for="name"><?php echo get_string('username','theme_portal');?></label>
                                <input type="text" name="username"/>
                            </div>
                            <div>
                                <label for="password"><?php echo get_string('password','theme_portal');?></label>
                                <input type="password" name="password"/>
                            </div>
                            <a href="forgot_password.php" style="float: right;"><?php echo get_string('forgotuser','theme_portal');?></a>
                            <div class="clear"></div>
                        </div>
                        <input type="submit" value="<?php echo get_string('login','theme_portal');?>"/>
                    </form>
                    <?php if(isset($errormsg) && trim($errormsg) != ""){ ?>
                        <div class="error">
                            <?php echo get_string("invalidlogin"); ?>
                        </div>
                    <?php } ?>
                </div>
                <br>
                <div class="shadow2"></div>
                <?php echo $OUTPUT->otherLoginMethods($CFG); ?>
                <br><br>
            </div>
            <?php 
                if($showLoginSummary){
                    echo '<div class="eight columns if-rtl-flip">
                            <div id="loginSummary">
                                '.$loginSummaryText.'
                            </div>
                          </div>';
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