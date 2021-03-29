<?php
$APP_VERSION_MAJOR = 0;
$APP_VERSION_MIDDLE = 2;
$APP_VERSION_MINOR = 6;
$APP_PATCH = 5;

$CONN_ENCODING = "utf8";

$DEBUG = TRUE;

$DEFAULT_LOG_FILE="Log.txt";

$DEFAULT_LOG_PATH="Logs";

$CURRENCY = "EURO";

$CURRENCY_SYMBOL = "&#x20AC";

$CURRENCY_DECIMAL_PRECISION = 2;

$AVAILABLE = 
[
    'Hide' => 1,
    'Show' => 2
];

$ACCESS = 
[
    'Admin' => 1,
    'CEO' => 2,
    'Employee' => 3,
    'Guest' => 4
];

$MENU_INDEX = 
[
    'AccessError' => -1,
    'Company' => 0,
    'Country' => 1,
    'Employee' => 2,
    'EmployeePosition' => 3,
    'Job' => 4,
    'Shareholder' => 5,
    'Customer' => 6,
    'County' => 7
];

$MODULE = 
[
    'Add' => 0,
    'Edit' => 1,
    'Delete' => 2,
    'Extend' => 3
];

//The index contains the name value that will appear in the HTML selector document
$COMPANY_SEARCH_TYPE = 
[
    "Company_Title" => ["name" => "Company", "value" => "Company"],
    "Country_Title" => ["name" => "Country", "value" => "Country"],
    "County_Title" => ["name" => "County", "value" => "County"],
    "Company_Date" => ["name" => "Date", "value" => "Date"],
    "County_Tax" => ["name" => "Tax", "value" => "Tax"],
    "County_IR" => ["name" => "Interest", "value" => "Interest Rate"]
];

$COUNTRY_SEARCH_TYPE = 
[
    "Country_Title" => ["name" => "Country", "value" => "Country"]
];

$COUNTY_SEARCH_TYPE = 
[
    "County_Title" => ["name" => "Country", "value" => "County"],
    "County_Tax" => ["name" => "Tax", "value" => "Tax"],
    "County_IR" => ["name" => "Interest", "value" => "Interest Rate"]
];

$CUSTOMER_SEARCH_TYPE = 
[
    "Customer_Name" => ["name" => "Name", "value" => "Name"],
    "Customer_Surname" => ["name" => "Surname", "value" => "Surname"],
    "Customer_Phone" => ["name" => "Phone", "value" => "Phone Number"],
    "Customer_Stable" => ["name" => "Stable", "value" => "Stable Number"],
    "Customer_Email" => ["name" => "Email", "value" => "Email"],
    "Customer_VAT" => ["name" => "VAT", "value" => "VAT"]
];

$EMPLOYEE_SEARCH_TYPE = 
[
    "Employee_Name" => ["name" => "Name", "value" => "Name"],
    "Employee_Surname" => ["name" => "Surname", "value" => "Surname"],
    "Employee_Email" => ["name" => "Email", "value" => "Email"],
    "Employee_BirthDay" => ["name" => "BirthDate", "value" => "Birth Date"],
    "Employee_Phone" => ["name" => "Phone", "value" => "Phone Number"],
    "Employee_Stable" => ["name" => "Stable", "value" => "Stable Number"],
    "Employee_Title" => ["name" => "Title", "value" => "Title"],
    "Employee_Salary" => ["name" => "Salary", "value" => "Salary"]
];

$EMPLOYEE_POSITION_SEARCH_TYPE = 
[
    "Employee_Position_Title" => ["name" => "Title", "value" => "Title"]
];

$JOB_ASSIGMENT_SEARCH_TYPE = [];

$JOB_SEARCH_TYPE = 
[
    "Job_Title" => ["name" => "Title", "value" => "Title"],
    "Job_Date" => ["name" => "Date", "value" => "Date"],
    "Job_Price" => ["name" => "Price", "value" => "Price"],
    "Job_PIA" => ["name" => "PIA", "value" => "Payment In Advance"],
    "Job_Expenses" => ["name" => "Expenses", "value" => "Expenses"],
    "Job_Damage" => ["name" => "Damage", "value" => "Damage"],
    "Job_CompTitle" => ["name" => "CompanyTitle", "value" => "Company Name"]
];

$SHAREHOLDER_SEARCH_TYPE = 
[
    "Shareholder_Name" => ["name" => "Name", "value" => "Name"],
    "Shareholder_Surname" => ["name" => "Surname", "value" => "Surname"],
    "Shareholder_Email" => ["name" => "Email", "value" => "Email"],
    "Shareholder_BDay" => ["name" => "Date", "value" => "Birth day Date"],
    "Shareholder_PosTitle" => ["name" => "PositionTitle", "value" => "Position Title"],
    "Shareholder_Salary" => ["name" => "Salary", "value" => "Salary"]
];

$AVAILABLE_ARRAY_SIZE = count($GLOBALS['AVAILABLE']);

$ACCESS_ARRAY_SIZE = count($GLOBALS['ACCESS']);

$MENU_INDEX_ARRAY_SIZE = count($GLOBALS['ACCESS']);
?>
