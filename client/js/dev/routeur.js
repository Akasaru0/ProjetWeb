export class Routeur{
    constructor(){
        this.baseRouteur = "/client/";
        this.queryString = window.location.search;
        if(this.queryString!=""){
            var urlParams = new URLSearchParams(this.queryString);
            try {
                const product = urlParams.get('routage');
                const file = product;
                this.includeHtmlFile(file,"html");
                this.includeHtmlFile(file,"js","dev");
            } catch (error) {
                console.log(error)
            }
        }
    }

    routerRequete(page,type,opt){
        if(type=="js"){
            return this.baseRouteur+type+"/"+opt+"/"+ page+"."+type + "?t=" + new Date().getTime(); 
        }else{
            return this.baseRouteur+type+"/"+ page + "?t=" + new Date().getTime(); 
        }
    }

    includeHtmlFile(page="menu.html",type="html",opt=false){
        if(type!="html" && type!="js")return;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', this.routerRequete(page,type,opt), true);
        
        if(type=="html"){
            xhr.responseType = 'document';
        }

        // handle the response
        xhr.onload = function() {
        if (xhr.status === 200) {
            if(type=="html"){
                // get the HTML document from the response
                var htmlDocument = xhr.response.documentElement.innerHTML;
                // insert the content into the page
                document.getElementById('content').innerHTML = htmlDocument;
            }else if(type=="js"){
                var jsDocument = xhr.responseText;
                // insert the content into the page
                document.getElementById('script').innerHTML = jsDocument;
            }
        }
        };
        // send the request
        xhr.send();
    }   
}