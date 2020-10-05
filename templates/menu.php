<?php
$menuList = [
	[
		'title' => 'Главная',
		'href' => '/',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
	[
		'title' => 'Задание 1',
		'href' => '?page=task_1',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
	[
		'title' => 'Задание 2',
		'href' => '?page=task_2',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
	[
		'title' => 'Задание 3 и 8',
		'href' => '?page=task_3_8',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
	[
		'title' => 'Задание 4, 5 и 9',
		'href' => '?page=task_4_5_9',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
];

function renderMenu($menuList) {
	$res = "<ul class='nav-ul'>";

	foreach ($menuList as $listItem) {
		if(!is_array($listItem)) {
			$res .= "<ul class='{$listItem}'>";
		}

		$res .= "<li class=\"{$listItem["style"]}\"><a href=\"{$listItem["href"]}\" class=\"{$listItem["styleLink"]}\">{$listItem["title"]}</a>";

		if(isset($menu['menuList'])){
			$res .= renderMenu($menu['submenu']);
		}

		$res .= "</li>";
	}
	$res .= "</ul>";
	return $res;
}

echo renderMenu($menuList)
?>