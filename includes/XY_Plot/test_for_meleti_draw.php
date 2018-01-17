<?php
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

	// Create image
	$image = @imageCreate( $imageWidth, $imageHeight )
	   or die( "Cannot Initialize new GD image stream" );

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

	// New plot
	$xyPlot = new XY_Plot( $image );
	// Setup boundries
	$xyPlot->sizeWindow(
	$leftMargin, $topMargin,
	$imageWidth - $rightMargin, $imageHeight - $bottomMargin );
	// Set plot colors
	$xyPlot->setColor( $colorMap[ "LightRed" ] );
	// Set linear regression color
	$xyPlot->setAverageColor( $colorMap[ "LightPurple" ] );
	$xyPlot->setLinearRegressionColor( $colorMap[ "LightBlue" ] );
	// Average line size
	$xyPlot->setAverageWidth( 3 );
	// Set point size
	$xyPlot->setCircleSize( 5 );
	
	foreach ( $line_array as $arrayxy ){
		$xyPlot->addData( $arrayxy["x"], $arrayxy["y"] );
	}

	// Automaticlly adjust verticle scale
	$xyPlot->AutoScaleX_MinMax();
	$xyPlot->AutoScaleY_MinMax( $yMajorScale );

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
	$xyPlot->renderMeanPlot();
	$xyPlot->renderLinearRegression();
	$xyPlot->renderWithLines();
	$xyPlot->renderPoints();

	// Draw borders
	drawBorders(
	 $leftMargin, $topMargin,
	 $rightMargin, $bottomMargin );

	//----------------------------------
	// Center a title above the chart
	//----------------------------------
	$title = "East <-- Solar Azimuth --> West";
	$fontSize = 5;

	// Calculate the horizontal position to center text
	$x = round( $imageWidth / 2 ) + getCenterBias( $title, $fontSize );

	// Place text
	imageString(
	 $image,
	 5,
	 $x, $fontSize,
	 $title,
	 $colorMap[ "Black" ] );

	// Output image
	$path = "includes/suncalc/solar_path.png";	
	$create=imagepng ($image,$path);
	ImageDestroy($image);
	$img="<img src=\"".$path."\"></img>";
	echo $img;

	//---------------------------------------------------------------------------
	// Calculate the center bias of a graphics string
	// Returns a negitive number to be added to a point from with to center
	//---------------------------------------------------------------------------
	function getCenterBias( $string, $fontSize )
	{
	$centerBias  = strlen( $string );
	$centerBias *= imageFontWidth( $fontSize );
	$centerBias /= 2;
	$centerBias  = -round( $centerBias );

	return $centerBias;
	}

	//---------------------------------------------------------------------------
	// Simple function to draw a border around a box
	//---------------------------------------------------------------------------
	function drawBorder( $image, $x, $y, $xx, $yy, $color )
	{
	imageLine( $image,  $x,  $y, $xx,  $y, $color );
	imageLine( $image,  $x,  $y,  $x, $yy, $color );
	imageLine( $image, $xx,  $y, $xx, $yy, $color );
	imageLine( $image,  $x, $yy, $xx, $yy, $color );
	}

	//---------------------------------------------------------------------------
	// Draw borders around the outside of the image and the chart
	//---------------------------------------------------------------------------
	function drawBorders(
	$leftMargin, $topMargin, $rightMargin, $bottomMargin )
	{
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
?>