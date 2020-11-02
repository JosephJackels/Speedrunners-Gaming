<?php
	$gameCategories = getCategories();
	$gameListByCategory;
	/*
		gameCategories will be setup as a list of all available catageories, 
		i.e. [cat0, cat1, cat2, cat3...]
		
		gameListByCatgegory will be a two-dimensional array where the key is a category from gameCategories
		and the corresponding value is an array of all games that are in that category
		i.e. [ {cat0, [game1, game2, game3]}, {cat1, [game1, game2, game3]}...]
	*/
	foreach ($gameCategories as $key => $value) {
		$gameListByCategory[$value] = getGames($value);
	}

	/*These are temporary 'getter' functions, they will need to be rewritten once the database is created to return real values from the database*/
	function getCategories() {
		return ['Action', 'Adventure', 'Puzzle', 'RPG'];
	}
	function getGames($category){
		return [$category . " game ID 1", $category . " game ID 2", $category . " game ID 3", $category . " game ID 4", $category . " game ID 5"];
	}

	function getGameTitle($gameID){
		return 'temp title for ' . $gameID;
	}

	function getGameImage($gameID){
		return 'temp image for ' . $gameID;
	}

	function getGameRating($gameID){
		return 'temp rating for ' . $gameID;
	}

	function getGameDescShort($gameID){
		return 'temp description for ' . $gameID;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Speedrunners Gaming</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/gameList.css">
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Welcome to Speedrunners Gaming</h1>
				<p>This will be the main landing page for our project</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>
		</div>

		<?php 
			include 'pageParts/navbar.php'; 
		?>
	</div>

	<!-- Once the database has been implemented thes containers will be filled via php and queries to the database-->
	<div id="page-body">
		<div id="game-lists-container">
			<?php 
				foreach ($gameCategories as $key => $categoryValue) {
					echo "<div class = 'game-list-container'>";
						echo "<h1 class='game-list-title'>" . $categoryValue . ' Games</h1>';
						echo "<ul class='game-list'>";

						foreach ($gameListByCategory[$categoryValue] as $key => $gameValue) {
							echo "<li class='game-container'>";
								echo "<img class='game-img' src='#' alt='" . getGameImage($gameValue) . "'>";
								echo "<div class='game-info-container'>";
									echo "<span class='game-title'>" . getGameTitle($gameValue) . "</span>";
									echo "<span class='game-rating'>" . getGameRating($gameValue) . "</span>";
									echo "<span class='game-desc-short'>" . getGameDescShort($gameValue) . "</span>";
								echo "</div>";
							echo "</li>";
						}

						echo "</ul>";
						echo"</div>";
				}
			?>
		</div>
	</div>

	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php';?>
</body>
</html>