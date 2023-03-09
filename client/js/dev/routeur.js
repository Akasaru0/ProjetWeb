export class Routeur{
    constructor(){
        this.baseRouteur = "/client/html/";
    }

    routerRequete(page){
        return this.baseRouteur + page + "?t=" + new Date().getTime(); 
    }

    includeHtmlFile(page="menu.html",initFunc=false){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', this.routerRequete(page), true);

        xhr.responseType = 'document';

        // handle the response
        xhr.onload = function() {
        if (xhr.status === 200) {
            // get the HTML document from the response
            var htmlDocument = xhr.response.documentElement.innerHTML;
            // insert the content into the page
            document.getElementById('content').innerHTML = htmlDocument;
            if(initFunc){
                initFunc();
            }
        }
        };
        // send the request
        xhr.send();
    }   
}