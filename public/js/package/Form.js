"use-strict";

function Form(inputObject) {
    this.inputObject = inputObject
    this.state = false
    this.error = []

    this.validateForm = function() {
        this.error = [];
        for(const input in this.inputObject) {
            const inputObj = this.inputObject[input]
            !inputObj.input instanceof Input ? console.log("Error : args have to be Input Object") : false;
            
            this.state = inputObject[input].input.state
            if(!this.state) {
                
                this.error.push(inputObj.error)
            }
        }
        if(this.error.length !== 0) {
            this.triggerResponse()
        }
        return this.error.length === 0 && this.state  
    }
    
    this.showError = function() {
        const backDiv = document.createElement("div");
        backDiv.classList.add("backAlert");

        const alert = document.createElement("ul");
        alert.classList.add("alert");

        const title = document.createElement("strong");
        title.innerText = "ATTENTION";
        alert.appendChild(title)
       
        for(let i=0, c= this.error.length; i <c ; i++) {
            const p = document.createElement("li");
            p.innerText = this.error[i]
            alert.appendChild(p)
        }
        
        const stopButton = document.createElement("button")
        stopButton.innerText = "ok";
        alert.appendChild(stopButton)
        
        stopButton.addEventListener("click", function(){
            document.body.removeChild(backDiv)
        })

        backDiv.appendChild(alert);
        document.body.appendChild(backDiv);

    }

    this.triggerResponse = function() {
        const event = new Event('input')
        
        for(let input in this.inputObject) {
            console.log(this.inputObject[input].input.input);
            this.inputObject[input].input.input.dispatchEvent(event)
        }
    }
}