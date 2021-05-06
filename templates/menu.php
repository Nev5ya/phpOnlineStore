<?php
$authMenu = [
    [
        'title' => 'Выход',
        'href' => '/?logout',
        'style' => 'nav-li',
        'styleLink' => 'nav-link'
    ]
];

$menuList = [
	[
		'title' => 'Главная',
		'href' => '/',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
	[
		'title' => 'Дз 3',
		'href' => '/homework_3',
		'style' => 'nav-li',
		'hover' => 'hover',
		'styleLink' => 'nav-link',
		'subHidden' => 'ul-hidden',
		'subMenu' => [
			[
				'title' => 'Задание 1',
				'href' => '/task_1',
				'style' => 'nav-li',
				'styleLink' => 'nav-link'
			],
			[
				'title' => 'Задание 2',
				'href' => '/task_2',
				'style' => 'nav-li',
				'styleLink' => 'nav-link'
			],
			[
				'title' => 'Задание 3 и 8',
				'href' => '/task_3_8',
				'style' => 'nav-li',
				'styleLink' => 'nav-link'
			],
			[
				'title' => 'Задание 4, 5 и 9',
				'href' => '/task_4_5_9',
				'style' => 'nav-li',
				'styleLink' => 'nav-link'
			],
		]
	],
	[
		'title' => 'Галерея',
		'href' => '/gallery',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
    [
        'title' => 'Каталог',
        'href' => '/catalog',
        'style' => 'nav-li',
        'styleLink' => 'nav-link'
    ],
	[
		'title' => 'Калькулятор',
		'href' => '/calculator',
		'style' => 'nav-li',
		'styleLink' => 'nav-link'
	],
    [
        'title' => 'Отзывы',
        'href' => '/feedback',
        'style' => 'nav-li',
        'styleLink' => 'nav-link'
    ],
    [
        'title' => 'Корзина<span id="count"> [ ' . $count . ' ]</span>',
        'href' => '/cart',
        'style' => 'nav-li',
        'styleLink' => 'nav-link',
    ],
    [
        'title' => $params['auth']? 'Кабинет' : 'Вход',
        'href' => '/auth',
        'style' => 'nav-li',
        'hover' => 'hover',
        'subHidden' => 'ul-hidden',
        'styleLink' => 'nav-link',
        'subMenu' => $params['auth']?$authMenu : ''
    ]
];

function renderMenu($menuList, $params):string {
	$res = "<ul class='nav-ul {$params['subHidden']}'>";

	foreach ($menuList as $listItem) {

		$res .= "<li class=\"{$listItem["style"]} {$listItem["hover"]}\"><a href=\"{$listItem["href"]}\" class=\"{$listItem["styleLink"]}\">{$listItem["title"]}</a>";

		if(isset($listItem['subMenu'])){
			$res .= renderMenu($listItem['subMenu'], ['subHidden' => 'ul-hidden']);
		}

		$res .= "</li>";
	}
	$res .= "</ul>";
	return $res;
}

echo renderMenu($menuList, $params);