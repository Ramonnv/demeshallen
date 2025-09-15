<?php
/*
*  Name: Contact block
*  Title: Contact block
*  Description: Contact block met ACF + Gravity Forms icons
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: contact, form, gravityforms
*  Post Types: page
*/

$name  = 'contact-block';
$id    = fairbase_block_id($name, $block, false);
$class = fairbase_block_classes($name, $block, false);

// Preview image in backend
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . esc_url($block['data']['preview_image']) . '" alt="" style="width: 100%; height: auto;" >';
    return;
}

// Helpers
if (!function_exists('fixPhoneNumber')) {
    function fixPhoneNumber($x) {
        return str_replace(' ', '', $x);
    }
}

$form_id          = get_field('contact_form');
$form_field_icons = get_field('form_field_icons');
$contact_info     = get_field('contact_info');

// Mapping GF veld_id → icon
$gravity_settings = [];
if ($form_field_icons) {
    foreach ($form_field_icons as $row) {
        if (!empty($row['veld_id']) && !empty($row['icon'])) {
            if (is_numeric($row['icon'])) {
                $gravity_settings[(int)$row['veld_id']] = wp_get_attachment_url($row['icon']);
            } else {
                $gravity_settings[(int)$row['veld_id']] = $row['icon'];
            }
        }
    }
}

// Voeg filter toe voor GF velden
if ($form_id && !empty($gravity_settings)) {
add_filter('gform_field_content', function ($field_content, $field, $value, $lead_id, $form_id) use ($gravity_settings) {
    if (!isset($gravity_settings[$field->id])) {
        return $field_content;
    }

    $icon_uri = $gravity_settings[$field->id];
    $required_class = $field->isRequired ? ' required' : '';

    // Label en input splitsen
    preg_match('/^(<label.*<\/label>)(.*)$/s', $field_content, $matches);
    $label_html = $matches[1] ?? '';
    $input_html = $matches[2] ?? $field_content;

    return sprintf(
        '<div class="special-contact-form-group">
            <div class="svg-wrapper">
                <img src="%s" alt="">
            </div>
            <div class="field-content%s">
                <div class="field-label">%s</div>
                <div class="field-input">%s</div>
            </div>
        </div>',
        esc_url($icon_uri),
        esc_attr($required_class),
        $label_html,
        $input_html
    );
}, 10, 5);


}
?>

<section id="<?= esc_attr($id); ?>" class="<?= esc_attr($class); ?>">
    <div class="container contact-section">
        <div class="row no-gutters">

            <!-- Linkerkant: afbeelding + contact info -->
            <div class="col-12 col-lg-4 offset-lg-1">
                <div class="contact-section-image-wrapper">
                    <?php 
                    echo wp_get_attachment_image(
                        get_field('image'),
                        'full',
                        false,
                        [ "class" => "contact-section-image", "alt" => "" ]
                    );
                    ?>

                    <?php if ($contact_info): ?>
                        <div class="contact-section-hovering-contact-info">
                            <?php foreach ($contact_info as $item): 
                                $icon  = $item['icon'];
                                $title = $item['title'];
                                $text  = $item['text'];

                                if (is_numeric($icon)) {
                                    $icon = wp_get_attachment_url($icon);
                                }
                            ?>
                                <div class="contact-section-item">
                                    <?php if (!empty($icon)): ?>
                                        <div class="contact-section-item-icon">
                                            <img src="<?= esc_url($icon); ?>" alt="">
                                        </div>
                                    <?php endif; ?>

                                    <div class="contact-section-item-content">
                                        <?php if (!empty($title)): ?>
                                            <h2><?= esc_html($title); ?></h2>
                                        <?php endif; ?>

                                        <?php if (!empty($text)): ?>
                                            <div class="contact-section-item-text">
                                                <?= wp_kses_post(nl2br($text)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Rechterkant: titel + formulier -->
            <div class="col-12 col-lg-7">
                <div class="contact-section-text-wrapper">
                    <h2 class="contact-section-text-wrapper-title">
                        <?= esc_html(get_field('title')); ?>
                    </h2>

                    <div class="contact-section-form">
                        <?php 
                        if ($form_id) {
                            echo do_shortcode('[gravityform id="' . intval($form_id) . '" title="false" description="false" ajax="true"]');
                        } else {
                            echo '<p><em>Geen formulier geselecteerd.</em></p>';
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
