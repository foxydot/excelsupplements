<?php
remove_all_actions('genesis_entry_header');
remove_all_actions('genesis_entry_footer');
add_action('genesis_entry_content','msdlab_display_testimonial');

function msdlab_display_testimonial(){
    global $post,$testimonial_info;
    $ret = false;
    $testimonial_info->the_meta($post->ID);
    $title = $post->post_title;
    $quote = apply_filters('the_content',$testimonial_info->get_the_value('quote'));
    $name = $testimonial_info->get_the_value('attribution')!=''?'<span class="name">'.$testimonial_info->get_the_value('attribution').'</span> ':'';
    $position = $testimonial_info->get_the_value('position')!=''?'<span class="position">'.$testimonial_info->get_the_value('position').'</span> ':'';
    $company = $testimonial_info->get_the_value('company')!=''?'<span class="company">'.$testimonial_info->get_the_value('company').'</span> ':'';
    $np = $name != '' && ($position != '' || $company != '')?', ':'';
    $pc = $position != '' && $company != ''?', ':'';
    //$ret .= '<div class="title"><h3>'.$title.'</h3></div>';
    $ret .= '<div class="quote">'.$quote.'</div>
    <div class="attribution">&mdash;'.$name.$np.$position.$pc.$company.'</div>';
    print $ret;      
}
genesis();
