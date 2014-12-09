<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * PressMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the PressDAO to the Press datastore.
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
class PressMap implements IDaoMap, IDaoMap2
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
			self::$FM["PressId"] = new FieldMap("PressId","Press","press_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Manufacture"] = new FieldMap("Manufacture","Press","manufacture",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["ProductionRate"] = new FieldMap("ProductionRate","Press","production_rate",false,FM_TYPE_INT,11,null,false);
			self::$FM["PressType"] = new FieldMap("PressType","Press","press_type",false,FM_TYPE_CHAR,4,null,false);
			self::$FM["Thread"] = new FieldMap("Thread","Press","thread",false,FM_TYPE_VARCHAR,255,null,false);
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
			self::$KM["Die_ibfk_1"] = new KeyMap("Die_ibfk_1", "PressId", "Die", "Press", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>