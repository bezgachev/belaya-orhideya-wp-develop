<?
if(!defined('ABSPATH')){exit;}
if(function_exists('acf_add_options_page') ) {
  $enabled_mail_smtp = get_field('enabled_mail_smtp', 'options');
  if ($enabled_mail_smtp == true) {
      
    add_action( 'phpmailer_init', 'my_phpmailer_example' );
    function my_phpmailer_example( $phpmailer ) {
          // $id_post = 'options';
          $phpmailer->IsSMTP();
          $phpmailer->SMTPAuth = true;
          $phpmailer->CharSet = 'UTF-8';
          $phpmailer->SMTPSecure = 'ssl';
          $phpmailer->Host = 'ssl://'.get_field('mail_custom_SMTP_HOST', 'options').'';
          $phpmailer->Port = 465;
          $phpmailer->Username = get_field('mail_custom_SMTP_USER', 'options');
          $phpmailer->Password = get_field('mail_custom_SMTP_PASS', 'options');
          $phpmailer->isHTML(true);
    }
  }
}
add_action('wp_mail_failed', 'log_mailer_errors', 10, 1);
function log_mailer_errors( $wp_error ){
  $fn = ABSPATH . '/mail-smtp.log'; // say you've got a mail.log file in your server root
  $fp = fopen($fn, 'a');
  fputs($fp, "Mailer Error: " . $wp_error->get_error_message() ."\n");
  fclose($fp);
}

add_filter( 'wp_mail_content_type', 'true_content_type' );
function true_content_type( $content_type ) {
	return 'text/html';
//   return 'application/json';
}