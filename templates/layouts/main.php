<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index</title>
	<style>
		@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);
			* {
					margin: 0;
					padding: 0;
					box-sizing: border-box;
			}

			body {
					font-family: 'Roboto', Arial, sans-serif;
					background-color: #ebebeb;
					overflow-x: hidden;
					text-align: center;
			}

			header {
				display: flex;
				align-items: center;
	    		justify-content: space-around;
				width: 100%;
				height: 80px;
				background-color: #6b6d79c7;
				box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
			}

			.nav-li {
				line-height: 30px;
    			display: flex;
			}

			.nav-ul {
				display: flex;	
			}

			.nav-link:hover {
				background-color: rgba(0, 0, 0, 0.1);
				cursor: pointer;
			}
			.nav-link {
				font-size: 15px;
				text-transform: uppercase;
				text-decoration: none;
				padding: 8px 10px;
				width: 150px;
				margin: 2%;
				text-align: center;
				background-color: #4c4848b8;
				color: #fbfbfb;
				border-radius: 2px;
				transition: background-color 0.2s ease;
			}

			.nav-link:hover {
				background-color: #212121;
				cursor: pointer;
			}

			h1 {
				margin-top: 100px;
				font-weight: 100;
			}

			p {
				text-align: center;
				padding: 10px;
				color: #aaa;
				font-weight: 500;
			}

			.container {
				margin-top: 50px;
				min-width: 900px;
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
			}

			.block {
				margin: 10px;
				border: 1px solid black;
			}

			.block_flex-wrapper {
				padding: 15px;
			}

			.block_main {
				display: flex;
				justify-content: space-between;
			}
			
			.block_exp {
				padding: 5px;
			}

			.block_exp-border-none {
				border-right: none;
			}

			.header_3 {
				margin: 20px;
			}
	</style>
</head>
<body>
	<header>
		<?= $menu ?>
	</header>
	<div class="container">
		<?= $content ?>
	</div>
</body>
</html>