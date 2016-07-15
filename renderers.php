<?php
class theme_portal_core_renderer extends core_renderer {
    protected function googleAnalytics(){
        return get_config('theme_portal', 'googleAnalytics');
    }

    protected function breadcrumb($PAGE){
        $breadcrumb = get_config('theme_portal', 'breadcrumb');
        $editPageButton = get_config('theme_portal', 'editPageButton');
        $content = '';
        
        if(($breadcrumb + $editPageButton) > 0){
            $content = '<div class="sixteen columns if-rtl-flip">
                            <div class="navbar">
                                <div class="wrapper clearfix">';

            if($breadcrumb){
                $content .=             '<div class="breadcrumb">'.$this->navbar().'</div>';
            }
            if($editPageButton){
                $content .=             '<div class="navbutton">'.$PAGE->button.'</div>';
            }

            $content .=         '</div>
                            </div>
                        </div>';
        }

        return $content;
    }
    private function footermod_aboutus(){
        $logourl = get_config('theme_portal', 'footermod_aboutus_whitelogo');
        $text = get_config('theme_portal', 'footermod_aboutus_text');

        $content = '';

        if($logourl && trim($logourl)!=""){
            $content = '<div class="underlined">
                            <img src="'.$logourl.'" alt="Logo" width="149" height="47">
                        </div>';
        }
        
        $content .= '<p>'.$text.'</p>';
        
        return $content;
    }

    private function footermod_links(){
        $links = json_decode(get_config('theme_portal', 'footermod_links'));
        
        $content = '<div class="underlined"><h3>'.get_string('links','theme_portal').'</h3></div>';
        
        $content .= '<ul>';
        
        for($x=0;$x<sizeof($links);$x++){
            $content .= '<li><a target="blank" href="'.$links[$x]->link.'">'.$links[$x]->text.'</a></li>';
        }
        
        $content .= '</ul>';
        
        return $content;
    }
    
    private function footermod_contactinfo(){
        $address = get_config('theme_portal', 'footermod_contact_address');
        $city = get_config('theme_portal', 'footermod_contact_city');
        $phone = get_config('theme_portal', 'footermod_contact_phone');
        $mail = get_config('theme_portal', 'footermod_contact_mail');
        
        $content = '<div class="underlined"><h3>'.get_string('contactinfo','theme_portal').'</h3></div>';
        
        $content .= '<ul class="contactinfos">';
        $content .= '<li><i class="fa fa-home"></i>'.$address.'</li>';
        $content .= '<li><i class="fa fa-globe"></i>'.$city.'</li>';
        $content .= '<li><i class="fa fa-phone"></i>'.$phone.'</li>';
        $content .= '<li><i class="fa fa-envelope-o"></i>'.$mail.'</li>';
        $content .= '</ul>';
        
        return $content;
    }

    private function footermod_notice(){
        $title = get_config('theme_portal', 'footermod_notice_title');
        $text = get_config('theme_portal', 'footermod_notice_text');
        
        $content = '<div class="underlined"><h3>'.$title.'</h3></div>';
        $content .= '<p>'.$text.'</p>';
        
        return $content;
    }
    
    private function footermod_image(){
        $title = get_config('theme_portal', 'footermod_image_title');
        $src = get_config('theme_portal', 'footermod_image_url');
        
        $content = '<div class="underlined"><h3>'.$title.'</h3></div>';
        $content .= '<div class="image"><img src="'.$src.'"/></div>';
        
        return $content;
    }
    
    protected function footermod($modulearea){
        $module = get_config("theme_portal","footer".$modulearea);
        if(trim($module)!="" && trim($module)!="none"){
            $module = "footermod_".$module;
            return $this->$module();
        }else{
            return ' ';
        }
    }
    
    protected function linkbox($CFG){
        $linkboxitems = json_decode(get_config('theme_portal', 'linkboxdata'));
        $linkboxColumns = json_decode(get_config('theme_portal', 'linkboxColumns'));
        $showlinkboxes = get_config("theme_portal","showlinkboxes");

        $content = '<section id="link-boxes">
                        <div class="sklt-container">
                            <div class="clearfix v-padding">';

        if($showlinkboxes){
            $columns = '';

            switch ($linkboxColumns) {
                case '2':
                    $columns = 'eight columns';
                    break;
                case '3':
                    $columns = 'one-third column';
                    break;
                case '4':
                    $columns = 'four columns';
                    break;
                default:
                    $columns = 'one-third columns';
                    break;
            }

            $content .= '<div class="row">';

            for($x=1;$x<=sizeof($linkboxitems);$x++){
                $content .= '<div class="'.$columns.' if-rtl-flip">
                                <a class="circle" href="'.$linkboxitems[$x-1]->link.'"><i class="fa '.$linkboxitems[$x-1]->icon.'"></i></a>
                                <h3 class="title"><a href="'.$linkboxitems[$x-1]->link.'">'.$linkboxitems[$x-1]->title.'</a></h3>
                                <p>'.$linkboxitems[$x-1]->text.'</p>
                            </div>';

                if($x%$linkboxColumns==0){
                    $content .= '</div>';
                 
                    if($x!=sizeof($linkboxitems))   
                        $content .= '<div class="row">';
                }
            }

            if(sizeof($linkboxitems)%$linkboxColumns!=0)
                $content .= "</div>";
        }

        $content .= "       </div>
                        </div>
                    </section>
                    <!-- /#link-boxes -->";
        return $content;
    }

    protected function mycourses($CFG,$sidebar){
        $mycourses = enrol_get_users_courses($_SESSION['USER']->id);
        
        $courselist = array();
        foreach ($mycourses as $key=>$val){
            $courselist[] = $val->id;
        }
        
        $content = '';
        
        $coursesinline = 0;
        
        if($sidebar == "NONE")
            $coursesinline = 4;
        else
            $coursesinline = 3;
        
        for($x=1;$x<=sizeof($courselist);$x++){
            $course = get_course($courselist[$x-1]);
            $courseName = get_config('theme_portal','courseName');
            $title = $course->$courseName;
            
            if ($course instanceof stdClass) {
                require_once($CFG->libdir. '/coursecatlib.php');
                $course = new course_in_list($course);
            }

            $url = $CFG->wwwroot."/theme/portal/pix/coursenoimage.jpg";
            foreach ($course->get_course_overviewfiles() as $file) {
                $isimage = $file->is_valid_image();
                $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                        '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                        $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
                if (!$isimage) {
                    $url = $CFG->wwwroot."/theme/portal/pix/coursenoimage.jpg";
                }
            }
            
            $align = "";
            if($x % $coursesinline == 1)
                $align = "alpha";
            else if($x % $coursesinline == 0)
                $align = "omega";
                    
            $content .= '<div class="mycourses four columns course '.$align.'">
                            <a href="'.$CFG->wwwroot.'/course/view.php?id='.$courselist[$x-1].'">   
                                <img src="'.$url.'" alt="'.$title.'">
                                <div>'.$title.'</div>
                            </a>
                         </div>';
        }
                    
        return $content;
    }
    
    protected function introduction($CFG){
        $showintroduction = get_config("theme_portal","showintroduction");
        $introductiontitle = get_config("theme_portal","introductiontitle");
        $introductiontext = get_config("theme_portal","introductiontext");

        $content = '';

        if($showintroduction){
            $content .= '<!-- #introduction -->
                            <section id="introduction">
                                <div class="sklt-container">
                                    <div class="row">
                                        <div class="six columns v-padding super-title-box"><h1 class="super-title if-rtl-flip">'.$introductiontitle.'</h1></div>
                                        <div class="ten columns v-padding"><h2 class="intro-text if-rtl-flip">'.$introductiontext.'</h2></div>
                                    </div>
                                </div>
                            </section>
                        <!-- /#introduction -->';
        }

        return $content;
    }

    protected function imagewithtext($CFG){
        $showimagetext = get_config("theme_portal","showimagetext");
        $imagetexttext = get_config("theme_portal","imagetexttext");
        $imagetexttitle = get_config("theme_portal","imagetexttitle");
        $imagetextimage = get_config("theme_portal","imagetextimage");

        $content = '';

        if($showimagetext){
            $content .= '<!-- #image-with-text -->
                        <section id="image-with-text">
                            <div class="sklt-container">
                                <div class="clearfix v-padding">
                                    <div class="sixteen columns title if-rtl-flip">
                                        <h1>'.$imagetexttitle.'</h1>
                                        <h2 class="subtitle">'.$imagetexttext.'</h2>
                                    </div>
                                    <img class="if-rtl-flip" src="'.$imagetextimage.'" alt="'.$imagetexttext.'">
                                </div>
                            </div>
                        </section>
                        <!-- /#image-with-text -->';
        }

        return $content;
    }
    
    protected function html_blocks($CFG){
        $showhtmlblocks              = get_config('theme_portal','showhtmlblocks');
        
        $content = '';
        
        if($showhtmlblocks){
            $htmlblocktitle             = get_config('theme_portal','htmlblocktitle');
            $htmlblocksubtitle          = get_config('theme_portal','htmlblocksubtitle');
            $htmlblockpattern           = get_config('theme_portal','htmlblockpattern');
            $htmlblock1                 = get_config('theme_portal','htmlblock1');
            $htmlblock2                 = get_config('theme_portal','htmlblock2');

            $content = '<section id="video-with-text" class="feature" style="background-image: url('.$CFG->wwwroot.'/theme/portal/pix/patterns/'.$htmlblockpattern.')">
                            <div class="sklt-container">
                                <div class="clearfix v-padding">
                                    <div class="sixteen columns title if-rtl-flip">
                                        <h1>'.$htmlblocktitle.'</h1>
                                        <h2 class="subtitle">'.$htmlblocksubtitle.'</h2>
                                    </div>
                                    <div class="eight columns if-rtl-flip">
                                        '.$htmlblock1.'
                                    </div>
                                    <div class="eight columns if-rtl-flip">
                                        '.$htmlblock2.'
                                    </div>
                                </div>
                            </div>
                        </section>';
        }
        return $content;
    }

    protected function buttonbar(){
        $showbuttonbar              = get_config('theme_portal','showbuttonbar');

        $content = '';
        
        if($showbuttonbar){
            $buttonbartext             = get_config('theme_portal','buttonbartext');
            $buttonbarbuttontext       = get_config('theme_portal','buttonbarbuttontext');
            $buttonbarbuttonurl        = get_config('theme_portal','buttonbarbuttonurl');
            
            $content = '<!-- #button-bar -->
                        <section id="button-bar" class="buttons-block">
                            <div class="over-pattern opacity50 diagonal"></div>
                            <div class="sklt-container">
                                <div class="clearfix v-padding">
                                    <div class="sixteen columns if-rtl-flip">
                                        <h1 class="hyper-title">'.$buttonbartext.'</h1>
                                        <a target="_blank" href="'.$buttonbarbuttonurl.'" class="btn btn-large">'.$buttonbarbuttontext.'</a>
                                    </div>
                                </div>
                            </div>
                        </section><!-- /#button-bar -->';
        }

        return $content;
    }

    protected function featuredcourses($CFG){
        $showfeaturedcourses = get_config("theme_portal","showfeaturedcourses");

        $content = '';

        if($showfeaturedcourses){
            $featuredcourses = get_config('theme_portal', 'featuredcourses');
            $courselist = json_decode($featuredcourses);

            $content .= '<!-- #featured-courses -->
                            <section id="featured-courses">
                                <div class="sklt-container">
                                    <div class="clearfix v-padding">
                                        <div class="ten columns"><h1 class="if-rtl-flip">'.get_string('featuredcourses','theme_portal').'</h1></div>
                                        <div class="six columns control if-rtl-flip" dir="ltr">
                                            <a href="'.$CFG->wwwroot.'/course/" class="btn btn-small">'.get_string('allcourses','theme_portal').'</a><a href="#" class="btn btn-icon owl-prev"><i class="fa fa-angle-left"></i></a><a href="#" class="btn btn-icon owl-next"><i class="fa fa-angle-right"></i></a>
                                        </div>
                                        <div class="sixteen columns alpha omega" dir="ltr">
                                            <div id="owl-carousel" class="headers-light">';

                                            for($x=1;$x<=sizeof($courselist);$x++){
                                                $course = get_course($courselist[$x-1]);
                                                $courseName = get_config('theme_portal','courseName');
                                                $title = $course->$courseName;
                                                
                                                if ($course instanceof stdClass) {
                                                    require_once($CFG->libdir. '/coursecatlib.php');
                                                    $course = new course_in_list($course);
                                                }

                                                $url = $CFG->wwwroot."/theme/portal/pix/coursenoimage.jpg";
                                                foreach ($course->get_course_overviewfiles() as $file) {
                                                    $isimage = $file->is_valid_image();
                                                    $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                                                            '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                                                            $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
                                                    if (!$isimage) {
                                                        $url = $CFG->wwwroot."/theme/portal/pix/coursenoimage.jpg";
                                                    }
                                                }

                                                $content .= '<div class="item"><a href="'.$CFG->wwwroot.'/course/view.php?id='.$courselist[$x-1].'"><img src="'.$url.'" alt="'.$title.'" width="280" height="197" class="if-rtl-flip"></a><h3 class="if-rtl-flip">'.$title.'</h3></div>';
                                            }

            $content .= '                   </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <!-- /#featured-courses -->';
        }

        return $content;
    }
    
    protected function menu(){

        $menuitems = json_decode(get_config('theme_portal', 'menudata'));
        $content = '<ul id="menu-list" class="inline">';

        $currentpage = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $currentpage = str_replace("/my/", "", $currentpage);
        $currentpage = str_replace("/#", "", $currentpage);

        $active = '';

        $newCurrentPage = '';
        $isCourse = false;
        if(stristr($currentpage,'.php')){
            $exp = explode("/", $currentpage);
            $newCurrentPage = '';
            for($i=0; $i<sizeof($exp)-1;$i++){
                $newCurrentPage .= $exp[$i].'/';
                if($exp[$i] == 'course') $isCourse = true;
            }
        }
        if($isCourse) $currentpage = $newCurrentPage;

        if($currentpage[strlen($currentpage)-1] == '/') $currentpage = substr($currentpage, 0, -1);

        for($x=0;$x<sizeof($menuitems);$x++){         
//            echo str_replace("http://", "", str_replace("https://", "", $menuitems[$x]->link)).' -- '.$currentpage.'<br><br>';
            $active = ( $currentpage == str_replace("http://", "", str_replace("https://", "", $menuitems[$x]->link)))?'class="active"':'';

            if($menuitems[$x]->deep == '1'){
                $content .= '<li class="menu">';

                if($x+1 < sizeof($menuitems)){
                    if($menuitems[$x+1]->deep == '2'){
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'>'.$menuitems[$x]->text.' <i class="fa fa-angle-down"></i></a>
                                  <ul class="sub-menu lvl-1">';
                    }
                    else{
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'>'.$menuitems[$x]->text.'</a><li>';
                    }
                }else{
                    $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'>'.$menuitems[$x]->text.'</a><li>';
                }
            }

            if($menuitems[$x]->deep == '2'){
                $content .= '<li class="menu if-rtl-flip">';

                if($x+1 < sizeof($menuitems)){
                    if($menuitems[$x+1]->deep == '3'){
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div> <i class="fa fa-angle-right in-ltr-mode"></i></a>
                                  <ul class="lvl-2">';
                    }
                    else if($menuitems[$x+1]->deep == '2'){
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div></a><li>';
                    }
                    else{
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div></a><li></ul>';   
                    }
                }else{
                    $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div></a><li></ul></li>';
                }
            }

            if($menuitems[$x]->deep == '3'){
                $content .= '<li class="menu">';

                if($x+1 < sizeof($menuitems)){
                    if($menuitems[$x+1]->deep == '3'){
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div></a><li>';
                    }
                    else if($menuitems[$x+1]->deep == '2'){
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div></a><li></ul><li>';
                    }
                    else{
                        $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div></a><li></ul></li></ul></li>';
                    }
                }else{
                    $content .= '<a href="'.$menuitems[$x]->link.'" '.$active.'><div class="if-rtl-flip">'.$menuitems[$x]->text.'</div></a><li></ul></li></ul></li>';
                }
            }

        }
        
        $content .= '</ul>';

        return $content;
    }

    protected function responsive_menu(){

        $menuitems = json_decode(get_config('theme_portal', 'menudata'));
       
        $content = '';

        /* Responsive Menu */
        $content .= '   <div id="responsive_menu_button"></div>';

        $content .= '<div id="responsive_menu">';
        $content .= '   <ul class="rp-menu">';

        for($x=0;$x<sizeof($menuitems);$x++){

            if($menuitems[$x]->deep == '1'){
                if($menuitems[$x]->link[strlen($menuitems[$x]->link)-1] == '/') $menuitems[$x]->link = substr($menuitems[$x]->link, 0, -1);

                $content .= '<li>
                                <a href="'.$menuitems[$x]->link.'">'.$menuitems[$x]->text.'</a>';
                if(($x+1)>=sizeof($menuitems) || $menuitems[$x+1]->deep == '1'){
                    $content .= '</li>';
                }else{
                    $content .= '<ul'.((($x+1)>=sizeof($menuitems) || $menuitems[$x+1]->deep == '1')?'':' class="has-submenu"').'>';
                }
            }else if($menuitems[$x]->deep == '2'){
                $content .= '       <li>
                                        <a href="'.$menuitems[$x]->link.'">'.$menuitems[$x]->text.'</a>
                                    </li>';
                if(($x+1)>=sizeof($menuitems) || $menuitems[$x+1]->deep == '1'){
                    $content .= '</ul>
                             </li>';
                }
            }
        }

        $content .= '   </ul>';
        $content .= '</div>';



        return $content;
    }
    
    public function logo($CFG){
        $logourl = get_config('theme_portal', 'logourl');

        $content = '';
        if(!$logourl || trim($logourl)=="")
            $content = '<img class="if-rtl-flip" src="'.$CFG->wwwroot.'/theme/portal/pix/defaultlogo.png"/>';
        else{
            $content = '<img class="if-rtl-flip" src="'.$logourl.'"/>';
        }
        return $content;
    }

    public function favicon() {
        $faviconurl = get_config('theme_portal', 'faviconurl');
        if(!$faviconurl || trim($faviconurl)=="")
            $faviconurl = $this->page->theme->pix_url('favicon', 'theme');
        return $faviconurl;
    }

    protected function copyright(){
        $copyright = get_config('theme_portal', 'copyright');
        return $copyright;
    }

    protected function socialicons($area){
        $hassocialicons = get_config('theme_portal', $area.'socialicon');
        
        $social_facebook = get_config('theme_portal','social_facebook');
        $social_twitter = get_config('theme_portal','social_twitter');
        $social_gplus = get_config('theme_portal','social_gplus');
        $social_youtube = get_config('theme_portal','social_youtube');
        $social_vimeo =  get_config('theme_portal','social_vimeo');
        $social_pinterest = get_config('theme_portal','social_pinterest');
        $social_flickr = get_config('theme_portal','social_flickr');
        $social_rss = get_config('theme_portal','social_rss');
        $social_dribbble = get_config('theme_portal','social_dribbble');
        $social_linkedin = get_config('theme_portal','social_linkedin');
        $social_tumblr = get_config('theme_portal','social_tumblr');

        $social_foursquare = get_config('theme_portal','social_foursquare');
        $social_github = get_config('theme_portal','social_github');
        $social_skype = get_config('theme_portal','social_skype');
        $social_instagram = get_config('theme_portal','social_instagram');

        $content = '<ul class="social-icons if-rtl-flip">';
        
        if($hassocialicons){
            if(isset($social_facebook) && trim($social_facebook)!=""){
                $content .= '<li><a href="'.$social_facebook.'"><i class="fa fa-facebook"></i></a></li> ';
            }
            if(isset($social_twitter) && trim($social_twitter)!=""){
                $content .= '<li><a href="'.$social_twitter.'"><i class="fa fa-twitter"></i></a></li> ';
            }
            if(isset($social_gplus) && trim($social_gplus)!=""){
                $content .= '<li><a href="'.$social_gplus.'"><i class="fa fa-google-plus"></i></a></li> ';
            }
            if(isset($social_youtube) && trim($social_youtube)!=""){
                $content .= '<li><a href="'.$social_youtube.'"><i class="fa fa-youtube"></i></a></li> ';
            }
            if(isset($social_vimeo) && trim($social_vimeo)!=""){
                $content .= '<li><a href="'.$social_vimeo.'"><i class="fa fa-vimeo-square"></i></a></li> ';
            }
            if(isset($social_pinterest) && trim($social_pinterest)!=""){
                $content .= '<li><a href="'.$social_pinterest.'"><i class="fa fa-pinterest"></i></a></li> ';
            }
            if(isset($social_flickr) && trim($social_flickr)!=""){
                $content .= '<li><a href="'.$social_flickr.'"><i class="fa fa-flickr"></i></a></li> ';
            }
            if(isset($social_rss) && trim($social_rss)!=""){
                $content .= '<li><a href="'.$social_rss.'"><i class="fa fa-rss"></i></a></li> ';
            }
            if(isset($social_dribbble) && trim($social_dribbble)!=""){
                $content .= '<li><a href="'.$social_dribbble.'"><i class="fa fa-dribbble"></i></a></li> ';
            }
            if(isset($social_linkedin) && trim($social_linkedin)!=""){
                $content .= '<li><a href="'.$social_linkedin.'"><i class="fa fa-linkedin"></i></a></li> ';
            }
            if(isset($social_tumblr) && trim($social_tumblr)!=""){
                $content .= '<li><a href="'.$social_tumblr.'"><i class="fa fa-tumblr"></i></a></li> ';
            }
            if(isset($social_foursquare) && trim($social_foursquare)!=""){
                $content .= '<li><a href="'.$social_foursquare.'"><i class="fa fa-foursquare"></i></a></li> ';
            }
            if(isset($social_github) && trim($social_github)!=""){
                $content .= '<li><a href="'.$social_github.'"><i class="fa fa-github"></i></a></li> ';
            }
            if(isset($social_skype) && trim($social_skype)!=""){
                $content .= '<li><a href="'.$social_skype.'"><i class="fa fa-skype"></i></a></li> ';
            }
            if(isset($social_instagram) && trim($social_instagram)!=""){
                $content .= '<li><a href="'.$social_instagram.'"><i class="fa fa-instagram"></i></a></li> ';
            }
        } 
        
        $content .= '</ul>';
        
        return $content;
    }

    protected function slider($page){
        $slider = get_config('theme_portal', 'slidermode');
        $headerType = get_config("theme_portal","headerType");

        $content = '';
        
        if($slider == 'slideshow'){
            if($page == 'frontpage'){
                $slideritems = json_decode(get_config('theme_portal', 'slideshowdata'));

                $content .= '<section id="slideshow">
                                    <div id="wrapper">
                                        <div class="plume-slider" dir="ltr">';

                for($x=0;$x<sizeof($slideritems);$x++){

                    $content .= '           <div id="slide-'.($x+1).'" class="plume-slide">
                                                <div class="plume-slide-inner">
                                                    <div class="over-pattern dots opacity50"></div><div class="over-color opacity50"></div>
                                                    <div class="bg-img bg-img-'.($x+1).'"></div>
                                                    <div class="plume-slide-content">
                                                        <div class="elem-1 animation ccenter" data-type="easeOutSine" data-time="1000" data-delay="0" data-xy="-50, 0">
                                                            <div class="vcenter">
                                                                <h1>'.$slideritems[$x]->title.'</h1>
                                                                <h2>'.$slideritems[$x]->description.'</h2>
                                                                <a href="'.$slideritems[$x]->link.'" class="btn brand-2">'.get_string('readmore','theme_portal').'</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

                }

                $content .= '           </div><!-- /.plume-slider -->';
                      
                if(sizeof($slideritems) > 1 ){
                    $content .= '           <!-- arrows -->
                                            <span class="nav-arrow prev"></span>
                                            <span class="nav-arrow next"></span>

                                            <!-- bullets -->
                                            <ul class="plume-bullets">';

                                                for($x=0;$x<sizeof($slideritems);$x++){
                                                    $content .= '<li><a id="bullet-'.($x+1).'" class="nav-bullet" href="#"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="76.729px" height="81.726px" viewBox="-6.468 -6.776 76.729 81.726" enable-background="new -6.468 -6.776 76.729 81.726" xml:space="preserve"><g><g>
                                                                 <rect class="bullet-part-1" x="18.267" y="17.955" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 76.7864 31.3677)" fill="#FFFFFF" width="27.261" height="27.262"/><path class="bullet-part-2" fill="#D8D8D8" d="M31.896,13.724l17.865,17.861L31.896,49.451L14.033,31.586L31.896,13.724 M31.896,10.896l-1.414,1.414 L12.619,30.172l-1.415,1.414L12.619,33l17.863,17.865l1.414,1.414l1.414-1.414L51.176,33l1.414-1.414l-1.414-1.415L33.31,12.31 L31.896,10.896L31.896,10.896z"/></g><path class="bullet-part-3" enable-background="new" d="M31.896-1.776L-6.468,34.588l38.364,40.361l38.365-40.361L31.896-1.776z M5.798,31.588L31.898,8.487l26.1,23.101l-26.101,31.1L5.798,31.588z"/><path class="bullet-part-4" fill="#FFFFFF" d="M31.896-6.776L-6.468,31.588l38.364,38.361l38.365-38.361L31.896-6.776z M5.798,31.588L31.898,5.487 l26.1,26.101l-26.101,26.1L5.798,31.588z"/><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="31.8577" y1="64.8787" x2="31.8577" y2="29.1526" gradientTransform="matrix(1 0 0 -1 0.04 78.603)"><stop  offset="0" style="stop-color:#000000"/><stop offset="1" style="stop-color:#FFFFFF"/></linearGradient><polygon class="bullet-part-5" fill="url(#SVGID_1_)" enable-background="new" points="14.033,31.586 31.896,13.724 49.761,31.586 31.896,49.451"/></g></svg></a></li>';
                                                }
                    $content .= '           </ul>';
                }

                $content .= '       </div><!-- /.slider -->
                                <div class="clear"></div>
                            </section><!-- /#slideshow -->';
            }else if($headerType != '3' && $headerType != '4'){
                $slideritems = json_decode(get_config('theme_portal', 'slideshowdata'));

                $content .= '<section id="slideshow" style="height: 120px; ">
                                    <div id="wrapper">
                                        <div class="plume-slider">';

                for($x=0;$x<sizeof($slideritems);$x++){

                    $content .= '           <div id="slide-'.($x+1).'" class="plume-slide">
                                                <div class="plume-slide-inner">
                                                    <div class="over-pattern dots opacity50"></div><div class="over-color opacity50"></div>
                                                    <div class="bg-img bg-img-'.($x+1).'"></div>
                                                </div>
                                            </div>';

                }

                $content .= '           </div><!-- /.plume-slider -->';
                $content .= '       </div><!-- /.slider -->
                                <div class="clear"></div>
                            </section><!-- /#slideshow -->';
            }
        }else{
            $content .= '';
        }
        return $content;
    }

    protected function get_header($CFG, $is_front, $topbutton){
        $headerType = get_config("theme_portal","headerType");
        $slider = get_config('theme_portal', 'slidermode');

        if($slider == 'slideshow'){
            if(!$is_front){
                if($headerType == '3') $headerType = '4';
            }

            $function = "get_header_type".$headerType;
            $this->$function($CFG, $is_front, $topbutton);
        }else{
            $this->get_header_type4($CFG, $is_front, $topbutton);
        }
    }

    protected function get_header_type1($CFG, $is_front, $topbutton){
        echo '<section id="topbar" class="over-slideshow transparent">
                    <div class="sklt-container">
                        <div class="sixteen columns">
                            '.$this->socialicons('header').

                            '<div id="login" class="if-rtl-flip">';
                                
        switch ($topbutton) {
                                case 'home':
                                    echo '<a href="'.$CFG->wwwroot.'">'.get_string('home','theme_portal').'</a>';
                                break;
                                default:
                                    if(isloggedin())
                                        echo '<a href="'.$CFG->wwwroot.'/login/logout.php">'.get_string('logout','theme_portal').'</a>';
                                    else
                                        echo '<a href="'.$CFG->wwwroot.'/login">'.get_string('login','theme_portal').'</a>';
        }

        echo                '</div>';

        if(isloggedin() && get_config('theme_portal', 'loggedAs')){
            echo '<p id="topText" class="if-rtl-flip"> '.$this->login_info(false).'</p>';
        }else if(!isloggedin() && get_config('theme_portal', 'registerLink')){
            echo '<p id="topText" class="if-rtl-flip"><a href="'.$CFG->wwwroot.'/login/signup.php">'.get_string('register','theme_portal').'</a></p>';
        }

        echo '         </div>
                    </div>
                </section><!-- /#topbar -->

                <!-- #menubar -->
                <section id="menubar" class="over-slideshow transparent">
                    <div class="sklt-container">
                        <div class="four columns if-rtl-flip"><a href="'.$CFG->wwwroot.'" class="logo if-rtl-flip clearfix">'.$this->logo($CFG).'</a></div>
                        <div class="twelve columns">
                            <!-- main menu -->
                            <a href="#" id="bt-menu-mobile"><i class="fa fa-bars"></i></a>
                            <nav id="mainmenu" class="if-rtl-flip">
                                '.$this->menu().'
                            </nav>
                        </div>
                    </div>
                </section><!-- /#menubar -->';

    }

    protected function get_header_type2($CFG, $is_front, $topbutton){
        echo '<section id="topbar" class="over-slideshow">
                    <div class="sklt-container">
                        <div class="sixteen columns">
                            '.$this->socialicons('header').'
                            <div id="login" class="if-rtl-flip">';
                                
        switch ($topbutton) {
                                case 'home':
                                    echo '<a href="'.$CFG->wwwroot.'">'.get_string('home','theme_portal').'</a>';
                                break;
                                default:
                                    if(isloggedin())
                                        echo '<a href="'.$CFG->wwwroot.'/login/logout.php">'.get_string('logout','theme_portal').'</a>';
                                    else
                                        echo '<a href="'.$CFG->wwwroot.'/login">'.get_string('login','theme_portal').'</a>';
        }

        echo                '</div>';

        if(isloggedin() && get_config('theme_portal', 'loggedAs')){
            echo '<p id="topText" class="if-rtl-flip"> '.$this->login_info(false).'</p>';
        }else if(!isloggedin() && get_config('theme_portal', 'registerLink')){
            echo '<p id="topText" class="if-rtl-flip"><a href="'.$CFG->wwwroot.'/login/signup.php">'.get_string('register','theme_portal').'</a></p>';
        }

        echo           '</div>
                    </div>
                </section><!-- /#topbar -->

                <!-- #menubar -->
                <section id="menubar" class="over-slideshow transparent">
                    <div class="sklt-container">
                        <div class="four columns if-rtl-flip"><a href="'.$CFG->wwwroot.'" class="logo if-rtl-flip clearfix">'.$this->logo($CFG).'</a></div>
                        <div class="twelve columns">
                            <!-- main menu -->
                            <a href="#" id="bt-menu-mobile"><i class="fa fa-bars"></i></a>
                            <nav id="mainmenu" class="if-rtl-flip">
                                '.$this->menu().'
                            </nav>
                        </div>
                    </div>
                </section><!-- /#menubar -->';

    }

    protected function get_header_type3($CFG, $is_front, $topbutton){
        echo '<section id="topbar" class="over-slideshow">
                    <div class="sklt-container">
                        <div class="sixteen columns">
                            '.$this->socialicons('header').'
                            <div id="login" class="if-rtl-flip">';
                                
        switch ($topbutton) {
                                case 'home':
                                    echo '<a href="'.$CFG->wwwroot.'">'.get_string('home','theme_portal').'</a>';
                                break;
                                default:
                                    if(isloggedin())
                                        echo '<a href="'.$CFG->wwwroot.'/login/logout.php">'.get_string('logout','theme_portal').'</a>';
                                    else
                                        echo '<a href="'.$CFG->wwwroot.'/login">'.get_string('login','theme_portal').'</a>';
        }

        echo                '</div>';

        if(isloggedin() && get_config('theme_portal', 'loggedAs')){
            echo '<p id="topText" class="if-rtl-flip"> '.$this->login_info(false).'</p>';
        }else if(!isloggedin() && get_config('theme_portal', 'registerLink')){
            echo '<p id="topText" class="if-rtl-flip"><a href="'.$CFG->wwwroot.'/login/signup.php">'.get_string('register','theme_portal').'</a></p>';
        }

        echo           '</div>
                    </div>
                </section><!-- /#topbar -->

                <!-- #menubar -->
                <section id="menubar" class="over-slideshow">
                    <div class="sklt-container">
                        <div class="four columns if-rtl-flip"><a href="'.$CFG->wwwroot.'" class="logo if-rtl-flip clearfix">'.$this->logo($CFG).'</a></div>
                        <div class="twelve columns">
                            <!-- main menu -->
                            <a href="#" id="bt-menu-mobile"><i class="fa fa-bars"></i></a>
                            <nav id="mainmenu" class="if-rtl-flip">
                                '.$this->menu().'
                            </nav>
                        </div>
                    </div>
                </section><!-- /#menubar -->';

    }

    protected function get_header_type4($CFG, $is_front, $topbutton){
        echo '<section id="topbar">
                    <div class="sklt-container">
                        <div class="sixteen columns">
                            '.$this->socialicons('header').'
                            <div id="login" class="if-rtl-flip">';
                                
        switch ($topbutton) {
                                case 'home':
                                    echo '<a href="'.$CFG->wwwroot.'">'.get_string('home','theme_portal').'</a>';
                                break;
                                default:
                                    if(isloggedin())
                                        echo '<a href="'.$CFG->wwwroot.'/login/logout.php">'.get_string('logout','theme_portal').'</a>';
                                    else
                                        echo '<a href="'.$CFG->wwwroot.'/login">'.get_string('login','theme_portal').'</a>';
        }

        echo                '</div>';

        if(isloggedin() && get_config('theme_portal', 'loggedAs')){
            echo '<p id="topText" class="if-rtl-flip"> '.$this->login_info(false).'</p>';
        }else if(!isloggedin() && get_config('theme_portal', 'registerLink')){
            echo '<p id="topText" class="if-rtl-flip"><a href="'.$CFG->wwwroot.'/login/signup.php">'.get_string('register','theme_portal').'</a></p>';
        }

        echo            '</div>
                    </div>
                </section><!-- /#topbar -->

                <!-- #menubar -->
                <section id="menubar">
                    <div class="sklt-container">
                        <div class="four columns if-rtl-flip"><a href="'.$CFG->wwwroot.'" class="logo if-rtl-flip clearfix">'.$this->logo($CFG).'</a></div>
                        <div class="twelve columns">
                            <!-- main menu -->
                            <a href="#" id="bt-menu-mobile"><i class="fa fa-bars"></i></a>
                            <nav id="mainmenu" class="if-rtl-flip">
                                '.$this->menu().'
                            </nav>
                        </div>
                    </div>
                </section><!-- /#menubar -->';

    }

    protected function loadGoogleFont(){
        $fontFamily = get_config('theme_portal', 'font');

        switch ($fontFamily) {
            case 'oxygen':
                /* Theme Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>";
                /* Theme Options Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>";
                break;
            case 'lato':
                /* Theme Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>";
                /* Theme Options Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>";
                break;
            case 'roboto':
                /* Theme Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Roboto:400,100italic,100,300italic,300,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>";
                /* Theme Options Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>";
                break;
            case 'ubuntu':
                /* Theme & Theme Options Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>";
                break;
            default:
                /* Theme Options Font */
                echo "<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>";
                break;
        }
    }

    protected function otherLoginMethods($CFG){
        $shibbolethLogin = get_config('theme_portal', 'shibbolethLogin');
        $guestLogin = get_config('theme_portal', 'guestLogin');

        echo '<div class="otherLoginMethod">';

        if($shibbolethLogin){
            echo '<a href="'.$CFG->wwwroot.'/auth/shibboleth/index.php" class="shibbolethLogin">'.get_string('loginwith','theme_portal').' Shibboleth</a>';
        }

        if($guestLogin){
            echo '<div class="subcontent guestsub">
                        <div class="desc">
                            '.get_string('mayAllowGuestAccess','theme_portal').'        
                        </div>
                        <form action="index.php" method="post" id="guestlogin">
                            <div class="guestform">
                                <input type="hidden" name="username" value="guest">
                                <input type="hidden" name="password" value="guest">
                                <input type="submit" value="'.get_string('loginAsGuest','theme_portal').'">
                            </div>
                        </form>
                    </div>';
        }

        echo '</div>';
    }
    
    protected function render_navigation_node(navigation_node $item) {
        $content = $item->get_content();
        $title = $item->get_title();
        if ($item->icon instanceof renderable && !$item->hideicon) {
            if(trim($content) == 'Portal')
                $item->icon->pix = 'g/portal_'.get_config('theme_portal','themecolor');
            $icon = $this->render($item->icon);
            if(trim($content) == 'Portal')
                $content = '<b>Portal</b>';
            $content = $icon.$content; // use CSS for spacing of icons
        }
        if ($item->helpbutton !== null) {
            $content = trim($item->helpbutton).html_writer::tag('span', $content, array('class'=>'clearhelpbutton', 'tabindex'=>'0'));
        }
        if ($content === '') {
            return '';
        }
        if ($item->action instanceof action_link) {
            $link = $item->action;
            if ($item->hidden) {
                $link->add_class('dimmed');
            }
            if (!empty($content)) {
                // Providing there is content we will use that for the link content.
                $link->text = $content;
            }
            $content = $this->render($link);
        } else if ($item->action instanceof moodle_url) {
            $attributes = array();
            if ($title !== '') {
                $attributes['title'] = $title;
            }
            if ($item->hidden) {
                $attributes['class'] = 'dimmed_text';
            }
            $content = html_writer::link($item->action, $content, $attributes);

        } else if (is_string($item->action) || empty($item->action)) {
            $attributes = array('tabindex'=>'0'); //add tab support to span but still maintain character stream sequence.
            if ($title !== '') {
                $attributes['title'] = $title;
            }
            if ($item->hidden) {
                $attributes['class'] = 'dimmed_text';
            }
            $content = html_writer::tag('span', $content, $attributes);
        }
        return $content;
    }

    public function login_info($withlinks = null) {
        global $USER, $CFG, $DB, $SESSION;

        if (during_initial_install()) {
            return '';
        }

        if (is_null($withlinks)) {
            $withlinks = empty($this->page->layout_options['nologinlinks']);
        }

        $loginpage = ((string)$this->page->url === get_login_url());
        $course = $this->page->course;

        $moodleVersion = get_config('theme_portal', 'moodleVersion');
        if($moodleVersion == '25'){
            if (session_is_loggedinas()) {
                $realuser = session_get_realuser();
                $fullname = fullname($realuser, true);
                if ($withlinks) {
                    $loginastitle = get_string('loginas');
                    $realuserinfo = " [<a href=\"$CFG->wwwroot/course/loginas.php?id=$course->id&amp;sesskey=".sesskey()."\"";
                    $realuserinfo .= "title =\"".$loginastitle."\">$fullname</a>] ";
                } else {
                    $realuserinfo = " [$fullname] ";
                }
            } else {
                $realuserinfo = '';
            }
        }else{
            if (\core\session\manager::is_loggedinas()) {
                $realuser = session_get_realuser();
                $fullname = fullname($realuser, true);
                if ($withlinks) {
                    $loginastitle = get_string('loginas');
                    $realuserinfo = " [<a href=\"$CFG->wwwroot/course/loginas.php?id=$course->id&amp;sesskey=".sesskey()."\"";
                    $realuserinfo .= "title =\"".$loginastitle."\">$fullname</a>] ";
                } else {
                    $realuserinfo = " [$fullname] ";
                }
            } else {
                $realuserinfo = '';
            }
        }

        $loginurl = get_login_url();

        if (empty($course->id)) {
            // $course->id is not defined during installation
            return '';
        } else if (isloggedin()) {
            $context = context_course::instance($course->id);

            $fullname = fullname($USER, true);
            // Since Moodle 2.0 this link always goes to the public profile page (not the course profile page)
            if ($withlinks) {
                $linktitle = get_string('viewprofile');
                $username = "<a href=\"$CFG->wwwroot/user/profile.php?id=$USER->id\" title=\"$linktitle\">$fullname</a>";
            } else {
                $username = $fullname;
            }
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host', array('id'=>$USER->mnethostid))) {
                if ($withlinks) {
                    $username .= " from <a href=\"{$idprovider->wwwroot}\">{$idprovider->name}</a>";
                } else {
                    $username .= " from {$idprovider->name}";
                }
            }
            if (isguestuser()) {
                $loggedinas = $realuserinfo.get_string('loggedinasguest');
                if (!$loginpage && $withlinks) {
                    $loggedinas .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
                }
            } else if (is_role_switched($course->id)) { // Has switched roles
                $rolename = '';
                if ($role = $DB->get_record('role', array('id'=>$USER->access['rsw'][$context->path]))) {
                    $rolename = ': '.role_get_name($role, $context);
                }
                $loggedinas = get_string('loggedinas', 'moodle', $username).$rolename;
                if ($withlinks) {
                    $url = new moodle_url('/course/switchrole.php', array('id'=>$course->id,'sesskey'=>sesskey(), 'switchrole'=>0, 'returnurl'=>$this->page->url->out_as_local_url(false)));
                    $loggedinas .= '('.html_writer::tag('a', get_string('switchrolereturn'), array('href'=>$url)).')';
                }
            } else {
                $loggedinas = $realuserinfo.get_string('loggedinas', 'moodle', $username);
                if ($withlinks) {
                    $loggedinas .= " (<a href=\"$CFG->wwwroot/login/logout.php?sesskey=".sesskey()."\">".get_string('logout').'</a>)';
                }
            }
        } else {
            $loggedinas = get_string('loggedinnot', 'moodle');
            if (!$loginpage && $withlinks) {
                $loggedinas .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
            }
        }

        if (isset($SESSION->justloggedin)) {
            unset($SESSION->justloggedin);
            if (!empty($CFG->displayloginfailures)) {
                if (!isguestuser()) {
                    if ($count = count_login_failures($CFG->displayloginfailures, $USER->username, $USER->lastlogin)) {
                        $loggedinas .= '&nbsp;<div class="loginfailures">';
                        if (empty($count->accounts)) {
                            $loggedinas .= get_string('failedloginattempts', '', $count);
                        } else {
                            $loggedinas .= get_string('failedloginattemptsall', '', $count);
                        }
                        if (file_exists("$CFG->dirroot/report/log/index.php") and has_capability('report/log:view', context_system::instance())) {
                            $loggedinas .= ' (<a href="'.$CFG->wwwroot.'/report/log/index.php'.
                                                 '?chooselog=1&amp;id=1&amp;modid=site_errors">'.get_string('logs').'</a>)';
                        }
                        $loggedinas .= '</div>';
                    }
                }
            }
        }

        return $loggedinas;
    }

    public function navbar() {
        $items = $this->page->navbar->get_items();
        $itemcount = count($items);
        if ($itemcount === 0) {
            return '';
        }

        $htmlblocks = array();
        // Iterate the navarray and display each node
        $separator = '<i class="fa fa-angle-double-right"> </i>';

        for ($i=0;$i < $itemcount;$i++) {
            $item = $items[$i];
            $item->hideicon = true;
            if ($i===0) {
                $content = html_writer::tag('li', $this->render($item));
            } else {
                $content = html_writer::tag('li', $separator.$this->render($item));
            }
            $htmlblocks[] = $content;
        }

        //accessibility: heading for navbar list  (MDL-20446)
        $navbarcontent = html_writer::tag('span', get_string('pagepath'), array('class'=>'accesshide'));
        $navbarcontent .= html_writer::tag('ul', join('', $htmlblocks), array('role'=>'navigation'));
        // XHTML
        return $navbarcontent;
    }
}

include_once($CFG->dirroot . "/course/renderer.php");

class theme_portal_core_course_renderer extends core_course_renderer {
    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        global $CFG;

        if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
            return '';
        }
        if ($course instanceof stdClass) {
            require_once($CFG->libdir. '/coursecatlib.php');
            $course = new course_in_list($course);
        }
        $content = '';

        // display course overview files
        $contentimages = $contentfiles = '';
        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                    '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                    $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimages .= html_writer::tag('div',
                        html_writer::empty_tag('img', array('src' => $url)),
                        array('class' => 'courseimage'));
            } else {
                $image = $this->output->pix_icon(file_file_icon($file, 24), $file->get_filename(), 'moodle');
                $filename = html_writer::tag('span', $image, array('class' => 'fp-icon')).
                        html_writer::tag('span', $file->get_filename(), array('class' => 'fp-filename'));
                $contentfiles .= html_writer::tag('span',
                        html_writer::link($url, $filename),
                        array('class' => 'coursefile fp-filename-icon'));
            }
        }
        $content .= $contentimages. $contentfiles;

        // display course summary
        if ($course->has_summary()) {
            $content .= html_writer::start_tag('div', array('class' => 'summary'));
            $content .= $chelper->get_course_formatted_summary($course,
                    array('overflowdiv' => false, 'noclean' => true, 'para' => false));
            $content .= html_writer::end_tag('div'); // .summary
        }

        // display course contacts. See course_in_list::get_course_contacts()
        if ($course->has_course_contacts()) {
            $content .= html_writer::start_tag('ul', array('class' => 'teachers'));
            foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                $name = $coursecontact['rolename'].': '.
                        html_writer::link(new moodle_url('/user/view.php',
                                array('id' => $userid, 'course' => SITEID)),
                            $coursecontact['username']);
                $content .= html_writer::tag('li', $name);
            }
            $content .= html_writer::end_tag('ul'); // .teachers
        }

        // display course category if necessary (for example in search results)
        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_EXPANDED_WITH_CAT) {
            require_once($CFG->libdir. '/coursecatlib.php');
            if ($cat = coursecat::get($course->category, IGNORE_MISSING)) {
                $content .= html_writer::start_tag('div', array('class' => 'coursecat'));
                $content .= get_string('category').': '.
                        html_writer::link(new moodle_url('/course/index.php', array('categoryid' => $cat->id)),
                                $cat->get_formatted_name(), array('class' => $cat->visible ? '' : 'dimmed'));
                $content .= html_writer::end_tag('div'); // .coursecat
            }
        }

        return $content;
    }
}

?>
