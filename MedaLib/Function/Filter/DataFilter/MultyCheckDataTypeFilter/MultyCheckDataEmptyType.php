<?php
function ME_MultyCheckEmptyType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(empty($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>