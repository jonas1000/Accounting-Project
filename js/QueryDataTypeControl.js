"use strict";

function CompanyQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");

    switch(QueryTypeElement.value)
    {
        case "Company":
        case "Country":
        case "County":
            document.getElementById("QueryInput").type = "text";
            break;
        case "Date":
            document.getElementById("QueryInput").type = "date";
            break;
        case "Tax":
        case "Interest":
            document.getElementById("QueryInput").type = "number";
            break;
    }
}

function CountryQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");

    switch(QueryTypeElement.value)
    {
        case "Country":
            document.getElementById("QueryInput").type = "text";
            break;
    }
}

function EmployeeQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");

    switch(QueryTypeElement.value)
    {
        case "Name":
        case "Surname":
            document.getElementById("QueryInput").type = "text";
            break;
        case "Phone":
        case "Stable":
            document.getElementById("QueryInput").type = "tel";
            break;
        case "Email":
            document.getElementById("QueryInput").type = "email";
            break;
        case "VAT":
            document.getElementById("QueryInput").type = "number";
            break;
    }
}