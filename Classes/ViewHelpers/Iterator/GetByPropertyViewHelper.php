<?php
namespace NN\NnAddress\ViewHelpers\Iterator;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Hendrik Reimers <h.reimers@neonaut.de>, Neonaut GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Returns the first element of $haystack
 *
 * @autho by Hendrik Reimers
 * @package NnAddress
 * @subpackage ViewHelpers\Iterator
 */
class GetByPropertyViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper  {

	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerArgument('object', 'mixed', 'Object in which to look', FALSE, NULL);
		$this->registerArgument('property', 'string', 'Property in which to look for needle', FALSE, NULL);
		$this->registerArgument('value', 'string', 'Value for looking', FALSE, NULL);
	}

	/**
	 * Render method
	 *
	 * @return mixed|NULL
	 */
	public function render() {
		$object = $this->arguments['object'];
		$key    = $this->arguments['property'];
		$val    = $this->arguments['value'];
		
		if ( NULL === $object ) $object = $this->renderChildren();
		if ( NULL === $object ) return NULL;
		if ( NULL === $key ) return NULL;
		if ( NULL === $val ) return NULL;
		
		$object->rewind();
		
		for ( $i = 1; $i <= $object->count(); $i++ ) {
			$cur = $object->current();
			$keyFunc = 'get'.ucfirst($key);
			if ( $cur->$keyFunc() == $val ) return $cur;
			$object->next();
		}
		
		return NULL;
	}

}
