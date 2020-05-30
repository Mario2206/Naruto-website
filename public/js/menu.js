"use-strict";
(function(){
    const button = document.querySelector('#button_resp');
    const nav_container = document.querySelector('nav .ul');

    button.addEventListener("click", function(){
        
        nav_container.classList.toggle('nav_toggle');
        nav_container.classList.toggle('nav_toggle_init')

        button.classList.add('anim_button')
    })

    document.body.addEventListener("click", function(e) {
        let target = e.target
        
        
        while(target != document.body && target != nav_container && target != button) {

            target = target.parentNode
            
        }

        if(target == document.body) {
            
            nav_container.classList.replace('nav_toggle', 'nav_toggle_init')

            button.classList.remove('anim_button')
        }

    })

})()