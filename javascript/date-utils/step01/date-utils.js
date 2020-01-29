var dateUtils = dateUtils || {};

/**
* Formats a date to look like this: Sunday January 11, 2018
* @method format
*/
// dateUtils.format = function(){

//     var date = new Date();

//     var monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
//     var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    
//     var monthName = monthNames[date.getMonth()];
//     var dayName = dayNames[date.getDay()];

//     var day = date.getDate();
//     var year = date.getFullYear();
    
//     var formattedDate = dayName + " " + monthName + " " + day + ", " + year;
    
//     alert(formattedDate);
  
// }

dateUtils.formatDay = function(){
    var date = new Date();
    var dayNames = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var dayName = dayNames[date.getDay()];

    return dayName;
}

dateUtils.formatMonth = function(){
    var date = new Date();
    var monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var monthName = monthNames[date.getMonth()];

    return monthName;
}

dateUtils.getDayNumber = function(){
    var today = new Date();
    var dayNumber = today.getDate();

    return dayNumber;
}

dateUtils.getYearNumber = function(){
    var date = new Date();
    var yearNumber = date.getFullYear();

    return yearNumber;
}

dateUtils.format = function(){
    alert("Today is " + dateUtils.formatDay() + " " + dateUtils.formatMonth() + " " + dateUtils.getDayNumber() + ", " + dateUtils.getYearNumber());
}


/**
* Checks to see if a Date object is more than 18 years prior to the current date
* @method isOldEnoughToVote
*
* @param {Date} birthDate		The date to check. 	
* @return {boolean}				True if the date is more than 18 years ago. False if not.
*/
dateUtils.isOldEnoughToVote = function(birthDate){ 
    var today = new Date();
    var votingAgeBirthdate = new Date();
    votingAgeBirthdate = votingAgeBirthdate.setYear((today.getFullYear()) - 18);

    if(birthDate <= votingAgeBirthdate){
        return true;
    }else{
        return false;
    }
}



