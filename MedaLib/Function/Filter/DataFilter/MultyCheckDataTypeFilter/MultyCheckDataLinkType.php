<?php
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