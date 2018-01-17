function setLatLong(f, index) {
    //Decimal degrees are passed in the array.  Temporarily store these decimal
    // degs in lat and lon deg and have convLatLong modify them.
    f["latDeg"].value = City[index].lat;
    f["lonDeg"].value = City[index].lng;

    //These are needed to prevent iterative adding of min and sec when set
    //button is clicked.
    f["latMin"].value = 0;
    f["latSec"].value = 0;
    f["lonMin"].value = 0;
    f["lonSec"].value = 0;

    //call convLatLong to convert decimal degrees into table form.
    convLatLong(f);

    //Local time zone value set in table
    f["hrsToGMT"].value = City[index].zoneHr;
}

//  'isLeapYear' returns '1' if the yr is a leap year, '0' if it is not.

function isLeapYear(yr) {
    return ((yr % 4 == 0 && yr % 100 != 0) || yr % 400 == 0);
}

//*********************************************************************/

// isPosInteger returns false if the value is not a positive integer, true is
// returned otherwise.  The code is from taken from Danny Goodman's Javascript
// Handbook, p. 372.

function isPosInteger(inputVal) {
    inputStr = "" + inputVal;
    for(var i = 0; i < inputStr.length; i++) {
        var oneChar = inputStr.charAt(i);
        if(oneChar < "0" || oneChar > "9")
            return false;
    }
    return true;
}

//*********************************************************************/

function isInteger(inputVal) {
    inputStr = "" + inputVal;
    if(inputStr == "NaN")
        return false;
    if(inputStr == "-NaN")
        return false;
    for(var i = 0; i < inputStr.length; i++) {
        var oneChar = inputStr.charAt(i);
        if(i == 0 && (oneChar == "-" || oneChar == "+")) {
            continue;
        }
        if(oneChar < "0" || oneChar > "9") {
            return false;
        }
    }
    return true;
}

//*********************************************************************/

function isNumber(inputVal) {
    var oneDecimal = false;
    var inputStr = "" + inputVal;
    for(var i = 0; i < inputStr.length; i++) {
        var oneChar = inputStr.charAt(i);
        if(i == 0 && (oneChar == "-" || oneChar == "+")) {
            continue;
        }
        if(oneChar == "." && !oneDecimal) {
            oneDecimal = true;
            continue;
        }
        if(oneChar < "0" || oneChar > "9") {
            return false;
        }
    }
    return true;
}

//  'isValidInput' makes sure valid input is entered before calculating
//  the sunrise and sunset.  False is returned if an invalid entry was made,
//  true if the entry is valid.

function isValidInput(f, index, latLongForm) {
    if(f["day"].value == "") {//    see if the day field is empty
        alert("You must enter a day before attempting the calculation.");
        return false;
    } else if(f["year"].value == "") {// see if year field is empty
        alert("You must enter a year before attempting the calculation.");
        return false;
    } else if(!isPosInteger(f["day"].value) || f["day"].value == 0) {
        alert("The day must be a positive integer.");
        return false;
    } else if(!isPosInteger(f["year"].value)) {
        alert("The year must be a positive integer.");
        return false;
    } else if(f["hour"].value == "") {// see if hour field is empty
        alert("You must enter a time before attempting the calculation.");
        return false;
    } else if(!isPosInteger(f["hour"].value) || !isPosInteger(f["mins"].value) || !isPosInteger(f["secs"].value)) {
        alert("The time fields must contain positive integers.");
        return false;
    }

    // else if ( ((f["ampm"].value == "AM") || (f["ampm"].value == "PM")) && (f["hour"].value > 12) )
    //      {
    //          alert("AM/PM hour must be between 0 and 12.");
    //          return false;
    //      }
    //      else if ( (f["ampm"].value == "24") && (f["hour"].value > 23) )
    //      {
    //          alert("Hour must be between 0 and 23.");
    //          return false;
    //      }
    else if((f["hour"].value > 23)) {
        alert("Hour must be between 0 and 23.");
        return false;
    } else if(f["mins"].value > 59) {
        alert("Minutes must be between 0 and 59.");
        return false;
    } else if(f["secs"].value > 59) {
        alert("Seconds must be between 0 and 59.");
        return false;
    }

    //  For the non-February months see if the day entered is greater than
    //  the number of days in the selected month
    
else if((index != 1) && (f["day"].value > monthList[index].numdays)) {
        alert("There are only " + monthList[index].numdays + " days in " + monthList[index].name + ".");
        return false;
    }

    //  First see if the year entered is a leap year.  If so we have to make sure
    //  the days entered is <= 29.  If not a leap year we make sure that the days
    //  entered is <= 28.
    
else if(index == 1) {//  month selected is February
        if(isLeapYear(f["year"].value)) {// year is a leap year
            if(f["day"].value > (monthList[index].numdays + 1)) {
                alert("There are only " + (monthList[index].numdays + 1) + " days in " + monthList[index].name + ".");
                return false;
            } else
                return true;
        } else {//  year entered is not a leap year
            if(f["day"].value > monthList[index].numdays) {
                alert("There are only " + monthList[index].numdays + " days in " + monthList[index].name + ".");
                return false;
            } else
                return true;
        }
    } else
        return true;
}

//convLatLong converts any type of lat/long input
//into  the table form and then handles bad input
//it is nested in the calcSun function.

function convLatLong(f) {

    if(f["latDeg"].value == "") {
        f["latDeg"].value = 0;
    }
    if(f["latMin"].value == "") {
        f["latMin"].value = 0;
    }
    if(f["latSec"].value == "") {
        f["latSec"].value = 0;
    }
    if(f["lonDeg"].value == "") {
        f["lonDeg"].value = 0;
    }
    if(f["lonMin"].value == "") {
        f["lonMin"].value = 0;
    }
    if(f["lonSec"].value == "") {
        f["lonSec"].value = 0;
    }

    var neg = 0;
    if(f["latDeg"].value.charAt(0) == '-') {
        neg = 1;
    }

    if(neg != 1) {
        var latSeconds = (parseFloat(f["latDeg"].value)) * 3600 + parseFloat(f["latMin"].value) * 60 + parseFloat(f["latSec"].value) * 1;

        f["latDeg"].value = Math.floor(latSeconds / 3600);
        f["latMin"].value = Math.floor((latSeconds - (parseFloat(f["latDeg"].value) * 3600)) / 60);
        f["latSec"].value = Math.floor((latSeconds - (parseFloat(f["latDeg"].value) * 3600) - (parseFloat(f["latMin"].value) * 60)) + 0.5);

    } else if(parseFloat(f["latDeg"].value) > -1) {
        var latSeconds = parseFloat(f["latDeg"].value) * 3600 - parseFloat(f["latMin"].value) * 60 - parseFloat(f["latSec"].value) * 1;

        f["latDeg"].value = "-0";
        f["latMin"].value = Math.floor((-latSeconds) / 60);
        f["latSec"].value = Math.floor((-latSeconds - (parseFloat(f["latMin"].value) * 60)) + 0.5);

    } else {
        var latSeconds = parseFloat(f["latDeg"].value) * 3600 - parseFloat(f["latMin"].value) * 60 - parseFloat(f["latSec"].value) * 1;

        f["latDeg"].value = Math.ceil(latSeconds / 3600);
        f["latMin"].value = Math.floor((-latSeconds + (parseFloat(f["latDeg"].value) * 3600)) / 60);
        f["latSec"].value = Math.floor((-latSeconds + (parseFloat(f["latDeg"].value) * 3600) - (parseFloat(f["latMin"].value) * 60)) + 0.5);
    }
    neg = 0;
    if(f["lonDeg"].value.charAt(0) == '-') {
        neg = 1;
    }

    if(neg != 1) {
        var lonSeconds = parseFloat(f["lonDeg"].value) * 3600 + parseFloat(f["lonMin"].value) * 60 + parseFloat(f["lonSec"].value) * 1;
        f["lonDeg"].value = Math.floor(lonSeconds / 3600);
        f["lonMin"].value = Math.floor((lonSeconds - (parseFloat(f["lonDeg"].value) * 3600)) / 60);
        f["lonSec"].value = Math.floor((lonSeconds - (parseFloat(f["lonDeg"].value) * 3600) - (parseFloat(f["lonMin"].value)) * 60) + 0.5);
    } else if(parseFloat(f["lonDeg"].value) > -1) {
        var lonSeconds = parseFloat(f["lonDeg"].value) * 3600 - parseFloat(f["lonMin"].value) * 60 - parseFloat(f["lonSec"].value) * 1;

        f["lonDeg"].value = "-0";
        f["lonMin"].value = Math.floor((-lonSeconds) / 60);
        f["lonSec"].value = Math.floor((-lonSeconds - (parseFloat(f["lonMin"].value) * 60)) + 0.5);

    } else {
        var lonSeconds = parseFloat(f["lonDeg"].value) * 3600 - parseFloat(f["lonMin"].value) * 60 - parseFloat(f["lonSec"].value) * 1;
        f["lonDeg"].value = Math.ceil(lonSeconds / 3600);
        f["lonMin"].value = Math.floor((-lonSeconds + (parseFloat(f["lonDeg"].value) * 3600)) / 60);
        f["lonSec"].value = Math.floor((-lonSeconds + (parseFloat(f["lonDeg"].value) * 3600) - (parseFloat(f["lonMin"].value) * 60)) + 0.5);
    }
    //Test for invalid lat/long input

    if(latSeconds > 323280) {
        alert("You have entered an invalid latitude.\nSetting lat=89.8.");
        f["latDeg"].value = 89.8;
        f["latMin"].value = 0;
        f["latSec"].value = 0;
    }
    if(latSeconds < -323280) {
        alert("You have entered an invalid latitude.\n  Setting lat= -89.8.");
        f["latDeg"].value = -89.8;
        f["latMin"].value = 0;
        f["latSec"].value = 0;
    }
    if(lonSeconds > 648000) {
        alert("You have entered an invalid longitude.\n Setting lon= 180.");
        f["lonDeg"].value = 180;
        f["lonMin"].value = 0;
        f["lonSec"].value = 0;
    }
    if(lonSeconds < -648000) {
        alert("You have entered an invalid latitude.\n Setting lon= -180.");
        f["lonDeg"].value = -180;
        f["lonMin"].value = 0;
        f["lonSec"].value = 0;
    }
}

//***********************************************************************/
//***********************************************************************/
//*                                             */
//*This section contains subroutines used in calculating solar position */
//*                                             */
//***********************************************************************/
//***********************************************************************/

// Convert radian angle to degrees

function radToDeg(angleRad) {
    return (180.0 * angleRad / Math.PI);
}

//*********************************************************************/

// Convert degree angle to radians

function degToRad(angleDeg) {
    return (Math.PI * angleDeg / 180.0);
}

//*********************************************************************/

//***********************************************************************/
//* Name:    calcDayOfYear                              */
//* Type:    Function                                   */
//* Purpose: Finds numerical day-of-year from mn, day and lp year info  */
//* Arguments:                                      */
//*   month: January = 1                                */
//*   day  : 1 - 31                                 */
//*   lpyr : 1 if leap year, 0 if not                       */
//* Return value:                                       */
//*   The numerical day of year                         */
//***********************************************************************/

function calcDayOfYear(mn, dy, lpyr) {
    var k = ( lpyr ? 1 : 2);
    var doy = Math.floor((275 * mn) / 9) - k * Math.floor((mn + 9) / 12) + dy - 30;
    return doy;
}

//***********************************************************************/
//* Name:    calcDayOfWeek                              */
//* Type:    Function                                   */
//* Purpose: Derives weekday from Julian Day                    */
//* Arguments:                                      */
//*   juld : Julian Day                                 */
//* Return value:                                       */
//*   String containing name of weekday                     */
//***********************************************************************/

function calcDayOfWeek(juld) {
    var A = (juld + 1.5) % 7;
    var DOW = (A == 0) ? "Sunday" : (A == 1) ? "Monday" : (A == 2) ? "Tuesday" : (A == 3) ? "Wednesday" : (A == 4) ? "Thursday" : (A == 5) ? "Friday" : "Saturday";
    return DOW;
}

//***********************************************************************/
//* Name:    calcJD                                 */
//* Type:    Function                                   */
//* Purpose: Julian day from calendar day                       */
//* Arguments:                                      */
//*   year : 4 digit year                               */
//*   month: January = 1                                */
//*   day  : 1 - 31                                 */
//* Return value:                                       */
//*   The Julian day corresponding to the date                  */
//* Note:                                           */
//*   Number is returned for start of day.  Fractional days should be   */
//*   added later.                                  */
//***********************************************************************/

function calcJD(year, month, day) {
    if(month <= 2) {
        year -= 1;
        month += 12;
    }
    var A = Math.floor(year / 100);
    var B = 2 - A + Math.floor(A / 4);

    var JD = Math.floor(365.25 * (year + 4716)) + Math.floor(30.6001 * (month + 1)) + day + B - 1524.5;
    return JD;
}

//***********************************************************************/
//* Name:    calcDateFromJD                             */
//* Type:    Function                                   */
//* Purpose: Calendar date from Julian Day                  */
//* Arguments:                                      */
//*   jd   : Julian Day                                 */
//* Return value:                                       */
//*   String date in the form DD-MONTHNAME-YYYY                 */
//* Note:                                           */
//***********************************************************************/

function calcDateFromJD(jd) {
    var z = Math.floor(jd + 0.5);
    var f = (jd + 0.5) - z;

    if(z < 2299161) {
        var A = z;
    } else {
        alpha = Math.floor((z - 1867216.25) / 36524.25);
        var A = z + 1 + alpha - Math.floor(alpha / 4);
    }

    var B = A + 1524;
    var C = Math.floor((B - 122.1) / 365.25);
    var D = Math.floor(365.25 * C);
    var E = Math.floor((B - D) / 30.6001);

    var day = B - D - Math.floor(30.6001 * E) + f;
    var month = (E < 14) ? E - 1 : E - 13;
    var year = (month > 2) ? C - 4716 : C - 4715;

    // alert ("date: " + day + "-" + monthList[month-1].name + "-" + year);
    return (day + "-" + monthList[month - 1].name + "-" + year);
}

//***********************************************************************/
//* Name:    calcDayFromJD                              */
//* Type:    Function                                   */
//* Purpose: Calendar day (minus year) from Julian Day          */
//* Arguments:                                      */
//*   jd   : Julian Day                                 */
//* Return value:                                       */
//*   String date in the form DD-MONTH                      */
//***********************************************************************/

function calcDayFromJD(jd) {
    var z = Math.floor(jd + 0.5);
    var f = (jd + 0.5) - z;

    if(z < 2299161) {
        var A = z;
    } else {
        alpha = Math.floor((z - 1867216.25) / 36524.25);
        var A = z + 1 + alpha - Math.floor(alpha / 4);
    }

    var B = A + 1524;
    var C = Math.floor((B - 122.1) / 365.25);
    var D = Math.floor(365.25 * C);
    var E = Math.floor((B - D) / 30.6001);

    var day = B - D - Math.floor(30.6001 * E) + f;
    var month = (E < 14) ? E - 1 : E - 13;
    var year = (month > 2) ? C - 4716 : C - 4715;

    return ((day < 10 ? "0" : "") + day + monthList[month - 1].abbr);
}

//***********************************************************************/
//* Name:    calcTimeJulianCent                         */
//* Type:    Function                                   */
//* Purpose: convert Julian Day to centuries since J2000.0.         */
//* Arguments:                                      */
//*   jd : the Julian Day to convert                        */
//* Return value:                                       */
//*   the T value corresponding to the Julian Day               */
//***********************************************************************/

function calcTimeJulianCent(jd) {
    var T = (jd - 2451545.0) / 36525.0;
    return T;
}

//***********************************************************************/
//* Name:    calcJDFromJulianCent                           */
//* Type:    Function                                   */
//* Purpose: convert centuries since J2000.0 to Julian Day.         */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   the Julian Day corresponding to the t value               */
//***********************************************************************/

function calcJDFromJulianCent(t) {
    var JD = t * 36525.0 + 2451545.0;
    return JD;
}

//***********************************************************************/
//* Name:    calGeomMeanLongSun                         */
//* Type:    Function                                   */
//* Purpose: calculate the Geometric Mean Longitude of the Sun      */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   the Geometric Mean Longitude of the Sun in degrees            */
//***********************************************************************/

function calcGeomMeanLongSun(t) {
    var L0 = 280.46646 + t * (36000.76983 + 0.0003032 * t);
    while(L0 > 360.0) {
        L0 -= 360.0;
    }
    while(L0 < 0.0) {
        L0 += 360.0;
    }
    return L0;
    // in degrees
}

//***********************************************************************/
//* Name:    calGeomAnomalySun                          */
//* Type:    Function                                   */
//* Purpose: calculate the Geometric Mean Anomaly of the Sun        */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   the Geometric Mean Anomaly of the Sun in degrees          */
//***********************************************************************/

function calcGeomMeanAnomalySun(t) {
    var M = 357.52911 + t * (35999.05029 - 0.0001537 * t);
    return M;
    // in degrees
}

//***********************************************************************/
//* Name:    calcEccentricityEarthOrbit                     */
//* Type:    Function                                   */
//* Purpose: calculate the eccentricity of earth's orbit            */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   the unitless eccentricity                         */
//***********************************************************************/

function calcEccentricityEarthOrbit(t) {
    var e = 0.016708634 - t * (0.000042037 + 0.0000001267 * t);
    return e;
    // unitless
}

//***********************************************************************/
//* Name:    calcSunEqOfCenter                          */
//* Type:    Function                                   */
//* Purpose: calculate the equation of center for the sun           */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   in degrees                                        */
//***********************************************************************/

function calcSunEqOfCenter(t) {
    var m = calcGeomMeanAnomalySun(t);

    var mrad = degToRad(m);
    var sinm = Math.sin(mrad);
    var sin2m = Math.sin(mrad + mrad);
    var sin3m = Math.sin(mrad + mrad + mrad);

    var C = sinm * (1.914602 - t * (0.004817 + 0.000014 * t)) + sin2m * (0.019993 - 0.000101 * t) + sin3m * 0.000289;
    return C;
    // in degrees
}

//***********************************************************************/
//* Name:    calcSunTrueLong                                */
//* Type:    Function                                   */
//* Purpose: calculate the true longitude of the sun                */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   sun's true longitude in degrees                       */
//***********************************************************************/

function calcSunTrueLong(t) {
    var l0 = calcGeomMeanLongSun(t);
    var c = calcSunEqOfCenter(t);

    var O = l0 + c;
    return O;
    // in degrees
}

//***********************************************************************/
//* Name:    calcSunTrueAnomaly                         */
//* Type:    Function                                   */
//* Purpose: calculate the true anamoly of the sun              */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   sun's true anamoly in degrees                         */
//***********************************************************************/

function calcSunTrueAnomaly(t) {
    var m = calcGeomMeanAnomalySun(t);
    var c = calcSunEqOfCenter(t);

    var v = m + c;
    return v;
    // in degrees
}

//***********************************************************************/
//* Name:    calcSunRadVector                               */
//* Type:    Function                                   */
//* Purpose: calculate the distance to the sun in AU                */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   sun radius vector in AUs                          */
//***********************************************************************/

function calcSunRadVector(t) {
    var v = calcSunTrueAnomaly(t);
    var e = calcEccentricityEarthOrbit(t);

    var R = (1.000001018 * (1 - e * e)) / (1 + e * Math.cos(degToRad(v)));
    return R;
    // in AUs
}

//***********************************************************************/
//* Name:    calcSunApparentLong                            */
//* Type:    Function                                   */
//* Purpose: calculate the apparent longitude of the sun            */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   sun's apparent longitude in degrees                       */
//***********************************************************************/

function calcSunApparentLong(t) {
    var o = calcSunTrueLong(t);

    var omega = 125.04 - 1934.136 * t;
    var lambda = o - 0.00569 - 0.00478 * Math.sin(degToRad(omega));
    return lambda;
    // in degrees
}

//***********************************************************************/
//* Name:    calcMeanObliquityOfEcliptic                        */
//* Type:    Function                                   */
//* Purpose: calculate the mean obliquity of the ecliptic           */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   mean obliquity in degrees                         */
//***********************************************************************/

function calcMeanObliquityOfEcliptic(t) {
    var seconds = 21.448 - t * (46.8150 + t * (0.00059 - t * (0.001813)));
    var e0 = 23.0 + (26.0 + (seconds / 60.0)) / 60.0;
    return e0;
    // in degrees
}

//***********************************************************************/
//* Name:    calcObliquityCorrection                        */
//* Type:    Function                                   */
//* Purpose: calculate the corrected obliquity of the ecliptic      */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   corrected obliquity in degrees                        */
//***********************************************************************/

function calcObliquityCorrection(t) {
    var e0 = calcMeanObliquityOfEcliptic(t);

    var omega = 125.04 - 1934.136 * t;
    var e = e0 + 0.00256 * Math.cos(degToRad(omega));
    return e;
    // in degrees
}

//***********************************************************************/
//* Name:    calcSunRtAscension                         */
//* Type:    Function                                   */
//* Purpose: calculate the right ascension of the sun               */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   sun's right ascension in degrees                      */
//***********************************************************************/

function calcSunRtAscension(t) {
    var e = calcObliquityCorrection(t);
    var lambda = calcSunApparentLong(t);

    var tananum = (Math.cos(degToRad(e)) * Math.sin(degToRad(lambda)));
    var tanadenom = (Math.cos(degToRad(lambda)));
    var alpha = radToDeg(Math.atan2(tananum, tanadenom));
    return alpha;
    // in degrees
}

//***********************************************************************/
//* Name:    calcSunDeclination                         */
//* Type:    Function                                   */
//* Purpose: calculate the declination of the sun               */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   sun's declination in degrees                          */
//***********************************************************************/

function calcSunDeclination(t) {
    var e = calcObliquityCorrection(t);
    var lambda = calcSunApparentLong(t);

    var sint = Math.sin(degToRad(e)) * Math.sin(degToRad(lambda));
    var theta = radToDeg(Math.asin(sint));
    return theta;
    // in degrees
}

//***********************************************************************/
//* Name:    calcEquationOfTime                         */
//* Type:    Function                                   */
//* Purpose: calculate the difference between true solar time and mean  */
//*     solar time                                  */
//* Arguments:                                      */
//*   t : number of Julian centuries since J2000.0              */
//* Return value:                                       */
//*   equation of time in minutes of time                       */
//***********************************************************************/

function calcEquationOfTime(t) {
    var epsilon = calcObliquityCorrection(t);
    var l0 = calcGeomMeanLongSun(t);
    var e = calcEccentricityEarthOrbit(t);
    var m = calcGeomMeanAnomalySun(t);

    var y = Math.tan(degToRad(epsilon) / 2.0);
    y *= y;

    var sin2l0 = Math.sin(2.0 * degToRad(l0));
    var sinm = Math.sin(degToRad(m));
    var cos2l0 = Math.cos(2.0 * degToRad(l0));
    var sin4l0 = Math.sin(4.0 * degToRad(l0));
    var sin2m = Math.sin(2.0 * degToRad(m));

    var Etime = y * sin2l0 - 2.0 * e * sinm + 4.0 * e * y * sinm * cos2l0 - 0.5 * y * y * sin4l0 - 1.25 * e * e * sin2m;

    return radToDeg(Etime) * 4.0;
    // in minutes of time
}

// Return the hour angle for the given location, decl, and time of day

function calcHourAngle(time, longitude, eqtime) {
    return (15.0 * (time - (longitude / 15.0) - (eqtime / 60.0)));
    // in degrees
}

// Returns decimal latitude from deg, min, sec entered in the form

function getLatitude(myLatitude) {
    var neg = 0;
    var degs = parseFloat(myLatitude[0]);
    if(myLatitude[0]<0) {
        neg = 1;
    }

    var mins = myLatitude[1];

    var secs = myLatitude[2];

    if(neg != 1) {
        var decLat = degs + (mins / 60) + (secs / 3600);
    } else if(neg == 1) {
        var decLat = degs - (mins / 60) - (secs / 3600);
    } else {
        return -9999;
    }
    return decLat;

}

// Returns decimal longitude from the deg, min, sec entered in the form

function getLongitude(myLongitude) {
    var neg = 0;
    var degs = myLongitude[0];
    if(myLongitude<0) {
        neg = 1;
    }

    var mins = myLongitude[1];

    var secs = myLongitude[2];

    var decLon = degs + (mins / 60) + (secs / 3600);

    if(neg != 1) {
        var decLon = degs + (mins / 60) + (secs / 3600);
    } else if(neg == 1) {
        var decLon = degs - (mins / 60) - (secs / 3600);
    } else {
        return -9999;
    }
    return decLon;

}

// *****************************************************
// *****************************************************
// ***********  Main calculation routine  **************
// *****************************************************
// *****************************************************

//***********************************************************************/
//* Name:    calcSun                                    */
//* Type:    Main Function called by form controls              */
//* Purpose: calculate solar position for the entered date, time and    */
//*     location.  Results are reported in azimuth and elevation    */
//*     (in degrees) and cosine of solar zenith angle.          */
//* Arguments:                                      */
//*   riseSetForm : for displaying results                  */
//*   latLongForm : for reading latitude and longitude data         */
//*   index : daylight saving yes/no select                 */
//*   index2 : city select index                            */
//* Return value:                                       */
//*   none                                          */
//* (fills riseSetForm text fields with results of calculations)    */
//***********************************************************************/
var mySunData = [0, 0, 0, 0, 0];

function calcSun(myLatitude, myLongitude, myZone, mySavings, myDate, myTime) {
    
    var latitude = getLatitude(myLatitude);
    var longitude = getLongitude(myLongitude);
    var indexRS = myDate[1];
    var zone = myZone;
    var daySavings = mySavings;

    var ss = myTime[2];
    var mm = myTime[1];
    var hh = myTime[0]; - (daySavings / 60);
    
    while(hh > 23) {
        hh -= 24;
    }

    // timenow is GMT time for calculation
    timenow = hh + mm / 60 + ss / 3600 + zone;
    // in hours since 0Z
    //alert("timenow = " + timenow);

    var JD = (calcJD(myDate[0], indexRS + 1, myDate[2]));
    var dow = calcDayOfWeek(JD);
    var doy = calcDayOfYear(indexRS + 1, myDate[2], isLeapYear(myDate[0]));
    var T = calcTimeJulianCent(JD + timenow / 24.0);
    //var L0 = calcGeomMeanLongSun(T);
    //var M = calcGeomMeanAnomalySun(T);
    //var e = calcEccentricityEarthOrbit(T);
    //var C = calcSunEqOfCenter(T);
    //var O = calcSunTrueLong(T);
    //var v = calcSunTrueAnomaly(T);
    var R = calcSunRadVector(T);
    //var lambda = calcSunApparentLong(T);
    //var epsilon0 = calcMeanObliquityOfEcliptic(T);
    //var epsilon = calcObliquityCorrection(T);
    var alpha = calcSunRtAscension(T);
    var theta = calcSunDeclination(T);
    var Etime = calcEquationOfTime(T);

    var eqTime = Etime;
    var solarDec = theta;
    // in degrees
    var earthRadVec = R;

    mySunData[0] = (Math.floor(100 * eqTime)) / 100;
    mySunData[1] = (Math.floor(100 * (solarDec))) / 100;

    var solarTimeFix = eqTime - 4.0 * longitude + 60.0 * zone;
    var trueSolarTime = hh * 60.0 + mm + ss / 60.0 + solarTimeFix;
    // in minutes

    while(trueSolarTime > 1440) {
        trueSolarTime -= 1440;
    }

    //var hourAngle = calcHourAngle(timenow, longitude, eqTime);
    var hourAngle = trueSolarTime / 4.0 - 180.0;
    // Thanks to Louis Schwarzmayr for finding our error,
    // and providing the following 4 lines to fix it:
    if(hourAngle < -180) {
        hourAngle += 360.0;
    }
    // alert ("Hour Angle = " + hourAngle);

    var haRad = degToRad(hourAngle);

    var csz = Math.sin(degToRad(latitude)) * Math.sin(degToRad(solarDec)) + Math.cos(degToRad(latitude)) * Math.cos(degToRad(solarDec)) * Math.cos(haRad);
    if(csz > 1.0) {
        csz = 1.0;
    } else if(csz < -1.0) {
        csz = -1.0;
    }
    var zenith = radToDeg(Math.acos(csz));

    var azDenom = (Math.cos(degToRad(latitude)) * Math.sin(degToRad(zenith)) );
    if(Math.abs(azDenom) > 0.001) {
        azRad = ((Math.sin(degToRad(latitude)) * Math.cos(degToRad(zenith)) ) - Math.sin(degToRad(solarDec))) / azDenom;
        if(Math.abs(azRad) > 1.0) {
            if(azRad < 0) {
                azRad = -1.0;
            } else {
                azRad = 1.0;
            }
        }

        var azimuth = 180.0 - radToDeg(Math.acos(azRad));

        if(hourAngle > 0.0) {
            azimuth = -azimuth;
        }
    } else {
        if(latitude > 0.0) {
            azimuth = 180.0;
        } else {
            azimuth = 0.0;
        }
    }
    if(azimuth < 0.0) {
        azimuth += 360.0;
    }
    exoatmElevation = 90.0 - zenith;
    if(exoatmElevation > 85.0) {
        refractionCorrection = 0.0;
    } else {
        te = Math.tan(degToRad(exoatmElevation));
        if(exoatmElevation > 5.0) {
            refractionCorrection = 58.1 / te - 0.07 / (te * te * te) + 0.000086 / (te * te * te * te * te);
        } else if(exoatmElevation > -0.575) {
            refractionCorrection = 1735.0 + exoatmElevation * (-518.2 + exoatmElevation * (103.4 + exoatmElevation * (-12.79 + exoatmElevation * 0.711) ) );
        } else {
            refractionCorrection = -20.774 / te;
        }
        refractionCorrection = refractionCorrection / 3600.0;
    }
    solarZen = zenith - refractionCorrection;

    if(solarZen < 108.0) {// astronomical twilight
        mySunData[2] = (Math.floor(100 * azimuth)) / 100;
        mySunData[3] = (Math.floor(100 * (90.0 - solarZen))) / 100;
        if(solarZen < 90.0) {
            mySunData[4] = (Math.floor(10000.0 * (Math.cos(degToRad(solarZen))))) / 10000.0;
        } else {
            mySunData[4] = 0.0;
        }
    } else {// do not report az & el after astro twilight
        mySunData[2] = "dark";
        mySunData[3] = "dark";
        mySunData[4] = 0.0;
    }

    return mySunData;
    //***********Conv lat and long
    //convLatLong(latLongForm);
}
