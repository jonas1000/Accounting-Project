<?php
function ME_MultyCheckResourceType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_resource($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>