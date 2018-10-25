
<?php
	if (isset($_FILES['file']['name'])) {
		$tmp_name = $_FILES['file']['tmp_name'];
		$path = $_FILES['file']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE );
		
		$file_type = finfo_file($finfo, $tmp_name);
		if ($file_type !== "text/plain") {
			$errors['Файл'] = 'Ошибка! Загрузите тест в формате json';
			print_r($errors['Файл']);

		}

			elseif (isset($_FILES['file'])) {
		$file_name = $_FILES['file']['name'];
		$file_path = __DIR__ . '/uploads/';
		$file_url = './uploads/' . $file_name;
		move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
		print("Файл успешно загружен: <a href='$file_url'>$file_name</a>");
		
		}
	}


	$datadir = './uploads/';
	$ArrFiles = [];
	$ArrTests = [];
	if($OpDir = opendir($datadir)){
    while(false !== ($file = readdir($OpDir))) {
        if(preg_match ('~\.json$~',$file)){
            $ArrFiles[] = $file;
        }
    }
}

for ($i = 0; $i < count($ArrFiles);$i++){
$JsonFile = file_get_contents('./uploads/'.$ArrFiles[$i]);
$Arr = json_decode($JsonFile,true);
    $key = $ArrFiles[$i];
    
    $ArrTests[] = $key;
    
}

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список тестов</title>
</head>
<body>

<form action="list.php"  method="post">
    <div> <b>Список доступных тестов:</b>
        <ul>
    <?php foreach ($ArrTests as $id=>$key){
       
    echo "<li><a href=\"test.php?id=$key\">$key</a></li>";
    }
       ?>
     </ul>
    </div>
</form>
</body>
</html>