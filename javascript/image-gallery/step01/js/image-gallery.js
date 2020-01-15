window.addEventListener('load', function(){

  // array of 'images'
  var images = [
    "../images/Desert.jpg",
    "../images/Lighthouse.jpg",
    "../images/Tulips.jpg"
  ];

  var animalImages = [
    "../images/Jellyfish.jpg",
    "../images/Koala.jpg",
    "../images/Penguins.jpg"
  ];

  // The 'target' (the tag in the page that will display our images)
  if(document.title == "Landscapes"){
    var mainImg = document.getElementById("mainImg");
  }else if(this.document.title == "Animals"){
    var mainImg = this.document.getElementById("mainAnimalImg");
  }
  
  // set up a 'counter' variable to display the 'current' image
  var currentImg = 0;
  
  // display the first image
  if(document.title == "Landscapes"){
    mainImg.src = images[currentImg];
  }else if(this.document.title == "Animals"){
    mainImg.src = animalImages[currentImg];
  }
  
  
  // get handles on the buttons
  var btnPrev = document.getElementById("btnPrev");
  var btnNext = document.getElementById("btnNext");

 // set up event handlers
  btnNext.addEventListener('click', function(){
    currentImg++;
    if(currentImg == images.length){
       currentImg = 0;     
    }
    if(document.title == "Landscapes"){
      mainImg.src = images[currentImg];
    }else if(document.title == "Animals"){
      mainImg.src = animalImages[currentImg];
    }
  });

  btnPrev.addEventListener('click', function(){
    currentImg--;
    if(currentImg == -1){
        currentImg = images.length -1;    
    }
    if(document.title == "Landscapes"){
      mainImg.src = images[currentImg];
    }else if(document.title == "Animals"){
      mainImg.src = animalImages[currentImg];
    }
  });


});
