document.getElementById("login").addEventListener("submit", () => {
    preventDefault();

    let formData = new FormData(this);
    let xhr = new XMLHttpRequest();

    xhr.open("POST","../../interno/apresentacao/validacao-login.php", true);
    xhr.onload = () => {
        let response = xhr.responseText;
        console.log(response);

        if(IsSuccess){
            window.location.href = "../view/pagina-inicial.html";
        }else{
            alert("Falha ao Efetuar login, tente novamente")
        }
    }

    xhr.send(formData);
})