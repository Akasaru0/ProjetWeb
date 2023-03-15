function getBlocs(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    let id= urlParams.get('id');

    $.ajax({
        url:"http://localhost/ProjetWeb/server/Salle/getBlocsSalle/"+id,
        type: "GET",
        xhrFields: {
            withCredentials: true
        },
        success: function (response) {
            var data = response;
            var table = $('#table').DataTable();
            data.forEach(element => {
                table.row.add([element.description,element.id_couleur,'<a href="/client/?routage=bloc&id='+element.id+'">lien</a>']);
            });
            table.draw();
        },
        error: function(response){
            alert(response)
            // window.location.href = "/client/";
        },
    });
}

$(document).ready(function() {
    $('#table').DataTable();
    getBlocs();
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