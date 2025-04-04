function disableElement(elementId)
{
    $(elementId).css('opacity','0.3');
}
function enableElement(elementId)
{
    $(elementId).css('opacity','1');
}
function changeStatus()
{
    $.ajax(
    {
        url:'/site/tmp',
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