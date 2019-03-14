<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is a Link
//Return false the first key it finds is not a Link
function ME_MultyCheckLinkType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_link($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>