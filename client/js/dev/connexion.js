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
            setCookie("username", response["username"])
            window.location.href = "/client/?routage=menu";
        },
        error: function(response){
            alert(response.responseText);
        },
    });
}

function setCookie(name, content){
    // Set the cookie expiration date
    let date = new Date();
    date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000)); // Expires in 7 days

    // Set the cookie value
    let cookieValue = content;

    // Create the cookie
    document.cookie = `${name}=${cookieValue};expires=${date.toUTCString()};path=/`;
}

$(document).ready(function() {
    $(document).on("click", "#submit", function() {
        connexion();
    });
});