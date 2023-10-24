$("#agregarUnidades").submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "./includes/unidad.inc.php",
        dataType: "json",
        data: {
            numero: $("#numero").val(),
            nombre: $("#nombreUnidad").val(),
            abreviatura: $("#abreviaturaUnidad").val()
        },
        success: function (e) {
            if (e == "Se agrego correctamente") {
                update()
                document.getElementById("agregarUnidades").reset()
            }
            alert(e)
        }
    });
});

$("#agregarOficinas").submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "./includes/oficina.inc.php",
        dataType: "json",
        data: {
            numero: document.getElementById("select").value,
            nombre: $("#nombreOficina").val(),
            abreviatura: $("#abreviaturaOficina ").val()
        },
        success: function (e) {
            if (e == "Se agrego correctamente") {
                update()
                document.getElementById("agregarOficinas").reset()
            }
            alert(e)
        }
    });
});



function update() {
    console.log("entra 1")
    $.ajax({
        type: "post",
        url: "./includes/tableUnidades.inc.php",
        success: function (response) {
            $('#tablaUnidades').html(response);
            $('#unidadesTable').dataTable({
                "pageLength": 100,
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    'excel',
                ]
            });
        }
    });
    $.ajax({
        type: "post",
        url: "./includes/selectUnidades.inc.php",
        success: function (response) {
            $('#select').html(response);
        }
    });
    $.ajax({
        type: "post",
        url: "./includes/tableOficinas.inc.php",
        success: function (response) {
            $('#tablaOficinas').html(response);
            $('#oficinasTable').dataTable({
                "pageLength": 100,
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    'excel',
                ]
            });
        }
    });
    console.log("entra 2")
}

