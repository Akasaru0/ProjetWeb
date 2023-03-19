function getSalles(){
    $.ajax({
        url:"http://localhost/projetWeb/server/Salle/",
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            var data = response;
            var table = $('#table').DataTable();
            data.forEach(element => {
                table.row.add([element.nom,element.adresse,'<a href="/client/?routage=blocs&id='+element.id+'">lien</a>']);
            });
            table.draw();
        },
        error: function(response){
            window.location.href = "/client/?routage=menu";
        },
    });
}

$(document).ready(function() {
    $('#table').DataTable();
    getSalles();
});

document.addEventListener('DOMContentLoaded', function() {
    // Add your code here to load and apply your CSS and JavaScript files
    // For example:
    var cssLink = document.createElement('link');
    cssLink.href = '/client/css/lib/dataTables.min.css';
    cssLink.rel = 'stylesheet';
    document.head.appendChild(cssLink);
    
    var script = document.createElement('script');
    script.src = '/client/js/lib/dataTables.min.js';
    document.body.appendChild(script);
    
    // Add your code here to create and add the dynamic HTML template to the DOM
  });

