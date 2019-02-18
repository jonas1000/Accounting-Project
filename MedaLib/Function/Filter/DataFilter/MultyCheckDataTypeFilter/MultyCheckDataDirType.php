<?php
function ME_MultyCheckDirType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_dir($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>