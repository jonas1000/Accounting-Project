<?php
function ME_MultyCheckFileType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_file($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>