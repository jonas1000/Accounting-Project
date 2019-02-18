<?php
function ME_MultyCheckCountableType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_countable($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>