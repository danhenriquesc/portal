<?php

/**
 * Makes our changes to the CSS
 *
 * @param string $css
 * @param theme_config $theme
 * @return string 
 */
function portal_process_css($css, $theme) {
    global $CFG;
    $themecolor = $theme->settings->themecolor;
    
    switch ($themecolor) {
        case 'blue':
            $color1 = "#2299EE";
            $color2 = "#51AFF2";
            $color3 = "#FFAA00";
            $color4 = "#FFBB33";
            $color5 = '#114C77';
            break;
        case 'purple':
            $color1 = "#3A1C4E";
            $color2 = "#743B9C";
            $color3 = "#FF7E00";
            $color4 = "#FF8F33";
            $color5 = "#2E0D44";
            break;
        case 'green':
            $color1 = "#00564D";
            $color2 = "#00AA98";
            $color3 = "#55BAEE";
            $color4 = "#55CBFF";
            $color5 = "#06332E";
            break;
        case 'custom':
            $color1 = $theme->settings->customColorScheme1;
            $color2 = $theme->settings->customColorScheme2;
            $color3 = $theme->settings->customColorScheme3;

            $colorA = str_split($color3);
            $color4 = $colorA[0] . dechex( min(255, hexdec($colorA[1] . $colorA[2]) + 17) ) . dechex( min(255, hexdec($colorA[3] . $colorA[4]) + 17) ) . dechex( min(255, hexdec($colorA[5] . $colorA[6]) + 17) );

            $colorA = str_split($color1);
            $color5 = $colorA[0] . str_pad(dechex( max(0, hexdec($colorA[1] . $colorA[2]) - 17) ), 2, '0', STR_PAD_LEFT) . str_pad(dechex( max(0, hexdec($colorA[3] . $colorA[4]) - 17) ), 2, '0', STR_PAD_LEFT) . str_pad(dechex( max(0, hexdec($colorA[5] . $colorA[6]) - 17)), 2, '0', STR_PAD_LEFT);
            
            break;
    }
    
    $layoutStyle = $theme->settings->layoutStyle;
    $bgstyle = '';

    switch ($layoutStyle) {
        case 'bgcolor':
            $bgstyle = '
                        body{
                            left: 50%;
                            margin-left: -675px;
                            position: absolute;
                            width: 1350px;
                        }

                        html{
                            background: '.$theme->settings->bgcolor.'
                        }

                        ';
            break;
        case 'bgpattern':
            $bgstyle = '
                        body{
                            left: 50%;
                            margin-left: -675px;
                            position: absolute;
                            width: 1350px;
                        }

                        html{
                            background-image: url('.((isset($theme->settings->bgpatternCustom) && trim($theme->settings->bgpatternCustom) != "")?$theme->settings->bgpatternCustom:$CFG->wwwroot."/theme/portal/pix/patterns/".$theme->settings->bgpattern).');
                            background-attachment: scroll;
                            background-size: auto;
                            background-position: 50% 50%;
                            background-repeat: repeat repeat;
                        }

                        ';
            break;
        case 'bgimage':
            $bgstyle = '
                        body{
                            left: 50%;
                            margin-left: -675px;
                            position: absolute;
                            width: 1350px;
                        }

                        html{
                            background-image: url('.$theme->settings->bgimage.');
                            background-attachment: fixed;
                            background-size: cover;
                            background-position: 50% 50%;
                            background-repeat: no-repeat no-repeat;
                        }

                        ';
            break;
    }

    $slideritems = json_decode($theme->settings->slideshowdata);
    
    $slidecss = "";
    for($x=1;$x<=sizeof($slideritems);$x++){
        $slidecss .= '.bg-img-'.$x.' {
                            background-image: url('.$slideritems[$x-1]->image.');
                        }';
    }

    $featuredcoursesitems = json_decode($theme->settings->featuredcourses);
    $featuredCoursesMediaQuery = "";
    if( sizeof($featuredcoursesitems) <= 4){
        $featuredCoursesMediaQuery = '.owl-prev, .owl-next { display: none !important; }';

        if( sizeof($featuredcoursesitems) == 4){
            $featuredCoursesMediaQuery .= '@media only screen and (max-width: 959px) { .owl-prev, .owl-next { display: inline-block !important; } } ';
        }

        if( sizeof($featuredcoursesitems) > 1){
            $featuredCoursesMediaQuery .= '@media only screen and (max-width: 767px) { .owl-prev, .owl-next { display: inline-block !important; } } ';
        }
    }

    $css = str_replace("[[setting:slidebackgrounds]]", $slidecss, $css);
    $css = str_replace("[[setting:color1]]", $color1, $css);
    $css = str_replace("[[setting:color2]]", $color2, $css);
    $css = str_replace("[[setting:color3]]", $color3, $css);
    $css = str_replace("[[setting:color4]]", $color4, $css);
    $css = str_replace("[[setting:color5]]", $color5, $css);
    $css = str_replace("[[setting:fontFamily]]", ucfirst($theme->settings->font), $css);
    $css = str_replace("[[setting:customCSS]]", $theme->settings->customCSS, $css);
    $css = str_replace("[[setting:footerBackground]]", $theme->settings->footerBackground, $css);
    $css = str_replace("[[setting:featuredCoursesMediaQuery]]", $featuredCoursesMediaQuery, $css);
    $css = str_replace("[[setting:fontDir]]", $CFG->wwwroot.'/theme/portal/fonts/', $css);


    $css = str_replace("[[setting:bgstyle]]", $bgstyle, $css);

    // Return the CSS
    return $css;
}

?>