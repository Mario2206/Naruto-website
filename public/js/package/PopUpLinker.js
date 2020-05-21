"use-strict";

class PopUpLinker {

    constructor({initButton, endButton}, divToPop) {
        this.startingButton = initButton
        this.endingButton = endButton
        this.divToPop = divToPop

        this.init()
    }
    init() {
        this.startingButton.addEventListener("click", this.pop)
        this.endingButton.addEventListener("click", this.unpop)
    }

    pop = ()=> {
        this.divToPop.classList.replace("container_create_admin_hidden", "container_create_admin_visible");
    }
    unpop = (e)=> {
        if(e.target == this.endingButton) {
            this.divToPop.classList.replace("container_create_admin_visible","container_create_admin_hidden")
        }
        
        
    }
}