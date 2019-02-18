<?php
require_once("ElementBase.php");

interface ME_IHTMLInputAttr
{
	public const CONST_INPUT_ATTR_LIST=[
	"autocomplete" => 0,
	"autofocus" => 1,
	"disabled" => 2,
	"form" => 3,
	"list" => 4,
	"name" => 5,
	"readonly" => 6,
	"required" => 7,
	"tabindex" => 8,
	"value" => 9
	];
}

abstract class ME_CHTMLInputElementBase extends ME_CHTMLElement implements ME_IHTMLInputAttr
{
	abstract public function Clear();
}

?>
