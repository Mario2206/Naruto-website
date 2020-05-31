"use-strict";
class HandlerTouch {
    
    constructor(slides_container) {
        this.slide = slides_container
        this.initalPosX = null
        this.lastPosX = null
        this.moveX = null
        this.callbackFunc = {
            funcStart : undefined,
            funcMove : undefined,
            funcEnd : undefined         // REQUIRED
        }
        const obj = this
        this.slide.addEventListener("touchstart", function(e){obj.getGestureHandlerStart(e)}, true)
        this.slide.addEventListener("touchmove", function(e) {obj.getGestureHandlerMove(e)})
        this.slide.addEventListener("touchend", function(e){obj.getGestureHandlerEnd(e)}, true)
        this.slide.addEventListener("touchcancel", function(e){obj.getGestureHandlerEnd(e)}, true)

        this.slide.addEventListener("mousedown", function(e){obj.getGestureHandlerStart(e)}, true)
        this.slide.addEventListener("mouseup", function(e){obj.getGestureHandlerEnd(e)}, true)
    }
    //GESTURES HANDLER 
    getGestureHandlerStart(e) {
        const obj = this
        if(e.type === "mousedown") {
            this.initalPosX = e.clientX 
            this.slide.addEventListener('mousemove', obj.getGestureHandlerMove,true)
        } else {
            this.initalPosX = e.targetTouches[0].clientX
        }   
        this.callbackFunc.funcStart ? this.callbackFunc.funcStart() : false
    }
    
    getGestureHandlerEnd(e) {
        const obj = this
        this.callbackFunc.funcEnd ? this.callbackFunc.funcEnd(this.moveX) 
        : 
        console.log("You have to define the function which is playing at the end of the touch : please do : HandlerTouch.callbackFunc.funcEnd = your_function");
        
        if(e.type === "mouseup") {
            this.slide.removeEventListener("mousemove", obj.getGestureHandlerMove,true)
        }
        this.moveX = 0
    }
    // arrow fx for binding
    getGestureHandlerMove = (e)=> {

        e.type === "mousemove" ? this.lastPosX = e.clientX : this.lastPosX = e.changedTouches[0].clientX
        this.moveX = this.initalPosX - this.lastPosX
        this.callbackFunc.funcMove ? this.callbackFunc.funcMove(this.moveX) : false
        
    }

    //SET
    set funcEnd(func) {
        this.callbackFunc.funcEnd = func
    }
    set funcStart(func) {
        this.callbackFunc.funcStart = func
    }
    set funcMove(func) {
        this.callbackFunc.funcMove = func
    }   

}