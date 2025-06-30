<?php 

$contactData = get_field('contact_fields', 'option');

function fixPhoneNumber($x) {
  return str_replace(' ', '', $x);
}

?>

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="footer-column">
        <h2>Lorem ipsum</h2>
        <ul>
          <li><a href="#">Lorem, ipsum.</a></li>
          <li><a href="#">Lorem, ipsum.</a></li>
          <li><a href="#">Lorem, ipsum.</a></li>
        </ul>
      </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="footer-column">
        <h2>About us</h2>
        <ul>
          <li><a href="#">Lorem, ipsum.</a></li>
          <li><a href="#">Lorem, ipsum.</a></li>
          <li><a href="#">Lorem, ipsum.</a></li>
        </ul>
      </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="footer-column">
        <h2>Contact</h2>
        <ul>
          <?php
            if ($contactData) {

              // Address URL open
              if ($contactData['address_url_link'] !== '') {
                echo '<a href="' . $contactData['address_url_link'] . '" target="_blank">';
              }
              
              // Show address
              if ($contactData['address'] !== '') {
                echo '<li>' . $contactData['address'] . '</li>';
              }
              
              // Showing zipcode + placename together
              if ($contactData['zipcode'] !== '' && $contactData['place_name'] !== '') {
                echo '<li>' . $contactData['zipcode'] . ' ' . $contactData['place_name'] . '</li>';
              }
              
              // Address URL close
              if ($contactData['address_url_link'] !== '') {
                echo '</a>';
              }
            }
            ?>
        </ul>
        <ul>
          <?php 

            if ($contactData) {
            if ($contactData['phonenumber'] !== '') {
          
          ?>

              <li>
                <a class="text-decoration-underline" title="Bel ons" href="tel:<?= fixPhoneNumber($contactData['phonenumber']); ?>"><?= $contactData['phonenumber']; ?></a>
              </li>

              <?php
            }
            
            // Show email + mailto link
            if ($contactData['e_mail'] !== '') {
              
              ?>
              <li>
                <a class="text-decoration-underline" title="Mail ons" href="mailto:<?= $contactData['e_mail']; ?>"><?= $contactData['e_mail']; ?></a>
              </li>
              <?php
            }
            }
          ?>
        </ul>
      </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
