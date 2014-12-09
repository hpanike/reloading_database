<?php
/** @package Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("UltrasonicCleanerMap.php");

/**
 * UltrasonicCleanerDAO provides object-oriented access to the Ultrasonic_Cleaner table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Reloading::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class UltrasonicCleanerDAO extends Phreezable
{
	/** @var int */
	public $UltrasonicCleanerId;

	/** @var string */
	public $Manufacture;

	/** @var string */
	public $UltrasonicCleanerSize;

	/** @var char */
	public $UltrasonicCleanerType;


	/**
	 * Returns a dataset of CleaningSolution objects with matching UltrasonicCleaner
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetUltrasonicCleanerCleaningSolutions($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "Cleaning_Solution_ibfk_1", $criteria);
	}


}
?>