<?php
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

function HTMLLogedIn()
{
	if(isset($_SESSION['Username']))
	{
		printf("<div class='LogedIn'>");
		printf("<div>");

		printf("<div>");
		printf("<h2>Welcome</h2>");
		printf("</div>");

		printf("<div>");
		printf("<h4>" . (!empty($_SESSION['Username']) ? $_SESSION['Username'] : "No Name") . "</h4>");
		printf("</div>");

		printf("</div>");

		printf("<div>");
		printf("<a href='Struct/Module/Session/Logout.php'>");
		printf("<h4>Logout</h4>");
		printf("</a>");
		printf("</div>");

		printf("</div>");
	}
	else
		throw new Exception("Session username not declared");
}

function HTMLLoginForm()
{
	printf("<div class='Login'>");

	printf("<form method='POST'>");
	printf("<div>");

	printf("<div id='Title'>");
	printf("<h4>Login</h4>");
	printf("</div>");

	printf("<div>");
	printf("<div>");
	printf("<h5>Email</h5>");
	printf("</div>");

	printf("<div>");
	printf("<input type='email' name='Email' required>");
	printf("</div>");
	printf("</div>");

	printf("<div>");
	printf("<div>");
	printf("<h5>Password</h5>");
	printf("</div>");

	printf("<div>");
	printf("<input type='password' name='Pass' required>");
	printf("</div>");
	printf("</div>");

	printf("</div>");

	printf("<div>");
	printf("<input type='submit' value='Login' formaction='Process/ProCheck/ProLoginCheck.php'>");
	printf("</div>");

	printf("</form>");

 	printf("</div>");
}

if(isset($_SESSION['LogedIn']))
{
	if(!empty($_SESSION['LogedIn']))
		ProFunctionCallback("HTMLLogedIn", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], $_SERVER['REQUEST_METHOD'], "GET", "Logs");
}
else
	ProFunctionCallback("HTMLLoginForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Guest'], $_SERVER["REQUEST_METHOD"], "GET", "Logs");
?>