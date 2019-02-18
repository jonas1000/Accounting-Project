<?php
function ME_MultyCheckFiniteType(float ...$InfaVar) : bool
{
  $iArrayLenght = count($InfaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_finite($InfaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>