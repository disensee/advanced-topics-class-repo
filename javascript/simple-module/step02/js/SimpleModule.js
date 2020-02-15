class SimpleModule{

    constructor(options){ 
        console.log(options);
        //////////////////////////////////////////
	    // INSTANCE VARIABLES/////////////////////
	    //////////////////////////////////////////
        this.container = this.options.container || null;
        this.firstName = this.options.firstName || null;
    
        this.template = '<div class="simple-module"> \
                            <div class="first-name"></div> \
                            <input type="button" class="increment" value="Click Me!" /> \
                        </div>';
        
        // We'll keep track of how many times the button gets pressed.
        this.pressCount = 0;
    
        // UI variables
        this.divFirstName;
        this.btnIncrement;
    }

    

}