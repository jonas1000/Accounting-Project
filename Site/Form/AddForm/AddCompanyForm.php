<?php
require_once("../../Data/HeaderData/HeaderData.php");
require_once("../../Data/ConnData/DBSessionToken.php");

session_start();

require_once("../../DBConnManager.php");
require_once("../../Output/Retriever/AccessRetriever.php");
require_once("../../Output/Retriever/CountryRetriever.php");
require_once("../../Output/Retriever/CountyRetriever.php");
require_once("../../Element/Form.php");
require_once("../../Element/Input.php");


printf("<!DOCTYPE html>");
printf("<html>");

printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Home</title>");
printf("</head>");

printf("<body>");

//printf("<form action='../../Input/Parser/AddParser/AddCompanyParser.php' method='POST'>");

//printf("<p>Name</p><input name='Name' type='text' placeholder='Studio Name'>");
$AddCompForm = new ElementForm();
$AddCompForm->SetMethod(ElementForm::CONST_METHOD_LIST['POST']);
$AddCompForm->SetActionUrl("../../Input/Parser/addParder/AddCompanuParser.php");

$InputCompName = new ElementInput();
$InputCompName->SetTitle("Name");
$InputCompName->AddAttribute(ElementInput::CONST_INPUT_ATTR_LIST['type'], "text");
$InputCompName->AddAttribute(ElementInput::CONST_INPUT_ATTR_LIST['name'], "Name");
$InputCompName->AddAttribute(ElementInput::CONST_GLOB_ATTR_LIST['id'] , "CompNameFormID");
$InputCompName->AddAttribute(ElementInput::CONST_INPUT_ATTR_LIST['placeholder'] , "Studio Name");

$AddCompForm->Link($InputCompName);

$InputCompCDate = new ElementInput();
$InputCompCDate->SetTitle("Creation Date");
$InputCompCDate->AddAttribute(ElementInput::CONST_INPUT_ATTR_LIST['type'], "date");
$InputCompCDate->AddAttribute(ElementInput::CONST_INPUT_ATTR_LIST['name'] ,"Date");

$AddCompForm->Link($InputCompCDate);

$InputSubmit = new ElementInput();
$InputSubmit->AddAttribute(ElementInput::CONST_INPUT_ATTR_LIST['type'], "submit");
$InputSubmit->AddAttribute(ElementInput::CONST_INPUT_ATTR_LIST['value'], "submit");

$AddCompForm->Link($InputSubmit);

$AddCompForm->Render();

$AddCompForm->Clear();

$InputCompName->Destroy();
$InputCompCDate->Destroy();

unset($InputCompName);
unset($InputCompCDate);
unset($InputSubmit);
unset($AddCompForm);



//printf("<p>creation date</p><input name='Date' type='date'>");

//DisplayAccessSelectRow();

//DisplayCountySelectRow();

//DisplayCountrySelectRow();

//printf("<input type='submit' value='add'>");

//printf("</form>");

printf("</body>");

printf("</html>");


function DisplayAccessSelectRow()
{
	$AccessRows = AccessFormRetriever();

	printf("<p>Access Level</p><select name='Access'>");

	foreach($AccessRows as $AccessRow => $AccessData)
	{

		printf("<option value='". $AccessData['ACCESS_ID'] ."'>". $AccessData['ACCESS_Title'] ."</option>");

	}
	printf("</select><br>");

	$AccessRows = null;
}

function DisplayCountrySelectRow()
{
	$CountryRows = CountryFormRetriever();

	printf("<p>Country</p><select name='Country'>");

	foreach($CountryRows as $CountryRow => $CountryData)
	{

		printf("<option value='". $CountryData['COU_ID'] ."'>". $CountryData['COU_Title'] ."</option>");

	}
	printf("</select><br>");

	$CountryRows = null;
}

function DisplayCountySelectRow()
{
	$CountyRows = CountyFormRetriever();

	printf("<p>County</p><select name='Country'>");

	foreach($CountyRows as $CountyRow => $CountyData)
	{

		printf("<option value='". $CountyData['COU_ID'] ."'>". $CountyData['COU_Title'] ."</option>");

	}
	printf("</select><br>");

	$CountyRows = null;
}
?>
