"use-strict";
/**
 * AsyncInput is an extension of Input Object
 */
class AsyncInput {

    /**
     * 
     * @param {Input} inputObject 
     */
    constructor(inputObject) {
        
        if(inputObject instanceof Input === false) {

            throw "input has to be an instance of Input"

        }

        this.inputObj = inputObject
        this.asyncState = this.inputObj.state

        
        
    }
    /**
     * For adding event listener
     * 
     * @param {Function} eventFunc (function for testing)
     * @param {mixed} arg (arguments to pass to function)
     */
    addAsyncListener = (eventFunc, arg)=> {

        

            this.inputObj.input.addEventListener('input',  async (e)=> {

                await eventFunc(arg)
               
                
                this._checkState()
              
                
            }) 
            this.inputObj.input.addEventListener('paste', async (e)=> {
    
                await eventFunc(arg)
                this._checkState()

            }) 
        

    }

    //AJAX TESTS

    checkData = async ({dataName, conditionData})=> {
        
        const ajax = new Ajax("api/check/data/user")
        let data = {}
        data[dataName] = this.inputObj.value

        let res =  await ajax.post(data).then((data)=>data).catch((e)=>console.log(e))
        
        this.asyncState = res == conditionData
    
    }

    _checkState = ()=> {

        if(!this.asyncState && this.asyncState != this.inputObj.state) {

            this.inputObj.state = this.asyncState
            console.log(this.inputObj.state);

            this.inputObj.changeStyle()
            
        }

    } 

}