<?php 

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'dravet_article_nav' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class dravet_article_nav extends WP_Widget {
 
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'dravet_article_nav', 
        
        // Widget name will appear in UI
        __('Artikel Navigation', 'dravet'), 
        
        // Widget description
        array( 'description' => __( 'Artikel Navigation Widget', 'dravet' ), ) 
        );
    }
 
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        ?>
        <div id="article_navigation" class="is-hidden-mobile">
        <span class="loading">... Loading</span>
        </div>
        <?php
        echo $args['after_widget'];
    }
         
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Titel', 'dravet' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class dravet_article_nav ends here