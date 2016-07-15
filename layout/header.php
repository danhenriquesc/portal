<?php 
    $is_front = isset($PAGE->layout_options['is_front'])?$PAGE->layout_options['is_front']:false;
    $topbutton = (isset($PAGE->layout_options['topbutton']))?$PAGE->layout_options['topbutton']:'logout';

    $OUTPUT->get_header($CFG, $is_front, $topbutton);
?>

