"use-strict";


(function(){
    const button = document.querySelector("#container_helper");
    const div = document.querySelector('#txt_helper');
    const p = document.querySelector('#txt_helper p');

    let timing = setTimeout(()=>hideMessage(), 10000);

    button.addEventListener("mouseover", function() {
        clearTimeout(timing);
        timing = setTimeout(()=>hideMessage(), 10000);
        showMessage();
        
    })

    function hideMessage() {
        p.style.animation = 'txtHiding 0.5s'
        div.style.animation = 'divHidding 1s';
        p.style.opacity = "0";
        div.style.width = "0";
        div.style.height = "0";
        button.style.opacity = "0.7";
    }
    function showMessage() {
        p.style.animation = 'txtArrival 3s'
        div.style.animation = 'divArrival 1s';
        p.style.opacity = "1";
        div.style.width = "30%";
        div.style.height = "75px";
        button.style.opacity = "1";
    }
})()