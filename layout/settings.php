<?php
    if(!is_siteadmin()){
        redirect($CFG->wwwroot);
    }

    $hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
    $hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
    $courseheader = $coursecontentheader = $coursecontentfooter = $coursefooter = '';
    if (empty($PAGE->layout_options['nocourseheaderfooter'])) {
        $courseheader = $OUTPUT->course_header();
        $coursecontentheader = $OUTPUT->course_content_header();
        if (empty($PAGE->layout_options['nocoursefooter'])) {
            $coursecontentfooter = $OUTPUT->course_content_footer();
            $coursefooter = $OUTPUT->course_footer();
        }
    }

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
    
    <?php
        $moodleVersion = get_config('theme_portal', 'moodleVersion');

        if($moodleVersion == '25')
            $settingsURL = '/theme/'. current_theme() . '/settings';
        else
            $settingsURL = '/theme/'. $PAGE->theme->name . '/settings';

        $PAGE->requires->css($settingsURL.'/css/style.css');

        $PAGE->requires->css($settingsURL.'/inc/colorpicker/css/colorpicker.css');
        $PAGE->requires->css($settingsURL.'/inc/colorpicker/css/layout.css');

        echo $OUTPUT->standard_head_html() 
    ?>

    <script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/inc/colorpicker/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/inc/colorpicker/js/eye.js"></script>
    <script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/inc/colorpicker/js/utils.js"></script>

</head>
<body>
    <?php echo $OUTPUT->standard_top_of_body_html(); ?>
    <?php include 'header.php'; ?>
    <?php echo $OUTPUT->slider('inside'); ?>
            
    <div id="contentarea" class="row">
        <div class="sklt-container">
            <div class="sixteen columns">
                <div id="page">
                    <div id="ie6-container-wrap">
                        <div id="outercontainer">
                            <div id="container">
				                <div id="innercontainer">
                                    <div id="page-content">
                                        <div id="region-main-box">
                                            <div id="region-post-box">
                                                <div id="region-main-wrap">
                                                    <div id="region-main">
                                                        <div class="region-content ararazu-settings-content">
                                                            <?php echo $coursecontentheader; ?>
                                                            <?php echo $OUTPUT->main_content() ?>
                                                            <?php echo $coursecontentfooter; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>

<?php 
    echo $OUTPUT->standard_end_of_body_html();
?>

<script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/js/tabs.js"></script>
<script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/js/imageUrlPreview.js"></script>
<script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/js/list.js"></script>
<script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/js/slideshow.js"></script>
<script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/js/linkbox.js"></script>
<script type="text/javascript" src="<?php echo $CFG->wwwroot.'/'.$settingsURL; ?>/js/thumbList.js"></script>


