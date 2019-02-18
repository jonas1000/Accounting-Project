<?php
function ME_MultyCheckCallableType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_callable($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>