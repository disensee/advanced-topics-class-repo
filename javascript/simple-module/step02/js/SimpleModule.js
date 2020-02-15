class SimpleModule{

    constructor(options){ 
        console.log(options);
        //Instance variables
        this.container = options.container || null;
        this.firstName = options.firstName || null;
    
        this.template = '<div class="simple-module"> \
                            <div class="first-name"></div> \
                            <input type="button" class="increment" value="Click Me!" /> \
                        </div>';
        
        // We'll keep track of how many times the button gets pressed.
        this.pressCount = 0;
    
        // UI variables
        this.divFirstName;
        this.btnIncrement;

        this.initialize();
    }


    initialize(){
        // inject the template into the page
		this.container.innerHTML = this.template;
		
		// initalize UI variables
		this.divFirstName = this.container.querySelector(".first-name");
		this.btnIncrement = this.container.querySelector(".increment");

		// display the first name in the first name div
		this.divFirstName.innerHTML = "Hello " + this.firstName;

        // hook up event listeners
        let self = this;
		this.btnIncrement.addEventListener("click", function(){
			self.pressCount++;
			self.update();
		});
    }

    update(){
        this.msg = this.firstName + " you have pressed the button " + this.pressCount + " time(s)!";
        this.divFirstName.innerHTML = this.msg;
        return this.msg;
    }

    

}