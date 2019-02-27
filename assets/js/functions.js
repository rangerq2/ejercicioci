$(function(){
    getUsers();
    var table = $('#myTable').DataTable({
        language: {
            processing:     "Procesando...",
            search:         "Buscar:",
            lengthMenu:    "Mostrar _MENU_ registros",
            info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered:   "(filtrado de un total de _MAX_ registros)",
            infoPostFix:    "",
            loadingRecords: "Cargando...",
            zeroRecords:    "No se encontraron resultados",
            emptyTable:     "Ningún dato disponible en esta tabla",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Ultimo"
            },
            aria: {
                sortAscending:  ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    //
    function getUsers(){
        var data = $(this).text();
        $.ajax({
            type: 'ajax',
            url: 'user/getUsers',
            data: data,
            async: false,
            dataType: 'json',
            success: function(data){
                var html = '';
                var i;

                for (i=0; i<data.length; i++){
                    html += '<tr>'+
                                '<td>'+data[i].id+'</td>'+
                                '<td>'+data[i].descripcion+'</td>'+
                                '<td>'+data[i].nombre+'</td>'+
                                '<td>'+data[i].apellido+'</td>'+
                                '<td>'+data[i].email+'</td>'+
                                '<td>'+data[i].telefono+'</td>'+
                                '<td>'+
                                '<a href="javascript:;" class="btn btn-info item-edit mx-2" data="'+data[i].id+'">Edit</a>'+
                                '<a href="javascript:;" class="btn btn-danger item-delete mx-2" data="'+data[i].id+'">Delete</a>'+
                                '</td>'+
                            '</tr>';
                }
                $('#showdata').html(html);
            },
            error: function(){
                console.log('error al procesar');
            }
        });
    }

	//Agregar usuario
	$('#btnAdd').click(function(){
		$('#myModal').modal('show');
		$('#myModal').find('.modal-title').text('Agregar nuevo usuario');
		$('#myForm').attr('action', 'user/addUser');
    });
    
    $('#btnSave').click(function(){
        var url = $('#myForm').attr('action');
        var data = $('#myForm').serialize();
        var error_validador = false;

        var id_perfil = $('select[name=id_perfil]');
        var nombre = $('input[name=nombre]');
        var apellido = $('input[name=apellido]');
        var email = $('input[name=email]');
        var telefono = $('input[name=telefono]');

        if(id_perfil.val()==''){
            id_perfil.parent().parent().addClass('has-error');
            error_validador = false;
        }
        else{
            id_perfil.parent().parent().removeClass('has-error');
            error_validador = true;
        }

        if(nombre.val()==''){
            nombre.addClass('border_error');
            error_validador = false;
        }
        else{
            nombre.removeClass('border_error');
            error_validador = true;
        }
        
        if(apellido.val()==''){
            apellido.addClass('border_error');
            error_validador = false;
        }
        else{
            apellido.removeClass('border_error');
            error_validador = true;
        }
        /**
        if(email.val()==''){
            email.addClass('border_error');
            error_validador = false;
        }
        else{
            email.removeClass('border_error');
            error_validador = true;
        }   
         */
        if(telefono.val()==''){
            telefono.addClass('border_error');
            error_validador = false;
        }
        else{
            telefono.removeClass('border_error');
            error_validador = true;
        } 
        
        if (error_validador == true){
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#myModal').modal('hide');
                        $('#myForm')[0].reset();

                        if(response.type=='add'){
                            var type = 'agregado'
                        }
                        else if(response.type=='update'){
                            var type ="actualizado"
                        }
                        $('.alert-success').html('Usuario '+type+' correctamente.').fadeIn().delay(4000).fadeOut('slow');
                        getUsers();
                    }
                    else{
                        console.log('error');
                    }
                },
                error: function(){
                    alert('No se pudo agregar');
                }
            });            
        }
    });

		//actualizar usuario
	$('#showdata').on('click', '.item-edit', function(){
		var id = $(this).attr('data');
		$('#myModal').modal('show');
		$('#myModal').find('.modal-title').text('Editar Usuario');
		$('#myForm').attr('action', 'user/updateUser');
		$.ajax({
			type: 'ajax',
			method: 'get',
			url: 'user/editUser',
			data: {id: id},
			async: false,
            dataType: 'json',
			success: function(data){
				$('input[name=nombre]').val(data.nombre);
                $('input[name=apellido]').val(data.apellido);
                $('input[name=email]').val(data.email);
                $('input[name=telefono]').val(data.telefono);
                $('select[name=id_perfil').val(data.id_perfil);
				$('input[name=id]').val(data.id);
			},
			error: function(){
                console.log("No se pudo actualizar.")
			}
		});
	});

    //Eliminar usuario 
    $('#showdata').on('click', '.item-delete', function () {
        var id = $(this).attr('data');
        $('#deleteModal').modal('show');
        $('#btnDelete').unbind().click(function () {
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: 'user/deleteUser',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('#deleteModal').modal('hide');
                        $('.alert-success').html('Usuario eliminado correctamente').fadeIn().delay(4000).fadeOut('slow');
                        getUsers();
                    } 
                    else {
                        console.log("error");
                    }
                },
                error: function () {
                    $('.alert-error').html('Error al eliminar').fadeIn().delay(4000).fadeOut('slow');
                }
            });
        });
    });
});