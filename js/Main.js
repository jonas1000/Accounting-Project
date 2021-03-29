'use strict';

function Main()
{
	var CVReport = document.getElementById("CVIncomeReport");
	var CVReportContext = CVReport.getContext("2d");

	InitHeightInvertedCanvas(CVReportContext, CVReport.height);
	ClearCanvas(CVReportContext, CVReport.width, CVReport.height);
}
