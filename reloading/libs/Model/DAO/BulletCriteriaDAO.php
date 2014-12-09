<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * BulletCriteria allows custom querying for the Bullet object.
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
class BulletCriteriaDAO extends Criteria
{

	public $BulletId_Equals;
	public $BulletId_NotEquals;
	public $BulletId_IsLike;
	public $BulletId_IsNotLike;
	public $BulletId_BeginsWith;
	public $BulletId_EndsWith;
	public $BulletId_GreaterThan;
	public $BulletId_GreaterThanOrEqual;
	public $BulletId_LessThan;
	public $BulletId_LessThanOrEqual;
	public $BulletId_In;
	public $BulletId_IsNotEmpty;
	public $BulletId_IsEmpty;
	public $BulletId_BitwiseOr;
	public $BulletId_BitwiseAnd;
	public $BulletName_Equals;
	public $BulletName_NotEquals;
	public $BulletName_IsLike;
	public $BulletName_IsNotLike;
	public $BulletName_BeginsWith;
	public $BulletName_EndsWith;
	public $BulletName_GreaterThan;
	public $BulletName_GreaterThanOrEqual;
	public $BulletName_LessThan;
	public $BulletName_LessThanOrEqual;
	public $BulletName_In;
	public $BulletName_IsNotEmpty;
	public $BulletName_IsEmpty;
	public $BulletName_BitwiseOr;
	public $BulletName_BitwiseAnd;
	public $Caliber_Equals;
	public $Caliber_NotEquals;
	public $Caliber_IsLike;
	public $Caliber_IsNotLike;
	public $Caliber_BeginsWith;
	public $Caliber_EndsWith;
	public $Caliber_GreaterThan;
	public $Caliber_GreaterThanOrEqual;
	public $Caliber_LessThan;
	public $Caliber_LessThanOrEqual;
	public $Caliber_In;
	public $Caliber_IsNotEmpty;
	public $Caliber_IsEmpty;
	public $Caliber_BitwiseOr;
	public $Caliber_BitwiseAnd;
	public $BulletType_Equals;
	public $BulletType_NotEquals;
	public $BulletType_IsLike;
	public $BulletType_IsNotLike;
	public $BulletType_BeginsWith;
	public $BulletType_EndsWith;
	public $BulletType_GreaterThan;
	public $BulletType_GreaterThanOrEqual;
	public $BulletType_LessThan;
	public $BulletType_LessThanOrEqual;
	public $BulletType_In;
	public $BulletType_IsNotEmpty;
	public $BulletType_IsEmpty;
	public $BulletType_BitwiseOr;
	public $BulletType_BitwiseAnd;
	public $Manufacture_Equals;
	public $Manufacture_NotEquals;
	public $Manufacture_IsLike;
	public $Manufacture_IsNotLike;
	public $Manufacture_BeginsWith;
	public $Manufacture_EndsWith;
	public $Manufacture_GreaterThan;
	public $Manufacture_GreaterThanOrEqual;
	public $Manufacture_LessThan;
	public $Manufacture_LessThanOrEqual;
	public $Manufacture_In;
	public $Manufacture_IsNotEmpty;
	public $Manufacture_IsEmpty;
	public $Manufacture_BitwiseOr;
	public $Manufacture_BitwiseAnd;
	public $Grain_Equals;
	public $Grain_NotEquals;
	public $Grain_IsLike;
	public $Grain_IsNotLike;
	public $Grain_BeginsWith;
	public $Grain_EndsWith;
	public $Grain_GreaterThan;
	public $Grain_GreaterThanOrEqual;
	public $Grain_LessThan;
	public $Grain_LessThanOrEqual;
	public $Grain_In;
	public $Grain_IsNotEmpty;
	public $Grain_IsEmpty;
	public $Grain_BitwiseOr;
	public $Grain_BitwiseAnd;
	public $BallisticCoefficient_Equals;
	public $BallisticCoefficient_NotEquals;
	public $BallisticCoefficient_IsLike;
	public $BallisticCoefficient_IsNotLike;
	public $BallisticCoefficient_BeginsWith;
	public $BallisticCoefficient_EndsWith;
	public $BallisticCoefficient_GreaterThan;
	public $BallisticCoefficient_GreaterThanOrEqual;
	public $BallisticCoefficient_LessThan;
	public $BallisticCoefficient_LessThanOrEqual;
	public $BallisticCoefficient_In;
	public $BallisticCoefficient_IsNotEmpty;
	public $BallisticCoefficient_IsEmpty;
	public $BallisticCoefficient_BitwiseOr;
	public $BallisticCoefficient_BitwiseAnd;
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
	public $Amount_Equals;
	public $Amount_NotEquals;
	public $Amount_IsLike;
	public $Amount_IsNotLike;
	public $Amount_BeginsWith;
	public $Amount_EndsWith;
	public $Amount_GreaterThan;
	public $Amount_GreaterThanOrEqual;
	public $Amount_LessThan;
	public $Amount_LessThanOrEqual;
	public $Amount_In;
	public $Amount_IsNotEmpty;
	public $Amount_IsEmpty;
	public $Amount_BitwiseOr;
	public $Amount_BitwiseAnd;
	public $Material_Equals;
	public $Material_NotEquals;
	public $Material_IsLike;
	public $Material_IsNotLike;
	public $Material_BeginsWith;
	public $Material_EndsWith;
	public $Material_GreaterThan;
	public $Material_GreaterThanOrEqual;
	public $Material_LessThan;
	public $Material_LessThanOrEqual;
	public $Material_In;
	public $Material_IsNotEmpty;
	public $Material_IsEmpty;
	public $Material_BitwiseOr;
	public $Material_BitwiseAnd;

}

?>