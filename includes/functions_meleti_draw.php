<?php
/*
Copyright (C) 2013 - Labros kenak v.4.0 beta
Author: Labros Karoyntzos 

Labros kenak v.4.0 beta from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros kenak v.4.0 beta με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/


if (isset($_GET['create_draworder'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_draworder();
	echo $tb;
	exit;
}
if (isset($_GET['create_solarpath'])){
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("suncalc/suncalc.php");
	require("XY_Plot/XY_Plot.php");
	confirm_logged_in();
	$tb = create_solarpath($lat,$lon);
	echo $tb;
	exit;
}

require("include_check.php");

// ##################################################### ΖΩΝΕΣ ###############################################
//Εκτύπωση πίνακα ζωνών
function create_draworder(){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_adiafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_allwalls = $database->select($tb,$col,$where);
	
	
	//Βρίσκω τους ορόφους και τους βάζω σε σειρά από μικρότερο σε μεγαλύτερο
	$array_floors=array();
	foreach($data_allwalls as $wall){
		array_push($array_floors, $wall["roof"]);
	}
	$array_floors = array_unique($array_floors);
	
	$txt = "";
	foreach($array_floors as $floor){
		$where_floor = array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"roof"=>$floor),
		"ORDER"=>array(
			"draw_order"=>"ASC"
			));
		$data_floorwalls = $database->select($tb,$col,$where_floor);
		$count = count($data_floorwalls);
		
		$txt .= "<div class=\"panel panel-warning\">";
		$txt .= "<div class=\"panel-heading\">Όροφος: ".$floor." </div>";
		$txt .= "<table class=\"table table-bordered table-condenced\">
				<tr>
				<td>Τοιχοποιία</td>
				<td>Όροφος</td>
				<td>Αρίθμηση - σειρά εμφάνισης</td>
				<td>Μήκος</td>
				<td>Προσανατολισμός(<sup>o</sup>)</td>
				</tr>";
		
		$array_ids= array();

		foreach($data_floorwalls as $wall){
			$array_ids[$wall["draw_order"]]=$wall["id"];//array με key το draw_order και τιμή το id	
			$txt .= "<tr>";
			$txt .= "<td>".$wall["name"]."</td>";
			$txt .= "<td>".$wall["roof"]."</td>";
			$txt .= "<td>".$wall["draw_order"]."</td>";
			$txt .= "<td>".$wall["l"]."</td>";
			$txt .= "<td>".$wall["g"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Σύνολο: ".$count."</div>";
		$txt .= "</div>";
		
		ksort($array_ids);//βάζω τους τοίχους με τη σειρά που εμφανίζονται
		//print_r($array_ids);
		
		/*
		foreach($array_ids as $id){	
			$where_wall = array("id"=>$id);
			$data_wall = $database->select($tb,$col,$where_wall);
				foreach($data_wall as $wall){
					//χώρος για σχεδίαση
				}
		}
		
		$test_table="meletes_zone_adiafani";
		$test_col="*";
		$test_where=array(
			"AND"=>array(
					"user_id"=>$_SESSION['user_id'],
					"meleti_id"=>$_SESSION['meleti_id'],
					"roof"=>$floor
				),
			"ORDER"=>array("draw_order"=>"ASC")
		);
		$test_data = $database->select($test_table,$test_col,$test_where);
		echo $database->last_query();
		foreach($test_data as $test){	
			$txt .= $test["name"]."<br/>";
		}
		*/
		
	$txt .= "<img  height=\"600px\" src=\"includes/draw_floor.php?floor=".$floor."\">";
	}
	
	
	return $txt;	
}


//RESIZE IMAGE GD
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}

function create_solarpath($lat,$lon){
	if(!isset($_GET['create_solarpath'])){
		require("includes/suncalc/suncalc.php");
		require("includes/XY_Plot/XY_Plot.php");
	}
	date_default_timezone_set('Europe/Athens');
	$dates=array(
		"2017-06-21",
		"2017-05-21",
		"2017-04-20",
		"2017-03-20",
		"2017-02-20",
		"2017-01-20",
		"2017-12-21"
	);
	
//EIKONA - GRID
	// Size of the image
	$imageWidth     = 800;
	$imageHeight    = 600;

	// Margins
	$leftMargin     = 15;
	$rightMargin    = 35;
	$topMargin      = 25;
	$bottomMargin   = 20;

	// verticle scale
	$yMajorScale   = 10;
	$yMinorScale   = $yMajorScale / 2;
	$xMajorScale   = 10;
	$xMinorScale   = $xMajorScale / 2;
	//-----------------------------------------------------------
	$font="verdana.ttf";
	
	// Create image
	$image = @imageCreate( $imageWidth, $imageHeight )
	   or die( "Cannot Initialize new GD image stream" );
	//imagefttext($image, 11, 0, $imageWidth/2, $imageHeight/2, $colorMap["sun".$aa], $font, $date);
	//---------------------------------
	// Create basic color map
	//---------------------------------
	$colorMap = array();
	$colorMap[ "Background" ] = imageColorAllocate( $image, 255, 255, 255 );
	$colorMap[ "Black"       ] = imageColorAllocate( $image,   0,   0,   0 );
	$colorMap[ "Red"         ] = imageColorAllocate( $image, 192,   0,   0 );
	$colorMap[ "Green"       ] = imageColorAllocate( $image,   0, 192,   0 );
	$colorMap[ "Blue"        ] = imageColorAllocate( $image,   0,   0, 192 );
	$colorMap[ "Brown"       ] = imageColorAllocate( $image,  48,  48,   0 );
	$colorMap[ "Cyan"        ] = imageColorAllocate( $image,   0, 192, 192 );
	$colorMap[ "Purple"      ] = imageColorAllocate( $image, 192,   0, 192 );
	$colorMap[ "LightGray"   ] = imageColorAllocate( $image, 192, 192, 192 );
	$colorMap[ "DarkGray"    ] = imageColorAllocate( $image,  48,  48,  48 );
	$colorMap[ "LightRed"    ] = imageColorAllocate( $image, 255,   0,   0 );
	$colorMap[ "LightGreen"  ] = imageColorAllocate( $image,   0, 255,   0 );
	$colorMap[ "LightBlue"   ] = imageColorAllocate( $image,   0,   0, 255 );
	$colorMap[ "Yellow"      ] = imageColorAllocate( $image, 255, 255,   0 );
	$colorMap[ "LightCyan"   ] = imageColorAllocate( $image,   0, 255, 255 );
	$colorMap[ "LightPurple" ] = imageColorAllocate( $image, 255,   0, 255 );
	$colorMap[ "White"       ] = imageColorAllocate( $image, 255, 255, 255 );
	$colorMap[ "sun1"        ] = imageColorAllocate( $image, 179, 116,   0 );
	$colorMap[ "sun2"        ] = imageColorAllocate( $image, 204, 132,   0 );
	$colorMap[ "sun3"        ] = imageColorAllocate( $image, 230, 149,   0 );
	$colorMap[ "sun4"        ] = imageColorAllocate( $image, 255, 55,   55 );
	$colorMap[ "sun5"        ] = imageColorAllocate( $image, 204, 40,   40 );
	$colorMap[ "sun6"        ] = imageColorAllocate( $image, 122, 24,   24 );
	$colorMap[ "sun7"        ] = imageColorAllocate( $image,  97, 19,   19 );


	// New plot
	$xyPlot = new XY_Plot( $image );
	// Setup boundries
	$xyPlot->sizeWindow($leftMargin, $topMargin, $imageWidth - $rightMargin, $imageHeight - $bottomMargin );
	// Set linear regression color
	$xyPlot->setAverageColor( $colorMap[ "LightPurple" ] );
	$xyPlot->setLinearRegressionColor( $colorMap[ "LightBlue" ] );
	// Average line size
	$xyPlot->setAverageWidth( 3 );
	// Set point size
	$xyPlot->setCircleSize( 5 );
	
/////////////////////////////////////////////////
$aa=1;
foreach($dates as $date){
	$xyPlot->resetData(); 
	// Set plot colors
	$xyPlot->setColor( $colorMap["sun".$aa] );
	for($i=1;$i<=24;$i+=0.1){
		$time = date("H:i", mktime(0,$i*60));
		$date_time=$date." ".$time;
		
		$sc = new SunCalc(new DateTime($date_time), $lat, $lon);
		//$sunTimes = $sc->getSunTimes();
		//$sunriseStr = $sunTimes['sunrise']->format('H:i');
		$sunpos = $sc->getSunPosition();
		$azimuth = $sunpos->azimuth * 180 / M_PI;
		$altitude = $sunpos->altitude * 180 / M_PI;
		
		//echo $date_time." ".$azimuth." ".$altitude."<br/>";
		$line_array[$i]["x"]=$azimuth;
		$line_array[$i]["y"]=$altitude;
		$array_azimuth[]=round($azimuth,2);
		$array_altitude[]=round($altitude,2);
		$xyPlot->addData( $azimuth, $altitude );
	}
	/////////////////////////////////////////////////
	
	// Automaticlly adjust verticle scale
	$xyPlot->AutoScaleX_MinMax();
	//$xyPlot->AutoScaleY_MinMax( $yMajorScale );

	if($aa==1){
	//------------------------------------------------------
	// Draw grids and labels
	// NOTE: Always draw minor grids first so the major
	// grids are on top
	//------------------------------------------------------
	// Setup and draw minor horizontal scale (right to left)
	$xyPlot->setX_MinorDivisionScale( $xMinorScale );
	$xyPlot->setX_MinorDivisionColor( $colorMap[ "Cyan" ] );
	$xyPlot->drawX_MinorDivisions();
	// Setup and draw minor vertical scale (top to bottom)
	$xyPlot->setY_MinorDivisionScale( $yMinorScale );
	$xyPlot->setY_MinorDivisionColor( $colorMap[ "LightGray" ] );
	$xyPlot->drawY_MinorDivisions();

	//----------------------------------
	// Setup and draw major horizontal scale (right to left)
	//----------------------------------

	// Extend lines 5 pixels past margins for lable
	$xyPlot->setX_MajorDivisionExtension( 5 );
	// Scale
	$xyPlot->setX_MajorDivisionScale( $xMajorScale );
	// Division lines are blue
	$xyPlot->setX_MajorDivisionColor( $colorMap[ "Blue" ] );
	// Text labels are dark gray
	$xyPlot->setX_MajorDivisionTextColor( $colorMap[ "DarkGray" ] );
	// Draw it
	$xyPlot->drawX_MajorDivisions();

	//----------------------------------
	// Setup and draw major verticle scale (top to bottom)
	//----------------------------------
	// Extend lines 5 pixels past margins for lable
	$xyPlot->setY_MajorDivisionExtension( 5 );
	// Scale
	$xyPlot->setY_MajorDivisionScale( $yMajorScale );
	// Divisions in dark gray
	$xyPlot->setY_MajorDivisionColor( $colorMap[ "DarkGray" ] );
	// labels in dark gray
	$xyPlot->setY_MajorDivisionTextColor( $colorMap[ "DarkGray" ] );
	// Draw it
	$xyPlot->drawY_MajorDivisions();

	//----------------------------------

	// Setup timeframe
	$xyPlot->setMaxX_Distance( 60 * 60 * 24 );

	// Render the points and lines to image
	//$xyPlot->renderMeanPlot();
	//$xyPlot->renderLinearRegression();
	$xyPlot->setLineThickness( $aa );
	}
	
	$xyPlot->renderWithLines($date);
	//$xyPlot->renderPoints();
	$aa++;
}//for dates


	// Draw borders
	//drawBorders($leftMargin, $topMargin,$rightMargin,$bottomMargin);
	drawBorder(
	 $image,
	 $leftMargin,
	 $topMargin,
	 $imageWidth - $rightMargin,
	 $imageHeight - $bottomMargin,
	 $colorMap[ "Black" ] );
	 drawBorder(
	 $image,
	 0,
	 0,
	 $imageWidth - 1,
	 $imageHeight - 1,
	 $colorMap[ "Black" ] );

	//----------------------------------
	// Center a title above the chart
	//----------------------------------
	$title = "Solar path estimation - Lat:".round($lat,3)." - Lon:".round($lon,3)." - ".APPLICATION_NAME." v".APPLICATION_VERSION;
	$fontSize = 5;

	// Calculate the horizontal position to center text
	$x = round( $imageWidth / 2 ) + getCenterBias( $title, $fontSize );

	// Place text
	imageString(
	 $image,
	 5,
	 $x, $fontSize,
	 $title,
	 $colorMap[ "Purple" ] );

	// Output image
	$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/solar_path.png";	
	$create=imagepng ($image,$path);
	ImageDestroy($image);
	//Header("Content-type: image/png");
	$img="<img src=\"".APPLICATION_FOLDER."includes/".$path."?m=".time()."\">";
	return $img;
}

//---------------------------------------------------------------------------
// Calculate the center bias of a graphics string
// Returns a negitive number to be added to a point from with to center
//---------------------------------------------------------------------------
function getCenterBias( $string, $fontSize ){
	$centerBias  = strlen( $string );
	$centerBias *= imageFontWidth( $fontSize );
	$centerBias /= 2;
	$centerBias  = -round( $centerBias );

	return $centerBias;
}

//---------------------------------------------------------------------------
// Simple function to draw a border around a box
//---------------------------------------------------------------------------
function drawBorder( $image, $x, $y, $xx, $yy, $color ){
	imageLine( $image,  $x,  $y, $xx,  $y, $color );
	imageLine( $image,  $x,  $y,  $x, $yy, $color );
	imageLine( $image, $xx,  $y, $xx, $yy, $color );
	imageLine( $image,  $x, $yy, $xx, $yy, $color );
}

//---------------------------------------------------------------------------
// Draw borders around the outside of the image and the chart
//---------------------------------------------------------------------------
function drawBorders($leftMargin, $topMargin, $rightMargin, $bottomMargin ){
	global $image;
	global $imageWidth;
	global $imageHeight;
	global $colorMap;

	// Draw borders around chart area
	drawBorder(
	 $image,
	 $leftMargin,
	 $topMargin,
	 $imageWidth - $rightMargin,
	 $imageHeight - $bottomMargin,
	 $colorMap[ "Black" ] );

	// Draw borders around entire image
	drawBorder(
	 $image,
	 0,
	 0,
	 $imageWidth - 1,
	 $imageHeight - 1,
	 $colorMap[ "Black" ] );
}


//PHP GD DOCUMENTATION FUNCTIONS
function imagelinedotted ($im, $x1, $y1, $x2, $y2, $dist, $col) {
    $transp = imagecolortransparent ($im);
   
    $style = array ($col);
   
    for ($i=0; $i<$dist; $i++) {
        array_push($style, $transp);        // Generate style array - loop needed for customisable distance between the dots
    }
   
    imagesetstyle ($im, $style);
    return (integer) imageline ($im, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED);
    imagesetstyle ($im, array($col));        // Reset style - just in case...
}
function imageBoldLine($resource, $x1, $y1, $x2, $y2, $Color, $BoldNess=2, $func='imageLine')
{
$center = round($BoldNess/2);
for($i=0;$i<$BoldNess;$i++)
{ 
  $a = $center-$i; if($a<0){$a -= $a;}
  for($j=0;$j<$BoldNess;$j++)
  {
   $b = $center-$j; if($b<0){$b -= $b;}
   $c = sqrt($a*$a + $b*$b);
   if($c<=$BoldNess)
   {
    $func($resource, $x1 +$i, $y1+$j, $x2 +$i, $y2+$j, $Color);
   }
  }
}        
} 
?>