<?php
include('SettingsRenderer.php');


class PortalSettings extends SettingsRenderer{
	public function __construct(){
        $this->save();
		$this->renderSettings();
	}

    public function renderSettings(){
        $courses = Array();

        $get_courses = get_courses();
        foreach ($get_courses as $key => $value) {
            if(strtolower($value->shortname) != "moodle")
                $courses[$value->id] = $value->shortname;
        }
        if(is_array($courses) && count($courses)>0) asort($courses);

        $patterns = array(
            'patterns/thumb1.png'  => 'bg1.png',
            'patterns/thumb2.png'  => 'bg2.png',
            'patterns/thumb3.png'  => 'bg3.png',
            'patterns/thumb4.png'  => 'bg4.png',
            'patterns/thumb5.jpg'  => 'bg5.jpg',
            'patterns/thumb6.png'  => 'bg6.png',
            'patterns/thumb7.png'  => 'bg7.png',
            'patterns/thumb8.png'  => 'bg8.png',
            'patterns/thumb9.png'  => 'bg9.png',
            'patterns/thumb10.png' => 'bg10.png',
            'patterns/thumb11.png' => 'bg11.png',
            'patterns/thumb12.png' => 'bg12.png',
            'patterns/thumb13.png' => 'bg13.png',
            'patterns/thumb14.png' => 'bg14.png',
            'patterns/thumb15.png' => 'bg15.png',
            'patterns/thumb16.png' => 'bg16.png',
            'patterns/thumb17.png' => 'bg17.png',
        );
        for($x=1; $x<=500; $x++){
            $heights[$x] = $x.'px';
        }

        $this->header('#');

        $this->newTab('general','general','general.png');

        $this->newOption('radio', 'moodleVersion', 'Moodle Version', 'Select the version of your Moodle.', '25', array('25' => '2.5', '26' => '2.6', '27' => '2.7'));
        $this->newOption('thumbList', 'themeColor', 'Color Scheme', 'Select the color scheme', 'blue', array('colorSchemes/blue.jpg' => 'blue', 'colorSchemes/purple.jpg' => 'purple', 'colorSchemes/green.jpg' => 'green', 'colorSchemes/custom.jpg' => 'custom'));
        $this->newOption('colorpicker', 'customColorScheme1', 'Custom Color Scheme', 'Create a custom color scheme.','#CCCCCC', null, array('floatLeft'));
        $this->newOption('colorpicker', 'customColorScheme2', '', '','#CCCCCC', null, array('floatLeft','left10px'));
        $this->newOption('colorpicker', 'customColorScheme3', '', '','#CCCCCC', null, array('left94px'));
        $this->newOption('select', 'layoutStyle', 'Layout Style', 'Select the layout style','wide', array('wide' => 'Wide', 'bgcolor' => 'Boxed with Background Color', 'bgpattern' => 'Boxed with Background Pattern', 'bgimage' => 'Boxed with Background Image'));        
        $this->newOption('colorpicker', 'bgcolor', 'Background Color', 'Select the background color to be used if layout style is Boxed with Background Color.','#CCCCCC');        
        $this->newOption('thumbList', 'bgpattern', 'Background Pattern', 'Select the background pattern to be used if layout style is Boxed with Background Pattern.', 'bg1.png', $patterns);
        $this->newOption('imageURL', 'bgpatternCustom', '', 'Or use a external pattern.');
        $this->newOption('imageURL', 'bgimage', 'Background Image', 'Select the background pattern to be used if layout style is Boxed with Background Pattern.');
        $this->newOption('imageURL', 'faviconURL', 'Favicon URL', 'Use a external link for include your favicon image.');
        $this->newOption('select', 'font', 'Font', 'Select the font style','oxygen', array('arial' => 'Arial','calibri' => 'Calibri','helvetica' => 'Helvetica','lato' => 'Lato','open sans' => 'Open Sans', 'oxygen' => 'Oxygen', 'roboto' => 'Roboto', 'ubuntu' => 'Ubuntu', 'verdana' => 'Verdana'));        
        $this->newOption('radio', 'showLoginSummary', 'Show Login Summary', 'Show the Summary of Login.', '0', array('0' => 'No', '1' => 'Yes'));
        $this->newOption('longtext', 'loginSummaryText', 'Login Summary Text', 'Text of Login Summary');
        $this->newOption('radio', 'shibbolethLogin', 'Shibboleth Login', 'Activate the link of shibboleth login in login page.', '0', array('0' => 'No', '1' => 'Yes'));
        $this->newOption('radio', 'guestLogin', 'Guest Login', 'Activate the login as guest.', '0', array('0' => 'No', '1' => 'Yes'));
        $this->newOption('radio', 'generalSidebar', 'Sidebar', 'Choose the default side of your sidebar in general.', 'side-pre', array('side-pre' => 'Left', 'side-post' => 'Right'));
        $this->newOption('radio', 'breadcrumb', 'Breadcrumb', 'Select "ON" to enable Breadcrumb or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('radio', 'editPageButton', 'Edit Page Button', 'Select "ON" to enable "Edit Page Button" or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('longtext', 'googleAnalytics', 'Google Analytics', 'Put your Google Analytics code');
        $this->newOption('longtext', 'customCSS', 'Custom CSS', 'Add custom CSS to theme');

        $this->newTab('header','header','header.png');

        $this->newOption('select', 'headerType', 'Header', 'Select the header','none', array('1' => 'Transparent (Need Slideshow)', '2' => 'Half-Transparent (Need Slideshow)', '3' => 'Solid with Slideshow Overlap (Need Slideshow)', '4' => 'Solid'));
        $this->newOption('radio', 'headerSocialIcons', 'Header Social Icons', 'Select "ON" to enable Social Icons on HEADER section or "OFF" to disable.', '1', array('1' => 'On', '0' => 'Off'));
        $this->newOption('imageURL', 'logoURL', 'Logo URL', 'Use a external link for include your logo image. Recommended size: 200x70.');
        $this->newOption('radio', 'registerLink', 'Register Link', 'Select "ON" to enable Register Link on HEADER section or "OFF" to disable.<br>(Need activate Self-Registration in Site administration -> Plugins -> Authentication -> Manage authentication -> Self registration)', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('radio', 'loggedAs', 'You are logged in as USERNAME', 'Select "ON" to enable "You are logged in as USERNAME" on HEADER section or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));

        $this->newOption('list', 'mainMenu', 'Main Menu', 'Type your main menu texts and complete with they links below.', '', array('text' => 'Menu', 'link' => 'Link (URL)', 'deep' => 'Deep'));
        $this->newTab('footer','footer','footer.png');

        $this->newOption('title', '', 'Select Modules', 'Choose until 3 options of modules to be showing on FOOTER section.');
        $this->newOption('title', '', '', '<b>Module 1</b>');
        $this->newOption('select', 'module1', '', '','none', array('none' => 'None', 'aboutus' => 'About Us', 'links' => 'Links', 'contactinfo' => 'Contact Info', 'Notice' => 'Notice','image' => 'Image'));
        $this->newOption('title', '', '', '<b>Module 2</b>');
        $this->newOption('select', 'module2', '', '','none', array('none' => 'None', 'aboutus' => 'About Us', 'links' => 'Links', 'contactinfo' => 'Contact Info', 'Notice' => 'Notice', 'image' => 'Image'));
        $this->newOption('title', '', '', '<b>Module 3</b>');
        $this->newOption('select', 'module3', '', '','none', array('none' => 'None', 'aboutus' => 'About Us', 'links' => 'Links', 'contactinfo' => 'Contact Info', 'Notice' => 'Notice', 'image' => 'Image'));
        $this->newOption('title', '', '', '<b>Module 4</b>');
        $this->newOption('select', 'module4', '', '','none', array('none' => 'None', 'aboutus' => 'About Us', 'links' => 'Links', 'contactinfo' => 'Contact Info', 'Notice' => 'Notice', 'image' => 'Image'));

        $this->newOption('imageURL', 'footerBackground', 'Footer Background', 'Upload Footer Background');
        $this->newOption('text', 'copyright', 'Footer Text / Copyright', 'Type the texts you want view on the last bar.','');
        $this->newOption('radio', 'footerSocialIcons', 'Footer Social Icons', 'Select "ON" to enable Social Icons on FOOTER section or "OFF" to disable.', '1', array('1' => 'On', '0' => 'Off'));

        $this->newTab('footerModule','footer Module','footerModules.png');

        $this->newOption('title', '', 'About Us', 'Talk about you. The text and image (200x70) bellow will be on module "About Us" on footer.');
        $this->newOption('title', '', '', '<b>Use an Image (URL)</b>');
        $this->newOption('imageURL', 'footermod_aboutus_whitelogo', '', '');
        $this->newOption('title', '', '', '<b>Description</b>');
        $this->newOption('longtext', 'footermod_aboutus_text', '', '');

        $this->newOption('separator');
        $this->newOption('list', 'footermod_links', 'Links', 'Insert useful links on your footer section.', '', array('text' => 'Link Title', 'link' => 'Link URL'));

        $this->newOption('separator');
        $this->newOption('title', '', 'Contact Info', 'Type your contact informations.');
        $this->newOption('title', '', '', '<b>Address</b>');
        $this->newOption('text', 'footermod_contact_address', '', '');
        $this->newOption('title', '', '', '<b>City</b>');
        $this->newOption('text', 'footermod_contact_city', '', '');
        $this->newOption('title', '', '', '<b>Phone Number</b>');
        $this->newOption('text', 'footermod_contact_phone', '', '');
        $this->newOption('title', '', '', '<b>E-mail</b>');
        $this->newOption('text', 'footermod_contact_mail', '', '');

        $this->newOption('separator');
        $this->newOption('title', '', 'Notice', 'Add a notice on footer.');
        $this->newOption('title', '', '', '<b>Notice Title</b>');
        $this->newOption('text', 'footermod_notice_title', '', '');
        $this->newOption('title', '', '', '<b>Notice Text</b>');
        $this->newOption('longtext', 'footermod_notice_text', '', '');

        $this->newOption('separator');
        $this->newOption('title', '', 'Image', 'You can use an image on footer as some feature of your business.');
        $this->newOption('title', '', '', '<b>Image Title</b>');
        $this->newOption('text', 'footermod_image_title', '', '');
        $this->newOption('title', '', '', '<b>Image URL</b>');
        $this->newOption('imageURL', 'footermod_image_url', '', '');

        $this->newTab('frontpage','frontpage','frontpage.png');

        $this->newOption('radio', 'slidermode', 'Slideshow', 'Select "ON" to enable Slideshow on your frontpage or "OFF" to disable.', 'banner', array('slideshow' => 'On', 'banner' => 'Off'));
        $this->newOption('radio', 'fullslider', 'Full Slideshow', 'Select "ON" to enable Full Slideshow on your frontpage or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('slideshow', 'slideshowdata', 'Slider Content', 'Type all informations about your content to each slider.', '');        
        
        $this->newOption('radio', 'showintroduction', 'Introduction', 'Select "ON" to enable Introduction on Frontpage site or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('text', 'introductiontitle', 'Introduction Title', 'Type the title of Introduction.','Title');
        $this->newOption('longtext', 'introductiontext', 'Introduction Text', 'Type the text of Introduction.','Text');

        $this->newOption('radio', 'showfeaturedcourses', 'Featured Courses', 'Select "ON" to enable Featured Courses on Frontpage site or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('select', 'courseName', 'Course Name', 'Choose the Course name that appears in Featured Courses and My Courses.','fullname', array('shortname' => 'Shortname', 'fullname' => 'Fullname'));
        $this->newOption('singlelist', 'featuredcourses', 'Select your features courses', 'Select your featured courses bellow to show on Frontpage.', 'Name of Course', $courses);
        
        $this->newOption('radio', 'showlinkboxes', 'Link Box', 'Select "ON" to enable Link Boxes on your frontpage or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('select', 'linkboxColumns', 'Linkbox Columns', 'Select the number of columns of Linkbox','2', array('2'=>'2','3'=>'3','4'=>'4'));        
        $this->newOption('linkbox', 'linkboxdata', 'Link Box Content', 'Type all informations about your content to each Link Box.', '');

        $this->newOption('radio', 'showimagetext', 'Image With Text', 'Select "ON" to enable Image With Text on Frontpage site or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('text', 'imagetexttitle', 'Image With Text - Title', 'Type the title of block Image With Text.','Title');
        $this->newOption('longtext', 'imagetexttext', 'Image With Text - Text', 'Type the text of block Image With Text.','Text');
        $this->newOption('imageURL', 'imagetextimage', 'Image With Text - Image', 'Type the URL of image of block Image With Text.','');

        $this->newOption('radio', 'showhtmlblocks', 'Show HTML Blocks', 'Select "ON" to enabled HTML Blocks on your frontpage of "OFF" to disabled.', '1', array('1' => 'On', '0' => 'Off'));
        $this->newOption('text', 'htmlblocktitle', 'HTML Block Area Title', 'Title of Block Area.');
        $this->newOption('text', 'htmlblocksubtitle', 'HTML Block Area Subtitle', 'Subtitle of Block Area.');
        $this->newOption('thumbList', 'htmlblockpattern', 'HTML Block Background Pattern', 'Select the background pattern to be used in HTML Block.', 'bg1.png', $patterns);
        $this->newOption('longtext', 'htmlblock1', 'Block 1 Embed HTML', 'Embed HTML of Block 1.');
        $this->newOption('longtext', 'htmlblock2', 'Block 2 Embed HTML', 'Embed HTML of Block 2.');

        $this->newOption('radio', 'showbuttonbar', 'Button Bar', 'Select "ON" to enable Button Bar on Frontpage site or "OFF" to disable.', '0', array('1' => 'On', '0' => 'Off'));
        $this->newOption('text', 'buttonbartext', 'Button Bar - Text', 'Type the text of block Button Bar','Text');
        $this->newOption('text', 'buttonbarbuttontext', 'Button Bar - Button Text', 'Type the text of the button of block Button Bar','Button Text');
        $this->newOption('text', 'buttonbarbuttonurl', 'Button Bar - Button URL', 'Type the URL of the button of block Button Bar','#');

        $this->newTab('socials','socials','socials.png');
        $this->newOption('text', 'social_rss', 'RSS', '','');
        $this->newOption('text', 'social_twitter', 'Twitter', '','');
        $this->newOption('text', 'social_dribbble', 'Dribbble', '','');
        $this->newOption('text', 'social_vimeo', 'Vimeo', '','');
        $this->newOption('text', 'social_facebook', 'Facebook', '','');
        $this->newOption('text', 'social_youtube', 'Youtube', '','');
        $this->newOption('text', 'social_flickr', 'Flickr', '','');
        $this->newOption('text', 'social_gplus', 'Google+', '','');
        $this->newOption('text', 'social_linkedin', 'Linkedin', '','');
        $this->newOption('text', 'social_tumblr', 'Tumblr', '','');
        $this->newOption('text', 'social_pinterest', 'Pinterest', '','');
        $this->newOption('text', 'social_foursquare', 'FourSquare', '','');
        $this->newOption('text', 'social_github', 'Github', '','');
        $this->newOption('text', 'social_skype', 'Skype', '','');
        $this->newOption('text', 'social_instagram', 'Instagram', '','');

        $this->footer();
    }
}

?>
