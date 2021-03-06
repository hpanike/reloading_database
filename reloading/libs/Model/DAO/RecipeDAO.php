<?php
/** @package Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("RecipeMap.php");

/**
 * RecipeDAO provides object-oriented access to the Recipe table.  This
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
class RecipeDAO extends Phreezable
{
	/** @var int */
	public $RecipeId;

	/** @var string */
	public $RecipeName;

	/** @var int */
	public $Bullet;

	/** @var int */
	public $Powder;

	/** @var float */
	public $PowderAmountInGrains;

	/** @var int */
	public $Casing;

	/** @var int */
	public $Primer;

	/** @var string */
	public $BallisticData;

	/** @var float */
	public $CostPerBullet;

	/** @var int */
	public $AmountAvailable;


	/**
	 * Returns the foreign object based on the value of Powder
	 * @return Powder
	 */
	public function GetPowderPowder()
	{
		return $this->_phreezer->GetManyToOne($this, "Recipe_ibfk_1");
	}

	/**
	 * Returns the foreign object based on the value of Casing
	 * @return Casing
	 */
	public function GetCasingCasing()
	{
		return $this->_phreezer->GetManyToOne($this, "Recipe_ibfk_2");
	}

	/**
	 * Returns the foreign object based on the value of Primer
	 * @return Primer
	 */
	public function GetPrimerPrimer()
	{
		return $this->_phreezer->GetManyToOne($this, "Recipe_ibfk_3");
	}

	/**
	 * Returns the foreign object based on the value of Bullet
	 * @return Bullet
	 */
	public function GetBulletBullet()
	{
		return $this->_phreezer->GetManyToOne($this, "Recipe_ibfk_4");
	}


}
?>