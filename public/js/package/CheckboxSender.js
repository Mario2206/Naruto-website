"use-strict"
class CheckboxSender {

    constructor(arr_checkButtons) {

        this.checkers = arr_checkButtons;
        this.url = ""

        this._init()

    }


    _init() {

        for(let i = 0, c = this.checkers.length; i < c ; i++) {

            this.checkers[i].addEventListener("change",this._ajaxEvent)
    
        }

    }

    _ajaxEvent = (e)=> {

        let check_state = e.target.checked ? 1 : 0
        let char_id = e.target.id
        
        const ajax = new Ajax(this.url)

        ajax.post({id : char_id, is_online : check_state}).then((data)=>console.log(data)).catch((e)=>console.error(e))

    }

    set urlRequest(url) {
        this.url = url
    }

}