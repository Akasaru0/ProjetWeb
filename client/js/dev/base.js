import { Routeur } from './routeur.js';

var routeur = new Routeur();

$(document).ready(function(){
    if(routeur.queryString==""){
        routeur.includeHtmlFile();
    }
    isConnected(setButtonConnexion);
});

//-------------------------- DEBUT CONNEXION -----------------------------------

function isConnected(action=false){
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Security/isconnecte/",
        type:"GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            if(action){
                action(Boolean(JSON.parse(response)))
            }
        },
    })
}

function setButtonConnexion(bool){
    if(bool){
        $("#connexion")[0].style.display = "none";
        $("#inscription")[0].style.display = "none";
        $("#deconnexion")[0].style.display = "block";
        $("#nav")[0].style.display = "flex";
        $("#navEmpty")[0].style.display = "none";
    }else{
        $("#connexion")[0].style.display = "block";
        $("#inscription")[0].style.display = "block";
        $("#deconnexion")[0].style.display = "none";
        $("#nav")[0].style.display = "none";
        $("#navEmpty")[0].style.display = "flex";

    }
}

function deconnexion(){
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Security/deconnecter/",
        type:"GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            window.location.href = "/client/";
        },
    });
}

$("#deconnexion").on("click",function(){
    deconnexion();
});

$("#connexion").on("click",function(){
    window.location.href = "/client/?routage=connexion";
})

$("#inscription").on("click",function(){
    window.location.href = "/client/?routage=inscription";
})

//-------------------------- FIN CONNEXION -----------------------------------

//-------------------------- DEBUT SALLES -----------------------------------
$("#salles").on("click",function(){
    // routeur.includeHtmlFile("salles.html",initSalles);
    window.location.href = "/client/?routage=salles";

})
//-------------------------- FIN SALLES -----------------------------------

//-------------------------- DEBUT BLOC -----------------------------------
//-------------------------- FIN BLOC -----------------------------------