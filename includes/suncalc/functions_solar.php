<?php
// calculates the sun position and path throughout the day
// input params: LAT&LON
// output json
 
// not much commenting in code
// ported from http://www.stjarnhimlen.se/comp/tutorial.html
// MANY THANKS!
// most var-names are identical to above tutorial
 
 
$LAT = deg2rad($_GET["lat"]);
$LON = deg2rad($_GET["lon"]);
 
 
$year = gmdate("Y");
$month = gmdate("m");
$day = gmdate("d");
$hour = gmdate("H") + (gmdate("i") / 60);
 
// get current position
getsunpos($LAT, $LON, $year, $month, $day, $hour, $azimuth, $altitude, $sunstate);
 
// get 3 points during day to create circle
getsunpos($LAT, $LON, $year, $month, $day, 1, $azm1, $alt1, $ignore);
getsunpos($LAT, $LON, $year, $month, $day, 9, $azm2, $alt2, $ignore);
getsunpos($LAT, $LON, $year, $month, $day, 13, $azm3, $alt3, $ignore);
 
// transform altitude from radians to number from 0 to 1
$alt1 = ((pi()/2) - $alt1) / (pi()/2);
$alt2 = ((pi()/2) - $alt2) / (pi()/2);
$alt3 = ((pi()/2) - $alt3) / (pi()/2);
 
// polar to cartesian
$x1 = cos($azm1) * $alt1; $y1 = sin($azm1) * $alt1;
$x2 = cos($azm2) * $alt2; $y2 = sin($azm2) * $alt2;
$x3 = cos($azm3) * $alt3; $y3 = sin($azm3) * $alt3;
 
findCentre($x1,$y1,$x2,$y2,$x3,$y3,$cx,$cy,$r);
 
echo "{\"result\":\"OK\",\"sunstate\":\"$sunstate\",\"azimuth\":$azimuth,\"altitude\":$altitude,";
echo "\"centrex\":$cx,\"centrey\":$cy,\"radius\":$r}";
 
 
 
function getsunpos($LAT, $LON, $year, $month, $day, $hour, &$azimuth, &$altitude, &$sunstate) {
 
// julian date
$d = 367*$year - floor((7*($year + floor(($month+9)/12)))/4)
+ floor((275*$month)/9) + $day - 730530;
 
$w = 4.9382415669097640822661983551248
+ .00000082193663128794959930855831205818* $d; // (longitude of perihelion)
$a = 1.000000 ;// (mean distance, a.u.)
$e = 0.016709 - .000000001151 * $d ;// (eccentricity)
$M = 6.2141924418482506287494932704807
+ 0.017201969619332228715501852561964 * $d ;// (mean anomaly)
 
 
$oblecl = 0.40909295936270689252387465029835
- .0000000062186081248557962825791102081249 * $d ;// obliquity of the ecliptic
 
$L = $w + $M; // sun's mean longitude
 
$E = $M + $e * sin($M) * (1 + $e * cos($M));
 
$x = cos($E) - $e;
$y = sin($E) * sqrt(1 - $e * $e);
 
$r = sqrt($x*$x + $y*$y);
$v = atan2( $y, $x ) ;
 
$lon = $v + $w;
 
$x = $r * cos($lon);
$y = $r * sin($lon);
$z = 0.0;
 
$xequat = $x;
$yequat = $y * cos($oblecl) + $z * sin($oblecl);
$zequat = $y * sin($oblecl) + $z * cos($oblecl);
 
$RA = atan2( $yequat, $xequat );
$Decl = asin( $zequat / $r );
 
$RAhours = r2d($RA)/15;
 
$GMST0 = r2d( $L + pi() ) / 15;//
$SIDTIME = $GMST0 + $hour + rad2deg($LON)/15;
 
$HA = deg2rad(($SIDTIME - $RAhours) *15);
 
$x = cos($HA) * cos($Decl);
$y = sin($HA) * cos($Decl);
$z = sin($Decl);
 
$xhor = $x * cos(pi()/2 - $LAT) - $z * sin(pi()/2 - $LAT);
$yhor = $y;
$zhor = $x * sin(pi()/2 - $LAT) + $z * cos(pi()/2 - $LAT);
 
$azimuth = pi()*3/2 -atan2( $yhor, $xhor );
$altitude = asin( $zhor );
 
 
// check sunshine state
$alt_d = rad2deg($altitude);
if ($alt_d >= 0)
$sunstate = "DAY";
else if ($alt_d >= -6)
$sunstate = "CIVIL-TWILIGHT";
else if ($alt_d >= -12)
$sunstate = "NAUTICAL-TWILIGHT";
else if ($alt_d >= -18)
$sunstate = "ASTRONOMICAL-TWILIGHT";
else
$sunstate = "NIGHT";
}	
 
 
function r2d($r) {
$d = rad2deg($r);
while ($d<0) $d += 360;
while ($d>360) $d -= 360;
return $d;
}
 
 
// functions below are for the sun's path through the day
 
function findCentre($x1,$y1,$x2,$y2,$x3,$y3,&$cx,&$cy,&$r) {
 
if (!isPerpendicular($x1,$y1,$x2,$y2,$x3,$y3) )	CalcCircle($x1,$y1,$x2,$y2,$x3,$y3,$cx,$cy,$r);
else if (!isPerpendicular($x1,$y1,$x3,$y3,$x2,$y2) )	CalcCircle($x1,$y1,$x3,$y3,$x2,$y2,$cx,$cy,$r);
else if (!isPerpendicular($x2,$y2,$x1,$y1,$x3,$y3) )	CalcCircle($x2,$y2,$x1,$y1,$x3,$y3,$cx,$cy,$r);
else if (!isPerpendicular($x2,$y2,$x3,$y3,$x1,$y1) )	CalcCircle($x2,$y2,$x3,$y3,$x1,$y1,$cx,$cy,$r);
else if (!isPerpendicular($x3,$y3,$x2,$y2,$x1,$y1) )	CalcCircle($x3,$y3,$x2,$y2,$x1,$y1,$cx,$cy,$r);
else if (!isPerpendicular($x3,$y3,$x1,$y1,$x2,$y2) )	CalcCircle($x3,$y3,$x1,$y1,$x2,$y2,$cx,$cy,$r);
else {
$cx=0;
$cy=0;
$r=0;
 
}
}	
 
function isPerpendicular($x1,$y1,$x2,$y2,$x3,$y3) {
$m = 0.00000001;
$dya = $y2 - $y1;
$dxa = $x2 - $x1;
$dyb = $y3 - $y2;
$dxb = $x3 - $x2;
 
// checking whether the line of the two pts are vertical
if (abs($dxa) <= $m && abs($dyb) <= $m){
//TRACE("The points are pependicular and parallel to x-y axis\n");
return false;
}
 
if (abs($dxa) <= $m || abs($dxb) <= $m || abs($dya) < $m || abs($dyb) <= $m) {
return true;
}
 
}
 
function CalcCircle($x1,$y1,$x2,$y2,$x3,$y3,&$cx,&$cy,&$r) {
$m = 0.00000001;
$dya = $y2 - $y1;
$dxa = $x2 - $x1;
$dyb = $y3 - $y2;
$dxb = $x3 - $x2;
 
if (abs($dxa) <= $m && abs($dxb) <= $m){
 
$cx= 0.5 * ($x2 + $x3);
$cy= 0.5 * ($y1 + $y2);
$r = sqrt(($x1-$cx)*($x1-$cx) + ($y1-$cy)*($y1-$cy));
return;
}
 
// IsPerpendicular() assure that xDelta(s) are not zero
$aSlope = $dya/$dxa;
$bSlope = $dyb/$dxb;
if (abs($aSlope-$bSlope) <= 0.000000001){	// checking whether the given points are colinear.
 
return;
}
 
// calc center
$cx = ($aSlope*$bSlope*($y1 - $y3) + $bSlope*($x1 + $x2)
- $aSlope*($x2+$x3) )/(2* ($bSlope-$aSlope) );
$cy = -1*($cx - ($x1+$x2)/2)/$aSlope + ($y1+$y2)/2;
 
$r = sqrt(($x1-$cx)*($x1-$cx) + ($y1-$cy)*($y1-$cy));
return;
 
}
 
?>