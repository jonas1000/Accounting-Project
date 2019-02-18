<?php

require_once("ElementBase/ElementBase.php");

class ME_CElementForm extends ME_CHTMLLinkElementBase
{
	const CONST_METHOD_LIST = [
		"POST" => 0,
		"GET" => 1,
	];

	private $sFormElem = [];
	private $sFormMethod;
	private $sFormActionUrl;

	public function __construct()
	{

	}

	public function __destruct()
	{
		unset($this->sFormElem, $this->sFormMethod, $this->sFormActionUrl);
	}

	public function Destroy()
	{
		$this->__destruct();
	}

	public function Render()
	{
		printf("<form ".$this->sFormActionUrl." ".$this->sFormMethod.">");
		if(count($this->sFormElem) > 0)
		{
			foreach($this->sFormElem as $InputElem)
			{
				$InputElem->Render();
			}
		}
		printf("</form>");
	}

	public function SetActionUrl($InsUrl)
	{
		$this->sFormActionUrl = "action='".$InsUrl."'";
	}

	public function SetMethod($InsMethodType)
	{
		$this->sFormMethod = "method='";

		switch($InsMethodType)
		{
			case 0:
			{
				$this->sFormMethod .= "POST'";
				break;
			}
			case 1:
			{
				$this->sFormMethod .= "GET'";
				break;
			}
			default:
				printf("Coulnd't get method type");
		}
	}

	public function Clear()
	{
		$this->sFormElem = $this->sFormActionUrl = $this->sFormMethod = "";
	}

	public function Link($InsElem)
	{
		array_push($this->sFormElem, $InsElem);
	}
}

?>
