"use-strict";
/**
 * FOR CREATING A PROTECTION CONTEXT FOR THE TESTS 
 * 
 * @param {object} element 
 */
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
    
    /**
     * FOR ADDING LISTNERS AND CONSEQUENTLY EVENTS
     * 
     * @param {Function} eventFunc
     * @param arg -->params of this function
     * 
     */
    this.addListener = function(eventFunc, arg) {
        this.input.addEventListener('input', function(e) {
            obj.state = eventFunc(arg);
            !obj.state ? obj.badStyle(obj.input) : obj.goodStyle(obj.input) 
        }) 
    }
    

    //TESTING METHODS
    
     /**For checking date
      * 
      * @param {object} ref ={min: ???, max : ???}
      * !return bool
      */
    this.checkDateNumber = function(ref) {//arg has to be an obj        
        const nDay = parseInt(this.value)
        return this.checkNumber(nDay, ref) 
    }.bind(this)

    /**For testing mail syntax
      * 
      * !return bool
      */
    this.testMail = function() {
        const reg = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/
        return reg.test(this.value)
    }.bind(this)

    /**For testing text
      * 
      * @param {object} length ={minLength: ???, maxLength : ???}
      * 
      * !return bool
      */
    this.testText = function(length) {
        return this.testLength(length)
    }.bind(this)

    /**For testing password syntax
      * 
      * !return bool
      */
    this.syntaxPassword = function() {//1 maj ; 1  special caract ; 2 numbers
        const reg = /[A-Za-z]{1,}[$!/;,?ù%£^+=}{'@#]{1,}[1-9]{2,}/ 
        const regMaj = this.caractFinder(/[A-Z]/);
        const regNum = this.caractFinder(/[0-9]/);
        const regCaract = this.caractFinder(/[$!/;,?ù%£^+=}{'@#]/);
        return regMaj.length > 0 && regNum.length > 2 && regCaract.length > 0 && this.value.length > 10
    }.bind(this)

    /**For testing the equality between password and confirmPassword
      * 
      * @param {Input} originPassword 
      * --> method has to be assign to the "confirm password" input for a good render
      * !return bool
      */
    this.testPasswordEquality = function(originPassword) {
        return this.testEquality({ref : originPassword.value, checked :this.value}) && originPassword.state
    }.bind(this)

    //ANNEX METHODS

    /**
     * for checking a number according to a reference
     * 
     * @param {number} number
     * @param {object} refNumber = {min : ???, max : ????}
     * 
     * !return bool
     */
    this.checkNumber = function(number, refNumber) {//arg is an obj
        return number > refNumber.max || number < refNumber.min || isNaN(number) ? false : true  
    }

    /**
     * for checking the presence of some characters
     * 
     * @param {RegExp} regExp
     * 
     * !return array 
     */
    this.caractFinder = function(regExp) {
         return this.value.split("").filter(item => regExp.test(item))
    }

    /**
     * for checking the equivalence between two values
     * 
     * @param {Object} passwords = {ref : ???, checked : ????}
     * 
     * !return array 
     */
    this.testEquality = function(passwords) {//arg is an object
        return passwords.ref === passwords.checked
    }.bind(this)
    
    /**
     * for checking the length of the value
     * 
     * @param {Object} length = {minLength : ????, maxLength : ????}
     * 
     * !return bool
     */
    this.testLength = function(length) {
        return this.value.length >= length.minLength && this.value.length<=length.maxLength
    }.bind(this)

    /**
     * for checking file extension
     * 
     * @param {string} filename
     * 
     * !return bool
     */
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
    this.showDoc = function(imgTag) {
        const obj = this
        const fileReader = new FileReader()
        fileReader.addEventListener("load", function(e) {
            const allowFile = obj.testFileExt(obj.value.name.toLowerCase());
            if(imgTag && allowFile ) {
                imgTag.src = e.target.result;
                obj.state = true;
                imgTag.style.opacity = "1";
            }else if(!allowFile) {
                imgTag.src = null;
                obj.state = false;
            }
        }); 
        
        this.input.addEventListener("change", function(e) {
            obj.value = e.target.files[0]
            fileReader.readAsDataURL(obj.value)
        })
    }.bind(this)

    

}