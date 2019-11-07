<?php
if ( ! class_exists( 'IP_WP_Support_Toolkit_Postmeta_Viewer' ) ) {
    class IP_WP_Support_Toolkit_Postmeta_Viewer {
        public function __construct() {
            $this->add_hooks();
        }

        private function add_hooks() {            
            add_action( 'add_meta_boxes', array( $this, 'add_postmeta_viewer_box' ), 10, 2 );
        }

        
        public function add_postmeta_viewer_box( $post_type, $post ) {
            add_meta_box( 
                'postmeta-viewer-box',
                __( 'Postmeta Viewer' ),
                array( $this, 'render_postmeta_box' ),
                $post_type,
                'normal',
                'default'
            );
        }

        public function render_postmeta_box() {
            $post_id = get_the_ID();
            $output = array();
            $meta = get_post_meta( $post_id );
            foreach ( $meta as $key => $value ) {
                if ( array_key_exists( 0, $value ) ) {
                    $output[ $key ] = maybe_unserialize( $value[0] );
                }
            }
            echo "<pre>";
            print_r( $output );
            echo "</pre>";
        }
    }
}

if ( ! function_exists( 'IP_WP_Support_Toolkit_Postmeta_Viewer' ) ) {
    function IP_WP_Support_Toolkit_Postmeta_Viewer() {
        $postmeta_viewer = new IP_WP_Support_Toolkit_Postmeta_Viewer();
    }
}

IP_WP_Support_Toolkit_Postmeta_Viewer();
?>
