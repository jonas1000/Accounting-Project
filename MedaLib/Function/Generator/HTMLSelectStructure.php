<?php

function HTMLGenerateSelectStructure(string &$OutsHTMLGeneretedStructure, string &$InsName, array &$InrStructure, string &$InsGetResult)
{
    $OutsHTMLGeneretedStructure = "<select name='".$InsName."'>";
    foreach($InrStructure as $rStructureComponent)
    {
        if($InsGetResult == $rStructureComponent["name"])
            $OutsHTMLGeneretedStructure .= "<option value=".$rStructureComponent["name"]." selected>".$rStructureComponent["value"]."</option>";
        else
            $OutsHTMLGeneretedStructure .= "<option value=".$rStructureComponent["name"].">".$rStructureComponent["value"]."</option>";
    }
    $OutsHTMLGeneretedStructure .= "</select>";
}

?>