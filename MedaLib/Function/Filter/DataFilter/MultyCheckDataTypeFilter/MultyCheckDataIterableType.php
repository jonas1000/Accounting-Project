<?php
function ME_MultyCheckIterableType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_iterable($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>