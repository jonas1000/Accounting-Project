<?php
function ME_MultyCheckArrayType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_array($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>