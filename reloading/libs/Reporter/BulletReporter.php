<?php
/** @package    Reloading::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Bullet object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Reloading::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class BulletReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `Bullet` table
	public $CustomFieldExample;

	public $BulletId;
	public $BulletName;
	public $Caliber;
	public $BulletType;
	public $Manufacture;
	public $Grain;
	public $BallisticCoefficient;
	public $CostPerBullet;
	public $Amount;
	public $Material;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`Bullet`.`bullet_id` as BulletId
			,`Bullet`.`bullet_name` as BulletName
			,`Bullet`.`caliber` as Caliber
			,`Bullet`.`bullet_type` as BulletType
			,`Bullet`.`manufacture` as Manufacture
			,`Bullet`.`grain` as Grain
			,`Bullet`.`ballistic_coefficient` as BallisticCoefficient
			,`Bullet`.`cost_per_bullet` as CostPerBullet
			,`Bullet`.`amount` as Amount
			,`Bullet`.`material` as Material
		from `Bullet`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `Bullet`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>