function modifierRole(id, role){
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Panel/modifierRole",
        type: "POST",
        xhrFields: {
            withCredentials: true
        },
        data:{
            "id":id,
            "role":role,
        },
        success: function (response) {
            console.log("Le rôle de l'utilisateur a été modifié !");
        },
        error: function(response){
            alert(response.responseText);
        },
    });
}

function ajouterSalle(nom, capacite){
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Panel/ajouterSalle",
        type: "POST",
        xhrFields: {
            withCredentials: true
        },
        data:{
            "nom":nom,
            "capacite":capacite,
        },
        success: function (response) {
            console.log("La salle a été ajoutée !");
        },
        error: function(response){
            alert(response.responseText);
        },
    });
}

function ajouterBloc(nom, description){
    $.ajax({
        url:"http://localhost/ProjetWeb/server/Panel/ajouterBloc",
        type: "POST",
        xhrFields: {
            withCredentials: true
        },
        data:{
            "nom":nom,
            "description":description,
        },
        success: function (response) {
            console.log("Le bloc a été ajouté !");
        },
        error: function(response){
            alert(response.responseText);
        },
    });
}

$(document).ready(function() {
    // Modifier le rôle d'un utilisateur
    $(document).on("click", "#modifierRoleBtn", function() {
        var id = $("#userId").val();
        var role = $("#roleSelect").val();
        modifierRole(id, role);
    });

    // Ajouter une salle
    $(document).on("click", "#ajouterSalleBtn", function() {
        var nom = $("#salleNom").val();
        var capacite = $("#salleCapacite").val();
        ajouterSalle(nom, capacite);
    });

    // Ajouter un bloc
    $(document).on("click", "#ajouterBlocBtn", function() {
        var nom = $("#blocNom").val();
        var description = $("#blocDescription").val();
        ajouterBloc(nom, description);
    });
});