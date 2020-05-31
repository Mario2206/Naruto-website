"use-strict";
/**
 * Object for checking all inputs
 */
class Form {
    /**
     * 
     * @param {Object} inputObject {inputName : {input: inputObject, error : "Here write error to send to client"}}
     */
    constructor(inputObject) {

        this.inputObject = inputObject
        this.state = false
        this.error = []

    }

    
    /**
     * Method for checking all input 
     * 
     * !return bool 
     */
    validateForm = ()=> {

        this.error = [];
        for(const input in this.inputObject) {
            const inputObj = this.inputObject[input]
            
            if(inputObj.input instanceof Input === false) {

                console.log("Error : args have to be Input Object");
                return false

            };
            
            this.state = this.inputObject[input].input.state
            
            if(!this.state) {
                
                this.error.push(inputObj.error)
            }
        }
        if(this.error.length !== 0) {
            this.triggerResponse()
        }
        
        return this.error.length === 0 && this.state  

    }
    
    /**
     * Method for sending error to client
     * (add css file "alert.css")
     */
    showError = function() {
        const backDiv = document.createElement("div");
        backDiv.classList.add("backAlert");

        const alert = document.createElement("ul");
        alert.classList.add("error_message");

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

    /**
     * In order to dispatch an event if there are errors in input data
     */
    triggerResponse = function() {
        const event = new Event('input')
        const eventForInputFile = new Event('change')
        
        for(let input in this.inputObject) {
        
            this.inputObject[input].input.input.dispatchEvent(event)
            this.inputObject[input].input.input.dispatchEvent(eventForInputFile)
        }
    }
}