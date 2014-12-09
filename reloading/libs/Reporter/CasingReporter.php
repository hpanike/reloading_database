<?php
/** @package    Reloading::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Casing object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Reloading::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class CasingReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `Casing` table
	public $CustomFieldExample;

	public $CasingId;
	public $CasingName;
	public $Caliber;
	public $WallThickness;
	public $UseExpectancy;
	public $Amount;
	public $CostPerCasing;
	public $PocketSize;

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
			,`Casing`.`casing_id` as CasingId
			,`Casing`.`casing_name` as CasingName
			,`Casing`.`caliber` as Caliber
			,`Casing`.`wall_thickness` as WallThickness
			,`Casing`.`use_expectancy` as UseExpectancy
			,`Casing`.`amount` as Amount
			,`Casing`.`cost_per_casing` as CostPerCasing
			,`Casing`.`pocket_size` as PocketSize
		from `Casing`";

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
		$sql = "select count(1) as counter from `Casing`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>