<?php
require_once("Output/Retriever/AccessRetriever.php");
require_once("Output/Retriever/CountryRetriever.php");
require_once("Output/Retriever/CountyRetriever.php");
require_once("Output/Retriever/CompanyRetriever.php");
require_once("Output/Retriever/EmployeeRetriever.php");

//-------------<FUNCTIONS>-------------//

//Render element <select> with the Access array result from query
function RenderAccessSelectRow()
{
	$AccessRows = AccessFormRetriever();

	printf("<p>Access Level</p><select name='Access'>");

	foreach($AccessRows as $AccessRow => $AccessData)
	{

		printf("<option value='". $AccessData['ACCESS_ID'] ."'>". $AccessData['ACCESS_Title'] ."</option>");

	}
	printf("</select>");

	unset($AccessRows);
}

//Render element <select> with the Country array result from query
function RenderCountrySelectRow()
{
	$CountryRows = CountryFormRetriever();

	printf("<p>Country</p><select name='Country'>");

	foreach($CountryRows as $CountryRow => $CountryData)
	{

		printf("<option value='". $CountryData['COU_ID'] ."'>". $CountryData['COU_Title'] ."</option>");

	}
	printf("</select>");

	unset($CountryRows);
}

//Render element <select> with the County array result from query
function RenderCountySelectRow()
{
	$CountyRows = CountyFormRetriever();

	printf("<p>County</p><select name='Country'>");

	foreach($CountyRows as $CountyRow => $CountyData)
	{

		printf("<option value='". $CountyData['COU_ID'] ."'>". $CountyData['COU_Title'] ."</option>");

	}
	printf("</select>");

	unset($CountyRows);
}

//Render element <select> with the Company array result from query
function RenderCompanySelectRow()
{
	$CompRows = CompanyFormRetriever();

	printf("<p>Company</p><select name='Company'>");

	foreach($CompRows as $CompRow => $CompData)
	{

		printf("<option value='". $CompData['COMP_ID'] ."'>". $CompData['COMP_Title'] ."</option>");

	}
	printf("</select>");

	unset($CompRows);
}

//Render element <select> with the Employee array result from query
function RenderEmployeeSelectRow()
{
	$EmpRows = EmployeeFormRetriever();

	printf("<p>Employee</p><select name='Employee'>");

	foreach($EmpRows as $EmpRow => $EmpData)
	{

		printf("<option value='". $EmpData['EMP_ID'] ."'>". $EmpData['EMP_Name'] ."</option>");

	}
	printf("</select>");

	unset($EmpRows);
}

//Render element <select> with the Employee Position array result from query
function RenderEmployeePosSelectRow()
{
	$EmpPosRows = EmployeePosFormRetriever();

	printf("<p>Position</p><select name='Position'>");

	foreach($EmpPosRows as $EmpPosRow => $EmpPosData)
	{

		printf("<option value='". $EmpPosData['EMP_ID'] ."'>". $EmpPosData['EMP_Title'] ."</option>");

	}
	printf("</select>");

	unset($EmpPosRows);
}
?>
