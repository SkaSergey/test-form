<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

$json = file_get_contents(__DIR__ . '/uploads/' . $id);
$test = json_decode($json, true);
// print_r("<pre>");
// var_dump($test);
// print_r("</pre>"); 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>
<body>
	<form action="" method="POST">
		<?php foreach ($test as $key => $question) : ?>
		<fieldset>
			<legend><?= $question['0'] ?></legend>
			<?php $c = count($question)-1; $i = 1; while ($i<=$c) {
			 		print "<label><input type=\"radio\" name=\"q".$key."\" value=\"".$question["$i"]."\" required>".$question["$i"]."</label>"; $i++;
				}
			?>
		</fieldset>	
		<?php endforeach; ?>
		<input type="submit" value="Отправить">
	</form>
	<?php 
	
		$answers = 0;
		$all = 0;
		if (!empty($_POST)) {
			foreach ($_POST as $q => $a) {
				$all++;
				if ($a == 'Спанч Боб') {
					$answers++;
					
				}
			}
			echo "Ваш результат " . $answers . ' из ' . $all ;
		}
		
	 ?>
</body>
</html>