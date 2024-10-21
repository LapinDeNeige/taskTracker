function createSelect()
{
	var select=$('<select>');
	
	var optionOne=$('<option>');
	var optionTwo=$('<option>');
	
	optionOne.text="On pause";
	optionTwo.text="Working";
	
	select.append(optionOne);
	select.append(optionTwo);
	
	
	return select[0];
	
}


window.onload=function()
{
	var tds=$('[name=on_id]'); //getElementById
	
	for(i=0;i<tds.length;i++)
	{
		var td=tds[i];
		var txt=td.innerText;
		var select=createSelect();
		td.append(select);
	}
	
	alert();
}


function addSelectToTable()
{
	//var select=createSelect();
	
	
	//var body=$("body");
	//body.append(select);
	
	alert();
}