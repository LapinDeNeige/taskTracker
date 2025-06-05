function openLoginModal()
{
	$('#modal-login').modal('show');
}
function openSignupModal()
{
	$('#modal-signup').modal('show');
	
}
function openAddModal()
{
	$('#modal-add-task').modal('show');
}

function openDeleteTaskModal(taskNumber)
{
	$('#modal-delete-task').modal('show');
	$('#hidden-delete').val(taskNumber); //setting hidden value of task number of task to delete 
	
}
function closeDeleteTaskModal()
{
	$('#modal-delete-task').modal('hide');
}
function openEditModal(taskNumber)
{
	$('#modal-edit').modal('show');
	$('#hidden-edit').val(taskNumber);

	/**ADDING DATA TO MODAL WINDOW */
	var chds=$(taskNumber).children();
	var len=chds.length;
	/*
	for(i=0;i<len;i++)
		alert(vars[i]);
	*/
}