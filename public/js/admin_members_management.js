if(document.querySelector(".initPop")) {
    let button = document.querySelector(".initPop")
    let endButton =  document.querySelector(".back_popup")

    let divPop = document.querySelector(".container_create_admin_hidden")
    let pop = new PopUpLinker({initButton : button, endButton : endButton}, divPop)
}
