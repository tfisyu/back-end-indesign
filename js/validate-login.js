const formulario = document.querySelector('#login-container');

formulario.onsubmit = evento => {
    var mail = document.querySelector("#e-mail").value;
    if (mail === "") {
        evento.preventDefault();
        document.querySelector(".aviso-e").innerHTML = "<span style='color: #f00;'>Preencha o campo email</span>";
        document.querySelector('#e-mail').style.outlineColor = '#f00';
        return;
    }

    // Receber o valor do campo
    var senha = document.querySelector("#pswd").value;
    // Verificar se o campo esta vazio
    if (senha === "") {
        evento.preventDefault();
        document.querySelector(".aviso-s").innerHTML = "<span style='color: #f00;'>Preencha a senha</span>";
        document.querySelector('#pswd').style.outlineColor = '#f00';
        return;
    }
}