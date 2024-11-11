const PAUSE=0;
const WORKING=1;
const FINISHED=2;

function createOption()
{
	var option =$('<option>');
	return option;
}
function createSelect()
{
	var select=$('<select>');
	
	var optionOne=createOption();
	var optionTwo=createOption();
	var optionThree=createOption();
	
	
	optionOne.text("On pause");
	optionOne.val("O");
	
	optionTwo.text("Working");
	optionTwo.val("W");
	
	optionThree.text("Finished");
	optionThree.val("F");
	
	select.append(optionOne);
	select.append(optionTwo);
	select.append(optionThree);
	
	
	return select[0];
	
}
function createImage(STATE)
{
	var image=$('<img>');
	var imgPath='';
	
	if(STATE==FINISHED)
		imgPath='../img/finished.svg';
	else if(STATE==PAUSE)
		imgPath='../img/pause.svg';
	else
		imgPath='../img/hui.svg';
	
	
	image.attr('src',imgPath);
	image.attr('width','30px');
	image.attr('height','30px');
	
	return image[0];
}
function createDiv()
{
	var div=$('<div>');
	div.attr('style','display:flex;');
	return div[0];
}
window.onload=function()
{
	var tds=$('[name=on_id]'); //getElementById
	
	for(i=0;i<tds.length;i++)
	{
		var tableElement=tds[i];
		var txt=tableElement.innerText;
		
		var div=createDiv();
		var image=createImage(PAUSE);
		var select=createSelect();
		
		div.append(image);
		div.append(select);
		
		tableElement.innerHTML='';
		tableElement.append(div);
	}
	
}


