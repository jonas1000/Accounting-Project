<?php
function ME_MultyCheckReadableType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_readable($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>