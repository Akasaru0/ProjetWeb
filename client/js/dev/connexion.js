function connexion(mail,mdp){
    var mail = $("#email").val();
    var mdp = $("#password").val();
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Security/connecter/",
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

$(document).ready(function() {
    $(document).on("click", "#submit", function() {
        connexion();
      });
    });