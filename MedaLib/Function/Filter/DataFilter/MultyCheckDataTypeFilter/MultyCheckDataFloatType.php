<?php
function ME_MultyCheckFloatType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_float($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>