<?php
//-------------<FUNCTION>-------------//
function HTMLCustomerAddForm(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");

  //-------------<PHP-HTML>-------------//
  printf("<div class='Form'>");

  printf("<form method='POST'>");
  printf("<div>");

  //Title
  printf("<div id='FormTitle'>");
  printf("<h3>New Customer</h3>");
  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>Name</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='text' maxlength='64' placeholder='Name' name='Name' required>");
  printf("</div>");

  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>Surname</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='text' maxlength='64' placeholder='Surname' name='Surname' required>");
  printf("</div>");

  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>Phone number</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='tel' maxlength='16' placeholder='cell phone' name='PhoneNumber' required>");
  printf("</div>");

  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>Stable number</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='tel' maxlength='16' placeholder='Stable number(house or bussiness)' name='StableNumber'>");
  printf("</div>");

  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>Email</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='email' maxlength='64' placeholder='customer@email.com' name='Email'>");
  printf("</div>");

  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>VAT</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='text' maxlength='32' placeholder='GR123456789' name='VAT'>");
  printf("</div>");

  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>Address</h5>");
  printf("</div>");

  printf("<div>");
  printf("<textarea placeholder='Description' spellcheck='true' rows='5' cols='10' maxlegnth='128' name='Addr'></textarea>");
  printf("</div>");

  printf("</div>");

  //Input Row
  printf("<div>");

  printf("<div>");
  printf("<h5>Note</h5>");
  printf("</div>");

  printf("<div>");
  printf("<textarea placeholder='Note' spellcheck='true' rows='5' 'cols='10' maxlegnth='256' name='Note'></textarea>");
  printf("</div>");

  printf("</div>");

  //get rows and render <select> element with data
  printf("<div>");

  printf("<div>");
  printf("<h5>Access</h5>");
  printf("</div>");

  printf("<div>");
  RenderAccessSelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
  printf("</div>");

  printf("</div>");

  printf("</div>");

  printf("<div>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&AddPro'>");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Customer']."'><div class='Button-Left'><p>Cancel</p></div></a>");
  printf("</div>");
  printf("</form>");

  printf("</div>");
}
?>
