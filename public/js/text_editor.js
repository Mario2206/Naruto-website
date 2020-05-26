"use-strict"

//<-- FOR TEXT EDITOR -->

//init text editor
$('#text_editor').trumbowyg()


let form = $("form")
let inputContent = $('input[name="content"]')
let inputSynopsis = $('input[name="synopsis"]')

//init value for text editor
$("#text_editor").trumbowyg('html', inputContent.val())


form.submit( function(e) {

    let synopsis;
    synopsis = prompt("Confirmer la création de l'article ?");

    if(synopsis.length > 0) {

        inputContent.val($("#text_editor").trumbowyg('html'))
        inputSynopsis.val(synopsis)

    } else {
        alert("Il est nécessaire d'intégrer un synopsis à votre histoire")
        e.preventDefault()
    }
    
})

$('input[name="title"]').contextmenu((e)=>e.preventDefault())

//<-- FOR IMG BACKUP -->

let inputFile = new Input($("input[type='file']")[0])
let imgTag =$("#miniature_ex")[0]


inputFile.addListener(inputFile.showDoc, imgTag)




