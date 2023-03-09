export var varIsConnected = false;

function connexion(mail,mdp){
    var mail = $("#email").val();
    var mdp = $("#password").val();
    $.ajax({
        url:"http://localhost/projetWeb/ProjetWeb/server/Security/connecter/",
        type: "POST",
        xhrFields: {
            withCredentials: true
        },
        data:{
            "mail":mail,
            "mdp":mdp,
        },
        success: function (response) {
            window.location.href = "/client/";
        },
        error: function(response){
            alert("Identifiants Invalides");
        },
    });
}

export function initConnexion() {
    $("#submit").on("click",function(){
        connexion();
    });
}