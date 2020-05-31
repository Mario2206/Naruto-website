(function() {

    let inputFile = document.querySelector("input[type='file']")
    let textArea = document.querySelector("textarea")
    let inputName = document.querySelector("#name")
    let form = document.querySelector('form')
    let img = document.querySelector("#img_profil")

    
    const fileObj = new Input(inputFile)
    const textAreaObj = new Input(textArea)
    const inputNameObj = new Input(inputName)

    fileObj.addListener(fileObj.showDoc, img)
    textAreaObj.addListener(textAreaObj.testText, {minLength : 10, maxLength : Infinity})
    inputNameObj.addListener(inputNameObj.testText, {minLength: 2, maxLength : 35})
    
    form.addEventListener("submit", (e)=> {

        let dataForm = {
             
            inputName : {
                input : inputNameObj,
                error : "Le nom ne doit pas être vide"
            },
            textArea : {
                input : textAreaObj,
                error : "La description ne doit pas être vide"
            }

        }
        let form = new Form(dataForm)

        if(!form.validateForm()) {
            e.preventDefault()
            form.showError();   
        }
    })

})()