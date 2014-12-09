<?php
/** @package Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("BulletMap.php");

/**
 * BulletDAO provides object-oriented access to the Bullet table.  This
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
class BulletDAO extends Phreezable
{
	/** @var int */
	public $BulletId;

	/** @var string */
	public $BulletName;

	/** @var float */
	public $Caliber;

	/** @var string */
	public $BulletType;

	/** @var string */
	public $Manufacture;

	/** @var int */
	public $Grain;

	/** @var float */
	public $BallisticCoefficient;

	/** @var float */
	public $CostPerBullet;

	/** @var int */
	public $Amount;

	/** @var string */
	public $Material;


	/**
	 * Returns a dataset of Recipe objects with matching Bullet
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetBulletRecipes($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "Recipe_ibfk_4", $criteria);
	}


}
?>