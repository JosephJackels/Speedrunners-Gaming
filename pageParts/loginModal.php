<?php 
	$output = <<<HEREDOC
	<div id="login-modal-window" class="modal-window">
		<div class="modal-content">
			<h2>Login Form</h2>
			<span class="modal-close" onclick="getElementById('login-modal-window').style.display = 'none'">&times</span>
			<form class="modal-form">
				<div class="modal-form-inputs">
					<div class="modal-form-input-container">
						<label for="username">Email:</label>
						<input type="email" name="username">
					</div>
					<div class="modal-form-input-container">
						<label for="password">Password:</label>
						<input type="password" name="password" id="password-input">
					</div>
				</div>
				<button type="submit">Log In!</button>
			</form>
			<p>Not yet a member? <a href="accountCreation.php">Click Here to Create an Account</a></p>
		</div>
	</div>
HEREDOC;
	echo $output;
?>