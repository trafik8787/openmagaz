<?php
function token($length = 32) {
	// Create token to login with
	$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
	$token = '';
	
	for ($i = 0; $i < $length; $i++) {
		$token .= $string[mt_rand(0, strlen($string) - 1)];
	}	
	
	return $token;
}


 function dd($message, $die = false, $title = false, $access = true, $color = '#008B8B')
{

	?>
<table border="0" cellpadding="5" cellspacing="0" style="border:1px solid <?= $color ?>;margin:2px; text-align: left;">
	<tr>
		<td>
			<?

			if (strlen($title) > 0) {
				echo '<p style="color:' . $color . ';font-size:11px;font-family:Verdana;">[' . $title . ']</p>';
			}

			if (is_array($message) || is_object($message)) {
				echo '<pre style="color:' . $color . ';font-size:11px;font-family:Verdana;">';
				print_r($message);
				echo '</pre>';
			} else {
				echo '<p style="color:' . $color . ';font-size:11px;font-family:Verdana;">' . var_dump($message) . '</p>';
			}
			echo '</td></tr><tr><td>';
			echo '<div style="font-family:verdana; font-size: 10px; font-weight: normal">';
			$a = debug_backtrace();
			$a = $a[0];
			echo "{$a['file']}: {$a['line']}";
			echo '</div>';
			if ($die === true) {
				die();
			}
			?></td>
	</tr></table><?
}
