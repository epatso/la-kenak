<?php
/**
 * PHPWord
 *
 * Copyright (c) 2011 PHPWord
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPWord
 * @package    PHPWord
 * @copyright  Copyright (c) 010 PHPWord
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    Beta 0.6.3, 08.07.2011
 */


/**
 * PHPWord_Section_Footer
 *
 * @category   PHPWord
 * @package    PHPWord_Section
 * @copyright  Copyright (c) 2011 PHPWord
 */
 
 //Below there is the statement of modifications to this file and this file only from the PHPWord Library distributed under the LGPL Lisence
 //which is being included in the distribution Labros Kenak v.1.0
 //This is mandatory by the lisence of PHPWord. Also if a user wants a way of doing the exact same thing with another php word library 
 //one can do this by changing the include_once("kenak_word.php"); line inside the file apotelesmata_kenak.php. 
 //This is to check that a user having this distributed software can use another library other than PHPWord.
 //This file is included in apotelesmata_kenak.php and in this file only. 
 //This file was modified in 15-January 2012 to get variables from a calculation and use PHPWord to store them in an word file 
 //Το αρχείο αυτό τροποποιήθηκε στις 15-Ιανουαρίου-2012 για να δέχεται τιμές από υπολογισμό και να αποθηκεύει ένα αρχείο word σε OPENXML format
 //Εαν αλλάξετε την κατάληξη του αρχείου docx μετά από ένα υπολογισμό ΚΕΝΑΚ σε zip θα παρατηρήσετε και την μορφή του φακέλου.
//This file was modified in utf8_encode() function to properly handle utf-8 strings
//Το αρχείο αυτό τροποποιήθηκε στην ρουτίνα utf8_encode() για να χειρίζεται τις τιμές με κωδικοποίηση utf-8 σωστά κατά την εγγραφή 
class PHPWord_Section_Footer {
	
	/**
	 * Footer Count
	 * 
	 * @var int
	 */
	private $_footerCount;
	
	/**
	 * Footer Relation ID
	 * 
	 * @var int
	 */
	private $_rId;
	
	/**
	 * Footer Element Collection
	 * 
	 * @var int
	 */
	private $_elementCollection = array();
	
	/**
	 * Create a new Footer
	 */
	public function __construct($sectionCount) {
		$this->_footerCount = $sectionCount;
	}
	
	/**
	 * Add a Text Element
	 * 
	 * @param string $text
	 * @param mixed $styleFont
	 * @param mixed $styleParagraph
	 * @return PHPWord_Section_Text
	 */
	public function addText($text, $styleFont = null, $styleParagraph = null) {
		//$givenText = utf8_encode($text);
		$givenText = $text;
		$text = new PHPWord_Section_Text($givenText, $styleFont, $styleParagraph);
		$this->_elementCollection[] = $text;
		return $text;
	}
	
	/**
	 * Add a TextBreak Element
	 * 
	 * @param int $count
	 */
	public function addTextBreak($count = 1) {
		for($i=1; $i<=$count; $i++) {
			$this->_elementCollection[] = new PHPWord_Section_TextBreak();
		}
	}
	
	/**
	 * Create a new TextRun
	 * 
	 * @return PHPWord_Section_TextRun
	 */
	public function createTextRun($styleParagraph = null) {
		$textRun = new PHPWord_Section_TextRun($styleParagraph);
		$this->_elementCollection[] = $textRun;
		return $textRun;
	}
	
	/**
	 * Add a Table Element
	 * 
	 * @param mixed $style
	 * @return PHPWord_Section_Table
	 */
	public function addTable($style = null) {
		$table = new PHPWord_Section_Table('footer', $this->_footerCount, $style);
		$this->_elementCollection[] = $table;
		return $table;
	}
	
	/**
	 * Add a Image Element
	 * 
	 * @param string $src
	 * @param mixed $style
	 * @return PHPWord_Section_Image
	 */
	public function addImage($src, $style = null) {
		$image = new PHPWord_Section_Image($src, $style);
		
		if(!is_null($image->getSource())) {
			$rID = PHPWord_Media::addFooterMediaElement($this->_footerCount, $src);
			$image->setRelationId($rID);
			
			$this->_elementCollection[] = $image;
			return $image;
		} else {
			trigger_error('Src does not exist or invalid image type.', E_ERROR);
		}
	}
	
	/**
	 * Add a by PHP created Image Element
	 * 
	 * @param string $link
	 * @param mixed $style
	 * @return PHPWord_Section_MemoryImage
	 */
	public function addMemoryImage($link, $style = null) {
		$memoryImage = new PHPWord_Section_MemoryImage($link, $style);
		if(!is_null($memoryImage->getSource())) {
			$rID = PHPWord_Media::addFooterMediaElement($this->_footerCount, $link, $memoryImage);
			$memoryImage->setRelationId($rID);
			
			$this->_elementCollection[] = $memoryImage;
			return $memoryImage;
		} else {
			trigger_error('Unsupported image type.');
		}
	}
	
	/**
	 * Add a PreserveText Element
	 * 
	 * @param string $text
	 * @param mixed $styleFont
	 * @param mixed $styleParagraph
	 * @return PHPWord_Section_Footer_PreserveText
	 */
	public function addPreserveText($text, $styleFont = null, $styleParagraph = null) {
		//$text = utf8_encode($text);
		$ptext = new PHPWord_Section_Footer_PreserveText($text, $styleFont, $styleParagraph);
		$this->_elementCollection[] = $ptext;
		return $ptext;
	}
	
	/**
	 * Get Footer Relation ID
	 */
	public function getRelationId() {
		return $this->_rId;
	}
	
	/**
	 * Set Footer Relation ID
	 * 
	 * @param int $rId
	 */
	public function setRelationId($rId) {
		$this->_rId = $rId;
	}
	
	/**
	 * Get all Footer Elements
	 */
	public function getElements() {
		return $this->_elementCollection;
	}
	
	/**
	 * Get Footer Count
	 */
	public function getFooterCount() {
		return $this->_footerCount;
	}
}
?>