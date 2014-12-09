<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * PowderMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the PowderDAO to the Powder datastore.
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
class PowderMap implements IDaoMap, IDaoMap2
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
			self::$FM["PowderId"] = new FieldMap("PowderId","Powder","powder_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Name"] = new FieldMap("Name","Powder","name",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["PowderType"] = new FieldMap("PowderType","Powder","powder_type",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["BurnRate"] = new FieldMap("BurnRate","Powder","burn_rate",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["QuantityInGrains"] = new FieldMap("QuantityInGrains","Powder","quantity_in_grains",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["CostPerGrain"] = new FieldMap("CostPerGrain","Powder","cost_per_grain",false,FM_TYPE_FLOAT,null,null,false);
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
			self::$KM["Recipe_ibfk_1"] = new KeyMap("Recipe_ibfk_1", "PowderId", "Recipe", "Powder", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>