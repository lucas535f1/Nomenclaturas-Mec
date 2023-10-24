function coso() {

    $.ajax({
        type: "post",
        url: "./includes/explodeId.inc.php",
        dataType: "json",
        data: {
            ue: document.getElementById("selectUE").value
        },
        success: function (ue) {
            $.ajax({
                type: "post",
                url: "./includes/selectOficinas.inc.php",
                data: {
                    ue: ue
                },
                success: function (response) {
                    $('#selectOficina').html(response);
                    actualizarNombreEquipo()
                }
            });
        }
    });
}

function actualizarNombreEquipo() {
    getNombreEquipo(function (response) {
        $('#nombreEquipo').val(response);
    })

}

function getNombreEquipo(callback) {
    $.ajax({
        type: "post",
        url: "./includes/explodeNomenclatura.inc.php",
        data: {
            ue: document.getElementById("selectUE").value
        },
        success: function (ue) {
            $.ajax({
                type: "post",
                url: "./includes/name.inc.php",
                data: {
                    ue: ue,
                    oficina: document.getElementById("selectOficina").value,
                    equipo: document.getElementById("selectEquipo").value
                },
                success: function (response) {
                    if (document.getElementById('selectOficina').getAttribute('oficina') == document.getElementById("selectOficina").value && document.getElementById('selectEquipo').getAttribute('equipo') == document.getElementById("selectEquipo").value) {
                        if (response.slice(0, -3) == document.getElementById('nombreEquipo').getAttribute('nombre').slice(0, -3)) {
                            callback(document.getElementById('nombreEquipo').getAttribute('nombre'))
                        } else {
                            callback(response)
                        }
                    } else {
                        callback(response)
                    }
                }
            });
        }
    });
}


function so() {
    var combo = document.getElementById("selectSO");
    if (combo.options[combo.selectedIndex].text == "Otro") {
        document.getElementById("soText").removeAttribute("style");
    } else {
        document.getElementById("soText").setAttribute("style", "display: none;");
    }
}
function otroSO() {
    document.getElementById('selectSO').options[3].value = document.getElementById("otrosSO").value;
    console.log(document.getElementById("selectSO").value)
}