<?php
function ME_MultyCheckWritableType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_writable($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>