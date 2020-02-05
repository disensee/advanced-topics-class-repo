var dateUtils = dateUtils || {};


/**
* Checks to see if a Date object is more than 18 years prior to the current date
* @method isOldEnoughToVote
*
* @param {Date} birthDate       The date to check.  
* @return {boolean}             True if the date is more than 18 years ago. False if not.
*/
dateUtils.isOldEnoughToVote = function(birthDate){
    /*
    // Note that this approach works 
    //but may not be accurate because it assumes 365 days in every year
    
    var now = new Date();
    var diffInDays = diff(now, birthDate);
    if( (diffInDays > 18 * 365) && (max(now,birthDate) == now) ){
        return true;
    }else{
        return false;
    }
    */
    
    if((birthDate instanceof Date) == false){
        throw Error("Invalid argument, Date object expected");
    }

    var currentYear = new Date().getFullYear();
    var exactly18yearsAgo = new Date();
    exactly18yearsAgo.setFullYear(currentYear - 18);
    exactly18yearsAgo.setHours(23,59,59,999); // make it the last millisecond of the day 18 years ago
    
    //console.log("BIRTHDAY: ",birthDate, "18 Years ago:",exactly18yearsAgo);
    if(birthDate <= exactly18yearsAgo){
        return true;
    }else{
        return false;
    }
}

/**
* Returns the day name for a given date.
* @method getDayName
* @param {Date} date
* @return {string}
*/
dateUtils.getDayName = function(date){
   
}

/**
* Returns the month name for a given date.
* @method getMonthName
* @param {Date} date
* @return {string}
*/
dateUtils.getMonthName = function(date){
   
}



/**
* Converts milliseconds to days.
* @method convertMillisecondsToDays
*
* @param {number} ms
* @return {number}
*/
dateUtils.convertMillisecondsToDays = function(ms){
    
}


/**
* Returns the latter of two Date objects.
* If both Date objects are storing the exact same time, then the first param is returned.
* @method max
*
* @param {Date} date1
* @param {Date} date2
*
* @return {Date}        Returns the latter of the two date params.
*/
dateUtils.max = function(date1, date2){
    
}

/**
* Compares two dates and determines the time difference (in days) between them.
* @method diff
*
* @param {Date} date1
* @param {Date} date2
* 
* @return {number}          The number of days between the two dates.
*/
dateUtils.diff = function(date1, date2){
        
}

/**
* Formats a date to look like this: Sunday January 11, 2018
* @method format
*
* @param {Date} date
* @return {string}
*/
dateUtils.format = function(date){
    
}

