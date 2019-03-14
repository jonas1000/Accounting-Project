<?php
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

function HTMLLogedIn()
{
	if(isset($_SESSION['Username']))
	{
		print("<div class='LogedIn'>");
		print("<div>");

		print("<div>");
		print("<h2>Welcome</h2>");
		print("</div>");

		print("<div>");
		printf("<h4>%s</h4>", (!empty($_SESSION['Username']) ? $_SESSION['Username'] : "No Name"));
		print("</div>");

		print("</div>");

		print("<div>");
		print("<a href='Struct/Module/Session/Logout.php'>");
		print("<h4>Logout</h4>");
		print("</a>");
		print("</div>");

		print("</div>");
	}
	else
		throw new Exception("Session username not declared");
}

function HTMLLoginForm()
{
	print("<div class='Login'>");

	print("<form method='POST'>");
	print("<div>");

	print("<div id='Title'>");
	print("<h4>Login</h4>");
	print("</div>");

	print("<div>");
	print("<div>");
	print("<h5>Email</h5>");
	print("</div>");

	print("<div>");
	print("<input type='email' name='Email' required>");
	print("</div>");
	print("</div>");

	print("<div>");
	print("<div>");
	print("<h5>Password</h5>");
	print("</div>");

	print("<div>");
	print("<input type='password' name='Pass' required>");
	print("</div>");
	print("</div>");

	print("</div>");

	print("<div>");
	print("<input type='submit' value='Login' formaction='Process/ProCheck/ProLoginCheck.php'>");
	print("</div>");

	print("</form>");

 	print("</div>");
}

if(isset($_SESSION['LogedIn']))
{
	if($_SESSION['LogedIn'])
		ProFunctionCallback("HTMLLogedIn", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], $_SERVER['REQUEST_METHOD'], "GET", "Logs");
}
else
	ProFunctionCallback("HTMLLoginForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Guest'], $_SERVER["REQUEST_METHOD"], "GET", "Logs");
?>