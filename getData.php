<?php
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	$table = $_GET['table'];
	$field = $_GET['field'];
	$id = $_GET['id'];
	$idType = $_GET['idType'];
	$response = '';
	$databaseCredentials = include('databaseCredentials.php');

	echo json_encode(getField($databaseCredentials, $table, $field, $idType, $id));

	function getField($credentials, $table, $field, $idType, $id){
		$query = "SELECT {$field} FROM {$table}  WHERE {$idType} = ?";
		$connection = mysqli_connect($credentials['servername'], $credentials['username'], $credentials['password'], $credentials['database']);
		$response = [];
		if(!$connection){
			die('Connection failed ' . mysqli_connect_error());
		}
		if($statement = mysqli_prepare($connection, $query)){
			mysqli_stmt_bind_param($statement, "i", $id);
			mysqli_stmt_execute($statement);
			$result = mysqli_stmt_get_result($statement);
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_row($result)){
					$response[] = $row[0];
				};
			}
			mysqli_stmt_close($statement);
		} else{
				/// no games
				$row = mysqli_error($connection);
		}
		mysqli_close($connection);
		return $response;
	}
?>