var isenseeimages = isenseeimages || {};
/**
* Creates a gallery of images on a page.
* @module ImageGallery
*
* @param {HTMLElement} container      The HTML tag on the page that will contain the image gallery
* @param {array} images               An array of strings where each string is a path to an image.
*/
isenseeimages.ImageGallery = function(container, images){

  // TODO: what if the contanier param is not a valid html tag???
  // TODO: what if the images param is not a valid???
  // This module is not bullet proof!

  // create the HTML tags needed for the image gallery
  var html = '<div class="img-gallery"> \
                <div class="img-wrapper"> \
                  <img class="mainImg" /> \
                </div> \
                <br> \
                <input type="button" class="btnPrev" value="Prev" /> \
                &nbsp; \
                <input type="button" class="btnNext" value="Next" /> \
              </div>';

  // inject the HTML into the container
  container.innerHTML = html;

  // set up a 'counter' variable to display the 'current' image
  var currentImg = 0;
  // get a handle on the img tag in the html
  var mainImg = container.querySelector(".mainImg");
  // get handles on the buttons
  var btnPrev = container.querySelector(".btnPrev");
  var btnNext = container.querySelector(".btnNext");

  // display the first image
  mainImg.src = images[currentImg];

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