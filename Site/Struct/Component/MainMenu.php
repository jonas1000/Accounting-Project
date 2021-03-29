
<div class='MenuWindow'><div class='MainMenu' id='MainMenu'>
    <div>

    <?php
    foreach($GLOBALS['MENU_INDEX'] as $Row => $RowData)
    {
        if($RowData > -1)
            printf("<a href='.?MenuIndex=%s'><div class='MainMenuButton'><p>%s Overview</p></div></a>", $RowData, $Row);
    }
    ?>

    </div>
</div>

    <div class='MenuButton' onclick='RenderMenuDisplay()'>
    </div>
</div>
