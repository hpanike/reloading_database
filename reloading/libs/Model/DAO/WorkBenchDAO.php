<?php
/** @package Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("WorkBenchMap.php");

/**
 * WorkBenchDAO provides object-oriented access to the Work_Bench table.  This
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
class WorkBenchDAO extends Phreezable
{
	/** @var int */
	public $WorkBenchId;

	/** @var string */
	public $Name;

	/** @var string */
	public $WorkBenchType;

	/** @var string */
	public $WworkBenchSize;



}
?>