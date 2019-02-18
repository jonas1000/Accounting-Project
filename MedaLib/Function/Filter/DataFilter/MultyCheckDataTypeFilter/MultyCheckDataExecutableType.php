<?php
function ME_MultyCheckExecutableType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_executable($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>