<?php

function HTMLGenerateSelectStructure(string &$OutsHTMLGeneretedStructure, string &$InsName, array &$InrStructure, string &$InsGetResult, string $InsId = "", string $InsEventType = "", string $InsJSFunctionCallback = "")
{
    $OutsHTMLGeneretedStructure = "<select name='".$InsName."' ".(empty($InsId) ? "" : ("id='".$InsId."'"))." " .((!empty($InsEventType) && !empty($InsJSFunctionCallback)) ? $InsEventType ."=". $InsJSFunctionCallback : ""). ">";
    foreach($InrStructure as $rStructureComponent)
    {
        if($InsGetResult == $rStructureComponent["NAME"])
            $OutsHTMLGeneretedStructure .= "<option value=".$rStructureComponent["NAME"]." selected>".$rStructureComponent["VALUE"]."</option>";
        else
            $OutsHTMLGeneretedStructure .= "<option value=".$rStructureComponent["NAME"].">".$rStructureComponent["VALUE"]."</option>";
    }
    $OutsHTMLGeneretedStructure .= "</select>";
}

?>