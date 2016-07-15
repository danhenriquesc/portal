<?php

defined('MOODLE_INTERNAL') || die();

$THEME->name = 'portal';

////////////////////////////////////////////////////
// Name of the theme. Most likely the name of
// the directory in which this file resides.
////////////////////////////////////////////////////

$THEME->parents = array('canvas','base');

/////////////////////////////////////////////////////
// Which existing theme(s) in the /theme/ directory
// do you want this theme to extend. A theme can
// extend any number of themes. Rather than
// creating an entirely new theme and copying all
// of the CSS, you can simply create a new theme,
// extend the theme you like and just add the
// changes you want to your theme.
////////////////////////////////////////////////////

$THEME->sheets = array('skeleton1200', 'core','base','course','login','fontawesome','shortcuts', 'font', 'buttons', 'owlcarousel', 'top', 'plumeslider', 'layout','responsive', 'rtlsupport');

////////////////////////////////////////////////////
// Name of the stylesheet(s) you've including in
// this theme's /styles/ directory.
////////////////////////////////////////////////////

$THEME->parents_exclude_sheets = array('base'=>array('pagelayout','course'),'canvas'=>array('pagelayout','text') );

////////////////////////////////////////////////////
// An array of stylesheets not to inherit from the
// themes parents
////////////////////////////////////////////////////

$THEME->enable_dock = false;

////////////////////////////////////////////////////
// Do you want to use the new navigation dock?
////////////////////////////////////////////////////

//$THEME->editor_sheets = array('editor');

////////////////////////////////////////////////////
// An array of stylesheets to include within the
// body of the editor.
////////////////////////////////////////////////////


$sidebar['frontpage'] = 'none';

$generalArray = array("side-pre","side-post");
$sidebar['general'] = get_config('theme_portal', 'generalsidebar');
if(!in_array($sidebar['general'], $generalArray)){
    $sidebar['general'] = "side-pre";
}


$THEME->layouts = array(
    // Most backwards compatible layout without the blocks - this is the layout used by default
    'base' => array(
        'file' => 'general.php',
        'regions' => array(),
    ),
    // Standard layout with blocks, this is recommended for most pages with general information
    'standard' => array(
        'file' => 'general.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general']
    ),
    'course' => array(
        'file' => 'general.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general']
    ),
    'coursecategory' => array(
        'file' => 'general.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general']
    ),
    'incourse' => array(
        'file' => 'general.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general']
    ),
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array($sidebar['frontpage']),
        'defaultregion' => $sidebar['frontpage'],
        'options' => array('nosearch'=>true,'topbutton'=>'login', 'is_front'=>true),
    ),
    'admin' => array(
        'file' => 'admin.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general']
    ),
    'ararazu_settings' => array(
        'file' => 'settings.php',
        'regions' => array(),
        'defaultregion' => ''
    ),
    'mydashboard' => array(
        'file' => 'my.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general'],
        'options' => array('langmenu'=>true,'topbutton'=>'logout'),
    ),
    'mypublic' => array(
        'file' => 'general.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general']
    ),
    'login' => array(
        'file' => 'login.php',
        'regions' => array(),
        'options' => array('nosearch'=>true,'topbutton'=>'home'),
    ),
    'popup' => array(
        'file' => 'embedded.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'noblocks'=>true, 'nonavbar'=>true, 'nocourseheaderfooter'=>true),
    ),
    'frametop' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nocoursefooter'=>true),
    ),
    'maintenance' => array(
        'file' => 'embedded.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'nocourseheaderfooter'=>true),
    ),
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>true, 'nocourseheaderfooter'=>true),
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'general.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>false, 'noblocks'=>true, 'nocourseheaderfooter'=>true),
    ),
    'report' => array(
        'file' => 'general.php',
        'regions' => array($sidebar['general']),
        'defaultregion' => $sidebar['general']
    ),
);

///////////////////////////////////////////////////////////////
// These are all of the possible layouts in Moodle. The
// simplest way to do this is to keep the theme and file
// variables the same for every layout. Including them
// all in this way allows some flexibility down the road
// if you want to add a different layout template to a
// specific page.
///////////////////////////////////////////////////////////////

$THEME->csspostprocess = 'portal_process_css';

////////////////////////////////////////////////////
// Allows the user to provide the name of a function
// that all CSS should be passed to before being
// delivered.
////////////////////////////////////////////////////

$THEME->javascripts = array('jquery211min','jqueryeasing13');

////////////////////////////////////////////////////
// An array containing the names of JavaScript files
// located in /javascript/ to include in the theme.
// (gets included in the head)
////////////////////////////////////////////////////

$fullslideshow = '';
if(get_config('theme_portal', 'fullslider') == '1') $fullslideshow = 'full';

$THEME->javascripts_footer = array('plumeslider','owlcarousel','customscripts',$fullslideshow.'slideshow');


////////////////////////////////////////////////////
// As above but will be included in the page footer.
////////////////////////////////////////////////////

$THEME->larrow = "/";

////////////////////////////////////////////////////
// Overrides the left arrow image used throughout
// Moodle
////////////////////////////////////////////////////

$THEME->rarrow = "/";

////////////////////////////////////////////////////
// Overrides the right arrow image used throughout Moodle
////////////////////////////////////////////////////

// $THEME->parents_exclude_javascripts

////////////////////////////////////////////////////
// An array of JavaScript files NOT to inherit from
// the themes parents
////////////////////////////////////////////////////

// $THEME->plugins_exclude_sheets

////////////////////////////////////////////////////
// An array of plugin sheets to ignore and not
// include.
////////////////////////////////////////////////////

$THEME->rendererfactory = "theme_overridden_renderer_factory";

////////////////////////////////////////////////////
// Sets a custom render factory to use with the
// theme, used when working with custom renderers.
////////////////////////////////////////////////////