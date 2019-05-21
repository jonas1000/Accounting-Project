<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Integer
//Return false the first key it finds is not Integer
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