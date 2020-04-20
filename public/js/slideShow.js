"use-strict";

(function() {
    const slides_container = document.querySelector('#container_slides');
    const slides_number = document.querySelectorAll('.slide').length;
    
    let current_slide = 0;

    function moveSlider(dir) {

        if(dir > 0) {
            current_slide++;
            current_slide >= slides_number ? current_slide = 0 : false;    
        } else if(dir < 0) {
            current_slide--;
            current_slide < 0 ? current_slide = slides_number-1 : false;    
        }
        
        let translationX = (100 / 3) * current_slide;
        slides_container.style.transform = `TranslateX( -${translationX}%)`;        
    }

    function onMovingSlider(moveX) {
        slides_container.style.transform = `TranslateX(${moveX}px) ` 
    }
    
    const handlerTouch = new HandlerTouch(slides_container)
    handlerTouch.funcEnd = function(moveX) {
        const widthScreen = document.querySelector('#screen').clientWidth
        const ref = widthScreen*0.2
        
        if(Math.abs(moveX) > ref) {
            moveSlider(moveX)
        }           
    }
})()

