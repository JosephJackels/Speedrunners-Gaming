<?php 
	//get variables here?
	$gameTitle = "Title - temp";
	$gameImage = "Image - temp";
	$gameDesc = "Description - temp";
	$gameRating = "Rating - temp";
	$gameTags = ["tag1", "tag2", "tag3"];
	$availability = false;

	$requestedGameId = htmlspecialchars($_GET['gameId']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo "$requestedGameId Page"; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/gameInfo.css">
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1><?php echo $gameTitle . " for $requestedGameId"; ?></h1>
				<p>About <?php echo $gameTitle  . " for $requestedGameId";?></p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>

		</div>

		<?php include 'pageParts/navbar.php'; ?>
	</div>

	<div id="page-body">
		<div id="game-display-container">
			<div id="image-container">
				<img src="#" <?php echo "alt='Image for $requestedGameId'" ?>>
				<span><?php if($availability){echo $requestedGameId . ' is Available';}else {echo $requestedGameId . ' is Unavailable';} ?></span>
				<button>Order Now!</button>
			</div>
			<div id="game-description-container">
				<h2><?php echo $gameTitle;?></h2>
				<h3>
					<?php
						$length = count($gameTags);
						for($i = 0; $i < $length - 1; $i++){
							echo $gameTags[$i] . ', ';
						}
						echo $gameTags[$length - 1];
					?>
				</h3>
				<h3>Rated <?php echo $gameRating; ?></h3>
				<div id="game-description">
					<p><?php echo $gameDesc; ?></p>
				</div>
			</div>
		</div>
	</div>

	<?php include 'pageParts/loginModal.php' ?>
	<?php include 'pageParts/sourcesFooter.php';?>
</body>
</html>