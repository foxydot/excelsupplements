<?php
/**
 * Connected Class
 */
if(class_exists('MSDConnected')){
class KohlerConnected extends MSDConnected {
    function widget( $args, $instance ) {
        extract($args);
        extract($instance);
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
        echo $before_widget;
        if($args[id] == 'pre-header'){
            if ( $phone ){
                $phone = '';
                if((get_option('msdsocial_tracking_phone')!='')){
                    if(wp_is_mobile()){
                      $phone .= '<a href="tel:+1'.get_option('msdsocial_tracking_phone').'">'.get_option('msdsocial_tracking_phone').'</a> ';
                    } else {
                      $phone .= '<span>'.get_option('msdsocial_tracking_phone').'</span> ';
                    }
                  $phone .= '<span itemprop="telephone" style="display: none;">'.get_option('msdsocial_phone').'</span> ';
                } else {
                    if(wp_is_mobile()){
                      $phone .= (get_option('msdsocial_phone')!='')?'<a href="tel:+1'.get_option('msdsocial_phone').'" itemprop="telephone">'.get_option('msdsocial_phone').'</a> ':'';
                    } else {
                      $phone .= (get_option('msdsocial_phone')!='')?'<span itemprop="telephone">'.get_option('msdsocial_phone').'</span> ':'';
                    }
                }
                if ( $phone ){ print '<div class="connected-phone">'.$phone.'</div>'; }
            }
            if ( $tollfree ){
                $tollfree = '';
                if((get_option('msdsocial_tracking_tollfree')!='')){
                    if(wp_is_mobile()){
                      $tollfree .= '<a href="tel:+1'.get_option('msdsocial_tracking_tollfree').'">'.get_option('msdsocial_tracking_tollfree').'</a> ';
                    } else {
                      $tollfree .= '<span>'.get_option('msdsocial_tracking_tollfree').'</span> ';
                    }
                  $tollfree .= '<span itemprop="telephone" style="display: none;">'.get_option('msdsocial_tollfree').'</span> ';
                } else {
                    if(wp_is_mobile()){
                      $tollfree .= (get_option('msdsocial_tollfree')!='')?'<a href="tel:+1'.get_option('msdsocial_tollfree').'" itemprop="telephone">'.get_option('msdsocial_tollfree').'</a> ':'';
                    } else {
                      $tollfree .= (get_option('msdsocial_tollfree')!='')?'<span itemprop="telephone">'.get_option('msdsocial_tollfree').'</span> ':'';
                    }
                }
                if ( $tollfree ){ print '<div class="connected-tollfree">'.$tollfree.'</div>'; }
            }
            if ( $email ){
                $email = (get_option('msdsocial_email')!='')?'<span itemprop="email"><a href="mailto:'.antispambot(get_option('msdsocial_email')).'"><i class="fa fa-envelope-o"></i></a></span> ':'';
                if ( $email ){ print '<div class="connected-email">'.$email.'</div>'; }
            }
        } else {
            if ( !empty( $title ) ) { print $before_title.$title.$after_title; } 
            if ( !empty( $text )){ print '<div class="connected-text">'.$text.'</div>'; }
            //if(($address||$phone||$tollfree||$fax||$email||$social)&&$form_id > 0){
                //print '<div class="col-md-3 right">';
            //}
            
            
            if ( $social ){
                $social = do_shortcode('[msd-social]');
                if( $social ){ print '<div class="connected-social">'.$social.'</div>'; }
            }   
            if ( $address ){
                $bizname = do_shortcode('[msd-bizname]'); 
                if ( $bizname ){
                    print '<div class="connected-bizname">'.$bizname.'</div>';
                }
                $address = do_shortcode('[msd-address]'); 
                if ( $address ){
                    print '<div class="connected-address">'.$address.'</div>';
                }
            }
            if ( $phone ){
                $phone = '';
                if((get_option('msdsocial_tracking_phone')!='')){
                    if(wp_is_mobile()){
                      $phone .= 'Phone: <a href="tel:+1'.get_option('msdsocial_tracking_phone').'">'.get_option('msdsocial_tracking_phone').'</a> ';
                    } else {
                      $phone .= 'Phone: <span>'.get_option('msdsocial_tracking_phone').'</span> ';
                    }
                  $phone .= '<span itemprop="telephone" style="display: none;">'.get_option('msdsocial_phone').'</span> ';
                } else {
                    if(wp_is_mobile()){
                      $phone .= (get_option('msdsocial_phone')!='')?'Phone: <a href="tel:+1'.get_option('msdsocial_phone').'" itemprop="telephone">'.get_option('msdsocial_phone').'</a> ':'';
                    } else {
                      $phone .= (get_option('msdsocial_phone')!='')?'Phone: <span itemprop="telephone">'.get_option('msdsocial_phone').'</span> ':'';
                    }
                }
                if ( $phone ){ print '<div class="connected-phone">'.$phone.'</div>'; }
            }
            if ( $tollfree ){
                $tollfree = '';
                if((get_option('msdsocial_tracking_tollfree')!='')){
                    if(wp_is_mobile()){
                      $tollfree .= 'Toll Free: <a href="tel:+1'.get_option('msdsocial_tracking_tollfree').'">'.get_option('msdsocial_tracking_tollfree').'</a> ';
                    } else {
                      $tollfree .= 'Toll Free: <span>'.get_option('msdsocial_tracking_tollfree').'</span> ';
                    }
                  $tollfree .= '<span itemprop="telephone" style="display: none;">'.get_option('msdsocial_tollfree').'</span> ';
                } else {
                    if(wp_is_mobile()){
                      $tollfree .= (get_option('msdsocial_tollfree')!='')?'Toll Free: <a href="tel:+1'.get_option('msdsocial_tollfree').'" itemprop="telephone">'.get_option('msdsocial_tollfree').'</a> ':'';
                    } else {
                      $tollfree .= (get_option('msdsocial_tollfree')!='')?'Toll Free: <span itemprop="telephone">'.get_option('msdsocial_tollfree').'</span> ':'';
                    }
                }
                if ( $tollfree ){ print '<div class="connected-tollfree">'.$tollfree.'</div>'; }
            }
            if ( $fax ){
                $fax = (get_option('msdsocial_fax')!='')?'Fax: <span itemprop="faxNumber">'.get_option('msdsocial_fax').'</span> ':'';
                if ( $fax ){ print '<div class="connected-fax">'.$fax.'</div>'; }
            }
            if ( $email ){
                $email = (get_option('msdsocial_email')!='')?'Email: <span itemprop="email"><a href="mailto:'.antispambot(get_option('msdsocial_email')).'">'.antispambot(get_option('msdsocial_email')).'</a></span> ':'';
                if ( $email ){ print '<div class="connected-email">'.$email.'</div>'; }
            }
            
            //if(($address||$phone||$tollfree||$fax||$email||$social)&&$form_id > 0){
               // print '</div>';
            //}
            //if(($address||$phone||$tollfree||$fax||$email||$social)&&$form_id > 0){
                //print '<div class="col-md-9">';
            //}
            if ( $form_id > 0 ){
                print '<div class="connected-form">';
                print do_shortcode('[gravityform id="'.$form_id.'" title="true" description="false" ajax="true"]');
                print '</div>';
                //add_action( 'wp_footer', array(&$this,'tabindex_javascript'), 60);
            }
            //if(($address||$phone||$tollfree||$fax||$email||$social)&&$form_id > 0){
                //print '</div>';
            //}
            
            echo $after_widget;
       }
    }
}

add_action('widgets_init', create_function('', 'return register_widget("KohlerConnected");'));
}


/**
 * Visit Class
 */
if(class_exists('MSDVisit')){
class KohlerVisit extends MSDVisit {
    function widget( $args, $instance ) {
        extract($args);
        global $msd_social;
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
        $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
        echo $before_widget;
        print '<a href="/" class="logo footer-logo"></a>';
        if ( !empty( $title ) ) { print $before_title.$title.$after_title; } 
        echo '<div class="business-hours">'.$msd_social->get_hours_deux().'</div>';
        if ( !empty( $text )){ print '<div class="business-hours-text">'.$text.'</div>'; }
        echo $after_widget;
    } 
}

add_action('widgets_init', create_function('', 'return register_widget("KohlerVisit");'));
}


add_shortcode('msd-email','msd_get_email');

function msd_get_email($content = false){
    if(!$content){$content = antispambot(get_option('msdsocial_email'));}
    $email = (get_option('msdsocial_email')!='')?'<span itemprop="email"><a href="mailto:'.antispambot(get_option('msdsocial_email')).'">'.$content.'</a></span> ':false;
    if ( $email ){ return $email; }
}

if(class_exists('RecentPostsPlus')){
    class MSDLabRecentPostsPlus extends RecentPostsPlus{
        
    private $default_config = array(
        'title' => '',
        'count' => 5,
        'include_post_thumbnail' => 'false',
        'include_post_excerpt' => 'false',
        'before_text' => 'text',
        'after_text' => 'text',
        'truncate_post_title' => '',
        'truncate_post_title_type' => 'char',
        'truncate_post_excerpt' => '',
        'truncate_post_excerpt_type' => 'char',
        'truncate_elipsis' => '...',
        'post_thumbnail_width' => '50',
        'post_thumbnail_height' => '50',
        'post_date_format' => 'M j',
        'wp_query_options' => '',
        'widget_output_template' => '<li>{THUMBNAIL}<a title="{TITLE_RAW}" href="{PERMALINK}">{TITLE}</a>{EXCERPT}</li>', //default format
        'show_expert_options' => 'false'
    );
    
    public function __construct(){
        parent::__construct();
    }
    
        function widget( $args, $instance ) {
            extract( $args );
            echo $before_widget;
            //ts_data($instance);
            
            $title = apply_filters( 'widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);        
            $widget_output_template = (empty($instance['widget_output_template'])) ? $this->default_config['widget_output_template'] : $instance['widget_output_template'];
            $before_text = $instance['before_text'];
            $after_text = $instance['after_text'];
                        
            echo $before_title . $title . $after_title;
            
            $output = $this->parse_output($instance);
            
            //if the first tag of the widget_output_template is a <li> tag then wrap it in <ul>
            if(stripos(ltrim($widget_output_template), '<li') === 0){
                $output = '<ul>'.$output.'</ul>';
            }
            
            if($before_text != ''){
                $output = '<p class="before_text">'.$before_text.'</p>'.$output;
            }
            
            if($after_text != ''){
                $output = $output.'<p class="after_text">'.$after_text.'</p>';
            }
                
            echo $output;
            
            echo $after_widget;
        }
        
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['count'] = strip_tags($new_instance['count']);
            
            $instance['include_post_thumbnail'] = strip_tags( $new_instance[ 'include_post_thumbnail' ] );
            if( empty($instance['include_post_thumbnail']) ) $instance['include_post_thumbnail'] = 'false';
             
            $instance['include_post_excerpt'] = strip_tags( $new_instance[ 'include_post_excerpt' ] );
            if( empty($instance['include_post_excerpt']) ) $instance['include_post_excerpt'] = 'false';
            
            $instance['before_text'] = $new_instance[ 'before_text' ];
            $instance['after_text'] = $new_instance[ 'after_text' ];
            
            $instance['truncate_post_title'] = strip_tags( $new_instance[ 'truncate_post_title' ] );
            $instance['truncate_post_title_type'] = strip_tags( $new_instance[ 'truncate_post_title_type' ] );
            $instance['truncate_post_excerpt'] = strip_tags( $new_instance[ 'truncate_post_excerpt' ] );
            $instance['truncate_post_excerpt_type'] = strip_tags( $new_instance[ 'truncate_post_excerpt_type' ] );
            $instance['truncate_elipsis'] = strip_tags( $new_instance[ 'truncate_elipsis' ] );
            $instance['post_thumbnail_width'] = strip_tags( $new_instance[ 'post_thumbnail_width' ] );
            $instance['post_thumbnail_height'] = strip_tags( $new_instance[ 'post_thumbnail_height' ] );
            $instance['wp_query_options'] = $new_instance[ 'wp_query_options' ];
            $instance['widget_output_template'] = $new_instance[ 'widget_output_template' ];
            $instance['show_expert_options'] = strip_tags( $new_instance[ 'show_expert_options' ] );
            $instance['post_date_format'] = strip_tags( $new_instance[ 'post_date_format' ] );
            
            return $instance;
        }

        function form( $instance ) {
            if ( $instance ) {
                foreach($this->default_config as $key => $val) {
                    $$key = esc_attr($instance[$key]);
                }            
            } else {
                /* DEFAULT OPTIONS */
                foreach($this->default_config as $key => $val) {
                    $$key = $val;
                }
            }
            ?>
            
            <script type="text/javascript">
                jQuery(document).ready(function($) {    
                    $('.rpp_show-expert-options').trigger('change');
                });
            </script>
            
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts to show:'); ?></label> 
                <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" size="3" value="<?php echo $count; ?>" />
            </p>
            
            <p>
                <?php if( current_theme_supports('post-thumbnails') ): ?>
                    <input id="<?php echo $this->get_field_id('include_post_thumbnail'); ?>" name="<?php echo $this->get_field_name('include_post_thumbnail'); ?>" type="checkbox" value="true"  class="checkbox" <?php echo ($include_post_thumbnail == 'true') ? 'checked="checked"' : '' ?> />
                    <label for="<?php echo $this->get_field_id('include_post_thumbnail'); ?>"><?php _e('Include post thumbnail'); ?></label><br>
                <?php endif; ?>
                
                <input id="<?php echo $this->get_field_id('include_post_excerpt'); ?>" name="<?php echo $this->get_field_name('include_post_excerpt'); ?>" type="checkbox" value="true" class="checkbox" <?php echo ($include_post_excerpt == 'true') ? 'checked="checked"' : '' ?> />
                <label for="<?php echo $this->get_field_id('include_post_excerpt'); ?>"><?php _e('Include post excerpt'); ?></label><br>
                
                <br>
                
                <input class="rpp_show-expert-options checkbox" id="<?php echo $this->get_field_name('show_expert_options'); ?>" name="<?php echo $this->get_field_name('show_expert_options'); ?>" type="checkbox" value="true" <?php echo ($show_expert_options == 'true') ? 'checked="checked"' : '' ?> /> 
                <label for="<?php echo $this->get_field_id('show_expert_options'); ?>"><?php _e('Show expert options'); ?></label>
            </p>
            
            <div class="rpp_expert-panel" style="display:none; margin-top: 10px">
            
                <p>
                    <label for="<?php echo $this->get_field_id('before_text'); ?>"><?php _e('Before Text'); ?></label> <br />
                    <textarea id="<?php echo $this->get_field_id('before_text'); ?>" name="<?php echo $this->get_field_name('before_text'); ?>" style="width:222px; height: 100px; font-size: 80%"><?php echo $before_text; ?></textarea>
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('after_text'); ?>"><?php _e('After Text'); ?></label> <br />
                    <textarea id="<?php echo $this->get_field_id('after_text'); ?>" name="<?php echo $this->get_field_name('after_text'); ?>" style="width:222px; height: 100px; font-size: 80%"><?php echo $after_text; ?></textarea>
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('truncate_post_title'); ?>"><?php _e('Limit post title:'); ?></label> 
                    <input id="<?php echo $this->get_field_id('truncate_post_title'); ?>" name="<?php echo $this->get_field_name('truncate_post_title'); ?>" type="text" size="2" value="<?php echo $truncate_post_title; ?>" />
                    <select id="<?php echo $this->get_field_id('truncate_post_title_type'); ?>" name="<?php echo $this->get_field_name('truncate_post_title_type'); ?>">
                          <option value="char" <?php echo ($truncate_post_title_type == 'char') ? 'selected="selected"' : '' ?>>Chars</option>
                          <option value="word" <?php echo ($truncate_post_title_type == 'word') ? 'selected="selected"' : '' ?>>Words</option>
                    </select>
                    <br>
                    
                    <label for="<?php echo $this->get_field_id('truncate_post_excerpt'); ?>"><?php _e('Limit post excerpt:'); ?></label> 
                    <input id="<?php echo $this->get_field_id('truncate_post_excerpt'); ?>" name="<?php echo $this->get_field_name('truncate_post_excerpt'); ?>" type="text" size="2" value="<?php echo $truncate_post_excerpt; ?>" />
                    <select id="<?php echo $this->get_field_id('truncate_post_excerpt_type'); ?>" name="<?php echo $this->get_field_name('truncate_post_excerpt_type'); ?>">
                          <option value="char" <?php echo ($truncate_post_excerpt_type == 'char') ? 'selected="selected"' : '' ?>>Chars</option>
                          <option value="word" <?php echo ($truncate_post_excerpt_type == 'word') ? 'selected="selected"' : '' ?>>Words</option>
                    </select>
                    <br>
                    
                    <label for="<?php echo $this->get_field_id('truncate_elipsis'); ?>"><?php _e('Limit ellipsis:'); ?></label> 
                    <input id="<?php echo $this->get_field_id('truncate_elipsis'); ?>" name="<?php echo $this->get_field_name('truncate_elipsis'); ?>" type="text" size="3" value="<?php echo $truncate_elipsis; ?>" /><br>
                    
                    <br>
                    
                    <label for="<?php echo $this->get_field_id('post_date_format'); ?>"><?php _e('Post date format:'); ?></label> <a title="View Documentation" target="_blank" href="http://www.pjgalbraith.com/2011/08/recent-posts-plus/">(?)</a>
                    <input id="<?php echo $this->get_field_id('post_date_format'); ?>" name="<?php echo $this->get_field_name('post_date_format'); ?>" type="text" size="3" value="<?php echo $post_date_format; ?>" />
                </p>
                
                <?php if( current_theme_supports('post-thumbnails') ): ?>
                    <p>
                        <label for="<?php echo $this->get_field_id('post_thumbnail_width'); ?>"><?php _e('Thumbnail size (WxH):'); ?></label> 
                        <input id="<?php echo $this->get_field_id('post_thumbnail_width'); ?>" name="<?php echo $this->get_field_name('post_thumbnail_width'); ?>" type="text" size="3" value="<?php echo $post_thumbnail_width; ?>" style="width: 40px" />
                        <input id="<?php echo $this->get_field_id('post_thumbnail_height'); ?>" name="<?php echo $this->get_field_name('post_thumbnail_height'); ?>" type="text" size="3" value="<?php echo $post_thumbnail_height; ?>" style="width: 40px" />
                    </p>
                <?php endif; ?>
            
                <p>
                    <label for="<?php echo $this->get_field_id('wp_query_options'); ?>"><?php _e('WP_Query Options'); ?></label> <a title="View Documentation" target="_blank" href="http://www.pjgalbraith.com/2011/08/recent-posts-plus/">(?)</a><br />
                    <textarea id="<?php echo $this->get_field_id('wp_query_options'); ?>" name="<?php echo $this->get_field_name('wp_query_options'); ?>" style="width:222px; height: 100px; font-size: 80%"><?php echo $wp_query_options; ?></textarea>
                </p>
                
                <p>
                    <label for="<?php echo $this->get_field_id('widget_output_template'); ?>"><?php _e('Widget Output Template'); ?></label> <a title="View Documentation" target="_blank" href="http://www.pjgalbraith.com/2011/08/recent-posts-plus/">(?)</a><br />
                    <textarea id="<?php echo $this->get_field_id('widget_output_template'); ?>" name="<?php echo $this->get_field_name('widget_output_template'); ?>" style="width:222px; height: 100px; font-size: 80%"><?php echo $widget_output_template; ?></textarea>
                </p>
            
            </div>
            
            <?php 
        }
    }

add_action('widgets_init', create_function('', 'return register_widget("MSDLabRecentPostsPlus");'));
}


function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}
add_shortcode('menu', 'print_menu_shortcode');