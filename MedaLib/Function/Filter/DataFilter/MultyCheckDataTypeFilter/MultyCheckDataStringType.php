<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is a String
//Return false the first key it finds is not a String
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