<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is a Bool
//Return false the first key it finds is not a Bool
function ME_MultyCheckBoolType(...$InVar) : bool
{
  $iArrayLenght = count($InVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_bool($InVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>