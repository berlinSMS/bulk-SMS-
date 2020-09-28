<html>
<head>
<title>PHP-Sample</title>
</head>
<style>
td,input,textarea,i { width:600px; display:block; font: 16px Arial, Helvetica, sans-serif; }
textarea { height:190px; }
   </style>
<body>
<form method="post">
<?php 
$name  =isset($_POST['name']  )?$_POST['name'  ]:'';
$pass  =isset($_POST['pass']  )?$_POST['pass'  ]:'';
$target=isset($_POST['target'])?$_POST['target']:'';
$text  =isset($_POST['text']  )?$_POST['text'  ]:'';
?>
<table border=0 cellspacing=0 cellpadding=0>
<tr><td align="center"><a href="php_sample.txt"><i>Dieses Script im PHP-Quellcode zum Download</i></a></td></tr>
<tr><td>Benutzername                                                                                  </td></tr>
<tr><td><input name="name"    placeholder="Benutzername"      value="<?php echo $name;   ?>"         ></td></tr>
<tr><td>Password                                                                                      </td></tr>
<tr><td><input name="pass"    placeholder="Password"          value="<?php echo $pass;   ?>"         ></td></tr>
<tr><td>Zielrufnummer                                                                                 </td></tr>
<tr><td><input name="target"  placeholder="Zielrufnummer"     value="<?php echo $target; ?>"         ></td></tr>
<tr><td>Text                                                                                          </td></tr>
<tr><td><textarea name="text" placeholder="Text" style="height:50px"><?php echo $text; ?></textarea  ></td></tr>
<tr><td><input type="submit" value="Absenden"></td></tr>

<?php if (strlen(trim($name))):
$host = 'interface.berlinsms.de';
$path = '/wab_versand.php';

$request = 'name='. urlencode($name)
         .'&pass='. urlencode($pass)
         .'&target='. urlencode($target)
         .'&text='. urlencode($text);

echo '<tr><td>Request</td></tr>
<tr><td><textarea>'. $request .'</textarea></td></tr>';

$fp = fsockopen("ssl://$host", 443);
fputs($fp, "POST $path HTTP/1.1\r\n");
fputs($fp, "Host: $host\r\n");
fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Content-length: ". strlen($request) ."\r\n");
fputs($fp, "Connection: close\r\n\r\n");
fputs($fp, $request);

$response = '';
while(!feof($fp)) { $response .= fgets($fp, 128); }
fclose($fp);

echo '<tr><td>Response</td></tr>
<tr><td><textarea style="height:270px">'. $response .'</textarea>';

endif; ?>

</table>
</form>
</body>
</html>