<?php
	$insert = '';
	if($adminLoggedIn){
		$insert = "<p>Click <a href='adminHome.php'>here</a> to return to the Admin Home Page</p>";
	}
	$output = <<<HEREDOC
	<div id="logout-modal-window" class="modal-window hidden">
		<div class="modal-content">
			<h2>Logout Form</h2>
			<span class="modal-close" onclick="toggleDisplay(document.getElementById('logout-modal-window'))">&times</span>
			$insert
			<form class="modal-form" method="post" action="">
				<input type='hidden' name='logout' value='true'>
				<button type="submit">Log Me Out!</button>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="scripts/modal.js"></script>
HEREDOC;
	echo $output;
?>