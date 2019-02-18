<?php
require_once("ElementBase.php");

class ME_CElementOption extends ME_CHTMLElementBase
{
	private $sOptElemAttr = "";

	public function __construct()
	{

	}

	public function __destroy()
	{

	}

	public function Destroy()
	{

	}

	public function Render()
	{

	}

	public function AddAttribute($InsAttr = "", $InsValue)
	{
		switch($InsAttr)
		{
			case 0:
			{
				$this->sInputElemAttr .= "accesskey='";
				break;
			}
			case 1:
			{
				$this->sInputElemAttr .= "class='";
				break;
			}
			case 2:
			{
				$this->sInputElemAttr .= "contenteditable='";
				break;
			}
			case 3:
			{
				$this->sInputElemAttr .= "dir='";
				break;
			}
			case 4:
			{
				$this->sInputElemAttr .= "draggable='";
				break;
			}
			case 5:
			{
				$this->sInputElemAttr .= "dropzone='";
				break;
			}
			case 6:
			{
				$this->sInputElemAttr .= "hidden='";
				break;
			}
			case 7:
			{
				$this->sInputElemAttr .= "id='";
				break;
			}
			case 8:
			{
				$this->sInputElemAttr .= "lang='";
				break;
			}
			case 9:
			{
				$this->sInputElemAttr .= "spellcheck='";
				break;
			}
			case 10:
			{
				$this->sInputElemAttr .= "style='";
				break;
			}
			case 11:
			{
				$this->sInputElemAttr .= "tabindex='";
				break;
			}
			case 12:
			{
				$this->sInputElemAttr .= "title='";
				break;
			}
			case 13:
			{
				$this->sInputElemAttr .= "translate='";
				break;
			}
			default:
				$this->AddInputAttr($InsAttr, $InsVal);

		}
	}

	private function AddVisAttr($InsAttr = "", $InsValue = "")
	{

	}
}

class ME_CElementSelect extends ME_CHTMLElementBase
{
	private $sSelElemOpt = "";
	private $sSelElemTitle = "";
	private $sSelElemName ="";

	public function __construct()
	{

	}

	public function __destruct()
	{
		unset($this->sSelElemTitle);
		unset($this->sSelElemName);
		unset($this->sSelElemOpt);
	}

	public function Destroy()
	{
		$this->__destruct();
	}

	public function Render()
	{
		printf("</select>");
	}

	public function SetName($InsName)
	{
		$this->sSelElemName = $InsName;
	}

	public function CreateOption()
	{
		$sSelElemOpt .= "<option " . $InsLabel . " " . (!$InbIsDisabled ?:"disabled") . (!$InbIsSelected ?:"selected");
	}

	public function AddOptionAttr()
	{

	}
}
?>
