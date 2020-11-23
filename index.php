<?php
	$databaseCredentials = include('databaseCredentials.php');

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$gameCategories = getCategories($databaseCredentials);
	$gameListByCategory;

	/*
		gameCategories will be setup as a list of all available catageories, 
		i.e. [cat0, cat1, cat2, cat3...]
		
		gameListByCatgegory will be a two-dimensional array where the key is a category from gameCategories
		and the corresponding value is an array of all games that are in that category
		i.e. [ {cat0, [game1, game2, game3]}, {cat1, [game1, game2, game3]}...]
	*/
	foreach ($gameCategories as $key => $value) {
		$gameListByCategory[$value] = getGames($value, $databaseCredentials);
	}

	/*These are temporary 'getter' functions, they will need to be rewritten once the database is created to return real values from the database*/
	function getCategories($credentials) {
		$query = 'SELECT DISTINCT genre FROM GAME';
		$outputList = [];
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		$queryResult = mysqli_query($connection, $query);

		if(mysqli_num_rows($queryResult) > 0){
			while($row = mysqli_fetch_assoc($queryResult)){
				$outputList[] = $row['genre'];
			}
		}else{
			//no genres?
		}
		mysqli_close($connection);
		return $outputList;
	}
	function getGames($category, $credentials){
		$query = 'SELECT game_id FROM GAME WHERE genre = ?';
		$outputList = [];
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "s", $category);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$outputList[] = $row['game_id'];
				}
			}
			mysqli_stmt_close($statement);
		} else{
			/// no games
		}
		mysqli_close($connection);
		return $outputList;
	}

	function getGameTitle($gameID, $credentials){

		$query = 'SELECT title FROM GAME WHERE game_id = ?';
		$output;
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "s", $gameID);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$output = $row['title'];
			}
			mysqli_stmt_close($statement);
		} else{
			/// no games
		}
		mysqli_close($connection);
		return $output;
	}

	function getGameImage($gameID, $credentials){
		$query = 'SELECT imagePath FROM GAME WHERE game_id = ?';
		$output;
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "s", $gameID);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$output = $row['imagePath'];
			}
			mysqli_stmt_close($statement);
		} else{
			/// no games
		}
		mysqli_close($connection);
		return $output;
	}

	function getGameRating($gameID, $credentials){
		$query = 'SELECT rating FROM GAME WHERE game_id = ?';
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		$output;
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "s", $gameID);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$output = $row['rating'];
			}
			mysqli_stmt_close($statement);
		} else{
			/// no games
		}
		mysqli_close($connection);
		return $output;
	}

	function getGameDesc($gameID, $credentials){
		$query = 'SELECT description FROM GAME WHERE game_id = ?';
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		$output;
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "s", $gameID);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$output = $row['description'];
			}
			mysqli_stmt_close($statement);
		} else{
			/// no games
		}
		mysqli_close($connection);
		return $output;
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

		<?php include "pageParts/navbar.php";?>
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
							$title = getGameTitle($gameValue, $databaseCredentials);
							$rating = getGameRating($gameValue, $databaseCredentials);
							$imagePath = getGameImage($gameValue, $databaseCredentials);
							$desc = getGameDesc($gameValue, $databaseCredentials);
							echo "<li class='game-container'>";
								echo "<a href='gameInfo.php?gameId=$gameValue' class='game-img'><img src='$imagePath' alt='Image for - $title'></a>";
								echo "<div class='game-info-container'>";
									echo "<span class='game-title'>$title</span>";
									echo "<span class='game-rating'>$rating</span>";
									echo "<span class='game-desc-short'>$desc</span>";
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
	<?php include 'pageParts/sourcesFooter.php';?>
</body>
</html>