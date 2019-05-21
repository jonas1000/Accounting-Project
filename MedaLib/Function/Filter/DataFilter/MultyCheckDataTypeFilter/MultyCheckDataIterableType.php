<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Iterable
//Return false the first key it finds is not Iterable
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