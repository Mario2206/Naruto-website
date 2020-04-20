"use-strict";
(function(){

    //GET NODES
    const username = document.querySelector("input[name='id_connection']");
    const password = document.querySelector("input[name='password']");
    const subButton = document.querySelector("input[type='submit']");

    //INSTANTIATE INPUT OBJECT
    const inputUsername = new Input(username);
    const inputPassword = new Input(password);

    //ADD LISTENERS
    inputUsername.addListener(inputUsername.testText,{minLength : 2, maxLength : 50});
    inputPassword.addListener(inputPassword.syntaxPassword);

    //VALIDATE FORM
    const validateForm = new Form({
            inputUsername : {input: inputUsername, error : "Le nom d'utilisateur n'est pas conforme"},
            inputPassword : {input: inputPassword, error : "Le mot de passe n'est pas conforme"}
        });
    subButton.addEventListener('click', function(e) {
        
        if(!validateForm.validateForm()) {
            e.preventDefault();
            validateForm.showError();
        } 
        sessionStorage.setItem('connect', 'already');
    },true);

    //TEST IF THE PAGE HAS ALREADY BEEN LOADED

    if(sessionStorage.getItem("connect") && performance.getEntriesByType("reload")) {
        const errorMess = document.querySelector("#errorMessage");
        errorMess.innerText = "L'identifiant ou le mot de passe n'est pas correct";
        validateForm.validateForm();
    }
    
})()
