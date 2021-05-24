"use strict";

function CompQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Company":
            case "Country":
            case "County":
                QueryInputElement.type = "text";
                break;

            case "Date":
                QueryInputElement.type = "date";
                break;

            case "Tax":
            case "Interest":
                QueryInputElement.type = "number";
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}

function CounQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Country":
                QueryInputElement.type = "text";
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}

function CouQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Country":
                QueryInputElement.type = "text";
                break;

            case "Tax":
            case "Interest":
                QueryInputElement.type = "number";
                break;

            default:
                QueryInputElement.type = "text";
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}

function EmpQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Name":
            case "Surname":
            case "VAT":
                QueryInputElement.type = "text";
                break;

            case "Phone":
            case "Stable":
                QueryInputElement.type = "tel";
                break;

            case "Email":
                QueryInputElement.type = "email";
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}

function EmpPosQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Title":
                QueryInputElement.type = "text";
                break;

            default:
                QueryInputElement.type = "text"
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}

function CustQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Name":
            case "Surname":
            case "VAT":
                QueryInputElement.type = "text";
                break;

            case "Phone":
            case "Stable":
                QueryInputElement.type = "tel";
                break;

            case "Email":
                QueryInputElement.type = "email";
                break;

            default:
                QueryInputElement.type = "text"
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}

function ShareQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Name":
            case "Surname":
                QueryInputElement.type = "text";
                break;

            case "Email":
                QueryInputElement.type = "email";
                break;

            case "Date":
                QueryInputElement.type = "date";
                break;

            case "Salary":
                QueryInputElement.type = "number"
                break;

            default:
                QueryInputElement.type = "text"
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}

function JobQueryDataType()
{
    var QueryTypeElement = document.getElementById("QueryDataType");
    var QueryInputElement = document.getElementById("QueryInput");

    if(QueryTypeElement || QueryInputElement)
    {
        switch(QueryTypeElement.value)
        {
            case "Title":
            case "CompanyTitle":
                QueryInputElement.type = "text";
                break;

            case "Date":
                QueryInputElement.type = "date";
                break;

            case "Price":
            case "PIA":
            case "Expenses":
            case "Damage":
                QueryInputElement.type = "number"
                break;

            default:
                QueryInputElement.type = "text"
                break;
        }
    }
    else
        console.error("failed to retrieve ids");
}