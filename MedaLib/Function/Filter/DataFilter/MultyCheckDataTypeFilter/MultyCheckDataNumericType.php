<?php
function ME_MultyCheckNumericType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_numeric($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>