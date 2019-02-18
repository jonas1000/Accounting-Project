<?php
interface ME_IHTMLGlobAttr
{
	public const CONST_GLOB_ATTR_LIST=[
	"accesskey" => 0,
	"autocapitalize" => 1,
	"class" => 2,
	"contenteditable" => 3,
	"contextmenu" => 4,
	"data-*" => 5,
	"dir" => 6,
	"draggable" => 7,
	"hidden" => 8,
	"id" => 9,
	"inputmode" => 10,
	"is" => 11,
	"lang" => 12,
	"style" => 13,
	"tabindex" => 14,
	"title" => 15
	];
}

interface ME_IHTMLEventAttr
{
	public const CONST_EVENT_ATTR_LIST =[
	"onabort" => 0,
	"onautocomplete" => 1,
	"onautocompleteerror" => 2,
	"onblur" => 3,
	"oncancel" => 4,
	"oncanplay" => 5,
	"oncanplaythrought" => 6,
	"onchange" => 7,
	"onclick" => 8,
	"onclose" => 9,
	"oncontextmenu" => 10,
	"oncuechange" => 11,
	"ondblclick" => 12,
	"ondrag" => 13,
	"ondragend" => 14,
	"ondragenter" => 15,
	"ondragexit" => 16,
	"ondragleave" => 17,
	"ondragover" => 18,
	"ondragstart" => 19,
	"ondrop" => 20,
	"ondurationchange" => 21,
	"onemptied" => 22,
	"onended" => 23,
	"onerror" => 24,
	"onfocus" => 25,
	"oninput" => 26,
	"oninvalid" => 27,
	"onkeydown" => 28,
	"onkeypress" => 29,
	"onkeyup" => 30,
	"onload" => 31,
	"onloadeddata" => 32,
	"onloadedmetadata" => 33,
	"onloadstart" => 34,
	"onmousedown" => 35,
	"onmouseenter" => 36,
	"onmouseleave" => 37,
	"onmousemove" => 38,
	"onmouseout" => 39,
	"onmouseover" => 40,
	"onmouseup" => 41,
	"onmousewheel" => 42,
	"onpause" => 43,
	"onplay" => 44,
	"onplaying" => 45,
	"onprogress" => 46,
	"onratechange" => 47,
	"onreset" => 48,
	"onresize" => 49,
	"onscroll" => 50,
	"onseeked" => 51,
	"onseeking" => 52,
	"onselect" => 53,
	"onshow" => 54,
	"onsort" => 55,
	"onstalled" => 56,
	"onsubmit" => 57,
	"onsuspend" => 58,
	"ontimepause" => 59,
	"ontoggle" => 60,
	"onvolumechange" => 61,
	"onwaiting" => 62
	];
}

abstract class ME_CHTMLElementBase implements ME_IHTMLGlobAttr
{
	abstract public function Destroy();
	abstract public function Render();
	abstract public function AddAttribute($IniAttr, $InsValue = "");

}

abstract class ME_CHTMLLinkElementBase implements ME_IHTMLGlobAttr
{
	abstract public function Destroy();
	abstract public function Render();
	abstract public function Link($InElement);
	//abstract public function AddAttribute($InAttr, $InValue = "");
}

class ME_CHTMLElement extends ME_CHTMLElementBase implements ME_IHTMLEventAttr
{
	private static $iNumElements = NULL;
	protected $sElemAttr = NULL;
	protected $sElemType = NULL;

	protected function AttributeAssigment($InsAttr, $InsValue)
	{
		if(is_string($InValue))
			$this->sElemAttr .= $InsAttr."=\"".$InsValue."\"";
		else
			throw new Exception("Attribute value is not a string");
	}

	public function __construct()
	{
		ME_CHTMLElement::$iNumElements++;
	}

	public function __destruct()
	{
		ME_CHTMLElement::$iNumElements--;
		$this->Destroy();
	}

	public function Destroy()
	{
		unset($this->sElemAttr);
	}

	public function Render()
	{
		return $this->sElemAttr;
	}

	public function GetRender()
	{
		return $this->sElemAttr;
	}

	public function AddAttribute($IniAttr, $InsValue = "")
	{
		$sKey = array_search($IniAttr, ME_CHTMLElement::CONST_GLOB_ATTR_LIST);

		if(!is_bool($sKey))
			$this->AttributeAssigment($sKey, $InsValue);
		else
		{
			$sKey = array_search($IniAttr, ME_CHTMLElement::CONST_EVENT_ATTR_LIST);

			if(!is_bool($sKey))
				$this->AttributeAssigment($sKey, $IniValue);
			else
				throw new Exception("Array is not of the constant arrays of the class");
		}

		unset($sKey);
	}

	public static function GetNumObjects()
	{
		return ME_CHTMLElement::$iNumElements;
	}
}

?>
