"use-strict";

class Slider {

    /**
     * 
     * @param {Object} container => contains all slides div (class = "slide") 
     * @param {Object} screen  => the screen for showing the slideshow
     */
    constructor(container, screen ) {

        this.container = container
        this.screen = screen
        this.slides = container.querySelectorAll(".slide")
        this.nSlides = this.slides.length
        this.current_slide = 0

        this.init()
        this._createHandlerTouch()
    }
    /**
     * Init configuration for nodes
     */
    init() {

        this.container.style.width = (this.screen.offsetWidth * this.nSlides) + "px"

        for(let i = 0; i< this.nSlides; i++) {
    
            this.slides[i].style.width = (100 / this.nSlides) + "%"
    
        }
        this.container.style.transition = "1s"

    }

    /**
     * For directing the slider movement
     * 
     * @param {Number} dir => direction ( > 0 : right; <0 : left)
     */
    _moveSlider = (dir) => {

        if(dir > 0) {

            this.current_slide++;
            this.current_slide >= this.nSlides ? this.current_slide = 0 : false;   

        } else if(dir < 0) {

            this.current_slide--;
            this.current_slide < 0 ? this.current_slide = this.nSlides - 1 : false;   

        }
        
        let translationX = (100 / this.nSlides) * this.current_slide;
        this.container.style.transform = `TranslateX( -${translationX}%)`; 

    }


    /**
     * Init HandlerTouch for directing mouse movement
     */
    _createHandlerTouch() {

        const handlerTouch = new HandlerTouch(this.container)

        handlerTouch.funcEnd = (moveX) => {

            const widthScreen = this.screen.clientWidth
            const ref = widthScreen*0.2
        
            if(Math.abs(moveX) > ref) {

                this._moveSlider(moveX)

            }           
        }

    }


}