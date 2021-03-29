<?php
function SearchQueryConstructor(string &$InsSearchQuery) : void
{
	$TempString = $InsSearchQuery;

	$InsSearchQuery = "%" . $TempString . "%";
}
?>