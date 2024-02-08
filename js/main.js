// Inicio de la funcion cuando se termina de cargar la pagina
// $(function() { ... })

let configurationDataTable = {
	paging: true,
	pageLength: 8,
	destroy: true,
	deferRender: false,
	bLengthChange: false,
	select: false,
	responsive: true,
    searching: true, 
	language: {
		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"search": "_INPUT_",
		"searchPlaceholder": "Buscar Usuario",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	},
};

let user_id = null;

$(function() {

    let configDataTable = JSON.parse(JSON.stringify(configurationDataTable));

    //console.log(configDataTable);

    configDataTable['dom'] = 'lfrtip';

    configDataTable['order'] = [
        [0, 'desc']
    ];

    configDataTable['ajax'] = {
        url: 'getUsers.php',
        method: 'GET',
        dataSrc: '',
    };

    configDataTable['fnCreatedRow'] = function (row, data, iDataIndex) {
        $(row).attr('id', data['id']);
    };

    configDataTable['columns'] = [
        {
            data: function (data, type, dataToSet) {
                return data['id'];
            }
        },
        {
            data: function(data, type, dataToSet) {
                return data['user_name'];
            }
        },
        {
            data: function (data, type, dataToSet) {
                return data['user_email'];
            }
        },
        {
            data: function(data, type, dataToSet) {
                return data['barrio'];
            }
        },
        {
            data: function(data, type, dataToSet) {
                return data['zona'];
            }
        },
        {
            orderable: false,
            data: function(data, type, dataToSet) {

                let buttonEditar = '<button class="btn btn-black editar" value="'+data['id']+'" data-toggle="modal" data-target="#modal-nuevo-usuario">Editar</button>';
                let buttonEliminar = '<button class="btn btn-danger ml-2 eliminar" value="'+data['id']+'">Eliminar</button>';

                let div = '<div>';
                div += buttonEditar;
                div += buttonEliminar;
                div += '</div>';
                return div;
            }
        }
    ];

    var table = $('#tabla_usuarios').DataTable(configDataTable);

    /* setInterval( function () {
        table.ajax.reload(null, false);
    }, 2000); */


    // Captura de Evento
    $('#zona').on('change', function(e) {
        let zona_id = e.target.value; // option value seleccionado del combo zonas
        fillComboZona(zona_id);
    });

    // Al iniciar la pagina, se debe llenar el combo de barrios con la zona seleccionada por defecto
    let zona_id = $('#zona')[0].value;
    fillComboZona(zona_id);

    // Funcion para Llenar el combo zonas
    function fillComboZona(id, barrio_id = null) {

        let data = {
            zona_id: id
        }

        $.post('getBarrioZona.php', data, function(response) {
            response = JSON.parse(response);
            if(response.success) {
                
                let barrios = response.results;
                let comboBarrios = $('#barrio');
                comboBarrios.empty(); // eliminamos todos los empty del combo de barrios

                for(let i = 0; i < barrios.length; i++) {
                    let barrio = barrios[i];
                    let option = '<option value="'+barrio['id']+'">'+barrio['barrio']+'</option>';
                    comboBarrios.append(option); // agregamos el codigo html del option al combo de barrios
                }

                if(barrio_id) comboBarrios.val(barrio_id);

            } else {
                console.log(response.message);
            }
        })
        .fail(function(error) {
            console.log(error.statusText, error.status);
        });
    }

    $('#form-nuevo-usuario').on('submit', function(e) {
        e.preventDefault();

        let form = $(this).serializeArray();

        // falta validar form

        if(user_id) {
            form.push({
                name: 'user_id',
                value: user_id
            });
        }

        $.post('addNewUser.php', form, function(response) {
            response = JSON.parse(response);
            $('#modal-nuevo-usuario').modal('hide'); // Ocultamos el modal de carga
            //$('#form-nuevo-usario')[0].reset(); // Limpiamos los campos del formulario
            alert(response.message);
            user_id = null;
        })
        .fail(function(error) {
            console.log(error.statusText, error.status);
        });
        
    });

    $(document).on('click', '.editar', function() {
        let id = $(this).val();

        let data = {
            user_id : id
        }

        $.post('getUser.php', data, function(response) {
            response = JSON.parse(response);
            if(response.success) {
                fillModal(response.results[0]);
            } else {
                console.log(response.message);
            }
        })
        .fail(function(error) {
            console.log(error.statusText, error.status);
        });
    });

    function fillModal(userInfo) {
        user_id = userInfo.id;
        $('#user_name').val(userInfo.user_name);
        $('#user_email').val(userInfo.user_email);
        $('#zona').val(userInfo.zona_id);
        fillComboZona(userInfo.zona_id, userInfo.barrio_id);
    }

    $('#modal-nuevo-usuario').on('hidden.bs.modal', function() {
        user_id = null;
    });

    $(document).on('click', '.eliminar', function() {
        let id = $(this).val();
        console.log('Eliminar el usuario con id', id);
    });
});