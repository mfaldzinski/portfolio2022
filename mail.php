<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['sub'];
$check = $_POST['check'];
header('Content-Type: application/json');
if ($name === ''){
  print json_encode(array('message' => 'Pole Twoje imię nie może pozostać puste!', 'code' => 0));
  exit();
}
if ($email === ''){
  print json_encode(array('message' => 'Pole Twój adres e-mail nie może pozostać puste!', 'code' => 0));
  exit();
} else {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  print json_encode(array('message' => 'Pole Twój adres e-mail zawiera nie poprawny format!', 'code' => 0));
  exit();
  }
}
if ($subject === ''){
  print json_encode(array('message' => 'Pole Temat nie może pozostać puste!', 'code' => 0));
  exit();
}
if ($message === ''){
  print json_encode(array('message' => 'Pole Twoja wiadomość nie może pozostać puste!', 'code' => 0));
  exit();
}
if ($check != 'true'){
  print json_encode(array('message' => 'Musisz wyrazić zgodę aby wysłać wiadomość!', 'code' => 0));
  exit();
}
$content="WIADOMOŚĆ WYSŁANA OD: $name \nTEMAT: $subject \nADRES E-MAIL: $email \nWIADOMOŚĆ: $message";
$recipient = "kontakt@mfaldzinski.pl";
$mailheader = 'From: '.$email.'' . "\r\n" .
    'Reply-To: '.$email.'' . "\r\n";
mail($recipient, $subject, $content, $mailheader) or die("Error!");
print json_encode(array('message' => '<font color="lime">Twoja wiadomość została wysłana! Odpowiem jak najszybciej ;)</font>', 'code' => 1));
exit();
?>
