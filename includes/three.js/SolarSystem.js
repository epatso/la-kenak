var sunPath;
var myLatitude = d_to_dms(lat);
var myLongitude = d_to_dms(lon);
var myZone = 2;

// Coordinate System
function v(x, y, z) {
    return new THREE.Vector3(x, y, z);
}

function getLatLong(lat,lon) {
		
		var latlong = [0, 0];
		latlong[0] = lat;
		latlong[1] = lon;
		myLatitude = d_to_dms(String(latlong[0]));
		myLongitude = d_to_dms(String(latlong[1]));

		myZone = latlong[1] * 24 / 360;
		document.getElementById("console").innerHTML = "Lat:" + lat + " - Lon:" + lon;
		//showMap(latlong);
		getData(0);
		startSunSystem(myLatitude, myLongitude);
		return latlong;

}

function d_to_dms(d) {
    var a = new Array();

    // if(d < 0) {
    // d = Math.abs(d);
    // }
    var n = d + '';
    var tmp = n.split(".");
    if(tmp[0] == '') {
        tmp[0] = '0'
    }
    a[0] = parseFloat(tmp[0]);
    // n
    n = parseFloat("." + tmp[1]) * 60 + '';
    // min dec
    tmp = n.split(".");
    a[1] = parseFloat(tmp[0]);
    // min
    n = parseFloat("." + tmp[1]) * 60 + '';
    // sec dec
    tmp = n.split(".");
    a[2] = parseFloat(tmp[0]);
    // sec
    return a;
}

function showMap(data) {

    var map = null;

    initialize();

    function initialize() {
        var latlng = new google.maps.LatLng(data[0], data[1]);

        var settings = {
            zoom : 11,
            center : latlng,
            mapTypeControl : false,
            scaleControl : false,
            zoomControl: true,
            controlPosition: false,
            streetViewControl : false,
            mapTypeId : google.maps.MapTypeId.ROADMAP,
            backgroundColor : 'white'
        };
        map = new google.maps.Map(document.getElementById('map_canvas'), settings);
    }

}

function startSunSystem(newLatitude, newLongitude) {

	newLatitude = myLatitude;
    newLongitude = myLongitude;
    var sunPoints = new Array();
    scene.remove(sunPath);
	scene.remove(Analemma);
    var sunPathGeo = new THREE.Geometry();
    var sunPathMat = new THREE.LineBasicMaterial({
        color : 0xff0000
    });

    for(var i = 1; i < 13; i++) {//για κάθε μήνα
        for(var j = 0; j < 80; j++) {//για κάθε ώρα
            myDate[1] = i;
            myTime[0] = 4 + j / 4;
            mySunPosition = calcSun(newLatitude, newLongitude, myZone, mySavings, myDate, myTime);
            var tempSunPos = getLightPos(mySunPosition, 50);
            sunPoints.push(tempSunPos);
            sunPathGeo.vertices.push(v(tempSunPos[1], tempSunPos[2], tempSunPos[0]));//(y, z, x) = (y προς το βάθος, z προς τα πάνω, x προς τα δεξιά)
        };
    };
	
    sunPath = new THREE.Line(sunPathGeo, sunPathMat);
    scene.add(sunPath);
	

	var AnalemmaPathMat = new THREE.LineBasicMaterial({
        color : 0xffffff
    });
	
	for(var h = 0; h < 23; h++) {//για κάθε ώρα
		var AnalemmaGeo = new THREE.Geometry();
		for(var m = 1; m < 13; m++) {//για κάθε μήνα
			myDate[1] = m;
            myTime[0] = h;
			var anPathGeo = calcSun(newLatitude, newLongitude, myZone, mySavings, myDate, myTime);
			var anPathGeo1 = getLightPos(anPathGeo, 50);
			AnalemmaGeo.vertices.push(v(anPathGeo1[1], anPathGeo1[2], anPathGeo1[0]));
		};
		var Analemma = new THREE.Line(AnalemmaGeo, AnalemmaPathMat);
		scene.add(Analemma);
	};
	
}

function getData(n) {
    mySavings = false;
    myDate = [2018, 1, 21];
    myTime = [12, 0, 0];
	
	if(n!=0){
		myDate[1] = parseFloat(document.getElementById('month').value);
		myDate[2] = parseFloat(document.getElementById('day').value);
		myTime[0] = parseFloat(document.getElementById('hour').value);
		myTime[1] = parseFloat(document.getElementById('sec').value);
	}
	
    mySunData;
    mySunPosition = calcSun(myLatitude, myLongitude, myZone, mySavings, myDate, myTime);
    setLightPos(mySunPosition);
}

function getLightPos(mySunPos, dist) {

    var lightZ = dist * Math.sin(mySunPos[3] * (Math.PI / 180));
    var hDist = dist * Math.cos(mySunPos[3] * (Math.PI / 180));
    var lightX = hDist * Math.sin(mySunPos[2] * (Math.PI / 180));
    var lightY = hDist * Math.cos(mySunPos[2] * (Math.PI / 180));
	
    return [lightX, lightY, lightZ];
}

function setLightPos(mySunPos) {
    var dist = 50;

    var lightZ = dist * Math.sin(mySunPos[3] * (Math.PI / 180));
    var hDist = dist * Math.cos(mySunPos[3] * (Math.PI / 180));
    var lightX = hDist * Math.sin(mySunPos[2] * (Math.PI / 180));
    var lightY = hDist * Math.cos(mySunPos[2] * (Math.PI / 180));
	
	//(y, z, x) = (y προς το βάθος, z προς τα πάνω, x προς τα δεξιά)
    light.position.set(lightY, lightZ, lightX);
	sun1.position.set(lightY, lightZ, lightX);
}