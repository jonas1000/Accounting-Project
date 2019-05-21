'use strict';

function RenderMenuDisplay()
{
	var MainMenu = document.getElementById('MainMenu');

	if(MainMenu.style.display === 'block')
		MainMenu.style.display = 'none';
	else
		MainMenu.style.display = 'block';

	MainMenu = undefined;
}
