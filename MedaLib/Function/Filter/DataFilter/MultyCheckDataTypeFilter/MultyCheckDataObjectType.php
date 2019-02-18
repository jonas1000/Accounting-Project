<?php
function ME_MultyCheckObjectType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_object($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>