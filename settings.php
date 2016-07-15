<?php
    $ADMIN->add('root', new admin_externalpage('portal', 'Portal', $CFG->wwwroot."/theme/portal/settings/index.php"));
    
    /* Setting default settings */
    
    /* General */
    $moodleVersion = get_config('theme_portal','moodleVersion');
    if(!isset($moodleVersion) || trim($moodleVersion) == "") set_config('moodleVersion','25','theme_portal');

    $themecolor = get_config('theme_portal','themecolor');
    if(!isset($themecolor) || trim($themecolor) == "") set_config('themecolor','green','theme_portal');

    $layoutstyle = get_config('theme_portal','layoutStyle');
    if(!isset($layoutstyle) || trim($layoutstyle) == "") set_config('layoutStyle','wide','theme_portal');

    $generalsidebar = get_config('theme_portal','generalsidebar');
    if(!isset($generalsidebar) || trim($generalsidebar) == "") set_config('generalsidebar','side-pre','theme_portal');

    $faviconurl = get_config('theme_portal','faviconurl');
    if(!isset($faviconurl) || trim($faviconurl) == "") set_config('faviconurl','','theme_portal');

    $breadcrumb = get_config('theme_portal','breadcrumb');
    if(!isset($breadcrumb) || trim($breadcrumb) == "") set_config('breadcrumb','1','theme_portal');

    $font = get_config('theme_portal','font');
    if(!isset($font) || trim($font) == "") set_config('font','oxygen','theme_portal');

    $showLoginSummary = get_config('theme_portal','showLoginSummary');
    if(!isset($showLoginSummary) || trim($showLoginSummary) == "") set_config('showLoginSummary','0','theme_portal');

    $loginSummaryText = get_config('theme_portal','loginSummaryText');
    if(!isset($loginSummaryText) || trim($loginSummaryText) == "") set_config('loginSummaryText','','theme_portal');

    $shibbolethLogin = get_config('theme_portal','shibbolethLogin');
    if(!isset($shibbolethLogin) || trim($shibbolethLogin) == "") set_config('shibbolethLogin','0','theme_portal');

    $guestLogin = get_config('theme_portal','guestLogin');
    if(!isset($guestLogin) || trim($guestLogin) == "") set_config('guestLogin','0','theme_portal');

    $customColorScheme1 = get_config('theme_portal','customColorScheme1');
    if(!isset($customColorScheme1) || trim($customColorScheme1) == "") set_config('customColorScheme1','#FFFFFF','theme_portal');

    $customColorScheme2 = get_config('theme_portal','customColorScheme2');
    if(!isset($customColorScheme2) || trim($customColorScheme2) == "") set_config('customColorScheme2','#FFFFFF','theme_portal');

    $customColorScheme3 = get_config('theme_portal','customColorScheme3');
    if(!isset($customColorScheme3) || trim($customColorScheme3) == "") set_config('customColorScheme3','#FFFFFF','theme_portal');

    $editPageButton = get_config('theme_portal','editPageButton');
    if(!isset($editPageButton) || trim($editPageButton) == "") set_config('editPageButton','1','theme_portal');

    $googleAnalytics = get_config('theme_portal','googleAnalytics');
    if(!isset($googleAnalytics) || trim($googleAnalytics) == "") set_config('googleAnalytics','','theme_portal');
    
    $googleAnalytics = get_config('theme_portal','customCSS');
    if(!isset($googleAnalytics) || trim($googleAnalytics) == "") set_config('customCSS','','theme_portal');

    /* Frontpage */
   
    /* --> Introduction */
    $showintroduction = get_config('theme_portal','showintroduction');
    if(!isset($showintroduction) || trim($showintroduction) == "") set_config('showintroduction','','theme_portal');

    $introductiontitle = get_config('theme_portal','introductiontitle');
    if(!isset($introductiontitle) || trim($introductiontitle) == "") set_config('introductiontitle','','theme_portal');

    $introductiontext = get_config('theme_portal','introductiontext');
    if(!isset($introductiontext) || trim($introductiontext) == "") set_config('introductiontext','','theme_portal');

    /* --> Featured Courses */

    $featuredcourses = get_config('theme_portal','featuredcourses');
    if(!isset($featuredcourses) || trim($featuredcourses) == "") set_config('featuredcourses','','theme_portal');
    
    $showfeaturedcourses = get_config('theme_portal','showfeaturedcourses');
    if(!isset($showfeaturedcourses) || trim($showfeaturedcourses) == "") set_config('showfeaturedcourses','0','theme_portal');

    $courseName = get_config('theme_portal','courseName');
    if(!isset($courseName) || trim($courseName) == "") set_config('courseName','fullname','theme_portal');
    
        
    /* --> Linkbox */
    
    $linkboxdata = get_config('theme_portal','linkboxdata');
    if(!isset($linkboxdata) || trim($linkboxdata) == "") set_config('linkboxdata','[{"title":"Attractive Layout","link":"http:\/\/www.facebook.com\/ararazustudio","icon":"fa-heart-o","animation":"anim-from-left","text":"Pellentesque enim tellus, consectetur id erat auctor, rhoncus dapibus nibh. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis condimentum cursus nibh, sed tincidunt sem gravida congue."},{"title":"Support","link":"#","icon":"fa-comments","animation":"anim-from-right","text":"Pellentesque enim tellus, consectetur id erat auctor, rhoncus dapibus nibh. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis condimentum cursus nibh, sed tincidunt sem gravida congue."},{"title":"Responsive","link":"#","icon":"fa-tablet","animation":"anim-from-left","text":"Pellentesque enim tellus, consectetur id erat auctor, rhoncus dapibus nibh. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis condimentum cursus nibh, sed tincidunt sem gravida congue."},{"title":"Translation Ready","link":"#","icon":"fa-superscript","animation":"anim-from-right","text":"Pellentesque enim tellus, consectetur id erat auctor, rhoncus dapibus nibh. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis condimentum cursus nibh, sed tincidunt sem gravida congue."}]','theme_portal');
    
    $linkboxColumns = get_config('theme_portal','linkboxColumns');
    if(!isset($linkboxColumns) || trim($linkboxColumns) == "") set_config('linkboxColumns','2','theme_portal');

    $showlinkboxes = get_config('theme_portal','showlinkboxes');
    if(!isset($showlinkboxes) || trim($showlinkboxes) == "") set_config('showlinkboxes','1','theme_portal');  
    
    /* --> Image With Text */
    $showimagetext = get_config('theme_portal','showimagetext');
    if(!isset($showimagetext) || trim($showimagetext) == "") set_config('showimagetext','0','theme_portal');

    $imagetexttitle = get_config('theme_portal','imagetexttitle');
    if(!isset($imagetexttitle) || trim($imagetexttitle) == "") set_config('imagetexttitle','Title','theme_portal');
    
    $imagetexttext = get_config('theme_portal','imagetexttext');
    if(!isset($imagetexttext) || trim($imagetexttext) == "") set_config('imagetexttext','Text','theme_portal');

    $imagetextimage = get_config('theme_portal','imagetextimage');
    if(!isset($imagetextimage) || trim($imagetextimage) == "") set_config('imagetextimage','','theme_portal');

    /* --> HTML Blocks */

    $showhtmlblocks = get_config('theme_portal','showhtmlblocks');
    if(!isset($showhtmlblocks) || trim($showhtmlblocks) == "") set_config('showhtmlblocks','0','theme_portal');
    
    $htmlblocktitle = get_config('theme_portal','htmlblocktitle');
    if(!isset($htmlblocktitle) || trim($htmlblocktitle) == "") set_config('htmlblocktitle','','theme_portal');

    $htmlblocksubtitle = get_config('theme_portal','htmlblocksubtitle');
    if(!isset($htmlblocksubtitle) || trim($htmlblocksubtitle) == "") set_config('htmlblocksubtitle','','theme_portal');

    $htmlblockpattern = get_config('theme_portal','htmlblockpattern');
    if(!isset($htmlblockpattern) || trim($htmlblockpattern) == "") set_config('htmlblockpattern','','theme_portal');
    
    $htmlblock1 = get_config('theme_portal','htmlblock1');
    if(!isset($htmlblock1) || trim($htmlblock1) == "") set_config('htmlblock1','','theme_portal');
    
    $htmlblock2 = get_config('theme_portal','htmlblock2');
    if(!isset($htmlblock2) || trim($htmlblock2) == "") set_config('htmlblock2','','theme_portal');  

    /* --> Button Bar */

    $showbuttonbar = get_config('theme_portal','showbuttonbar');
    if(!isset($showbuttonbar) || trim($showbuttonbar) == "") set_config('showbuttonbar','','theme_portal');

    $buttonbartext = get_config('theme_portal','buttonbartext');
    if(!isset($buttonbartext) || trim($buttonbartext) == "") set_config('buttonbartext','','theme_portal');

    $buttonbarbuttontext = get_config('theme_portal','buttonbarbuttontext');
    if(!isset($buttonbarbuttontext) || trim($buttonbarbuttontext) == "") set_config('buttonbarbuttontext','','theme_portal');

    $buttonbarbuttonurl = get_config('theme_portal','buttonbarbuttonurl');
    if(!isset($buttonbarbuttonurl) || trim($buttonbarbuttonurl) == "") set_config('buttonbarbuttonurl','','theme_portal');

    /* Footer */
    
    $footerBackground = get_config('theme_portal','footerBackground');
    if(!isset($footerBackground) || trim($footerBackground) == "") set_config('footerBackground','', 'theme_portal'); 

    $copyright = get_config('theme_portal','copyright');
    if(!isset($copyright) || trim($copyright) == "") set_config('copyright','All rights reserved  | Ararazu ®','theme_portal'); 

    $footermodule1 = get_config('theme_portal','footermodule1');
    if(!isset($footermodule1) || trim($footermodule1) == "") set_config('footermodule1','aboutus','theme_portal');     
    
    $footermodule2 = get_config('theme_portal','footermodule2');
    if(!isset($footermodule2) || trim($footermodule2) == "") set_config('footermodule2','links','theme_portal');     
    
    $footermodule3 = get_config('theme_portal','footermodule3');
    if(!isset($footermodule3) || trim($footermodule3) == "") set_config('footermodule3','contactinfo','theme_portal');     
    
    $footermodule4 = get_config('theme_portal','footermodule4');
    if(!isset($footermodule4) || trim($footermodule4) == "") set_config('footermodule4','image','theme_portal');     

    /* Header */
    $headerType = get_config('theme_portal','headerType');
    if(!isset($headerType) || trim($headerType) == "") set_config('headerType','1','theme_portal');     

    $logourl = get_config('theme_portal','logourl');
    if(!isset($logourl) || trim($logourl) == "") set_config('logourl','','theme_portal');
    
    $registerLink = get_config('theme_portal','registerLink');
    if(!isset($registerLink) || trim($registerLink) == "") set_config('registerLink','0','theme_portal');
    
    $loggedAs = get_config('theme_portal','loggedAs');
    if(!isset($loggedAs) || trim($loggedAs) == "") set_config('loggedAs','0','theme_portal');

    $menudata = get_config('theme_portal','menudata');
    if(!isset($menudata) || trim($menudata) == "") set_config('menudata','[{"text":"My","link":"http:\/\/localhost\/moodle253\/my\/","deep":"1"},{"text":"My Homepage 2","link":"#","deep":"2"},{"text":"Courses","link":"http:\/\/localhost\/moodle253\/course","deep":"1"},{"text":"Course A","link":"http:\/\/www.google.com","deep":"2"},{"text":"Course B","link":"http:\/\/www.facebook.com","deep":"2"},{"text":"Course C","link":"http:\/\/www.pinterest.com","deep":"2"},{"text":"Typography","link":"#","deep":"1"},{"text":"Documentation","link":"#","deep":"1"},{"text":"Installation","link":"#","deep":"2"},{"text":"Features","link":"#","deep":"2"}]','theme_portal');     
    
    /* Social Icons */
    
    $headersocialicon = get_config('theme_portal','headersocialicon');
    if(!isset($headersocialicon) || trim($headersocialicon) == "") set_config('headersocialicon','1','theme_portal');    
    
    $footersocialicon = get_config('theme_portal','footersocialicon');
    if(!isset($footersocialicon) || trim($footersocialicon) == "") set_config('footersocialicon','1','theme_portal');    
    
    
    /* Slider */
    
    $slidermode = get_config('theme_portal','slidermode');
    if(!isset($slidermode) || trim($slidermode) == "") set_config('slidermode','banner','theme_portal');     
    
    $fullslider = get_config('theme_portal','fullslider');
    if(!isset($fullslider) || trim($fullslider) == "") set_config('fullslider','0','theme_portal');     

    $slideshowdata = get_config('theme_portal','slideshowdata');
    if(!isset($slideshowdata) || trim($slideshowdata) == "") set_config('slideshowdata','','theme_portal');    
    
    /* Footer modules */
    
    $footermod_aboutus_whitelogo = get_config('theme_portal','footermod_aboutus_whitelogo');
    if(!isset($footermod_aboutus_whitelogo) || trim($footermod_aboutus_whitelogo) == "") set_config('footermod_aboutus_whitelogo','','theme_portal');    
    
    $footermod_aboutus_text = get_config('theme_portal','footermod_aboutus_text');
    if(!isset($footermod_aboutus_text) || trim($footermod_aboutus_text) == "") set_config('footermod_aboutus_text','Donec vitae eros sit amet nibh fringilla hendrerit non at odio. Sed eu lacus hendrerit, venenatis elit ac, mollis massa. Sed nec enim ac justo feugiat tincidunt vitae sed felis. Pellentesque tincidunt viverra justo, eget posuere sem facilisis sit amet.','theme_portal');        

    $footermod_image_title = get_config('theme_portal','footermod_image_title');
    if(!isset($footermod_image_title) || trim($footermod_image_title) == "") set_config('footermod_image_title','Image Title','theme_portal');    

    $footermod_image_url = get_config('theme_portal','footermod_image_url');
    if(!isset($footermod_image_url) || trim($footermod_image_url) == "") set_config('footermod_image_url','','theme_portal');    

    $footermod_links = get_config('theme_portal','footermod_links');
    if(!isset($footermod_links) || trim($footermod_links) == "") set_config('footermod_links','[{"text":"Facebook - Share this!","link":"https:\/\/www.facebook.com\/"},{"text":"Google","link":"https:\/\/www.google.com.br\/"},{"text":"Twitter - Follow us!","link":"https:\/\/twitter.com\/"},{"text":"Ararazu","link":"http:\/\/themeforest.net\/user\/ararazu"}]','theme_portal');
  
    $footermod_contact_address = get_config('theme_portal','footermod_contact_address');
    if(!isset($footermod_contact_address) || trim($footermod_contact_address) == "") set_config('footermod_contact_address','Address 42','theme_portal');    

    $footermod_contact_city = get_config('theme_portal','footermod_contact_city');
    if(!isset($footermod_contact_city) || trim($footermod_contact_city) == "") set_config('footermod_contact_city','Rio - Brazil','theme_portal');    

    $footermod_contact_phone = get_config('theme_portal','footermod_contact_phone');
    if(!isset($footermod_contact_phone) || trim($footermod_contact_phone) == "") set_config('footermod_contact_phone','+99 (99) 9999-9999','theme_portal');    

    $footermod_contact_mail = get_config('theme_portal','footermod_contact_mail');
    if(!isset($footermod_contact_mail) || trim($footermod_contact_mail) == "") set_config('footermod_contact_mail','email@email.com','theme_portal');    
    
    $footermod_notice_title = get_config('theme_portal','footermod_notice_title');
    if(!isset($footermod_notice_title) || trim($footermod_notice_title) == "") set_config('footermod_notice_title','Notice','theme_portal');    
    
    $footermod_notice_text = get_config('theme_portal','footermod_notice_text');
    if(!isset($footermod_notice_text) || trim($footermod_notice_text) == "") set_config('footermod_notice_text','Donec vitae eros sit amet nibh fringilla hendrerit non at odio. Sed eu lacus hendrerit, venenatis elit ac, mollis massa. Sed nec enim ac justo feugiat tincidunt vitae sed felis. Pellentesque tincidunt viverra justo, eget posuere sem facilisis sit amet.','theme_portal');        
    
    /* Social Icons */
    
    $social_rss = get_config('theme_portal','social_rss');
    if(!isset($social_rss) || trim($social_rss) == "") set_config('social_rss','','theme_portal');    
    
    $social_twitter = get_config('theme_portal','social_twitter');
    if(!isset($social_twitter) || trim($social_twitter) == "") set_config('social_twitter','','theme_portal');    
    
    $social_dribbble = get_config('theme_portal','social_dribbble');
    if(!isset($social_dribbble) || trim($social_dribbble) == "") set_config('social_dribbble','','theme_portal');    
   
    $social_vimeo = get_config('theme_portal','social_vimeo');
    if(!isset($social_vimeo) || trim($social_vimeo) == "") set_config('social_vimeo','','theme_portal');  
    
    $social_facebook = get_config('theme_portal','social_facebook');
    if(!isset($social_facebook) || trim($social_facebook) == "") set_config('social_facebook','','theme_portal');
    
    $social_youtube = get_config('theme_portal','social_youtube');
    if(!isset($social_youtube) || trim($social_youtube) == "") set_config('social_youtube','','theme_portal');
    
    $social_flickr = get_config('theme_portal','social_flickr');
    if(!isset($social_flickr) || trim($social_flickr) == "") set_config('social_flickr','','theme_portal');
    
    $social_gplus = get_config('theme_portal','social_gplus');
    if(!isset($social_gplus) || trim($social_gplus) == "") set_config('social_gplus','','theme_portal');
    
    $social_linkedin = get_config('theme_portal','social_linkedin');
    if(!isset($social_linkedin) || trim($social_linkedin) == "") set_config('social_linkedin','','theme_portal');
    
    $social_tumblr = get_config('theme_portal','social_tumblr');
    if(!isset($social_tumblr) || trim($social_tumblr) == "") set_config('social_tumblr','','theme_portal');
    
    $social_pinterest = get_config('theme_portal','social_pinterest');
    if(!isset($social_pinterest) || trim($social_pinterest) == "") set_config('social_pinterest','','theme_portal');
    
    $social_foursquare = get_config('theme_portal','social_foursquare');
    if(!isset($social_foursquare) || trim($social_foursquare) == "") set_config('social_foursquare','','theme_portal');

    $social_github = get_config('theme_portal','social_github');
    if(!isset($social_github) || trim($social_github) == "") set_config('social_github','','theme_portal');

    $social_skype = get_config('theme_portal','social_skype');
    if(!isset($social_skype) || trim($social_skype) == "") set_config('social_skype','','theme_portal');

    $social_instagram = get_config('theme_portal','social_instagram');
    if(!isset($social_instagram) || trim($social_instagram) == "") set_config('social_instagram','','theme_portal');


    if(isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING']) == 'section=themesettingportal')
        redirect ($CFG->wwwroot.'/theme/portal/settings/index.php');
?>