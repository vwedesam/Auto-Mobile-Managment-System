// (Ajax) HTTP Request library
function EasyHttp(){
   this.http = new XMLHttpRequest();
}

// make an HTTP GET Request
EasyHttp.prototype.get = function(url){

    return new Promise((resolve, reject) => {
        this.http.open('GET', url, true);
        
        let self = this;
        this.http.onload = function() {
            if( self.http.status === 200 ){
               resolve(JSON.parse(self.http.responseText));
            }else{
               reject(`Error: ${self.http.status}`);
            }
        }

        this.http.send();
    })

}

// make an HTTP POST Request
EasyHttp.prototype.post = function(url, datas){

    return new Promise((resolve, reject) => {

        this.http.open('POST', url, true);
        this.http.setRequestHeader('Content-type',  'application/json');
        this.http.setRequestHeader('Content-type',  'application/x-www-form-urlencoded');

        let self = this;
        this.http.onload = function() {
            if( self.http.status === 200 ){
               resolve(JSON.parse(self.http.responseText));
            }else{
               reject(`Error: ${self.http.status} Server-Error: ${self.http.responseText}`);
            }
        }

        this.http.send(JSON.stringify(datas));
        
    });

}

// make an HTTP PUT Request
EasyHttp.prototype.put = function(url, data, callback){

    return new Promise((resolve, reject) => {

        this.http.open('PUT', url, true);
        this.http.setRequestHeader('Content-type',  'application/json')

        let self = this;
        this.http.onload = function() {
            if( self.http.status === 200 ){
               resolve(self.http.responseText);
            }else{
               reject(`Error: ${self.http.status} Server-Error: ${self.http.responseText}`);
            }
        }

        this.http.send(JSON.stringify(data));
    });

}

// make an HTTP DELETE Request
EasyHttp.prototype.delete = function(url, callback){

    return new Promise((resolve, reject) => {

        this.http.open('DELETE', url, true);
        
        let self = this;
        this.http.onload = function() {
            if( self.http.status === 200 ){
               resolve(self.http.responseText);
            }else{
               reject(`Error: ${self.http.status} ${self.http.responseText}`);
            }
        }

        this.http.send();
    });

}

