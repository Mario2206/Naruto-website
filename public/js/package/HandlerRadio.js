function HandlerRadio(radios) {
    this.radios = radios;
    this.currentRadio = radios[0];
    this.style = "radioSelected";

    //INIT
    this.currentRadio.parentNode.classList.add(this.style)
    for(let i =0, c= this.radios.length; i < c;i++) {
        const radio = this.radios[i];
        const obj = this;
        radio.addEventListener('change', function(e) {
            if(radio != obj.currentRadios) {
                radio.parentNode.classList.add(obj.style);
                obj.currentRadio.parentNode.classList.remove(obj.style)
                obj.currentRadio = radio
            } 
        })
    }

}