<?php

print("<div class='MenuWindow'>");
print("<div class='MainMenu' id='MainMenu'>");
print("<div>");

foreach($_ENV['MenuIndex'] as $Row => $RowData)
{
    if($RowData > -1)
    {
        printf("<a href='.?MenuIndex=%s'>", $RowData);
        print("<div class='MainMenuButton'>");
        printf("<p>%s Overview</p>", $Row);
        print("</div>");
        print("</a>");
    }
}

print("</div>");
print("</div>");

print("<div class='MenuButton' onclick='RenderMenuDisplay()'>");
print("</div>");

print("</div>");

?>
