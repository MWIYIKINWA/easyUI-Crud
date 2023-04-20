

// function searchByDate(){
//     $('#dg').datagrid('load',{
//         fromdate: $('#fromdate').val(),
//         todate: $('#todate').val()
//     });
//     $('#dg').datagrid('reload');
// }


function doSearch(){
    $('#dg').datagrid('load',{
        textSearch : $('#textSearch').val()
    });
    $('#dg').datagrid('reload');
}


var url;
        function newItem(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Item Register');
            $('#fm').form('clear');
            url = 'include/new_item.php';
        }
        function editItem(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit Item ');
                $('#fm').form('load',row);
                url = 'include/edit_item.php?id='+row.id;
            }
        }
        function saveItem(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(response){
                    var respData = $.parseJSON(response);
                    if (respData.status == 0){
                        $.messager.show({
                            title: 'Error',
                            msg: respData.msg
                        });
                    } else {
                        $('#dlg').dialog('close');        
                        $('#dg').datagrid('reload');   
                    }
                }
            });
        }
        function destroyItem(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to delete this item?',function(r){
                    if (r){
                        $.post('include/delete_item.php',{id:row.id},function(response){
                            if (response.status == 1){
                                $('#dg').datagrid('reload');   
                            } else {
                                $.messager.show({    
                                    title: 'Error',
                                    msg: respData.msg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
   



  //print
        