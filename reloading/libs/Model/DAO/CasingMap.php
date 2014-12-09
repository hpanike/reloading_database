<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * CasingMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the CasingDAO to the Casing datastore.
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
class CasingMap implements IDaoMap, IDaoMap2
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
			self::$FM["CasingId"] = new FieldMap("CasingId","Casing","casing_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["CasingName"] = new FieldMap("CasingName","Casing","casing_name",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Caliber"] = new FieldMap("Caliber","Casing","caliber",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["WallThickness"] = new FieldMap("WallThickness","Casing","wall_thickness",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["UseExpectancy"] = new FieldMap("UseExpectancy","Casing","use_expectancy",false,FM_TYPE_INT,11,null,false);
			self::$FM["Amount"] = new FieldMap("Amount","Casing","amount",false,FM_TYPE_INT,11,null,false);
			self::$FM["CostPerCasing"] = new FieldMap("CostPerCasing","Casing","cost_per_casing",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["PocketSize"] = new FieldMap("PocketSize","Casing","pocket_size",false,FM_TYPE_CHAR,4,null,false);
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
			self::$KM["Recipe_ibfk_2"] = new KeyMap("Recipe_ibfk_2", "CasingId", "Recipe", "Casing", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>