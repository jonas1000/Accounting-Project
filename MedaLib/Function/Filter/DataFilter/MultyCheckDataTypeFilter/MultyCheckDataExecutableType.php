<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is an Executable
//Return false the first key it finds is not an Executable
function ME_MultyCheckExecutableType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_executable($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>