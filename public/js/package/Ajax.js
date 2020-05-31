"use-strict";


class Ajax {

    constructor(url) {

        this.domain = "http://projet-naruto.local/"
        this.url = url
        this.xhr = new XMLHttpRequest()

    }

     get(callback, params = null) {

        return new Promise(callback => {

            let sup = "";

            if(params) {
                
                sup = "?"

                for( const param in params) {

                    sup += param + "=" + params[param] + "&"

                }
                
                sup = sup.substr(0, sup.length -1)
            }
            
            
            this.xhr.open("GET", this.domain + this.url + sup)

            this.xhr.addEventListener("readystatechange", (e)=> {
                
                if(this.xhr.readyState === XMLHttpRequest.DONE && this.xhr.status === 200) {
                    const data = JSON.parse(this.xhr.response)

                    callback(data.response)

                }
            })

            this.xhr.send(null)
        })
    }

     post(data) {
        
        return new Promise(callback => {

            const formData = new FormData()

            for(const k in data) {

                formData.append(k, data[k])

            }

            this.xhr.open("POST", this.domain + this.url)

            this.xhr.addEventListener("readystatechange", (e)=> {
                
                if(this.xhr.readyState === XMLHttpRequest.DONE && this.xhr.status === 200) {
                    
                    const data = JSON.parse(this.xhr.response)
                    
                    callback(data.response)

                } else if(this.xhr.status === 0) {

                    throw "Error HTTP : domain is out"

                }
            })

            this.xhr.send(formData)

        })

    }
}