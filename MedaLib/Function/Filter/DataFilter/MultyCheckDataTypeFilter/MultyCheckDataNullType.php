<?php
function ME_MultyCheckNullType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_null($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>