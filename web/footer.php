<?php 

$contactData = get_field('contact_fields', 'option');

if (!function_exists('fixPhoneNumber')) {

  function fixPhoneNumber($x) {
    return str_replace(' ', '', $x);
  }

}

?>

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="footer-column">
        <h2>De Meshallen</h2>
        <ul class="footer-contact">
        <li>
          <?php
            if ($contactData) {
              
              // Address URL open
              if ($contactData['address_url_link'] !== '') {
                echo '<a href="' . $contactData['address_url_link'] . '" target="_blank" class="location-link">';
              }

              echo '
              <svg width="32" height="32" fill="#000000" viewBox="0 0 256 256">
              <path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"/>
              // </svg> <div>
              ';
              
              // Show address
              if ($contactData['address'] !== '') {
                echo '<div>' . $contactData['address'] . '</div>';
              }
              
              // Showing zipcode + placename together
              if ($contactData['zipcode'] !== '' && $contactData['place_name'] !== '') {
                echo '<div>' . $contactData['zipcode'] . ' ' . $contactData['place_name'] . '</div>';
              }
              echo '</div>';
              
              // Address URL close
              if ($contactData['address_url_link'] !== '') {
                echo '</a>';
              }
            }
            ?>
          </li>
          <li>

            <ul>
              
              <?php 

if ($contactData) {
  
            
            // Show email + mailto link
            if ($contactData['e_mail'] !== '') {
              
              ?>
              <li>
                <a class="text-decoration-underline" title="Mail ons" href="mailto:<?= $contactData['e_mail']; ?>">
                  <span>
                    <svg width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                      <path d="M128,24a104,104,0,0,0,0,208c21.51,0,44.1-6.48,60.43-17.33a8,8,0,0,0-8.86-13.33C166,210.38,146.21,216,128,216a88,88,0,1,1,88-88c0,26.45-10.88,32-20,32s-20-5.55-20-32V88a8,8,0,0,0-16,0v4.26a48,48,0,1,0,5.93,65.1c6,12,16.35,18.64,30.07,18.64,22.54,0,36-17.94,36-48A104.11,104.11,0,0,0,128,24Zm0,136a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"/>
                  </svg>
                  </span>
                  <?= $contactData['e_mail']; ?></a>
              </li>
              <?php
            }
            if ($contactData['phonenumber'] !== '') {
    
    ?>

<li>
  <a class="text-decoration-underline" title="Bel ons" href="tel:<?= fixPhoneNumber($contactData['phonenumber']); ?>">
    <span>
      <svg width="32" height="32" fill="#000000" viewBox="0 0 256 256">
        <path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z"/>
    </svg>
    </span>
    <?= $contactData['phonenumber']; ?></a>
</li>

<?php
            }
          }
          ?>
      </ul>
    </li>
      
    </ul>
  </div>
</div>

<div class="col-12 col-md-8 d-flex">
  <div class="footer-column">
        <div class="social-grid">
          <a href="#">
            <img src="<?= get_template_directory_uri(); ?>/dist/images/icons/facebook.svg" alt="Facebook icon">
          </a>
          <a href="#">
            <img src="<?= get_template_directory_uri(); ?>/dist/images/icons/instagram-logo.svg" alt="Instagram icon">
          </a>
          <a href="#">
              <img src="<?= get_template_directory_uri(); ?>/dist/images/icons/linkedin-logo.svg" alt="LinkedIn icon">
          </a>
          <a href="#">
              <img src="<?= get_template_directory_uri(); ?>/dist/images/icons/x-logo.svg" alt="X icon">
          </a>
        </div>
      </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
