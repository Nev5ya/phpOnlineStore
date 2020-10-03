<?php

//при рендере появляются артефакты в виде строки "1"

//хотелось полностью автоматизировать процесс подключения файлов
//и поэтому усложнил код доп скриптом не относящимся к домашке
function dirToArray($path = '.') {
  
   $result = array();

   $cdir = scandir($path);
   foreach ($cdir as $key => $value)
   {
      if (!in_array($value,array(".","..")))
      {
         if (is_dir($path . DIRECTORY_SEPARATOR . $value))
         {
            $result[$value] = dirToArray($path . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
            $result[] = $value;
         }
      }
   }
  
   return $result;
}

function renderTemplates($entryPoint){
	$templates = dirToArray($entryPoint);
	$content = '';

	foreach ($templates as $key => $value) {
		$content = include("$entryPoint/$value");
	}
	return $content;
	
}

// function renderTemplatesRecursive($pageName, $content = ''){
// 	ob_start();
// 	$filename = 'templates/' . $pageName . '.php';
// 	if(file_exists($filename)){
// 		include($filename);
// 	}
// 	return ob_get_clean();
// }


renderTemplates('templates');
?>