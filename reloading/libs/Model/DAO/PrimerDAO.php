<?php
/** @package Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("PrimerMap.php");

/**
 * PrimerDAO provides object-oriented access to the Primer table.  This
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
class PrimerDAO extends Phreezable
{
	/** @var int */
	public $PrimerId;

	/** @var string */
	public $Name;

	/** @var string */
	public $Manufacture;

	/** @var char */
	public $PrimerSize;

	/** @var int */
	public $Quanity;

	/** @var float */
	public $CostPerPrimer;


	/**
	 * Returns a dataset of Recipe objects with matching Primer
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetPrimerRecipes($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "Recipe_ibfk_3", $criteria);
	}


}
?>