<?php
/** @package Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("CleaningSolutionMap.php");

/**
 * CleaningSolutionDAO provides object-oriented access to the Cleaning_Solution table.  This
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
class CleaningSolutionDAO extends Phreezable
{
	/** @var int */
	public $SolutionId;

	/** @var string */
	public $Manufacture;

	/** @var string */
	public $Formula;

	/** @var float */
	public $Cost;

	/** @var float */
	public $Amount;

	/** @var int */
	public $UltrasonicCleaner;


	/**
	 * Returns the foreign object based on the value of UltrasonicCleaner
	 * @return UltrasonicCleaner
	 */
	public function GetUltrasonicCleanerUltrasonicCleaner()
	{
		return $this->_phreezer->GetManyToOne($this, "Cleaning_Solution_ibfk_1");
	}


}
?>