
<!-- This is a template php page to be used to build any pages needed for the project-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin Home Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
	<!-- ADD ANY PAGE-SPECIFIC STYLESHEETS HERE-->
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Admin Home</h1>
				<p>Admin Actions Available</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>
		</div>

		<?php include 'pageParts/navbar.php';?>
		<div id='admin-navbar-container'>
			<ul>
				<li><button onclick="showTab('home', this)" class="active">Admin Home</button></li>
				<li><button onclick="showTab('editGame', this)">Edit Games</button></li>
				<li><button onclick="showTab('editEmployee', this)">Edit Employees</button></li>
				<li><button onclick="showTab('ordersDeliveries', this)">Orders and Deliveries</button></li>
			</ul>
		</div>
		<script type="text/javascript">
			function showTab(tabChoice, button){
				
				document.querySelectorAll('.admin-page-tab').forEach(tab => {
					if(!tab.classList.contains('hide-tab')){
						tab.classList.add('hide-tab');
					}
				});
				
				switch(tabChoice){
					case 'home':
						document.getElementById('home-tab').classList.remove('hide-tab');
						break;
					case 'editGame':
						document.getElementById('edit-game-tab').classList.remove('hide-tab');
						break;
					case 'editEmployee':
						document.getElementById('edit-employee-tab').classList.remove('hide-tab');
						break;
					case 'ordersDeliveries':
						document.getElementById('orders-deliveries-tab').classList.remove('hide-tab');
						break;
					default:
						break;
				}
				document.querySelectorAll('#admin-navbar-container > ul > li > button.active').forEach(buttonLink => {
					buttonLink.classList.remove('active');
				});
				button.classList.add('active');
				
			}
		</script>
	</div>

	<div id="page-body">

		<!-- THE PAGES MAIN CONTENT-->
		<div id='tab-container'>
			
			<div id="home-tab" class="admin-page-tab">
				<div class="tab-content">
					<div id="home-tab-message">
						<h1 class="message-title">You are at the Admin Home Page</h1>

						<div class="tab-description-container">	
							<h2 class='tab-description-title'>At the Edit Games Tab You Can</h2>
							<ul class='tab-description-list'>
								<li class='tab-description-option'>Edit Game Properties</li>
								<li class='tab-description-option'>Add and Remove Instances (physical copies) from the database</li>
								<li class='tab-description-option'>Add New Games to the database</li>
							</ul>
						</div>

						<div class="tab-description-container">	
							<h2 class='tab-description-title'>At the Edit Employees Tab You Can</h2>
							<ul class='tab-description-list'>
								<li class='tab-description-option'>Grant and Revoke Permissions</li>
								<li class='tab-description-option'>Remove Employees</li>
								<li class='tab-description-option'>Create New Employees</li>
								<li class='tab-description-option'>Edit Employee Information</li>
							</ul>
						</div>

						<div class="tab-description-container">	
							<h2 class='tab-description-title'>At the Orders and Deliveries Tab You Can</h2>
							<ul class='tab-description-list'>
								<li class='tab-description-option'>View Current Orders that have not been assigned to a delivery</li>
								<li class='tab-description-option'>Assign Orders to a Delivery Employee</li>
								<li class='tab-description-option'>View Orders Currently being Delivered</li>
								<li class='tab-description-option'>View Past Orders that have already been delivered</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div id="edit-game-tab" class='admin-page-tab hide-tab'>
				<div class="tab-content">
					<div id="edit-game-container">

							<div id='edit-game-select-container'>
								<label for="edit-game-select">Game: </label>
								<select name="edit-game-select">
									
								</select>
							</div>
							<div id='instance-choice-select-container'>
								<label for="instance-choice-select">Game Instance: </label>
								<select name="instance-choice-select">
									
								</select>
							</div>
							<div id='edit-forms-container'>
								<form id='edit-game-form' class='hide-tab'>
									<input type="hidden" name="game-id">
									<input type="hidden" name="edit-type" value='edit'>
									<div class='edit-game-input-container'>
										<label for='edit-title'>Game Title</label>
										<input type="text" name="edit-title">
										<button type='radio' name='edit-title-radio'></button>
									</div>

									<div class='edit-game-input-container'>
										<label for='edit-genre'>Game Genre</label>
										<input type="text" name="edit-genre">
										<button type='radio' name='edit-genre-radio'></button>
									</div>

									<div class='edit-game-input-container'>
										<label for='edit-rating'>Game Rating</label>
										<input type="text" name="edit-rating">
										<button type='radio' name='edit-rating-radio'></button>
									</div>

									<div class='edit-game-input-container'>
										<label for='edit-imagePath'>Game Image Path</label>
										<input type="text" name="edit-imagePath">
										<button type='radio' name='edit-imagePath-radio'></button>
									</div>

									<div class='edit-game-input-container'>
										<label for='edit-description'>Game Description</label>
										<textarea name="edit-description">
										<button type='radio' name='edit-description-radio'></button>
									</div>
									<button type='submit'>Edit Game</button>
								</form>

								<form id='add-instance-form' class='hide-tab'>
									<input type="hidden" name="game-id">
									<input type="hidden" name="edit-type" value='add'>
									<div class='add-instance-input-container'>
										<label for='status'>Instance Status</label>
										<input type="text" name="status">
									</div>
									<div class='add-instance-input-container'>
										<label for='store'>Store</label>
										<input type="text" name="store">
									</div>
									<button type='submit'>Add Instance</button>
								</form>
								<form id='remove-instance-form' class='hide-tab'>
									<input type="hidden" name="game-id">
									<input type="hidden" name="copy-id">
									<input type="hidden" name="edit-type" value='remove'>
									<button type='submit'>Remove Instance</button>
								</form>
							</div>
							<div id='edit-games-buttons-container'>
								<button onclick='selectEditForm("edit-game-form")'>Edit Game Properties</button>
								<button onclick='selectEditForm("add-instance-form")'>Add New Instance</button>
								<button onclick='selectEditForm("remove-instance-form")'>Remove Current Instance</button>
							</div>
					</div>
					<div id="add-game-container">
						<form id="add-game-form">
							<div class='add-game-input-container'>
								<label for='title'>Game Title</label>
								<input type="text" name="title">
							</div>

							<div class='add-game-input-container'>
								<label for='genre'>Game Genre</label>
								<input type="text" name="genre">
							</div>

							<div class='add-game-input-container'>
								<label for='rating'>Game Rating</label>
								<input type="text" name="rating">
							</div>

							<div class='add-game-input-container'>
								<label for='imagePath'>Game Image Path</label>
								<input type="text" name="imagePath">
							</div>

							<div class='add-game-input-container'>
								<label for='description'>Game Description</label>
								<textarea name="description">
							</div>
							<button type='submit'>Add Game</button>
						</form>
					</div>
				</div>
			</div>

			<div id="edit-employee-tab" class='admin-page-tab hide-tab'>
				<div class="tab-content">
					<p>edit employee</p>
				</div>
			</div>

			<div id="orders-deliveries-tab" class='admin-page-tab hide-tab'>
				<div class="tab-content">
					<p>orders deliveries</p>
				</div>
			</div>

		</div>
	</div>

	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php';?>
	<?php include 'pageParts/sourcesFooter.php';?>
	<!-- ADD ANY PAGE SPECFIC SCRIPTS HERE-->
	<script type="text/javascript">
		
	</script>
</body>
</html>