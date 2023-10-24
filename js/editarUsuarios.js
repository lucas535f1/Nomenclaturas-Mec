function contrasena() {
    var checkBox = document.getElementById("cambiar");
    var text = document.getElementById("pwdInput");

    if (checkBox.checked == true) {
        text.style.display = "flex";
        text.value = "mec";
    } else {
        text.style.display = "none";
        text.value = "";
    }
}

function coso(event, a, b, c) {
    event.preventDefault();
    submit(a, b, c)
}

function pwd() {
    console.log(document.getElementById("cambiar").checked)
    if (document.getElementById("cambiar").checked == true) {
        document.getElementById("pwd").value ="";
        document.getElementById("pwd").removeAttribute('required');
        
    } else {
        document.getElementById("pwd").value ="mec";
        document.getElementById("pwd").setAttribute('required','');
    }
    console.log(document.getElementById("pwd").value)
}

// $("#editar").submit(function (e) {
//     e.preventDefault();
//     console.log("entra")
// });