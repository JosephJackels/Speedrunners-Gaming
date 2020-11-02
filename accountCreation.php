<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Account Creation Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	<link rel="stylesheet" type="text/css" href="styles/modal.css">
	<link rel="stylesheet" type="text/css" href="styles/accountCreation.css">
</head>
<body>
	<div id="page-header">
		<div id="page-title-container">
			<div id="page-title">
				<h1>Account Creation</h1>
				<p>Enter Information to create an account</p>
			</div>
			<button id="login-modal-window-open" onclick="getElementById('login-modal-window').style.display = 'block';">Click here to login/create an Account</button>
		</div>
		
		<?php include 'pageParts/navbar.php'; ?>

	</div>

	</div>
	<div id="page-body">
		<div id="account-creation-container">
			<form>
				<label for="fname">First Name:
					<input type="text" name="fname" placeholder="John" required>
				</label>
				<label for="lname">Last Name:
					<input type="text" name="lname" placeholder="Smith" required>
				</label>
				<label for="email">Email Address:
					<input type="email" name="email" placeholder="john.smith@email.com" required>
				</label>
				<div id="address-input-container">	
					<label for="address">Mailing Address:
						<input type="text" name="address" placeholder="1234 Real Street" required>
					</label>
					<label for="zip">ZIP/Postal Code:
						<input type="text" name="zip" placeholder="12345" required>
					</label>
					<label for="state">State:
						<select name='state' size='1' autocomplete="off" required>
							<option value="" selected disabled hidden>Select A State</option>
							<option value="AL">AL Alabama</option>
							<option value="AK">AK Alaska</option>
							<option value="AS">AS American Samoa</option>
							<option value="AZ">AZ Arizona</option>
							<option value="AR">AR Arkansas</option>
							<option value="AA">AA Armed Forces Americas</option>
							<option value="AE">AE Armed Forces Europe</option>
							<option value="AP">AP Armed Forces Pacific</option>
							<option value="CA">CA California</option>
							<option value="CO">CO Colorado</option>
							<option value="CT">CT Connecticut</option>
							<option value="DE">DE Delaware</option>
							<option value="DC">DC District of Columbia</option>
							<option value="FM">FM Federated States of Micronesia</option>
							<option value="FL">FL Florida</option>
							<option value="GA">GA Georgia</option>
							<option value="GU">GU Guam</option>
							<option value="HI">HI Hawaii</option>
							<option value="ID">ID Idaho</option>
							<option value="IL">IL Illinois</option>
							<option value="IN">IN Indiana</option>
							<option value="IA">IA Iowa</option>
							<option value="KS">KS Kansas</option>
							<option value="KY">KY Kentucky</option>
							<option value="LA">LA Louisiana</option>
							<option value="ME">ME Maine</option>
							<option value="MH">MH Marshall Islands</option>
							<option value="MD">MD Maryland</option>
							<option value="MA">MA Massachusetts</option>
							<option value="MI">MI Michigan</option>
							<option value="MN">MN Minnesota</option>
							<option value="MS">MS Mississippi</option>
							<option value="MO">MO Missouri</option>
							<option value="MT">MT Montana</option>
							<option value="NE">NE Nebraska</option>
							<option value="NV">NV Nevada</option>
							<option value="NH">NH New Hampshire</option>
							<option value="NJ">NJ New Jersey</option>
							<option value="NM">NM New Mexico</option>
							<option value="NY">NY New York</option>
							<option value="NC">NC North Carolina</option>
							<option value="ND">ND North Dakota</option>
							<option value="MP">MP Northern Mariana Islands</option>
							<option value="OH">OH Ohio</option>
							<option value="OK">OK Oklahoma</option>
							<option value="OR">OR Oregon</option>
							<option value="PW">PW Palau</option>
							<option value="PA">PA Pennsylvania</option>
							<option value="PR">PR Puerto Rico</option>
							<option value="RI">RI Rhode Island</option>
							<option value="SC">SC South Carolina</option>
							<option value="SD">SD South Dakota</option>
							<option value="TN">TN Tennessee</option>
							<option value="TX">TX Texas</option>
							<option value="UT">UT Utah</option>
							<option value="VT">VT Vermont</option>
							<option value="VI">VI Virgin Islands</option>
							<option value="VA">VA Virginia</option>
							<option value="WA">WA Washington</option>
							<option value="WV">WV West Virginia</option>
							<option value="WI">WI Wisconsin</option>
							<option value="WY">WY Wyoming</option>
						</select>
					</label>
				</div>
				<label for="birthdate">Birth Date
					<input type="date" name="birthdate" required>
				</label>
				<button type="submit">Create Account</button>
			</form>
		</div>
	</div>

	<!-- This window exists outside of the main body, should only be seen as a popup window-->
	<?php include 'pageParts/loginModal.php'; ?>
</body>
</html>