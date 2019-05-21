<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is a Object
//Return false the first key it finds is not a Object
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