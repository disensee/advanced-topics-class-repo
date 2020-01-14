window.addEventListener('load', function(){

    // array of 'images'
    var images = [
      "../images/Jellyfish.jpg",
      "../images/Koala.jpg",
      "../images/Penguins.jpg"
    ];
  
    // The 'target' (the tag in the page that will display our images)
    var mainImg = document.getElementById("mainAnimalImg");
    
    // set up a 'counter' variable to display the 'current' image
    var currentImg = 0;
    
    // display the first image
    mainImg.src = images[currentImg];
  
    // get handles on the buttons
    var btnPrev = document.getElementById("btnPrev");
    var btnNext = document.getElementById("btnNext");
  
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
  
  
  });
  