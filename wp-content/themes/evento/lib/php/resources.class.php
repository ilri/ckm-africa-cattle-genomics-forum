<?php
    class resources{
        static $type;
        static $labels;
        static $taxonomy;
		static $box;
        static function register(){
            if( !empty( self::$type ) ){
                foreach( self::$type as $res => $args ){
                    if( empty( $args )  ){
                        self::box( $res );
                    }else{
                        $label = self::$labels[ $res ];
                        $args['labels'] = $label;
                        /*$args['rewrite'] = array( 'slug' => $res , 'with_front' => false );*/
                        unset( $args['__on_front_page'] );
						if( isset( $args['rewrite'] ) ){
							if( isset ( $args['rewrite']['slug'] ) && ( strlen( $args['rewrite']['slug'] ) > 1 ) ){
								$args['has_archive'] = $args['rewrite']['slug'];
							}else{
								$args['has_archive'] = $res;
							}
						}else{
							$args['has_archive'] = $res;
						}
                        register_post_type( $res , $args );
                        self::taxonomy( $res );
                        self::box( $res );
                    }
                }
            }
        }

        static function taxonomy( $res ){
            if( isset( self::$taxonomy[ $res ] ) ){
                foreach( self::$taxonomy[ $res ] as $tax => $args ){
					if( isset( $args['rewrite'] ) ){
							if( isset ( $args['rewrite']['slug'] ) && ( strlen( $args['rewrite']['slug'] ) > 1 ) ){
								$slug = $args['rewrite']['slug'];
							}else{
								$slug = $res.'-'.$tax;
							}
						}else{
							$slug = $res.'-'.$tax;
						}
                    register_taxonomy( $slug , array( $res ) , $args );
                }
            }
        }
		//add_meta_box(	'gallery-type-div', __('Gallery Type','cosmotheme'),  'gallery_type_metabox', 'gallery', 'normal', 'low');
		static function box( $res ){
			if( isset( self::$box[ $res ] ) ){
				foreach( self::$box[ $res ] as $box => $args ){
                    add_action('admin_init', array( get_class() , 'addbox_' . $res . '_' . $box ) , 1 );
				}
			}
		}

        /* replace callStatic  with Callbox */
        static function conference_presentation(){
            self::CallBox( 'conference_presentation' );
        }

        static function conference_program(){
            self::CallBox( 'conference_program' );
        }

        static function conference_location(){
            self::CallBox( 'conference_location' );
        }

        static function conference_exhibitor(){
            self::CallBox( 'conference_exhibitor' );
        }

        static function conference_sponsor(){
            self::CallBox( 'conference_sponsor' );
        }

    	static function conference_testimonial(){
            self::CallBox( 'conference_testimonial' );
        }
        
        static function conference_shcode(){
            self::CallBox( 'conference_shcode' );
        }

        static function conference_guests(){
            self::CallBox( 'conference_guests' );
        }
        
        static function conference_layout(){
            self::CallBox( 'conference_layout' );
        }
		 
		static function conference_registration(){
            self::CallBox( 'conference_registration' );
        }

        static function conference_tickets(){
            self::CallBox( 'conference_tickets' );
        }

        static function conference_settings(){
            self::CallBox( 'conference_settings' );
        }

        static function exhibitor_shcode(){
            self::CallBox( 'exhibitor_shcode' );
        }

        static function exhibitor_conference(){
            self::CallBox( 'exhibitor_conference' );
        }

        static function exhibitor_layout(){
            self::CallBox( 'exhibitor_layout' );
        }

        static function exhibitor_settings(){
            self::CallBox( 'exhibitor_settings' );
        }

        static function sponsor_shcode(){
            self::CallBox( 'sponsor_shcode' );
        }

        static function sponsor_info(){
            self::CallBox( 'sponsor_info' );
        }

        static function sponsor_conference(){
            self::CallBox( 'sponsor_conference' );
        }

        static function sponsor_layout(){
            self::CallBox( 'sponsor_layout' );
        }

        static function sponsor_settings(){
            self::CallBox( 'sponsor_settings' );
        }

        static function presentation_speaker(){
            self::CallBox( 'presentation_speaker' );
        }

        static function presentation_shcode(){
            self::CallBox( 'presentation_shcode' );
        }

        static function presentation_conference(){
            self::CallBox( 'presentation_conference' );
        }

        static function presentation_layout(){
            self::CallBox( 'presentation_layout' );
        }

        static function presentation_docs(){
            self::CallBox( 'presentation_docs' );
        }

        static function presentation_settings(){
            self::CallBox( 'presentation_settings' );
        }

        /*testimonial*/	
    	static function testimonial_info(){
            self::CallBox( 'testimonial_info' );
        }
    	static function testimonial_conference(){
            self::CallBox( 'testimonial_conference' );
        }
        
    	static function testimonial_layout(){
            self::CallBox( 'testimonial_layout' );
        }
        
        /*speaker*/
        static function speaker_shcode(){
            self::CallBox( 'speaker_shcode' );
        }

        
        static function speaker_info(){
            self::CallBox( 'speaker_info' );
        }

        static function speaker_presentation(){
            self::CallBox( 'speaker_presentation' );
        }

        static function speaker_layout(){
            self::CallBox( 'speaker_layout' );
        }

        static function speaker_settings(){
            self::CallBox( 'speaker_settings' );
        }

        static function slideshow_manager(){
            self::CallBox( 'slideshow_manager' );
        }

        static function slideshow_box(){
            self::CallBox( 'slideshow_box' );
        }

        static function post_shcode(){
            self::CallBox( 'post_shcode' );
        }

        static function post_layout(){
            self::CallBox( 'post_layout' );
        }

        static function post_settings(){
            self::CallBox( 'post_settings' );
        }

        static function page_shcode(){
            self::CallBox( 'page_shcode' );
        }

        static function page_layout(){
            self::CallBox( 'page_layout' );
        }

        static function page_settings(){
            self::CallBox( 'page_settings' );
        }

        static function addbox_conference_presentation(){
            self::CallBox( 'addbox_conference_presentation' );
        }

        static function addbox_conference_program(){
            self::CallBox( 'addbox_conference_program' );
        }

        static function addbox_conference_location(){
            self::CallBox( 'addbox_conference_location' );
        }

        static function addbox_conference_exhibitor(){
            self::CallBox( 'addbox_conference_exhibitor' );
        }

        static function addbox_conference_sponsor(){
            self::CallBox( 'addbox_conference_sponsor' );
        }
        
    	static function addbox_conference_testimonial(){
            self::CallBox( 'addbox_conference_testimonial' );
        }
        
        static function addbox_conference_shcode(){
            self::CallBox( 'addbox_conference_shcode' );
        }

        static function addbox_conference_guests(){
            self::CallBox( 'addbox_conference_guests' );
        }

        static function addbox_conference_layout(){
            self::CallBox( 'addbox_conference_layout' );
        }

		static function addbox_conference_registration(){
            self::CallBox( 'addbox_conference_registration' );
        }

        static function addbox_conference_tickets(){
            self::CallBox( 'addbox_conference_tickets' );
        }

        static function addbox_conference_settings(){
            self::CallBox( 'addbox_conference_settings' );
        }

        static function addbox_exhibitor_shcode(){
            self::CallBox( 'addbox_exhibitor_shcode' );
        }

        static function addbox_exhibitor_conference(){
            self::CallBox( 'addbox_exhibitor_conference' );
        }

        static function addbox_exhibitor_layout(){
            self::CallBox( 'addbox_exhibitor_layout' );
        }

        static function addbox_exhibitor_settings(){
            self::CallBox( 'addbox_exhibitor_settings' );
        }

        static function addbox_sponsor_shcode(){
            self::CallBox( 'addbox_sponsor_shcode' );
        }

        static function addbox_sponsor_info(){
            self::CallBox( 'addbox_sponsor_info' );
        }
        static function addbox_sponsor_conference(){
            self::CallBox( 'addbox_sponsor_conference' );
        }

        static function addbox_sponsor_layout(){
            self::CallBox( 'addbox_sponsor_layout' );
        }

        static function addbox_sponsor_settings(){
            self::CallBox( 'addbox_sponsor_settings' );
        }

        static function addbox_presentation_speaker(){
            self::CallBox( 'addbox_presentation_speaker' );
        }

        static function addbox_presentation_shcode(){
            self::CallBox( 'addbox_presentation_shcode' );
        }

        static function addbox_presentation_conference(){
            self::CallBox( 'addbox_presentation_conference' );
        }

        static function addbox_presentation_layout(){
            self::CallBox( 'addbox_presentation_layout' );
        }

        static function addbox_presentation_docs(){
            self::CallBox( 'addbox_presentation_docs' );
        }

        static function addbox_presentation_settings(){
            self::CallBox( 'addbox_presentation_settings' );
        }

        /*testtimonial*/
    	static function addbox_testimonial_info(){
            self::CallBox( 'addbox_testimonial_info' );
        }
        	
    	static function addbox_testimonial_conference(){
            self::CallBox( 'addbox_testimonial_conference' );
        }
        
    	static function addbox_testimonial_layout(){
            self::CallBox( 'addbox_testimonial_layout' );
        }
        
        /*speaker*/
        static function addbox_speaker_shcode(){
            self::CallBox( 'addbox_speaker_shcode' );
        }

        static function addbox_speaker_info(){
            self::CallBox( 'addbox_speaker_info' );
        }

        static function addbox_speaker_presentation(){
            self::CallBox( 'addbox_speaker_presentation' );
        }

        static function addbox_speaker_layout(){
            self::CallBox( 'addbox_speaker_layout' );
        }

        static function addbox_speaker_settings(){
            self::CallBox( 'addbox_speaker_settings' );
        }

        static function addbox_slideshow_manager(){
            self::CallBox( 'addbox_slideshow_manager' );
        }

        static function addbox_slideshow_box(){
            self::CallBox( 'addbox_slideshow_box' );
        }

        static function addbox_post_shcode(){
            self::CallBox( 'addbox_post_shcode' );
        }

        static function addbox_post_layout(){
            self::CallBox( 'addbox_post_layout' );
        }

        static function addbox_post_settings(){
            self::CallBox( 'addbox_post_settings' );
        }

        static function addbox_page_shcode(){
            self::CallBox( 'addbox_page_shcode' );
        }

        static function addbox_page_layout(){
            self::CallBox( 'addbox_page_layout' );
        }

        static function addbox_page_settings(){
            self::CallBox( 'addbox_page_settings' );
        }

        
        static function  CallBox( $name , $args = null ) {
			global $post;
            $items = explode( '_' , $name );

            if( $items[0] == 'addbox' ){

                foreach( self::$box[ $items[1] ] as $box => $args ){
                    add_meta_box( $items[1] . '_' . $box , $args[0] , array( get_class() , $items[1] . '_' . $box ) , $items[1] , $args[1] , $args[2] );

                    if( isset( $_POST[ $box ] ) ){
                        if( isset( $args[ 'update' ] ) && $args[ 'update' ] ){
                            $new_value = $_POST[ $box ];
                            if( is_array( $args['content'] ) ){
                                foreach( $args['content'] as $name => $fields ){
                                    $type = explode( '--' , $fields['type'] );
                                    if( isset( $type[1] ) && $type[1] == 'checkbox' ){
                                        if( !isset( $new_value[ $name ] ) ){
                                            $new_value[ $name ] = '';
                                        }
                                    }
                                }
                            }
                            if( isset( $_POST[ 'post_ID' ] ) ){
                                meta::set_meta( $_POST[ 'post_ID' ] , $box , $new_value );
                            }
                            
                        }
                    }
                }
            }else{
                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'callback' ] ) ){
                    
                    if( self::$box[ $items[0] ][ $items[1] ][ 'callback' ][0] == 'get_meta_records' ){
                        $fn_result =  meta::get_meta_records( $post -> ID , $items );

                        if( !empty( $fn_result ) ){
                            $classes = "postbox";
                        }else{
                            $classes = '';
                        }

                        echo '<div id="box_' . $items[0] .'_'. $items[1] .'" class="' . $classes . '" >';
                        echo $fn_result;
                        echo '</div>';
                        
                    }else{                    
                        $fn = self::$box[ $items[0] ][ $items[1] ][ 'callback' ][0];
                        $fn_result = $fn( $post -> ID , self::$box[ $items[0] ][ $items[1] ][ 'callback' ][1] ) ;
                        
                        if( !empty( $fn_result ) ){
                            $classes = "postbox";
                        }else{
                            $classes = '';
                        }

                        echo '<div id="box_' . $items[0] .'_'. $items[1] .'" class="' . $classes. '" >';
                        echo $fn_result;
                        echo '</div>';
                        
                    }
                    
                }

                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'includes' ] ) ){
                    include get_template_directory(). '/lib/php/' . self::$box[ $items[0] ][ $items[1] ][ 'includes' ];
                }

                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'content' ] ) ){

                    if( isset( self::$box[ $items[0] ][ $items[1]][ 'box'  ] ) ){
                        $box = self::$box[ $items[0] ][ $items[1]][ 'box'  ];
                    }else{
                        $box = $items[1];
                    }

					echo '<div id="form' . $box . '">';


                    foreach( self::$box[ $items[0] ][ $items[1]][ 'content'  ] as $side => $field ){
                        $field['side'] 		= $side;
                        $field['box']  		= $box;
						$field['res']  		= $items[0];
						$field['post_id']  	= $post -> ID;
                        $field['pos']  		= self::$box[ $items[0] ][ $items[1]][1];
                        $meta  = meta::get_meta( $post -> ID , $box );
                        $value = isset( $meta[ $side ] ) ? $meta[ $side ] : '';
                        if( !isset( $field['value'] ) ){
                            $field['value'] = $value;
                        }

                        if( !isset( $field['ivalue'] ) ){
                            $field['ivalue'] = $value;
                        }

                        

                        /* special for upload-id*/
                        $type = explode( '--' , $field['type'] );
                        if( isset( $type[1] ) && $type[1] == 'upload-id' ){
                            $value_id = isset( $meta[ $side .'_id' ] ) ? $meta[ $side .'_id' ] : 0;
                            $field['value_id'] = $value_id;
                        }

                        $field['topic']  	= $side;
						$field['group']  	= $box;

                        echo fields::layout( $field );
                    }
					echo '</div>';
                }
            }
        }
    }
?>
