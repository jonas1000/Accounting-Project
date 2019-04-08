<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Empty
//Return false the first key it finds it is not Empty
function ME_MultyCheckEmptyType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(empty($InaVar[$I]))
      return TRUE;
  }

  return FALSE;
}
?>