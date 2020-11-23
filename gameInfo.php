<?php 
	//get variables here?
	$availability = false;
	$availabilityList = [];
	$requestedGameId = htmlspecialchars($_GET['gameId']);

	$databaseCredentials = include 'databaseCredentials.php';

	$connection = mysqli_connect($databaseCredentials['servername'], $databaseCredentials['username'], $databaseCredentials['password'], $databaseCredentials['database']);
	if(!$connection){
		die('Connection failed ' . mysqli_connect_error());
	}
	$getGameDataQuery = "SELECT title, genre, rating, imagePath, description FROM GAME WHERE game_id = ?";
	$getGameInstances = 'SELECT status, store_id, copy_id FROM GAME_INSTANCE WHERE game_id = ?';
	if($statement = mysqli_prepare($connection, $getGameDataQuery)){
		mysqli_stmt_bind_param($statement, "i", $requestedGameId);
		mysqli_stmt_execute($statement);
		$gameDataResult = mysqli_stmt_get_result($statement);
		if(mysqli_num_rows($gameDataResult) > 0){
				$row = mysqli_fetch_assoc($gameDataResult);
				$gameTitle = $row['title'];
				$gameImage = $row['imagePath'];
				$gameDesc = $row['description'];
				$gameRating = $row['rating'];
				$gameGenre = $row['genre'];
			}
		mysqli_stmt_close($statement);
	
		if($statement = mysqli_prepare($connection, $getGameInstances)){
			mysqli_stmt_bind_param($statement, "i", $requestedGameId);
			mysqli_stmt_execute($statement);
			$gameInstancesResult = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($gameInstancesResult) > 0){
				while($row = mysqli_fetch_assoc($gameInstancesResult)){
					if($row['status'] == 0)// 0 = available, 1 = with customer, 2 = damaged
					{
						$availability = true;
						$availabilityList[] = [$row['copy_id'], $row['store_id']];
					}
				}
			}
			mysqli_stmt_close($statement);
		}
	} else{
			//error?
	}
	mysqli_close($connection);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo "$gameTitle Page"; ?></title>
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
				<h1><?php echo $gameTitle . " Page"; ?></h1>
				<p>About <?php echo $gameTitle;?></p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>

		</div>

		<?php include 'pageParts/navbar.php'; ?>
	</div>

	<div id="page-body">
		<div id="game-display-container">
			<div id="image-container">
				<img src=<?php echo "'$gameImage'" ?> <?php echo "alt='$gameTitle'" ?>>
				<span><?php if($availability){echo $gameTitle . ' is Available';}else {echo $gameTitle . ' is Unavailable';} ?></span>
				<button>Order Now!</button>
			</div>
			<div id="game-description-container">
				<h2><?php echo $gameTitle;?></h2>
				<h3>
					<?php
						echo $gameGenre;
					?>
				</h3>
				<h3>Rating of <?php echo $gameRating; ?></h3>
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