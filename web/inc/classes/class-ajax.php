<?php
/**
 * Assets class, Singleton instance.
 * Class handles the loading of all the necessary assets.
 *
 * @package FFG Starter
 * @since 1.0.0
 */

// Set the namespace
namespace FAIRBASE_STARTER\Inc;

// Singleton class thus using the Singleton trait.
use FAIRBASE_STARTER\Inc\Traits\Singleton;

class Ajax
{

    private $lang;

    use Singleton;

    public function __construct()
    {

        $this->lang = apply_filters('wpml_current_language', null);

        add_action('wp_ajax_get_meetingroom_info', [$this, 'get_meetingroom_info']);
        add_action('wp_ajax_nopriv_get_meetingroom_info', [$this, 'get_meetingroom_info']);


    }

  

    public function get_meetingroom_info() {

        
        $post_id = intval($_POST['post_id']);

        $args = array(
            'post_type' => 'vergaderruimtes',
            'p' => $post_id,
            'post_status' => 'publish'
        );

        $posts = get_posts($args);
        $returningData = array();
        
        foreach ($posts as $post) {
            setup_postdata($post);

            $image = get_field('images', $post->ID);
            foreach ($image as $id) {
                $returningData['images'][] = wp_get_attachment_image_url($id['image'], 'full');;
                
            }
            $returningData['title'] = get_the_title($post->ID);
            $returningData['benefits_space'] = get_field('benefits_space', $post->ID);
        }

        wp_reset_postdata();

        wp_send_json_success([
            'data' => $returningData,
        ]);
    }
    
    
}