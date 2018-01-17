<?php

/**
* 
* HTMLtodocx
* HTML to docx Converter
* - HTML converter for use with PHPWord
* Copyright (C) 2011  Commtap CIC
* 
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2.1
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
* 
* @copyright  Copyright (c) 2011 Commtap CIC
* @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
* @version    Devel 0.5.0, 22.11.2011
* 
*/

// Functions for converting and adding HTML into PHPWord objects
// for creating a docx document.

/**
* 
* These are the elements which can be processed by this converter
* 
* This will tell us when to stop when parsing HTML.
* Anything still remaining after a stop (i.e. no more
* parsable tags) to be returned as is (with any tags filtered out).
* 
* @param string $tag - optional - the tag for the element for which
* its possible children are required.
* @return mixed
*/
function h2d_html_allowed_children($tag = NULL) {

  $allowed_children = array(
    'body' => array('p', 'ul', 'ol', 'table', 'div', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
    'h1' => array('a', 'em', 'i', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'),
    'h2' => array('a', 'em', 'i', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'),
    'h3' => array('a', 'em', 'i', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'),
    'h4' => array('a', 'em', 'i', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'),
    'h5' => array('a', 'em', 'i', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'),
    'h6' => array('a', 'em', 'i', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'),
    'p' => array('a', 'em', 'i', 'strong', 'b', 'ul', 'ol', 'img', 'table', 'br', 'span', 'u', 'sup', 'text', 'div', 'p'), // p does not nest - simple_html_dom will create a flat set of paragraphs if it finds nested ones.
    'div' => array('a', 'em', 'i', 'strong', 'b', 'ul', 'ol', 'img', 'table', 'br', 'span', 'u', 'sup', 'text', 'div', 'p'),
    'a' => array('text'), // PHPWord doesn't allow elements to be placed in link elements
    'em' => array('a', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'), // Italic
    'i' => array('a', 'strong', 'b', 'br', 'span', 'u', 'sup', 'text'), // Italic
    'strong' => array('a', 'em', 'i', 'br', 'span', 'u', 'sup', 'text'), // Bold
    'b' => array('a', 'em', 'i', 'br', 'span', 'u', 'sup', 'text'), // Bold
    'sup' => array('a', 'em', 'i', 'br', 'span', 'u', 'text'), // Superscript
    'u' => array('a', 'em', 'strong', 'b', 'i', 'br', 'span', 'sup', 'text'), // Underline - deprecated - but could be encountered.
    'ul' => array('li'),
    'ol' => array('li'),
    'li' => array('a', 'em', 'i', 'strong', 'b', 'ul', 'ol', 'img', 'br', 'span', 'u', 'sup', 'text'),
    'img' => array(),
    'table' => array('tbody', 'tr'),
    'tbody' => array('tr'),
    'tr' => array('td', 'th'),
    'td' => array('p', 'a', 'em', 'i', 'strong', 'b', 'ul', 'ol', 'img', 'br', 'span', 'u', 'sup', 'text', 'table'), // PHPWord does not allow you to insert a table into a table cell
    'th' => array('p', 'a', 'em', 'i', 'strong', 'b', 'ul', 'ol', 'img', 'br', 'span', 'u', 'sup', 'text', 'table'), // PHPWord does not allow you to insert a table into a table cell
    'br' => array(),
    'span' => array('a', 'em', 'i', 'strong', 'b', 'img', 'br', 'span', 'sup', 'text'), // Used for styles - underline
    'text' => array(), // The tag name used for elements containing just text in SimpleHtmlDom.
  );
  
  if (!$tag) {
    return $allowed_children;
  }
  elseif (isset($allowed_children[$tag])) {
    return $allowed_children[$tag];
  }
  else {
    return array();
  }
}

/**
* Clean up text:
* 
* @param string $text
*/
function h2d_clean_text($text) {
  
  // Replace each &nbsp; with a single space:
  $text = str_replace('&nbsp;', ' ', $text);
  if (strpos($text, '<') !== FALSE) {
    // We only run strip_tags if it looks like there might be some tags in the text
    // as strip_tags is expensive:
    $text = strip_tags($text);
  }
    
  // Strip out extra spaces:
  $text = preg_replace('/\s+/u', ' ', $text);
  
  return $text;
}

/**
* Compute the styles that should be applied for the 
* current element.
* We start with the default style, and successively override
* this with the current style, style set for the tag, classes
* and inline styles.
* 
* @param mixed $element
* @param mixed $state
* @return array
*/
function h2d_get_style($element, $state) {
 
  // Lists:
  $state['pseudo_list'] = TRUE; // This converter only supports "pseudo" lists at present.
  
  $style_sheet = $state['style_sheet'];
  
  // Get the default styles
  $phpword_style = $style_sheet['default'] ? $style_sheet['default'] : array();
  
  // Update with the current style
  $current_style = $state['current_style'] ? $state['current_style'] : array();
  $phpword_style = array_merge($phpword_style, $current_style);
  
  // Update with any styles defined by the element tag
  $tag_style = $style_sheet['elements'][$element->tag] ? $style_sheet['elements'][$element->tag] : array();
  $phpword_style = array_merge($phpword_style, $tag_style);
  
  // Find any classes defined for this element:
  $class_list = array();
  if (!empty($element->class)) {
    $classes = explode(' ', $element->class);
    foreach ($classes as $class) {
      $class_list[] = trim($class);
    } 
  }
  
  // Look for any style definitions for these classes:
  $classes_style = array();
  if (!empty($class_list) && !empty($style_sheet['classes'])) {
    foreach ($style_sheet['classes'] as  $class => $attributes) {
      if (in_array($class, $class_list)) {
        $classes_style = array_merge($classes_style, $attributes); 
      }
    }
  }
  
  $phpword_style = array_merge($phpword_style, $classes_style);
  
  // TO DO:
  // Need to rewrite this bit so that we can define some converters
  // for size and colours. The idea would be able to have a style like:
  // array('color: #{hex}' => array ('color' => '{hex}')); or
  // array('border-width: {px}' => array ('borderSize' => '{twip}'));
  // in the latter case, this would trigger a conversion from px to twips (SEE BELOW)
  
  // Find any inline styles:
  $inline_style_list = array();
  if (!empty($element->attr['style'])) {
    $inline_styles = explode(';', rtrim(rtrim($element->attr['style']), ';'));
    foreach ($inline_styles as $inline_style) {
      $style_pair = explode(':', $inline_style); 
      $inline_style_list[] = trim($style_pair[0]) . ': ' . trim($style_pair[1]);
    }
  }
  
  // Look for style definitions of these inline styles:
  $inline_styles = array();
  if (!empty($inline_style_list) && !empty($style_sheet['inline'])) {
    foreach ($style_sheet['inline'] as  $inline_style => $attributes) {
      if (in_array($inline_style, $inline_style_list)) {
        $inline_styles = array_merge($inline_styles, $attributes); 
      }
    } 
  }
  
  $phpword_style = array_merge($phpword_style, $inline_styles);
  
  return $phpword_style;
  
}

/**
* Populate PHPWord element
* This recursive function processes all the elements and child elements
* from the DOM array of objects created by SimpleHTMLDom.
* 
* @param object phpword_element - the object from PHPWord in which to place the converted html
* @param array $html_dom_array - array of nodes generated by simple HTML dom
* @param array $state - variables for the current run
*/
function h2d_insert_html(&$phpword_element, $html_dom_array, &$state = array()) {
  
  // Set some defaults:
  $state['current_style'] = $state['current_style'] ? $state['current_style'] : array('size' => '11');
  $state['parents'] = $state['parents'] ? $state['parents'] : array(0 => 'body'); // Our parent is body
  $state['list_depth'] = $state['list_depth'] ? $state['list_depth'] : 0;
  $state['context'] = $state['context'] ? $state['context'] : 'section'; // Possible values - section, footer or header
  
  
  // Go through the html_dom_array, adding bits to go in the PHPWord element
  $allowed_children = h2d_html_allowed_children($state['parents'][0]);
 
  // Go through each element:
  foreach ($html_dom_array as $element) {

    $old_style = $state['current_style'];
    
    $state['current_style'] = h2d_get_style($element, $state);
    
    switch($element->tag) {
      
      case 'p':
      case 'div': // Treat a div as a paragraph
      case 'h1':
      case 'h2':
      case 'h3':
      case 'h4':
      case 'h5':
      case 'h6':
        // Everything in this element should be in the same text run
        // we need to initiate a text run here and pass it on:
        $state['textrun'] = $phpword_element->createTextRun($state['current_style']);
        if (in_array($element->tag, $allowed_children)) {
          array_unshift($state['parents'], $element->tag);
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']);
        }
        else {
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }
        unset($state['textrun']);
        if (!isset($state['current_style']['spaceAfter'])) {
          // For better usability for the end user of the Word document, we 
          // separate paragraphs and headings with an empty line. You can 
          // override this behaviour by setting the spaceAfter parameter for
          // the current element.
          $phpword_element->addTextBreak();
        }
      break;
      
      case 'table':
        if (in_array('table', $allowed_children)) {
          $old_table_state = $state['table_allowed'];
          if (in_array('td', $state['parents']) || in_array('th', $state['parents'])) {
            $state['table_allowed'] = FALSE; // This is a PHPWord constraint
          }
          else {
            $state['table_allowed'] = TRUE;
            // PHPWord allows table_styles to be passed in a couple of different ways either using an array of properties, or by defining a full table style on the PHPWord object:
            if (is_object($state['phpword_object']) && method_exists($state['phpword_object']->addTableStyle)) {
              $state['phpword_object']->addTableStyle('temp_table_style', $state['current_style']);
              $table_style = 'temp_table_style';
            }
            else {
              $table_style = $state['current_style'];
            }
            $state['table'] = $phpword_element->addTable($table_style); 
          }
          array_unshift($state['parents'], 'table');
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']);
          // Reset table state to what it was before a table was added:
          $state['table_allowed'] = $old_table_state; 
          $phpword_element->addTextBreak(); 
        }
        else {
          $state['textrun'] = $phpword_element->createTextRun();
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }     
      break;
      
      case 'tbody':
        if (in_array('tbody', $allowed_children)) {
          array_unshift($state['parents'], 'tbody');
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']); 
        }
        else {
          $state['textrun'] = $phpword_element->createTextRun();
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }
      break;
      
      case 'tr':
        if (in_array('tr', $allowed_children)) {
          if ($state['table_allowed']) {
            $state['table']->addRow();
          }
          else {
            // Simply add a new line if a table is not possible in this context:
            $state['textrun'] = $phpword_element->createTextRun();
          }
          array_unshift($state['parents'], 'tr');
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']); 
        }
        else {
          $state['textrun'] = $phpword_element->createTextRun();
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }     
      break;

      case 'td':
      case 'th':
        // Unset any text run there may happen to be:
        // unset($state['textrun']);
        if (in_array($element->tag, $allowed_children) && $state['table_allowed']) {
          unset($state['textrun']);
          if (isset($element->width)) {
            $cell_width = $element->width * 15; // Converting at 15 TWIPS per pixel
          }
          else {
            $cell_width = 800;
          }
          $state['table_cell'] = $state['table']->addCell($cell_width, $state['current_style']);
          array_unshift($state['parents'], $element->tag);
          h2d_insert_html($state['table_cell'], $element->nodes, $state);
          array_shift($state['parents']); 
        }
        else {
          if (!isset($state['textrun'])) {
            $state['textrun'] = $phpword_element->createTextRun();
          }
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }
      break;
      
      case 'a':
        // Create a new text run if we aren't in one already:
        if (!$state['textrun']) {
          $state['textrun'] = $phpword_element->createTextRun();
        }
        if ($state['context'] == 'section') {
          
          if (strpos($element->href, 'http://') === 0) {
            $href = $element->href;
          }
          elseif (strpos($element->href, '/') === 0) {
            $href = $state['base_root'] . $element->href;
          }
          else {
            $href = $state['base_root'] . $state['base_path'] . $element->href; 
          }
          
          $state['textrun']->addLink($href, h2d_clean_text($element->innertext), $state['current_style']);
        }
        else {
          // Links can't seem to be included in headers or footers with PHPWord:
          // trying to include them causes an error which stops Word from opening the 
          // file - in Word 2003 with the converter at least.
          // So add the link styled as a link only.
          $state['textrun']->addText(h2d_clean_text($element->innertext), $state['current_style']);
        }
      break;
      
      case 'ul':
        if (in_array('ul', $allowed_children)) {
          if (!$state['pseudo_list']) {
            // Unset any existing text run:
            unset($state['textrun']); // PHPWord lists cannot appear in a text run. If we leave a text run active then subsequent text will go in that text run (if it isn't re-initialised), which would mean that text after this list would appear before it in the Word document.
          }
          array_unshift($state['parents'], 'ul');
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']);
        }
        else {
          $state['textrun'] = $phpword_element->createTextRun();
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }
      break;
      
      case 'ol':
        $state['list_number'] = 0; // Reset list number. 
        if (in_array('ol', $allowed_children)) {
          if (!$state['pseudo_list']) {
            // Unset any existing text run:
            unset($state['textrun']); // Lists cannot appear in a text run. If we leave a text run active then subsequent text will go in that text run (if it isn't re-initialised), which would mean that text after this list would appear before it in the Word document.
          }
          array_unshift($state['parents'], 'ol');
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']);
        }
        else {
          $state['textrun'] = $phpword_element->createTextRun();
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }
      break;
      
      case 'li': 
        // You cannot style individual pieces of text in a list element so we do it
        // with text runs instead. This does not allow us to indent lists at all, so
        // we can't show nesting.
        
        // Create a new text run for each element:
        $state['textrun'] = $phpword_element->createTextRun();
        
        if (in_array('li', $allowed_children)) {
          if ($state['parents'][0] == 'ol') {
            $state['list_number']++;
            $item_indicator = $state['list_number'] . '. ';
            $style = $state['current_style'];
          }
          else {
            $style = $state['current_style'];
            $style['name'] = $state['pseudo_list_indicator_font_name']; 
            $style['size'] = $state['pseudo_list_indicator_font_size'];
            $item_indicator = $state['pseudo_list_indicator_character'];
          }
          array_unshift($state['parents'], 'li');
          $state['textrun']->addText($item_indicator, $style);
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']);
        }
        else {
          $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
        }
        $phpword_element->addTextBreak();
        unset($state['textrun']);
      break;
      
      case 'text':
      // We may get some empty text nodes - containing just a space -
      // in simple HTML dom - we want
      // to exclude those, as these can cause extra line returns. However
      // we don't want to exclude spaces between styling elements (these will be within
      // a text run).
        if (!$state['textrun']) {
          $text = h2d_clean_text(trim($element->innertext));
        }
        else {
          $text = h2d_clean_text($element->innertext);
        }
        if (!empty($text)) {
          if (!$state['textrun']) {
            $state['textrun'] = $phpword_element->createTextRun();
          }
          $state['textrun']->addText($text, $state['current_style']);
        }
      break;
      
      // Style tags:
      case 'strong':
      case 'b':
      case 'sup': // Not working in PHPWord
      case 'em':
      case 'i':
      case 'u':      
      case 'span':
        
        // Create a new text run if we aren't in one already:
        if (!$state['textrun']) {
          $state['textrun'] = $phpword_element->createTextRun();
        }
        if (in_array($element->tag, $allowed_children)) {
          array_unshift($state['parents'], $element->tag);
          h2d_insert_html($phpword_element, $element->nodes, $state);
          array_shift($state['parents']);
        }
        else {
          $state['textrun']->addText(h2d_clean_text($element->innertext), $state['current_style']);
        }
      break;
      
      case 'br':
        // Simply create a new text run: 
        $state['textrun'] = $phpword_element->createTextRun();
      break;
      
      case 'img':
        $image_style = array();
        if ($element->height && $element->width) {
         $state['current_style']['height'] = $element->height;
         $state['current_style']['width'] = $element->width; 
        }
        $phpword_element->addImage(ltrim($element->src, 'http://localhost/kenakv2/includes/'), $state['current_style']);
      break;

      default:
        $state['textrun'] = $phpword_element->createTextRun();
        $state['textrun']->addText(h2d_clean_text($element->innertext),  $state['current_style']);
      break; 
    } 
    
    // Reset the style back to what it was:
    $state['current_style'] = $old_style;
  }
}

// Processing inline styles:

// What type of variable have we got:
// Somethings can have one to four numerical values - specifying 
// say left, right, top bottom - for colours and measurements;
// Others have variable number of values - e.g. font size, colour, font style:
// IDENTIFYING WHAT WE HAVE GOT:
// =============================

/*
NB, there are no "shorthand" styles in PHPWord - all one to one attribute-values

Allow custom overriding of the values converter





'#multi' for 1 to 4 way order dependent settings
you should provide all four values however.

<attribute-name> '#box_ordered' => TRUE if describe attributes around a box and order is important (or FALSE if not important);
                 '0' => 'type' = 'hex' // options: hex, twip, pt, px, // you must use the correct PHPWord type for this element, otherwise you will get strange results! (e.g. very large or very small)
                                      //text,
                                      // position, list_style_type
                                      
                        'html_value' = 'inline' (say) - only required if type = 'text'
                        'phpword_name' = PHPAttribute name
                        'phpword_value' = PHPAttribute value // for type text only - otherwise
                        this value is created'
                 '1' => 'type' = 'color' .... etc.
 
        attribute:        
tag:    width   height    color   font-size   other
img     px      px      
other   twip    twip      hex     pt          twip

*/


function h2d_inline_styles() {
  
  $inline_styles = array(
    'border' => array(
      '#box_ordered' => FALSE,
      0 => array(
        'type' => 'twip',
        'phpword' => array(
          'borderSize' => '', // will be replaced with the appropriate value
        ),
      ),
      // NB border style can't be set in PHPWord
      1 => array(
        'type' => 'hex',
        'phpword' => array(
          'borderColor' => '', // will be replaced with the appropriate value
        ),
      ),
    ),
    
    'border-width' => array(
      '#box_ordered' => TRUE, // If you don't specify less than four measurements
                              // there may be circumstances when a css measurement
                              // is not applied.
      0 => array(
        'type' => 'twip',     // note borders can only be defined in twips
        'phpword' => array(
          'borderTopSize' => '',
        ),
      ),
      1 => array(
        'type' => 'twip',
        'phpword' => array(
          'borderRightSize' => '',
        ),
      ),
      2 => array(
        'type' => 'twip',
        'phpword' => array(
          'borderBottomSize' => '',
        ),
      ),
      3 => array(
        'type' => 'twip',
        'phpword' => array(
          'borderLeftSize' => '',
        ),
      ),
    ),
    
    'text-decoration' => array(
      '#box_ordered' => FALSE,
      0 => array(
        'type' => 'text', // default - don't need to specify
        'css_value' => 'underline',
        'phpword' => array(
          'underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE,
        ),
      ),
      1 => array(
        'type' => 'text', // default - don't need to specify
        'css_value' => 'none',
        'phpword' => array(
          'underline' => 'none', // signals that this phpword attribute should be unset
        ),
      ),
    ),
    
    
    
    
    
  ); 
  
  
  
  
}


/* 
                  
if order_important is set to true, then if four values map:
0->0, 1->1, 2->2, 3->3;
three values:
0->0, 1->1, 1->3, 2->2;
two values:
0->0, 0->2, 1->1, 1->3;
one value:
0->0, 0->1, 0->2, 0->3;

a value of auto - counts as a value, but not supported - so will be ignored (no computable widths of elements to be able to calculate what the margins should be).

// identify what certain numerical values are, 
// everything else is "text" - needing a 1:1 substitution:

// colour (hex)
#([0-9a-fA-F]{3}){1,2}
// colour (red, green, blue etc.)
convert to the appropriate numerical value

backgrounds with url() - not supported;

position constants - convert to appropriate PHPWord position:
top, center, bottom;
left, center, right;
justify (equiv to justify == both in PHPWord)

also (css): baseline, middle, sub, super, text-bottom, text-top.

// per cent
<numerical value> followed by '%' (is percentage of current style for this parameter)

similarly for em and ex: 1.25em or 1.25ex is 1.25x the currently set size

// pixel
<numerical value> folowed by 'px'

similarly - in, cm, mm, pc (as well as pt px)
pc - 1/6 inch
// zero value
0 

// border style - not supported in PHPWord

// List-style-type - can be supported for pseudo lists (but not PHPWord lists:
circle
disc
square
lower-alpha
upper-alpha
lower-roman
upper-roman
none

// text width:
thin, medium or thick - convert to 1, 3 and 5px (this is the standard)

// Other tags to include:
code;

// page-break-after/page-break-before (p417 css book)
- works only if set to always
- add a page break before or after the element (needs to go in the converter).


// for headings - addTitleStyle - when you come to a heading;
// then addTitle for the heading (text for the title, depth)
// note - you cannot do any more styling with headings created in this way - so any 
child elements will be all returned as text (when a heading is encountered)
// switch this feature on or off;
// with this feature, insert a table of contents at the beginning - separate
// styling for this. Specify an element for this to appear after (or none). e.g.
// 'h1' - this will be inserted after the first h1 element and so on.

text-transform - if set (feature within the converter) :
to capitalize, lowercase, uppercase (or none) the contained text.

another feature:
display - skip the element (value - none) - other values meaning display it
visibility - set the text in the element to '' (value - hidden) 

another feature for the converter:
whitespace - normal - as we have it;
nowrap - the same as above - we can't have endless text lines in word;
pre - whitespace is not collapsed (but could still break to a new line) (same for <pre> tag)

// You can't flow text around images

// font - style, - text match; variant - text match, weight - text match, (any order - optional) followed by size (required) - number match [line-height] family - text match
// so for font we can actually specify order NOT important

// font: constant - just a text replacement thing

// absolute size constants - for font size:
// 
array('xx-small' => '6',
'x-small' => '8',
'small' => '10',
'medium' => '12',
'large' => '14',
'x-large' => '18',
'xx-large' => '24',);

'smaller' => 1/1.2 of existing size
'larger' => 1.2 x existing size

// points
<numeric value> followed by 'pt'

font-style - simple text replacement

numeric value = 
a number - for font-weight - not supported - values are bold (or not)

*/
// Colour names converter:
// From: http://www.w3schools.com/cssref/css_colornames.asp
$colours = array(
'AliceBlue' => '#F0F8FF',
'AntiqueWhite' => '#FAEBD7',
'Aqua' => '#00FFFF',
'Aquamarine' => '#7FFFD4',
'Azure' => '#F0FFFF',
'Beige' => '#F5F5DC',
'Bisque' => '#FFE4C4',
'Black' => '#000000',
'BlanchedAlmond' => '#FFEBCD',
'Blue' => '#0000FF',
'BlueViolet' => '#8A2BE2',
'Brown' => '#A52A2A',
'BurlyWood' => '#DEB887',
'CadetBlue' => '#5F9EA0',
'Chartreuse' => '#7FFF00',
'Chocolate' => '#D2691E',
'Coral' => '#FF7F50',
'CornflowerBlue' => '#6495ED',
'Cornsilk' => '#FFF8DC',
'Crimson' => '#DC143C',
'Cyan' => '#00FFFF',
'DarkBlue' => '#00008B',
'DarkCyan' => '#008B8B',
'DarkGoldenRod' => '#B8860B',
'DarkGray' => '#A9A9A9',
'DarkGrey' => '#A9A9A9',
'DarkGreen' => '#006400',
'DarkKhaki' => '#BDB76B',
'DarkMagenta' => '#8B008B',
'DarkOliveGreen' => '#556B2F',
'Darkorange' => '#FF8C00',
'DarkOrchid' => '#9932CC',
'DarkRed' => '#8B0000',
'DarkSalmon' => '#E9967A',
'DarkSeaGreen' => '#8FBC8F',
'DarkSlateBlue' => '#483D8B',
'DarkSlateGray' => '#2F4F4F',
'DarkSlateGrey' => '#2F4F4F',
'DarkTurquoise' => '#00CED1',
'DarkViolet' => '#9400D3',
'DeepPink' => '#FF1493',
'DeepSkyBlue' => '#00BFFF',
'DimGray' => '#696969',
'DimGrey' => '#696969',
'DodgerBlue' => '#1E90FF',
'FireBrick' => '#B22222',
'FloralWhite' => '#FFFAF0',
'ForestGreen' => '#228B22',
'Fuchsia' => '#FF00FF',
'Gainsboro' => '#DCDCDC',
'GhostWhite' => '#F8F8FF',
'Gold' => '#FFD700',
'GoldenRod' => '#DAA520',
'Gray' => '#808080',
'Grey' => '#808080',
'Green' => '#008000',
'GreenYellow' => '#ADFF2F',
'HoneyDew' => '#F0FFF0',
'HotPink' => '#FF69B4',
'IndianRed ' => '#CD5C5C',
'Indigo ' => '#4B0082',
'Ivory' => '#FFFFF0',
'Khaki' => '#F0E68C',
'Lavender' => '#E6E6FA',
'LavenderBlush' => '#FFF0F5',
'LawnGreen' => '#7CFC00',
'LemonChiffon' => '#FFFACD',
'LightBlue' => '#ADD8E6',
'LightCoral' => '#F08080',
'LightCyan' => '#E0FFFF',
'LightGoldenRodYellow' => '#FAFAD2',
'LightGray' => '#D3D3D3',
'LightGrey' => '#D3D3D3',
'LightGreen' => '#90EE90',
'LightPink' => '#FFB6C1',
'LightSalmon' => '#FFA07A',
'LightSeaGreen' => '#20B2AA',
'LightSkyBlue' => '#87CEFA',
'LightSlateGray' => '#778899',
'LightSlateGrey' => '#778899',
'LightSteelBlue' => '#B0C4DE',
'LightYellow' => '#FFFFE0',
'Lime' => '#00FF00',
'LimeGreen' => '#32CD32',
'Linen' => '#FAF0E6',
'Magenta' => '#FF00FF',
'Maroon' => '#800000',
'MediumAquaMarine' => '#66CDAA',
'MediumBlue' => '#0000CD',
'MediumOrchid' => '#BA55D3',
'MediumPurple' => '#9370D8',
'MediumSeaGreen' => '#3CB371',
'MediumSlateBlue' => '#7B68EE',
'MediumSpringGreen' => '#00FA9A',
'MediumTurquoise' => '#48D1CC',
'MediumVioletRed' => '#C71585',
'MidnightBlue' => '#191970',
'MintCream' => '#F5FFFA',
'MistyRose' => '#FFE4E1',
'Moccasin' => '#FFE4B5',
'NavajoWhite' => '#FFDEAD',
'Navy' => '#000080',
'OldLace' => '#FDF5E6',
'Olive' => '#808000',
'OliveDrab' => '#6B8E23',
'Orange' => '#FFA500',
'OrangeRed' => '#FF4500',
'Orchid' => '#DA70D6',
'PaleGoldenRod' => '#EEE8AA',
'PaleGreen' => '#98FB98',
'PaleTurquoise' => '#AFEEEE',
'PaleVioletRed' => '#D87093',
'PapayaWhip' => '#FFEFD5',
'PeachPuff' => '#FFDAB9',
'Peru' => '#CD853F',
'Pink' => '#FFC0CB',
'Plum' => '#DDA0DD',
'PowderBlue' => '#B0E0E6',
'Purple' => '#800080',
'Red' => '#FF0000',
'RosyBrown' => '#BC8F8F',
'RoyalBlue' => '#4169E1',
'SaddleBrown' => '#8B4513',
'Salmon' => '#FA8072',
'SandyBrown' => '#F4A460',
'SeaGreen' => '#2E8B57',
'SeaShell' => '#FFF5EE',
'Sienna' => '#A0522D',
'Silver' => '#C0C0C0',
'SkyBlue' => '#87CEEB',
'SlateBlue' => '#6A5ACD',
'SlateGray' => '#708090',
'SlateGrey' => '#708090',
'Snow' => '#FFFAFA',
'SpringGreen' => '#00FF7F',
'SteelBlue' => '#4682B4',
'Tan' => '#D2B48C',
'Teal' => '#008080',
'Thistle' => '#D8BFD8',
'Tomato' => '#FF6347',
'Turquoise' => '#40E0D0',
'Violet' => '#EE82EE',
'Wheat' => '#F5DEB3',
'White' => '#FFFFFF',
'WhiteSmoke' => '#F5F5F5',
'Yellow' => '#FFFF00',
'YellowGreen' => '#9ACD32',
);


