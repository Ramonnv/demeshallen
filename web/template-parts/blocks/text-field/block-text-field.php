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
                    <h2 class="text-wrapper-title-wrapper">
                        <?= esc_html($title) ?>
                    </h2>
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
                </div>
            </div>
        </div>
    </div>
</section>