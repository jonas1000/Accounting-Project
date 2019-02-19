<?php 

function HTMLCompanyEditForm(CDBConnManager &$InDBConn) : void
{
    require_once("Output/Retriever/AccessRetriever.php");
    require_once("Output/Retriever/CountyRetriever.php");
    require_once("Output/Retriever/CompanyRetriever.php");
    require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
    require_once("Struct/Element/Function/Select/SelectCountyRowRender.php");

    CompanyGeneralRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

    foreach($InDBConn->GetResult() as $CompRow => $CompData)
    {
        //-------------<PHP-HTML>-------------//
        printf("<div class='Form'>");

        printf("<form method='POST'>");

        printf("<div>");

        //Title
        printf("<div id='FormTitle'>");
        printf("<h3>Edit Company</h3>");
        printf("<br><h4>".$CompData['COMP_DATA_TITLE']."</h4>");
        printf("</div>");

        //Input Row
        printf("<div>");
        printf("<div>");
        printf("<h5>Name</h5>");
        printf("</div>");

        printf("<div>");
        printf("<input name='Name' type='text' placeholder='Company Name' value='".$CompData['COMP_DATA_TITLE']."' required>");
        printf("</div>");
        printf("</div>");

        //Input Row
        printf("<div>");
        printf("<div>");
        printf("<h5>creation date</h5>");
        printf("</div>");

        printf("<div>");
        printf("<input name='Date' type='date' value='".$CompData['COMP_DATA_DATE']."' required>");
        printf("</div>");
        printf("</div>");

        //get rows and render <select> element with data
        printf("<div>");
        printf("<div>");
        printf("<h5>County</h5>");
        printf("</div>");

        printf("<div>");
        RenderCountySelectRowCheck($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show'], $CompData['COU_ID']);
        printf("</div>");
        printf("</div>");

        //get rows and render <select> element with data
        printf("<div>");
        printf("<div>");
        printf("<h5>Access Type</h5>");
        printf("</div>");

        printf("<div>");
        RenderAccessSelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
        printf("</div>");
        printf("</div>");

        printf("</div>");

        //Input Buttons
        printf("<div>");
        printf("<a href='.?MenuIndex=" . $_ENV['MenuIndex']['Company'] . "'><div><p>Cancel</p></div></a>");
        printf("<input type='submit' value='Save' formaction='.?MenuIndex=" . $_GET['MenuIndex'] . "&Module=" . $_GET['Module'] . "&AddPro'>");
        printf("</div>");

        printf("</form>");

        printf("</div>");
    }
}

?>