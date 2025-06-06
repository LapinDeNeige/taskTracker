function disableElement(elementId)
{
    $(elementId).prop('disabled',true);
    $(elementId).css('opacity','0.3');
}
function enableElement(elementId)
{
    $(elementId).prop('disabled',false);
    $(elementId).css('opacity','1');
}
/*
function changeStatus()
{
    $.ajax(
    {
        url:'',
        method:'post',
        data:{status:'status'},
        success:()=>{
            alert('Status changed');
        },
        error:(data)=>{
            alert(`Error send ${data.statusText}`);
        }
        
    }
    );
    
}
*/