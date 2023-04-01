function sendForm(){
    let email = $("#email").val();
    let mdp = $("#password").val();
    let username = $("#username").val();
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Security/inscription/",
        type:"POST",
        xhrFields: {
            withCredentials: true
        },
        data:{
            "mail":email,
            "mdp":mdp,
            "username":username
        },
        success:function(response){
            alert("Veuillez voir votre voîte mail, pour activer votre compte, si vous n'avez rien reçu veuillez contacter un administrateur.")
        },
        error:function(response){
            console.log(response.responseText);
            alert(response.responseText);
        }
    })
}