<?php
function ME_MultyCheckStringType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_string($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>