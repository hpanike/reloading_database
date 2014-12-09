<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * RecipeCriteria allows custom querying for the Recipe object.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the ModelCriteria class which is extended from this class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @inheritdocs
 * @package Reloading::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class RecipeCriteriaDAO extends Criteria
{

	public $RecipeId_Equals;
	public $RecipeId_NotEquals;
	public $RecipeId_IsLike;
	public $RecipeId_IsNotLike;
	public $RecipeId_BeginsWith;
	public $RecipeId_EndsWith;
	public $RecipeId_GreaterThan;
	public $RecipeId_GreaterThanOrEqual;
	public $RecipeId_LessThan;
	public $RecipeId_LessThanOrEqual;
	public $RecipeId_In;
	public $RecipeId_IsNotEmpty;
	public $RecipeId_IsEmpty;
	public $RecipeId_BitwiseOr;
	public $RecipeId_BitwiseAnd;
	public $RecipeName_Equals;
	public $RecipeName_NotEquals;
	public $RecipeName_IsLike;
	public $RecipeName_IsNotLike;
	public $RecipeName_BeginsWith;
	public $RecipeName_EndsWith;
	public $RecipeName_GreaterThan;
	public $RecipeName_GreaterThanOrEqual;
	public $RecipeName_LessThan;
	public $RecipeName_LessThanOrEqual;
	public $RecipeName_In;
	public $RecipeName_IsNotEmpty;
	public $RecipeName_IsEmpty;
	public $RecipeName_BitwiseOr;
	public $RecipeName_BitwiseAnd;
	public $Bullet_Equals;
	public $Bullet_NotEquals;
	public $Bullet_IsLike;
	public $Bullet_IsNotLike;
	public $Bullet_BeginsWith;
	public $Bullet_EndsWith;
	public $Bullet_GreaterThan;
	public $Bullet_GreaterThanOrEqual;
	public $Bullet_LessThan;
	public $Bullet_LessThanOrEqual;
	public $Bullet_In;
	public $Bullet_IsNotEmpty;
	public $Bullet_IsEmpty;
	public $Bullet_BitwiseOr;
	public $Bullet_BitwiseAnd;
	public $Powder_Equals;
	public $Powder_NotEquals;
	public $Powder_IsLike;
	public $Powder_IsNotLike;
	public $Powder_BeginsWith;
	public $Powder_EndsWith;
	public $Powder_GreaterThan;
	public $Powder_GreaterThanOrEqual;
	public $Powder_LessThan;
	public $Powder_LessThanOrEqual;
	public $Powder_In;
	public $Powder_IsNotEmpty;
	public $Powder_IsEmpty;
	public $Powder_BitwiseOr;
	public $Powder_BitwiseAnd;
	public $PowderAmountInGrains_Equals;
	public $PowderAmountInGrains_NotEquals;
	public $PowderAmountInGrains_IsLike;
	public $PowderAmountInGrains_IsNotLike;
	public $PowderAmountInGrains_BeginsWith;
	public $PowderAmountInGrains_EndsWith;
	public $PowderAmountInGrains_GreaterThan;
	public $PowderAmountInGrains_GreaterThanOrEqual;
	public $PowderAmountInGrains_LessThan;
	public $PowderAmountInGrains_LessThanOrEqual;
	public $PowderAmountInGrains_In;
	public $PowderAmountInGrains_IsNotEmpty;
	public $PowderAmountInGrains_IsEmpty;
	public $PowderAmountInGrains_BitwiseOr;
	public $PowderAmountInGrains_BitwiseAnd;
	public $Casing_Equals;
	public $Casing_NotEquals;
	public $Casing_IsLike;
	public $Casing_IsNotLike;
	public $Casing_BeginsWith;
	public $Casing_EndsWith;
	public $Casing_GreaterThan;
	public $Casing_GreaterThanOrEqual;
	public $Casing_LessThan;
	public $Casing_LessThanOrEqual;
	public $Casing_In;
	public $Casing_IsNotEmpty;
	public $Casing_IsEmpty;
	public $Casing_BitwiseOr;
	public $Casing_BitwiseAnd;
	public $Primer_Equals;
	public $Primer_NotEquals;
	public $Primer_IsLike;
	public $Primer_IsNotLike;
	public $Primer_BeginsWith;
	public $Primer_EndsWith;
	public $Primer_GreaterThan;
	public $Primer_GreaterThanOrEqual;
	public $Primer_LessThan;
	public $Primer_LessThanOrEqual;
	public $Primer_In;
	public $Primer_IsNotEmpty;
	public $Primer_IsEmpty;
	public $Primer_BitwiseOr;
	public $Primer_BitwiseAnd;
	public $BallisticData_Equals;
	public $BallisticData_NotEquals;
	public $BallisticData_IsLike;
	public $BallisticData_IsNotLike;
	public $BallisticData_BeginsWith;
	public $BallisticData_EndsWith;
	public $BallisticData_GreaterThan;
	public $BallisticData_GreaterThanOrEqual;
	public $BallisticData_LessThan;
	public $BallisticData_LessThanOrEqual;
	public $BallisticData_In;
	public $BallisticData_IsNotEmpty;
	public $BallisticData_IsEmpty;
	public $BallisticData_BitwiseOr;
	public $BallisticData_BitwiseAnd;
	public $CostPerBullet_Equals;
	public $CostPerBullet_NotEquals;
	public $CostPerBullet_IsLike;
	public $CostPerBullet_IsNotLike;
	public $CostPerBullet_BeginsWith;
	public $CostPerBullet_EndsWith;
	public $CostPerBullet_GreaterThan;
	public $CostPerBullet_GreaterThanOrEqual;
	public $CostPerBullet_LessThan;
	public $CostPerBullet_LessThanOrEqual;
	public $CostPerBullet_In;
	public $CostPerBullet_IsNotEmpty;
	public $CostPerBullet_IsEmpty;
	public $CostPerBullet_BitwiseOr;
	public $CostPerBullet_BitwiseAnd;
	public $AmountAvailable_Equals;
	public $AmountAvailable_NotEquals;
	public $AmountAvailable_IsLike;
	public $AmountAvailable_IsNotLike;
	public $AmountAvailable_BeginsWith;
	public $AmountAvailable_EndsWith;
	public $AmountAvailable_GreaterThan;
	public $AmountAvailable_GreaterThanOrEqual;
	public $AmountAvailable_LessThan;
	public $AmountAvailable_LessThanOrEqual;
	public $AmountAvailable_In;
	public $AmountAvailable_IsNotEmpty;
	public $AmountAvailable_IsEmpty;
	public $AmountAvailable_BitwiseOr;
	public $AmountAvailable_BitwiseAnd;

}

?>