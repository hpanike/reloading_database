<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * RecipeMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the RecipeDAO to the Recipe datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Reloading::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class RecipeMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["RecipeId"] = new FieldMap("RecipeId","Recipe","recipe_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["RecipeName"] = new FieldMap("RecipeName","Recipe","recipe_name",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Bullet"] = new FieldMap("Bullet","Recipe","bullet",false,FM_TYPE_INT,11,null,false);
			self::$FM["Powder"] = new FieldMap("Powder","Recipe","powder",false,FM_TYPE_INT,11,null,false);
			self::$FM["PowderAmountInGrains"] = new FieldMap("PowderAmountInGrains","Recipe","powder_amount_in_grains",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["Casing"] = new FieldMap("Casing","Recipe","casing",false,FM_TYPE_INT,11,null,false);
			self::$FM["Primer"] = new FieldMap("Primer","Recipe","primer",false,FM_TYPE_INT,11,null,false);
			self::$FM["BallisticData"] = new FieldMap("BallisticData","Recipe","ballistic_data",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["CostPerBullet"] = new FieldMap("CostPerBullet","Recipe","cost_per_bullet",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["AmountAvailable"] = new FieldMap("AmountAvailable","Recipe","amount_available",false,FM_TYPE_INT,11,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["Recipe_ibfk_1"] = new KeyMap("Recipe_ibfk_1", "Powder", "Powder", "PowderId", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["Recipe_ibfk_2"] = new KeyMap("Recipe_ibfk_2", "Casing", "Casing", "CasingId", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["Recipe_ibfk_3"] = new KeyMap("Recipe_ibfk_3", "Primer", "Primer", "PrimerId", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["Recipe_ibfk_4"] = new KeyMap("Recipe_ibfk_4", "Bullet", "Bullet", "BulletId", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>