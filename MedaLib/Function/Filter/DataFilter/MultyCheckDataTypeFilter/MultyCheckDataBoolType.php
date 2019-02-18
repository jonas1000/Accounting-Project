<?php
function ME_MultyCheckBoolType(...$InVar) : bool
{
  $iArrayLenght = count($InVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_bool($InVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>