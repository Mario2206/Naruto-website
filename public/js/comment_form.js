(function() {

    let inputContent = document.querySelector(".input_area")
    let inputObj = new Input(inputContent)
    inputObj.addListener(inputObj.testText,{minLength: 1, maxLength : 500})

    let sub_button = document.querySelector('input[type="submit"]');

    sub_button.addEventListener("click", (e)=> {
        
        const formData = {
            contentInput : {
                input : inputObj,
                error : "Le contenu d'un commentaire ne peut être nul ou excéder 500 caractères"
            } 
        }

        const form = new Form(formData)
        
        if(!form.validateForm() ) {
            e.preventDefault()
        }
    })

})()