<?php
function HTMLLogedIn(ME_CLogHandle &$InrLogHandle)
{
	if(isset($_SESSION['Username']))
	{
		//Employee name
		printf("
		<div class='LogedIn'>
			<div>
				<div><h2>Welcome</h2></div>
				<div><h4>%s</h4></div>
			</div>
			<div>
				<a href='.?Logout'><h4>Logout</h4></a>
			</div>
		</div>",
		(!empty($_SESSION['Username']) ? $_SESSION['Username'] : "No Name"));
	}
	else
		$InrLogHandle->AddLogMessage("Session username not declared", __FILE__, __FUNCTION__, __LINE__);
}

function HTMLLoginForm()
{
	print("
	<form method='POST'>
		<div>
			<div id='Title'><h4>Login</h4></div>
			<div><label>Email<input type='email' name='Email' required></label></div>
			<div><label>Password<input type='password' name='Pass' required></label></div>
			<div><input type='submit' value='Login' formaction='.?Login'></div>
		</div>
	</form>");
}
?>