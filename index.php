<meta charset="utf-8">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="shorten.css">

<body>
<form method="POST" name="urlform">
  

 <input name="txt" type="url" id="txt" placeholder="Váš odkaz"><br />
<input type="submit" name="submit" value="Zkrátit">
</form>
</body>
<?php

if(isset($_POST['txt'])) {




  
$long_url = urlencode($_POST['txt']);


$bitly_login = 'filiptronicek';
$bitly_apikey = 'R_e8b7b028a203498f96129cbcda9f15e6';
$uniqid = uniqid();
$bitly_response = json_decode(file_get_contents("http://api.bit.ly/v3/shorten?login={$bitly_login}&apiKey={$bitly_apikey}&longUrl={$long_url}&format=json&shortUrl=http://filipt.cf/jednicka"));

$short_url = $bitly_response->data->url;
  
echo "Zkrácený odkaz:<br /><div id='result' class='result' onClick='document.getElementByClass(\'result\').select;'>".$short_url."</div> <br /> ";


  $cookie_name = "lasturllong";
$cookie_long_value = urldecode($long_url);
  
  
setcookie($cookie_name, $cookie_long_value, time() + (86400 * 100), "/"); // 86400 = 1 day

if(!isset($_COOKIE[$cookie_name])) {
//Ještě se nikdy nezkracovalo
  

} else {
     echo "Posledně jste zkrátili " . $_COOKIE[$cookie_name];
}

}
?>
<script src="shorten.js">

  </script>
