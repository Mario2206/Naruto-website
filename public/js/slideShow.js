"use-strict";

(function() {
    
    const slides_container = document.querySelector('#container_slides');
    const screen = document.querySelector('#screen')

    let slider = new Slider(slides_container, screen)

    window.addEventListener("resize", function() {

        slider.init()

    })
})()



