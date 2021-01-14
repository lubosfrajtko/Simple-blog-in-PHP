<?php 
require_once '_inc/config.php';
$tags = get_all_tags();

?>

<!DOCTYPE html>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= $page_name ?> CREATIVE REVIEW</title>
		<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?= asset('/css/normalize.css')?>">
		<link rel="stylesheet" href="<?= asset('/css/style.css')?>">

		<!--[if lt IE 9]>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
		<![endif]-->
	</head>
	<body>
		<header class="header-post">
			<div class="heading-group">
				<a href="<?= BASE_URL ?>">
					<h2>Creative</h2>
					<h2>review</h2>
				</a>
			</div>
			<nav class="navigation">
				<a href="<?= BASE_URL ?>">Home</a>
				<a href="<?= get_add_link( $post ) ?>">Add post</a>
				<div class="dropdown">
					<div id="mySidebar" class="sidebar">
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
						<h3>Find by tags</h3>
						<div class="header-tags-links">
							<?php foreach($tags as $tag ):?>
								<a href="<?= BASE_URL.'/tag/'.$tag->tag ?>"><?= $tag->tag ?></a>
							<?php endforeach?>
						</div>					
					</div>			
					<div id="main">
						<button class="openbtn" onclick="openNav()">&#9776; </button>
					</div>
				</div>	
			</nav>
		</header>
		<div class="menu-border"></div>
		<div class="notifications">
			<p><?= flash()->display() ?></p>
		</div>
		<main>