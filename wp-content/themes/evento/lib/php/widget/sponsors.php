<?php
    class widget_sponsors extends WP_Widget{
        function widget_sponsors() {
            $options = array( 'classname' => 'sponsors  images', 'description' => __('Display list of Sponsors from a Conference' , 'cosmotheme' ) );
            parent::__construct( false , _TN_ . ' : ' . __( 'Conference Sponsors' , 'cosmotheme' )  , $options );

        }

        function form($instance) {
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Conference sponsors' , 'cosmotheme' );
            }

            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'] ;
            }else{
                $conf_id = '';
            }

			if( isset( $instance['category'] ) ){
				$category=$instance['category'];
			}else{
				$category="";
			}

            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 2;
            }

            if( isset( $instance['page'] ) ){
                $page_id = $instance['page'] ;
            }else{
                $page_id = '';
            }

            if( isset( $instance['excerpt'] ) ){
                $excerpt = $instance['excerpt'] ;
            }else{
                $excerpt = 'true';
            }
        ?>
         <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this -> get_field_id('conference'); ?>"><?php _e( 'Select Conference' , 'cosmotheme' ); ?>:</label>
          <select class="widefat" id="<?php echo $this -> get_field_id( 'conference' ); ?>" name="<?php echo $this->get_field_name('conference'); ?>" >
              <option value="">select conference</option>
              <?php
                $conferences = get__posts( array( 'post_type' => 'conference','numberposts' => -1 ) , '' );

                foreach( $conferences as $index => $conference ){
                    if( $index ==  $conf_id ){
                        echo '<option value="' . $index . '" selected="selected">' . $conference . '</option>';
                    }else{
                        echo '<option value="' . $index . '">' . $conference . '</option>';
                    }
                }
              ?>
          </select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('category');?>"><?php _e( 'Select category', 'cosmotheme' );?>:</label>
			<select class="widefat" id="<?php echo $this->get_field_id('category');?>" name="<?php echo $this->get_field_name('category');?>">
				<option value="">select category</option>
				<?php
					$terms=get_terms( options::get_taxonomy( 'sponsor' , 'category' ) );
					if( is_array($terms) && count( $terms )>0 ){
						foreach( $terms as $term ){
							if( $category == $term->term_id ){
								echo '<option value="'.$term->term_id.'" selected="selected">'.$term->name.'</option>';
							}else{
								echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';
							}
						}
					}
				?>
			</select>
		</p>

        <!-- field for set limit  -->
        <p>
          <label for="<?php echo $this -> get_field_id('nr'); ?>"><?php _e( 'Number of sponsors to display' , 'cosmotheme' ); ?>:</label>
          <input class="widefat digit" id="<?php echo $this -> get_field_id('nr'); ?>" name="<?php echo $this->get_field_name('nr'); ?>" type="text" value="<?php echo $nr; ?>" />
        </p>

        <!-- field for sed read more page -->
        <p>
          <label for="<?php echo $this -> get_field_id('page'); ?>"><?php _e( "Select Page for 'Read more' link" , 'cosmotheme' ); ?>:</label>
          <select class="widefat" id="<?php echo $this -> get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name('page'); ?>" >
              <option value="">select page</option>
              <?php
                $pages = get__pages();

                foreach( $pages as $index => $page ){
                    if( $index ==  $page_id ){
                        echo '<option value="' . $index . '" selected="selected">' . $page . '</option>';
                    }else{
                        echo '<option value="' . $index . '">' . $page . '</option>';
                    }
                }
              ?>
          </select>
        </p>

        <!-- field for show / hide excerpt  -->
        <p>
          <?php
            if( 'true' ==  $excerpt ){
                $c = 'checked="checked"';
            }else{
                $c = '';
            }
        ?>
          <label for="<?php echo $this -> get_field_id('excerpt'); ?>">
              <input type="checkbox"  id="<?php echo $this -> get_field_id( 'excerpt' ); ?>" value="true" <?php echo $c; ?> name="<?php echo $this->get_field_name('excerpt'); ?>" />
              <?php _e( 'show description' , 'cosmotheme' ); ?>
          </label>

        </p>
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['conference'] = strip_tags( $new_instance['conference'] );
			$instance['category'] = strip_tags( $new_instance['category'] );
            $instance['nr']         = strip_tags( $new_instance['nr'] );
            $instance['page']       = strip_tags( $new_instance['page'] );
            $instance['excerpt']    = strip_tags( $new_instance['excerpt'] );
            return $instance;
        }

        function widget($args, $instance) {

            extract( $args );

            /* widget title */
            if( !empty( $instance['title'] ) ){
               $title = apply_filters('widget_title', $instance['title']);
            }else{
               $title = '';
            }

            /* id of conference */
            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'];
            }

			if( isset( $instance['category'] ) ){
				$category = $instance['category'];
			}else{
				$category=false;
			}

            /* limit number */
            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 2;
            }

            /* id of page for readmore */
            if( isset( $instance['page'] ) ){
                $page_id = $instance['page'];
            }else{
                $page_id = 0;
            }

            /* if show excerpt */
            if( isset( $instance['excerpt'] ) ){
                $excerpt = (bool)$instance['excerpt'];
            }else{
                $excerpt = true;
            }

            echo $before_widget;

            if ( strlen( $title ) ) {
                    echo $before_title . $title . $after_title;
            }

            if( (int) $conf_id > 0 ){
                echo conference::sponsors( $conf_id , $nr , $excerpt , $category);
                /* read more link */
                if( (int) $page_id > 0 ){
                    echo conference::readmore( $page_id );
                }
            }else{
                echo '<p class="select">' . __( 'Please select Conference' , 'cosmotheme' ) . '</p>';
            }

            echo $after_widget;
        }
    }
?>