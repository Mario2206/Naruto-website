"use-strict";
(function(){
    console.log(document.querySelector("#objectInput"));
    
    const objectInput = new Input(document.querySelector("#objectInput"));
    objectInput.addListener(objectInput.testText,{minLength : 5, maxLength : 20});

    const mailInput  = new Input(document.querySelector("input[type='email']"));
    mailInput.addListener(mailInput.testMail)
    
    const areaInput = new Input(document.querySelector("textarea"));
    areaInput.addListener(areaInput.testText, {minLength : 30, maxLength : 500});

    const subButton = document.querySelector("input[type='submit']");
    subButton.addEventListener("click", function(e) {
        const formTest = {
            objectInput : {input : objectInput, error : "L'objet est obligatoire"},
            mailInput : {input: mailInput, error : "Le mail n'est pas valide"},
            areaInput: {input:areaInput, error : "Le message doit comporter au moins 30 et maximum 500 caractères"}
        }
        const validateForm = new Form(formTest)
        if(!validateForm.validateForm()) {
            e.preventDefault();
            validateForm.showError()
        }
    })

})()