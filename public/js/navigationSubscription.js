(function(){
    const ID_RETURN = "return"
    const ID_SUB = "submitDef"

    const moveContainer = document.querySelector('#container_form')
    const buttons = document.querySelectorAll('.submit')
    const moveContainerSize = 50

    //Instance of inputObject

    //PART 1
    const inputUsername = new Input(document.querySelector('#username'))
    inputUsername.addListener(inputUsername.testText,{minLength : 2, maxLength : 20})

    const inputLastName = new Input(document.querySelector("input[name='lastname']"))
    inputLastName.addListener(inputLastName.testText, {minLength:2, maxLength : 20})

    const inputFirstName = new Input(document.querySelector("input[name='firstname']"))
    inputFirstName.addListener(inputFirstName.testText, {minLength:2, maxLength : 20})
    
    //Interconnection between password and confPassword
    const inputConfPassword = new Input(document.querySelector("input[name='confirmPassword']"))
    const inputPassword = new Input(document.querySelector("input[name='password']"))
    inputPassword.addListener(function() {//Function has to return true or false to define the state
        inputConfPassword.testPasswordEquality(inputPassword)
        return inputPassword.syntaxPassword()
    })
    inputConfPassword.addListener(inputConfPassword.testPasswordEquality,inputPassword)
    
    const inputMail = new Input(document.querySelector("input[type='email']"))
    inputMail.addListener(inputMail.testMail)

    const selectDay = new Input(document.querySelector("select[name='day']"))
    selectDay.addListener(selectDay.checkDateNumber, {min : 1, max :31})

    const selectYear = new Input(document.querySelector('select[name="year"]'))
    selectYear.addListener(selectYear.checkDateNumber, {min:1900, max : new Date().getFullYear()})
    
    const selectMonth = new Input(document.querySelector('select[name="month"]'))
    selectMonth.addListener(selectMonth.checkDateNumber, {min: 1, max : 12})
  
    //PART2
    
    const imgAvatar = document.querySelector("#avatarImg")
    const avatarIn =new Input(document.querySelector("input[name='avatar']"))
    avatarIn.showDoc(imgAvatar)

    const radios = document.querySelectorAll("input[type='radio']");
    const handlerRadios = new HandlerRadio(radios)

    //NAVIGATION
    let alreadyMove = false

    for(let i =0, c=buttons.length; i< c; i++) {
        
        buttons[i].addEventListener('click', function(e) {
            
            if(e.target.id === ID_RETURN) {//Return Button 
                e.preventDefault()
                if(alreadyMove) {
                    moveContainer.style.transform= `TranslateX(0)`
                    alreadyMove = false
                }
                
            } else if(e.target.id === ID_SUB) {//SUB BUTTON
                let validateForm= new Form({})
                 if(!alreadyMove) {
                    e.preventDefault()
                        validateForm = new Form({
                        inputUsername : {input : inputUsername, error : "Pseudo invalide"},
                        inputLastName : {input : inputLastName, error : "Nom de famille incorrect(trop court ou trop long)"},
                        inputFirstName : {input : inputFirstName, error : "Prenom incorrect(trop court ou trop long)"},
                        inputPassword : {input : inputPassword, error : "Le mot de passe doit comporter 1 Maj. 1 caractere special et 2 chiffres"}, 
                        inputConfPassword : {input : inputConfPassword, error : "La confirmation du mot de passe ne correspond pas"},
                        inputMail : {input : inputMail, error : "Le mail ne respecte pas la norme"},
                        selectDay : {input : selectDay, error : "Jour non saisi"},
                        selectYear : {input : selectYear, error : "Année non saisie"},
                        selectMonth : {input : selectMonth, error : "Mois non saisi"}
                    })
                    if(validateForm.validateForm()) {//Form is correct
                        moveContainer.style.transform = `TranslateX( ${(-moveContainerSize)}%)`
                        alreadyMove = true 
                    } else {//Form is uncorrect
                        validateForm.showError()
                    }
                         
                } else {
                    validateForm.inputObject.inputAvatar = {input : avatarIn, error : "Image de profile invalide" }
                    if(!validateForm.validateForm()) {
                        e.preventDefault();
                        validateForm.showError();
                    }
                }
                
            }
        
        }) 
    }

    //STOP TABULATION
    document.addEventListener("keydown", function(e){
        if(e.keyCode === 9){
            e.preventDefault()
        }
    })
})()


