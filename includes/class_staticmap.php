<?php
/**
 * PHP5 Google Static Maps API Wrapper Class
 *
 * <b>Usage</b>
 * <code>
 * $gmap = new GMapsStaticMap();
 * $gmap->set_api_key('YOUR GOOGLE MAPS API KEY');
 * $gmap->set_size(512,512);
 * $gmap->set_center(0,0);
 * $gmap->set_zoom(2);
 * echo '<img src="' . $gmap->get_url() . '"/>';
 * </code>
 *
 * @author Brent Housen {@link www.brentalan.com}
 * @link http://code.google.com/p/phpgmapsstaticmap/
 * @version 1.0.0
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class GMapsStaticMap{
       
        /**
         * The default maptype.
         *
         */
        const MAPTYPE_ROADMAP = 'roadmap';
		
		/**
         * The hybrid maptype.
         *
         */
        const MAPTYPE_HYBRID = 'hybrid';
       
        /**
         * A maptype with enlarged text and icons for mobile screens
         *
         */
        const MAPTYPE_MOBILE = 'mobile';
       
        /**
         * The red marker colour
         *
         */
        const MARKER_COLOUR_RED = 'red';
       
        /**
         * The blue marker colour
         *
         */
        const MARKER_COLOUR_BLUE = 'blue';
       
        /**
         * The green marker colour.
         *
         */
        const MARKER_COLOUR_GREEN = 'green';
       
        /**
         * The maximum width of a static google map.
         *
         */
        const MAP_MAX_WIDTH = 512;
       
        /**
         * The maximum height of a static google map.
         *
         */
        const MAP_MAX_HEIGHT = 512;
       
        /**
         * The Google Maps API key.  Sign up for one here: http://code.google.com/apis/maps/signup.html
         *
         * @var string
         */
        protected $api_key;
       
        /**
         * The width of the map
         *
         * @var int
         */
        protected $width;
       
        /**
         * The height of the map
         *
         * @var int
         */
        protected $height;
       
        /**
         * The latitude for the center position of the map
         *
         * @var float
         */
        protected $center_lat;
       
        /**
         * The longitude for the center position of the map
         *
         * @var float
         */
        protected $center_long;
       
        /**
         * The zoom level for the map
         *
         * @var int
         */
        protected $zoom;
       
        /**
         * The maptype for the map
         *
         * @var string
         */
        protected $maptype;
       
        /**
         * An array for the storage of map markers.
         *
         * @var array
         */
        protected $markers = array();
       
        /**
         * Boolean value pertaining to if the map should be cached.
         *
         * @var string
         */
        protected $cache_map = false;
       
        /**
         * The directory to save cached maps to.
         *
         * @var string
         */
        protected $cache_directory = 'cache/';
       
        /**
         * Constructor
         *
         * @param string $api_key
         */
        public function __construct($api_key = null){
                if(isset($api_key)){
                        $this->set_api_key($api_key);
                }
        }
       
        /**
         * Set if the map should be cached
         *
         * @param bool $cache
         */
        public function set_cache($cache){
                $this->cache_map = (bool) $cache;
        }
       
        /**
         * Set the directory to save the cached maps to.
         *
         * @param string $directory
         */
        public function set_cache_directory($directory){
                $this->cache_directory = $directory;
        }
       
        /**
         * Set the Google Maps API key to be used
         *
         * @param string $api_key
         */
        public function set_api_key($api_key){
                $this->api_key = $api_key;
        }
       
        /**
         * Return the set api key.
         *
         * @return string
         */
        public function get_api_key(){
                return $this->api_key;
        }
       
        /**
         * Set the size of the map
         *
         * @param int $width
         * @param int $height
         * @throws Exception If the width is invalid.
         * @throws Exception If the height is invalid.
         */
        public function set_size($width, $height){
                $this->set_width($width);
                $this->set_height($height);
        }
       
        /**
         * Set the width of the map
         *
         * @param int $width
         * @throws Exception If the width is invalid.
         */
        public function set_width($width){
                if($width > self::MAP_MAX_WIDTH) throw new Exception('The width of a GMapsStaticMap must be no larger than ' . self::MAP_MAX_WIDTH);
                $this->width = (int)$width;
        }
       
        /**
         * Set the height of the map
         *
         * @param int $height
         * @throws Exception If the height is invalid.
         */
        public function set_height($height){
                if($height > self::MAP_MAX_HEIGHT) throw new Exception('The height of a GMapsStaticMap must be no larger than ' . self::MAP_MAX_HEIGHT);
                $this->height = (int)$height;  
        }
       
        /**
         * Return the set width of the map.
         *
         * @return int
         */
        public function get_width(){
                return $this->width;
        }
       
        /**
         * Return the set height of the map
         *
         * @return int
         */
        public function get_height(){
                return $this->height;
        }
       
        /**
         * Set the center location of the map
         *
         * @param float $latitude
         * @param float $longitude
         * @throws Exception If the latitude is invalid.
         * @throws Exception If the longitude is invalid.
         */
        public function set_center($latitude, $longitude){
                $this->set_latitude($latitude);
                $this->set_longitude($longitude);
        }
       
        /**
         * Set the latitude of the center location of the map
         *
         * @param float $latitude
         * @throws Exception If the latitude is invalid.
         */
        public function set_latitude($latitude){
                $latitude = (float)$latitude;
                if(!$this->valid_latitude($latitude)) throw new Exception('Latitudes can be no greater than 90 and no less than -90');
                $this->center_lat = $latitude;
        }
       
        /**
         * Set the longitude of the center location of the map
         *
         * @param float $longitude
         * @throws Exception If the longitude is invalid.
         */
        public function set_longitude($longitude){
                $longitude = (float)$longitude;
                if(!$this->valid_longitude($longitude)) throw new Exception('Longitudes can be no greater than 180 and no less than -180');
                $this->center_long = $longitude;
        }
       
        /**
         * Returns the latitude of the center location of the map
         *
         * @return float
         */
        public function get_latitude(){
                return $this->center_lat;
        }
       
        /**
         * Returns the longitude of the center location of the map
         *
         * @return float
         */
        public function get_longitude(){
                return $this->center_long;
        }
       
        /**
         * Set the zoom level of the map. Any value between 0 and 19 is valid.
         *
         * @param int $zoom
         * @throws Exception If zoom level is invalid.
         */
        public function set_zoom($zoom){
                if($zoom<0 || $zoom>19) throw new Exception('Zoom level must be between 0 and 19.');
                $this->zoom = $zoom;
        }
       
        /**
         * Returns the zoom level of the map.
         *
         * @return int
         */
        public function get_zoom(){
                return $this->zoom;
        }
       
        /**
         * Set the maptype for the map. Must be GMapsStaticMap::MAPTYPE_ROADMAP, GMapsStaticMap::MAPTYPE_MOBILE, or NULL.
         *
         * @param string $maptype
         * @throws Exception If the maptype is invalid.
         */
        public function set_maptype($maptype){
                $valid_types = array( self::MAPTYPE_ROADMAP, self::MAPTYPE_MOBILE, self::MAPTYPE_HYBRID, null);
                if(!in_array($maptype, $valid_types, true)) throw new Exception('Invalid GMapsStaticMap maptype. Must be NULL, GMapsStaticMap::MAPTYPE_ROADMAP, or GMapsStaticMap::MAPTYPE_MOBILE, or GMapsStaticMap::MAPTYPE_HYBRID');
                $this->maptype = $maptype;
        }
       
        /**
         * Return the set maptype.
         *
         * @return string
         */
        public function get_maptype(){
                return $this->maptype;
        }
       
        /**
         * Add a marker to the map.
         *
         * @param float $latitude
         * @param float $longitude
         * @param string $colour
         * @param string $alphachar
         * @throws Exception If the latitude is invalid.
         * @throws Exception If the longitude is invalid.
         * @throws Exception If the colour is invalid.
         * @throws Exception If the alphachar is invalid.
         */
        public function add_marker($latitude, $longitude, $colour = null, $alphachar = null){
       
                if(!$this->valid_latitude($latitude)) throw new Exception('Latitudes can be no greater than 90 and no less than -90');
                if(!$this->valid_longitude($longitude)) throw new Exception('Longitudes can be no greater than 180 and no less than -180');
               
                $valid_colours = array(null, self::MARKER_COLOUR_RED, self::MARKER_COLOUR_BLUE, self::MARKER_COLOUR_GREEN);
                if(!in_array($colour, $valid_colours)) throw new Exception('Invalid marker colour. Must be NULL, GMapsStaticMap::MARKER_COLOUR_RED, GMapsStaticMap::MARKER_COLOUR_BLUE, or GMapsStaticMap::MARKER_COLOUR_GREEN');
               
                if(isset($alphachar)){
                        if (!preg_match('/([a-zA-Z])/', $alphachar)) throw new Exception('A markers alphachar must be either NULL or any letter between a-z.');
                        if(!isset($colour)) $colour = self::MARKER_COLOUR_RED;
                }
               
               
               
                $this->markers[] = array(
                        'latitude'      => $latitude,
                        'longitude'     => $longitude,
                        'colour'        => $colour,
                        'alphachar'     => $alphachar
                );
        }
       
        /**
         * Returns an array of all the markers on the map.
         *
         * @return array
         */
        public function get_markers(){
                return $this->markers;
        }
       
        /**
         * Returns the url for the map.  If cacheing is set to be true, it will return the path to the
         * cached file unless you set $ignore_cache to false.
         *
         * @param bool $ignore_cache
         * @return string
         */
        public function get_url($ignore_cache = false){
       
                //validate_data
                if(!isset($this->api_key)) throw new Exception('You must set a Google Maps API key.');
               
                if(!isset($this->width) || !isset($this->height)) throw new Exception('You must set a width and a height');
               
                if(count($this->markers)==0){
                        if(!isset($this->center_lat) || !isset($this->center_long)) throw new Exception('You must set a center latitude and longitude if there are no set markers.');
                        if(!isset($this->zoom)) throw new Exception('You must set a zoom level if no markers are set.');
                }
       
                $gmaps_url = $this->build_gmaps_url();
               
                if($this->cache_map && !$ignore_cache){
                       
                        if(!is_dir($this->cache_directory)) throw new Exception('Map cache directory "' . $this->cache_directory . '" could not be found.');
                        if(!is_writable($this->cache_directory)) throw new Exception('Map cache directory "' . $this->cache_directory . '" is not writeable.');
                       
                        $cache_fname = md5($gmaps_url) . '.gif';
                        $cache_fullfname = $this->cache_directory . $cache_fname;
                        if(!file_exists($cache_fullfname)){
                                file_put_contents($cache_fullfname,file_get_contents($gmaps_url));
                        }
                        return $cache_fullfname;
                       
                }else{
                        return $gmaps_url;
                }
               
               
        }
       
        /**
         * Builds the Google Static Maps url to be used.
         *
         * @return unknown
         */
        protected function build_gmaps_url(){
                //Build GMap URL
                $map_url = 'http://maps.google.com/staticmap?';
               
                if(isset($this->center_lat) && isset($this->center_long)){
                        $map_url .= 'center=' . $this->center_lat . ',' . $this->center_long . '&';
                }
               
                if(isset($this->zoom)){
                        $map_url .= 'zoom=' . $this->zoom . '&';
                }
               
                if(isset($this->maptype)){
                        $map_url .= 'maptype=' . $this->maptype . '&';
                }
               
                $map_url .= 'size=' . $this->width . 'x' . $this->height . '&';
               
                if(count($this->markers)>0){
                        $map_url .= 'markers=';
                        for($i = 0, $c = count($this->markers); $i<$c; $i++){
                                $map_url .= $this->markers[$i]['latitude'] . ',' . $this->markers[$i]['longitude'];
                                if(isset($this->markers[$i]['colour'])){
                                        $map_url .= ',' . $this->markers[$i]['colour'];
                                        if(isset($this->markers[$i]['alphachar'])){
                                                $map_url .= $this->markers[$i]['alphachar'];
                                        }
                                }
                                if($i+1 != $c) $map_url .= '|';
                        }
                        $map_url .= '&';
                }
               
                $map_url .= 'key=' . $this->api_key;
               
                return $map_url;
        }
       
        /**
         * Returns if a latitude is valid or not.
         *
         * @param float $latitude
         * @return bool
         */
        protected function valid_latitude($latitude){
                return ($latitude <= 90 && $latitude >= -90);
        }
       
        /**
         * Returns if a longitude is valid or not.
         *
         * @param float $longitude
         * @return bool
         */
        protected function valid_longitude($longitude){
                return ($longitude <= 180 && $longitude >= -180);
        }
       
}
