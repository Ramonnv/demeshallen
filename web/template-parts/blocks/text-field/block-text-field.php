<?php
/*
*  Name: Text Field block
*  Title: Text Field block
*  Description: This is an text-field block
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Text, description
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'text-field';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Get ACF fields
$title = get_field('title');
$description = get_field('description');
$contact_info = get_field('add_contact_info');
$contactData = get_field('contact_fields', 'option');


// Put custom functions here
if (!function_exists('fixPhoneNumber')) {

  function fixPhoneNumber($x) {
    return str_replace(' ', '', $x);
  }
  
}

?>

<section id="<?= $id; ?>" class="<?= $class; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-wrapper">
                    <div class="text-wrapper-title-wrapper">
                      <div class="text-wrapper-title-wrapper__reduce-title-height">
                        <h2><?= esc_html($title) ?></h2>
                      </div>
                    </div>
                    <div class="text-wrapper-description">
                        <?= wp_kses_post($description) ?>
                        
                        

                        
                        <?php
                        if ($contactData && $contact_info) {
                            echo '<div class="text-wrapper-description-info">';
            
            // Show email + mailto link
            if ($contactData['phonenumber'] !== '') {
    ?>
  <a class="text-decoration-none" title="Bel ons" href="tel:<?= fixPhoneNumber($contactData['phonenumber']); ?>">
    <?= $contactData['phonenumber']; ?>
</a>

<?php
            }
            if ($contactData['e_mail'] !== '') {
              
              ?>
                <a class="text-decoration-none" title="Mail ons" href="mailto:<?= $contactData['e_mail']; ?>">
                  <?= $contactData['e_mail']; ?>
                </a>
              <?php
            }
            echo '</div>';
          }
          ?>
                </div>
                <?php if (get_field('meetingrooms_section')) :
              $mtflds = get_field('meetingrooms_data');
              ?>
            <div class="col-12 wrapper meetingroom-section">
                <div class="text-wrapper-title-wrapper">
                  <div class="text-wrapper-title-wrapper__reduce-title-height">
                        <h2><?= $mtflds['title']; ?></h2>
                      </div>
                </div>
                <div class="text-wrapper-description">
                  <?= $mtflds['text_one']; ?>
                </div>
                  <div class="row meetingroom-blocks-wrapper">

                    <?php 
                
                $args = array(
                  'post_type' => 'vergaderruimtes',
                  'posts_per_page' => -1,
                  'post_status' => 'publish'
                );
                
                $posts = get_posts($args);
                
                foreach ($posts as $post) { ?>
    
    <div class="col-6 col-md-4 col-lg-3 mt-32">
      <div class="meetingroom-wrapper" data-postid="<?=$post->ID; ?>">
        <h3><?= get_the_title($post->ID); ?></h3>
        <div class="meetingroom-people-counter">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 20 17" fill="none">
            <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="#EA5B11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <?= get_field('people_count' , $post->ID);?>
          <p class="people_count_text">Personen</p>
        </div>
      </div>
    </div>
    
  <?php
}

wp_reset_postdata();
?>

</div>

                
                <div class="text-wrapper-description">
                  <hr>
                  <?= $mtflds['text_two']; ?>
                </div>
              </div>
              <?php endif; ?>
            </div>
            </div>
            
        </div>
    </div>
</section>

<?php if (get_field('meetingrooms_section')) : ?>

  <div id="meetingroom-popup-wrapper" style="display:none;">
    <?php /* Will be filled using AJAX */ ?>
  </div>

<?php endif; ?>