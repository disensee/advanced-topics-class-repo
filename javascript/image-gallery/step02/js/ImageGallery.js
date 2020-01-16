/**
* Creates a gallery of images on a page.
* @class ImageGallery
*/

class ImageGallery {

	/**
	* @param {HTMLElement} container      The HTML tag on the page that will contain the image gallery
	* @param {array} images               An array of strings where each string is a path to an image.
	*/
	constructor(container,images) {
		
		// apparently instance letiables are declared inside the constructor, with 'this'
		this.container = container;
		this.images = images;
	  
		// create the HTML tags needed for the image gallery
		let html = '<div class="img-gallery"> \
						<div class="img-wrapper"> \
						  <img class="mainImg" /> \
						</div> \
						<br> \
						<input type="button" class="btnPrev" value="Prev" /> \
						&nbsp; \
						<input type="button" class="btnNext" value="Next" /> \
					</div>';

		// inject the HTML into the container
		this.container.innerHTML = html;

		// set up a 'counter' letiable to display the 'current' image
		let currentImg = 0;
		// get a handle on the img tag in the html
		let mainImg = this.container.querySelector(".mainImg");
		// get handles on the buttons
		let btnPrev = this.container.querySelector(".btnPrev");
		let btnNext = this.container.querySelector(".btnNext");

		// display the first image
		mainImg.src = this.images[currentImg];

		// set up event handlers
		btnNext.addEventListener('click', function(){
			currentImg++;
			if(currentImg == images.length){
			   currentImg = 0;     
			}
			mainImg.src = images[currentImg];
		});

		btnPrev.addEventListener('click', function(){
			currentImg--;
			if(currentImg == -1){
				currentImg = images.length -1;    
			}
			mainImg.src = images[currentImg];
		});
	  
	}
}


