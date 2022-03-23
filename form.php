<?php
if(isset($_POST['email'])) {
	
	//replace your email here
	$email_to = "genshinpiky@gmail.com";
	
	
	function died($error) {
		// your error code can go here
		echo '<div class="center"><h2>Il y a eu des problèmes lors de la soumission de votre demande:</h2></div>';
		echo '<div class="center"><p>' . $error. '</p></div>';
		echo '<div class="center">';
		echo '<ul class="pages">';
		echo '<li><a href="index.html#contact">Clique pour re-send</a></li>';
		echo '</ul>';
		echo '</div>';
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['name']) || 
		!isset($_POST['email']) ||
		!isset($_POST['subject']) ||
		!isset($_POST['message'])) {
	 died('Nous sommes désolés, mais il semble y avoir un problème avec le formulaire que vous avez soumis.');	
		}
	
	$name = $_POST['name']; // required
	$email_from = $_POST['email']; // required
	$subject = $_POST['subject']; // required
	$message = $_POST['message']; // required
	
	$error_message = "";
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
  	$error_message .= 'Le nom saisie est invalide.<br />';
  }
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
  	$error_message .= 'Le email saisie est invalide..<br />';
  }
  if(strlen($subject) < 2) {
  	$error_message .= 'Le sujet saisie est invalide.<br />';
  }
  if(strlen($message) < 5) {
  	$error_message .= 'Le message saisie est invalide.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message = "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$subject .= "Subject: ".clean_string($subject)."\n";
	$email_message .= "Message: ".clean_string($message)."\n";
	
	
// create email headers
$headers = 'De: ' .$email_from. "\r\n"; 
$headers .= 'Répondre: ' .$email_from. "\r\n";
'X-Mailer: PHP/' . phpversion();
mail($email_to, $subject, $email_message, $headers)

?>
<!-- place your own success html below -->
<div class="center"><h2>Merci de m'avoir contacté !</h2></div>
<div class="center"><p>Je vous répondrai dans les plus brefs délais.</p></div>
<?php
}
die();
?>
