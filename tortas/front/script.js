var urlApi='http://localhost/tortas/api/route.php';

function list(){
    $.ajax({
        url:urlApi+'?option=list',
        type:'json',
        method:'GET',
        success:function(response){
            console.log('success');
            if(response.status==200)
            {
                $('#table_tortas tr').remove();
                $('#table_tortas').append('<tr><th>nombre</th><th>descripcion</th><th>precio</th><th>editar</th><th>borrar</th></tr>'); 
                response.data.forEach(element => {
                    $btnEdit='<button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'+element.id+'">Editar</button>';
                    $btnDelete='<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'+element.id+'">Eliminar</button>';
                    $('#table_tortas').append('<tr><td>'+element.nombre+'</td><td>'+element.descripcion+'</td><td>'+element.precio+'</td><td>'+$btnEdit+'</td><td>'+$btnDelete+'</td></tr>'); 
                });                
            }            
        },
        error:function(response){
            console.log('error de api');
        }
    });
}

function insert(form_data){
    $.ajax({
        url:urlApi+'?option=insert',
        type:'json',
        method:'POST',
        data:form_data,
        success:function(response){
            console.log('success');
            if(response.status==200)
            {
                alert('torta creada');
                list();
            }
        },
        error:function(response){
            console.log('error de api');
        }        
    });
}

$(document).ready(function(){
    list();

    $('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('Crear Tortas');
		$('#apicrudModal').modal('show');    
    });

    $('#api_crud_form').on('submit',function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        insert(form_data);
    })    
});