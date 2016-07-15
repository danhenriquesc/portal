<section id="footer">
    <div class="over-color opacity80"></div>
    <div class="sklt-container">
        <div class="clearfix v-padding">
            <?php 
                $current = 1;

                while($current <= 4){
                    $module = get_config("theme_portal","footermodule".$current);
                    $count = 1;
                    
                    while($module == get_config("theme_portal","footermodule".++$current)) { $count++; }
                    $current--;

                    $columns = '';
                    
                    switch ($count) {
                        case 1:
                            $columns = 'four';
                            break;
                        case 2:
                            $columns = 'eight';
                            break;
                        case 3:
                            $columns = 'twelve';
                            break;
                        case 4:
                            $columns = 'full';
                            break;
                        default:
                            $columns = 'four';
                            break;
                    }

                    echo '<div class="'.$columns.' columns if-rtl-flip">'.$OUTPUT->footermod("module".$current).'</div>';

                    $current++;
                }
            ?>
        </div>
    </div>
</section><!-- /#footer -->

<!-- #bottom-bar -->
<section id="bottom-bar">
    <div class="sklt-container">
        <div class="sixteen columns">
            <div id="copyright" class="if-rtl-flip"><p><?php echo $OUTPUT->copyright(); ?></p></div>
            <div id="connect">
                <?php echo $OUTPUT->socialicons('footer'); ?>
            </div>        
        </div>
    </div>
</section><!-- /#bottom-bar -->