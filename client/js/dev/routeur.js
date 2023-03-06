page = "menu.html"
$(document).ready(function(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', generateURL(page), true);
    // $("#content").load(generateURL(page));
    xhr.responseType = 'document';

    // handle the response
    xhr.onload = function() {
    if (xhr.status === 200) {
        // get the HTML document from the response
        var htmlDocument = xhr.response.documentElement.innerHTML;
        console.log(htmlDocument);
        // insert the content into the page
        document.getElementById('content').innerHTML = htmlDocument;
    }
    };
    // send the request
    xhr.send();
});

function generateURL(page){
    return "html/"+page;
}