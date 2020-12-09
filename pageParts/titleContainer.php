<?php
echo <<<HEREDOC
<div id="page-title-container">
			<div id="page-title">
				<h1>$pageHeader</h1>
				<p>$pageDescription</p>
			</div>
			<button id="login-modal-window-open" onclick="toggleDisplay(document.getElementById('$modalCurrentWindow'))">$modalOpenMessage</button>
</div>
HEREDOC;
?>