<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * PowderDispenserMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the PowderDispenserDAO to the Powder_Dispenser datastore.
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
class PowderDispenserMap implements IDaoMap, IDaoMap2
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
			self::$FM["PowderDispenserId"] = new FieldMap("PowderDispenserId","Powder_Dispenser","powder_dispenser_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Manufacture"] = new FieldMap("Manufacture","Powder_Dispenser","manufacture",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["PdispenserType"] = new FieldMap("PdispenserType","Powder_Dispenser","pdispenser_type",false,FM_TYPE_VARCHAR,255,null,false);
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
		}
		return self::$KM;
	}

}

?>