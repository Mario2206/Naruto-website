"use-strict";
// const months 
function Input (element) {
    
    this.input = element;
    this.value = element.value;
    this.correctStyle = "goodInput";
    this.uncorrectStyle = "badInput";
    this.correctExtensions = ["jpg", "png"]
    this.state = false;
    

    const obj = this;
    //DEFAULT EVENT TO UPDATE INPUT VALUE
    this.input.addEventListener("contextmenu", function(e) {e.preventDefault()})
    this.input.addEventListener("input", function() {
        obj.value = obj.input.value;     
    })
    
    //METHOD FOR ADD LISTENER (TESTS)
    this.addListener = function(eventFunc, arg) {
        this.input.addEventListener('input', function(e) {
            obj.state = eventFunc(arg);
            !obj.state ? obj.badStyle(obj.input) : obj.goodStyle(obj.input) 
        }) 
    }
    

    //TESTING METHODS : they have to return true or false to define the state
    
    this.checkDateNumber = function(ref) {//arg has to be an obj        
        const nDay = parseInt(this.value)
        return this.checkNumber(nDay, ref) 
    }.bind(this)

    this.testMail = function() {
        const reg = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/
        return reg.test(this.value)
    }.bind(this)

    this.testText = function(length) {//length has to be a litteral object
        return this.testLength(length)
    }.bind(this)

    this.syntaxPassword = function() {//1 maj ; 1  special caract ; 2 numbers
        const reg = /[A-Za-z]{1,}[$!/;,?ù%£^+=}{'@#]{1,}[1-9]{2,}/ 
        return reg.test(this.value) && this.value.length > 10
    }.bind(this)

    this.testPasswordEquality = function(originPassword) {//Arg has to be Input object; method has to be assign to the "confirm password" input for a good render
        return this.testEquality({ref : originPassword.value, checked :this.value}) && originPassword.state
    }.bind(this)

    //ANNEX METHODS
    this.checkNumber = function(number, refNumber) {//arg is an obj
        return number > refNumber.max || number < refNumber.min || isNaN(number) ? false : true  
    }
    this.caractFinder = function(regExp) {
         return this.value.split("").filter(item => regExp.test(item))
    }

    this.testEquality = function(passwords) {//arg is an object
        return passwords.ref === passwords.checked
    }.bind(this)
    
    this.testLength = function(length) {
        return this.value.length >= length.minLength && this.value.length<=length.maxLength
    }.bind(this)

    this.testFileExt = function(filename) {
        return this.correctExtensions.includes(filename.split('.').pop());
    }.bind(this)

    //METHODS FOR STYLE

     this.style = function(element, classToAdd, classToRemove ) {
        if(element.classList.contains(classToAdd) || element.classList.contains(classToRemove)) {
            element.classList.replace(classToRemove, classToAdd)
        } else {
            element.classList.add(classToAdd)
        }
    }

    this.goodStyle = function(element) {
       this.style(element, this.correctStyle, this.uncorrectStyle)
    }
    this.badStyle = function(element) {
        this.style(element, this.uncorrectStyle, this.correctStyle)
    }

    //METHODS FOR FILE READER 
    this.showDoc = function(img) {
        const obj = this
        const fileReader = new FileReader()
        fileReader.addEventListener("load", function(e) {
            const allowFile = obj.testFileExt(obj.value.name);
            if(img && allowFile ) {
                img.src = e.target.result;
                obj.state = true;
                img.style.opacity = "1";
            }else if(!allowFile) {
                img.src = null;
                obj.state = false;
            }
        }); 

        this.input.addEventListener("change", function(e) {
            obj.value = e.target.files[0]
            fileReader.readAsDataURL(obj.value)
        })
    }

    

}