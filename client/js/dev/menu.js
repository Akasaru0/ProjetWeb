$(document).ready(function() {
    isConnected(getStat);
});

function generateChart(){
    
    const ctx = document.getElementById('chart_user');
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Stat/getAllVoteOfUserForChart/",
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function(response){
            let labels = [];
            let data = [];
            let i=0;
            response.forEach(element => {
                data.push(element["valeur"]);
                labels.push(i);
                i++;
            });
            new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Progression',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });
        },
    })
    
}

// Get the value of a cookie
function getCookie(name) {
    const cookies = document.cookie.split(';');
    for(let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if(cookie.startsWith(`${name}=`)) {
        return cookie.substring(name.length + 1, cookie.length);
        }
    }
    return false;
}

function getStat(response){
    if(!response){
        $("#non_connecte")[0].style.display = "block";
        return;
    }
    $("#connecte")[0].style.display = "block";
    username_cookie = getCookie("username");
    if(username_cookie){
        document.getElementById('h1_user').textContent = "Hello "+username_cookie+",";
    }

    $.ajax({
        url:"http://localhost/projetWeb/server/Stat/getNbCommentOfUser",
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            var data = response;
            document.getElementById('nb_comment').textContent = "Nombre de commentaire publié : "+data[0]['nb_comment'];
        },
        error: function(response){
            window.location.href = "/client/?routage=menu";
        },
    });

    $.ajax({
        url:"http://localhost/projetWeb/server/Stat/getAllVoteOfUser",
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            var data = response;
            document.getElementById('nb_vote').textContent = "Nombre de bloc évalué : "+data.length;
        },
        error: function(response){
            window.location.href = "/client/?routage=menu";
        },
    });

    $.ajax({
        url:"http://localhost/projetWeb/server/Stat/getLastVoteOfUser",
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            var data = response;
            document.getElementById('last_vote').textContent = "Dernier bloc évalué : "+data[0]['valeur']+"/5 pour le bloc "+data[0]['description']+" (couleur du bloc: "+data[0]['couleur']+") de la salle "+data[0]['salle'];
        },
        error: function(response){
            window.location.href = "/client/?routage=menu";
        },
    });

    $.ajax({
        url:"http://localhost/projetWeb/server/Stat/getAverageVoteOfUser",
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            var data = response;
            document.getElementById('moy_vote').textContent = "Moyenne des blocs évalués : "+data[0]['moyenne_cotation']+"/5";
        },
        error: function(response){
            window.location.href = "/client/?routage=menu";
        },
    });

    $.ajax({
        url:"http://localhost/projetWeb/server/Stat/getAllCommentOfUser",
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            var data = response;
            var nb_comment = data.length;
            document.getElementById('last_comment').textContent = "Dernier commentaire publié : "+data[nb_comment-1]['libelle']+" le "+data[nb_comment-1]['date_creation'];
        },
        error: function(response){
            window.location.href = "/client/?routage=menu";
        },
    });
    generateChart();
}

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

