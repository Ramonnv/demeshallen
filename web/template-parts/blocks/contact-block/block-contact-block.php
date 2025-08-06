<?php
/*
*  Name: Contact block
*  Title: Contact block
*  Description: This is thecontact block
*  Category: fairbase-blocks
*  Icon: fairbase-block
*  Keywords: Example, demonstration
*  Post Types: page
*/

// Set name of the block for class and ID generation
$name = 'contat-block';

// Get id and classlist
$id    = fairbase_block_id( $name, $block, false );
$class = fairbase_block_classes( $name, $block, false );

// Preview image on back-end
if (isset($block['data']['preview_image'])) {
    echo '<style>p, a, svg, h1, h2, h3, h4, h5, h6, input, textarea, br, hr, span, button, ul, ol, li, table, tr, td, th, form, label {opacity:0;}</style>
    <img src="' . $block['data']['preview_image'] . '" alt="" style="width: 100%; height: auto;" >';
}

// Get ACF fiels
$form_shortcode = get_field('shortcode');

// Put custom functions here


?>

<section id="<?= $id; ?>" class="<?= $class; ?>">
    <div class="row justify-content-center">
        <div class="col-12">
            <?= do_shortcode($form_shortcode); ?>
        </div>
        <div class="col-12">
            <div class="contact-wrapper d-flex flex-wrap">
                <!-- Info Block -->
                <!-- <div class="contact-info d-flex flex-column justify-content-center p-4">
                    <div class="info-block">
                        <h3><span class="icon">📍</span>Locatie</h3>
                        <p>Nieuweweg 240<br>6603 BW Wijchen</p>
                    </div>
                    <div class="info-block">
                        <h3><span class="icon">📞</span>Telefoon</h3>
                        <p>+31 (0)24 200 11 22</p>
                    </div>
                    <div class="info-block">
                        <h3><span class="icon">📧</span>E-mail</h3>
                        <p>info@demeschellen.nl</p>
                    </div>
                    <div class="info-block">
                        <h3><span class="icon">📬</span>Postadres</h3>
                        <p>Postbus 13<br>6600 AA Wijchen</p>
                    </div>
                </div> -->
                <!-- Image -->
                <div class="contact-image offset-lg-2">
                    <img src="https://demeshallen.nl/wp-content/uploads/2022/03/Meshallen.jpg" alt="Vergaderruimte">
                </div>
                <!-- Contact Form -->
                <div class="contact-form col-6">
                    <h2>Neem contact op</h2>
                    <form>
                        <div class="form-group">
                            <label><span class="icon">          <a href="#">
            <img src="<?= get_template_directory_uri(); ?>/dist/images/icons/building-office.svg" alt="Facebook icon">
          </a></span>Organisatie *</label>
                            <input type="text" placeholder="Voorbeeld B.V." required>
                        </div>
                        <div class="form-group">
                            <label><span class="icon">📞</span>Telefoon *</label>
                            <input type="tel" placeholder="+31 6 12345678" required>
                        </div>
                        <div class="form-group">
                            <label><span class="icon">🧑‍💼</span>Contactpersoon *</label>
                            <input type="text" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label><span class="icon">📄</span>Onderwerp</label>
                            <input type="text" placeholder="Voorbeeld..." required>
                        </div>
                        <div class="form-group">
                            <label><span class="icon">📧</span>E-mailadres *</label>
                            <input type="email" placeholder="voorbeeld@voorbeeld.nl" required>
                        </div>
                        <div class="form-group full">
                            <label><span class="icon">💬</span>Uw bericht *</label>
                            <textarea placeholder="Dit is een voorbeeld tekst..." required></textarea>
                        </div>
                        <div class="form-group full">
                            <label><input type="checkbox" required> Ik ben geen robot</label>
                            <div class="g-recaptcha" data-sitekey="your-site-key"></div>
                        </div>
                        <button type="submit">Versturen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
