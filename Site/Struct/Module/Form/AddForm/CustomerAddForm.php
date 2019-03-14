<?php
//-------------<FUNCTION>-------------//
function HTMLCustomerAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");

  //-------------<PHP-HTML>-------------//
  print("<div class='Form'>");

  print("<form method='POST'>");
  print("<div>");

  //Title
  print("<div id='FormTitle'>");
  print("<h3>New Customer</h3>");
  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Name</h5>");
  print("</div>");

  print("<div>");
  print("<input type='text' maxlength='64' placeholder='Name' name='Name' required>");
  print("</div>");

  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Surname</h5>");
  print("</div>");

  print("<div>");
  print("<input type='text' maxlength='64' placeholder='Surname' name='Surname' required>");
  print("</div>");

  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Phone number</h5>");
  print("</div>");

  print("<div>");
  print("<input type='tel' maxlength='16' placeholder='cell phone' name='PhoneNumber' required>");
  print("</div>");

  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Stable number</h5>");
  print("</div>");

  print("<div>");
  print("<input type='tel' maxlength='16' placeholder='Stable number(house or bussiness)' name='StableNumber'>");
  print("</div>");

  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Email</h5>");
  print("</div>");

  print("<div>");
  print("<input type='email' maxlength='64' placeholder='customer@email.com' name='Email'>");
  print("</div>");

  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>VAT</h5>");
  print("</div>");

  print("<div>");
  print("<input type='text' maxlength='32' placeholder='GR123456789' name='VAT'>");
  print("</div>");

  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Address</h5>");
  print("</div>");

  print("<div>");
  print("<textarea placeholder='Description' spellcheck='true' rows='5' cols='10' maxlegnth='128' name='Addr'></textarea>");
  print("</div>");

  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Note</h5>");
  print("</div>");

  print("<div>");
  print("<textarea placeholder='Note' spellcheck='true' rows='5' 'cols='10' maxlegnth='256' name='Note'></textarea>");
  print("</div>");

  print("</div>");

  //get rows and render <select> element with data
  print("<div>");

  print("<div>");
  print("<h5>Access</h5>");
  print("</div>");

  print("<div>");
  RenderAccessSelectRow($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
  print("</div>");

  print("</div>");

  print("</div>");

  print("<div>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
  printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Customer']);
  print("</div>");
  print("</form>");

  print("</div>");
}
?>
