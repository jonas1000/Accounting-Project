<?php
function ME_MultyCheckIntType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_int($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>