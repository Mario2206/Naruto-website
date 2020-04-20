"use-strict";
(function(){
    const button = document.querySelector('#button_resp');
    const nav_container = document.querySelector('nav .ul');

    button.addEventListener("click", function(){
        
        nav_container.classList.toggle('nav_toggle');
        nav_container.classList.toggle('nav_toggle_init')
    })

})()