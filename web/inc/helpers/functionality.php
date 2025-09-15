<?php

function get_country(): string {
    
  static $country_code = '';

  if ( isset( $_COOKIE['country_code'] ) ) {
    return $_COOKIE['country_code'];
  } elseif( $country_code !== '' ) {
    return $country_code;
  } else {
    $user_ip = get_actual_ip_address();
    $country_code = fetch_country( $user_ip );
    setcookie( 'country_code', $country_code, time() + (86400 * 30), "/" );
    return $country_code;
  }
}

function get_actual_ip_address(): String {

    if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];
    
    } elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
    
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    
    } else {
    
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}


function is_bot(){

	if(isset($_SERVER['HTTP_USER_AGENT'])) {
		return preg_match('/rambler|abacho|acoi|accona|aspseek|altavista|estyle|scrubby|lycos|geona|ia_archiver|alexa|sogou|skype|facebook|twitter|pinterest|linkedin|naver|bing|google|yahoo|duckduckgo|yandex|baidu|teoma|xing|java\/1.7.0_45|bot|crawl|slurp|spider|AhrefsBot|robot|googlebot|wordpress|Applebot|MJ12bot|SemrushBot|zoominfobot|Velen|CFNetwork|Pinterest|Yandex|DotBot|BLEXBot|SeznamBot|crawl|MegaIndex.ru|python|link|nutch|Sogou|mediapartners|\sask\s|\saol\s/i', $_SERVER['HTTP_USER_AGENT']);
	}

  return false;
}

function fetch_country( String $ip ): String {

	if ( is_bot() ) {
		return 'NL';
	}

  $options = stream_context_create(array('http'=>
      array(
        'timeout' => 10
      ),
  ));
  $return = json_decode( file_get_contents("https://ipwebservice.vepa.nl/wp-json/vepa-webservice/v1/address?ip={$ip}", false, $options) , true);

  return $return;

}


