<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2007-2013 Rene Nitzsche (rene@system25.de)
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

tx_rnbase::load('Tx_Rnbase_Domain_Model_ModelInterface');
tx_rnbase::load('Tx_Rnbase_Domain_Model_Base');

/**
 * Basisklasse für die meisten Model-Klassen. Sie stellt einen Konstruktor bereit, der sowohl
 * mit einer UID als auch mit einem Datensatz aufgerufen werden kann. Die Daten werden
 * in den Instanzvariablen $uid und $record abgelegt. Diese beiden Variablen sind also immer
 * verfügbar. Der Umfang von $record kann aber je nach Aufruf unterschiedlich sein!
 */
class tx_rnbase_model_base
	extends Tx_Rnbase_Domain_Model_Base
{
	/**
	 * old constructor for backwards compatibility
	 *
	 * @param mixed $rowOrUid
	 * @return NULL
	 */
	public function tx_rnbase_model_base($rowOrUid = NULL) {
		return $this->init($rowOrUid);
	}

	/**
	 * make uid and record public, for backwards compatibility.
	 * for changes at the record, it has to be an reference!
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function &__get ($name) {
		if ($name === 'record') {
			return $this->record;
		} elseif ($name === 'uid') {
			return $this->uid;
		}

		return NULL;
	}

	/**
	 * make uid and record public, for backwards compatibility.
	 * for changes at the record, it has to be an reference!
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function __set ($name, $value) {
		if ($name === 'record') {
			$this->record = $value;
		} elseif ($name === 'uid') {
			$this->uid = $value;
		}

		return NULL;
	}

	/**
	 * Returns the records uid
	 *
	 * @return int
	 */
	function getUid() {
		// backwards compatibility for models without a integer!
		if (!is_numeric($this->uid)) {
			return $this->uid;
		}
		return parent::getUid();
	}
	/**
	 * Liefert den Inhalt eine Spalte formatiert durch eine stdWrap. Per Konvention wird
	 * erwartet, das der Name der Spalte auch in der TS-Config verwendet wird.
	 * Wenn in einem Objekt der Klasse event eine Spalte/Attribut "date" existiert, dann sollte
	 * das passende TypoScript folgendes Aussehen haben:
	 * <pre>
	 * event.date.strftime = %d-%b-%y
	 * </pre>
	 * Hier wäre <b>event.</b> die $confId und <b>date</b> der Spaltename
	 * @param $formatter ein voll initialisierter Formatter für den Wrap
	 * @param $columnName der Name der Spalte
	 * @param $baseConfId Id der übergeordneten Config
	 * @param $colConfId Id der Spalte in der Config zum Aussetzen der Konvention (muss mit Punkt enden)
	 * @deprecated
	 */
	function getColumnWrapped($formatter, $columnName, $baseConfId, $colConfId = '') {
		$colConfId = ( strlen($colConfId) ) ? $colConfId : $columnName . '.';
		return $formatter->wrap($this->record[$columnName], $baseConfId . $colConfId);
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/rn_base/model/class.tx_rnbase_model_base.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/rn_base/model/class.tx_rnbase_model_base.php']);
}
