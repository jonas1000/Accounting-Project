<?php

require_once("ElementBase/ElementInputBase.php");

class ME_CElementInput extends ME_CHTMLInputElementBase
{
	private $sInputElemTitle = NULL;

	public function __construct()
	{
		parent::__construct();
	}

	public function __destruct()
	{
		$this->Destroy();
		parent::__destruct();
	}

	public function Destroy()
	{
		unset($this->sInputElemTitle);
		parent::Destroy();
	}

	public function Render()
	{
		printf($this->sInputElemTitle."<input " . $this->sElemType . " " . parent::GetRender() . ">");
	}

	public function Clear()
	{
		$this->sInputElemTitle = $this->sElemAttr = "";
	}

	public function AddAttribute($IniAttr, $InsValue = "")
	{
		$sKey = array_search($IniAttr, ME_CElementInput::CONST_INPUT_ATTR_LIST);

		if(!is_bool($sKey))
			$this->AttributeAssigment($sKey, $InsValue);
		else
			parent::AddAttribute($IniAttr,$InsValue);

		unset($sKey);
	}

	public function GetRender()
	{
		return $this->sInputElemTitle."<input " . parent::GetRender() . ">";
	}

	public function SetTitle($InsTitle)
	{
		$this->sInputElemTitle = "<p>".$InsTitle."</p>";
	}

	public function SetButtonType()
	{
		$this->sElemType = "Type=\"button\"";
	}

	public function SetCheckboxType()
	{
		$this->sElemType = "Type=\"checkbox\"";
	}

	public function SetColorType()
	{
		$this->sElemType = "Type=\"color\"";
	}

	public function SetDateType()
	{
		$this->sElemType = "Type=\"date\"";
	}

	public function SetDateTimeType()
	{
		$this->sElemType = "Type=\"datetime\"";
	}

	public function SetEmailType()
	{
		$this->sElemType = "Type=\"email\"";
	}

	public function SetFileType()
	{
		$this->sElemType = "Type=\"file\"";
	}

	public function SetHiddenType()
	{
		$this->sElemType = "Type=\"hidden\"";
	}

	public function SetImageType()
	{
		$this->sElemType = "Type=\"image\"";
	}

	public function SetMonthType()
	{
		$this->sElemType = "Type=\"month\"";
	}

	public function SetNumberType()
	{
		$this->sElemType = "Type=\"number\"";
	}

	public function SetPasswordType()
	{
		$this->sElemType = "Type=\"password\"";
	}

	public function SetRadioType()
	{
		$this->sElemType = "Type=\"radio\"";
	}

	public function SetRangeType()
	{
		$this->sElemType = "Type=\"range\"";
	}

	public function SetResetType()
	{
		$this->sElemType = "Type=\"reset\"";
	}

	public function SetSearchType()
	{
		$this->sElemType = "Type=\"search\"";
	}

	public function SetSubmitType()
	{
		$this->sElemType = "Type=\"submit\"";
	}

	public function SetTelType()
	{
		$this->sElemType = "Type=\"tel\"";
	}

	public function SetTextType()
	{
		$this->sElemType = "Type=\"text\"";
	}

	public function SetTimeType()
	{
		$this->sElemType = "Type=\"time\"";
	}

	public function SetUrlType()
	{
		$this->sElemType = "Type=\"url\"";
	}

	public function SetWeekType()
	{
		$this->sElemType = "Type=\"week\"";
	}
}
?>
