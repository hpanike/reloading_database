<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * PocketCleanerMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the PocketCleanerDAO to the Pocket_Cleaner datastore.
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
class PocketCleanerMap implements IDaoMap, IDaoMap2
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
			self::$FM["PocketCleanerId"] = new FieldMap("PocketCleanerId","Pocket_Cleaner","pocket_cleaner_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Manufacture"] = new FieldMap("Manufacture","Pocket_Cleaner","manufacture",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["PocketCleanerSize"] = new FieldMap("PocketCleanerSize","Pocket_Cleaner","pocket_cleaner_size",false,FM_TYPE_CHAR,4,null,false);
			self::$FM["PocketCleanerType"] = new FieldMap("PocketCleanerType","Pocket_Cleaner","pocket_cleaner_type",false,FM_TYPE_VARCHAR,255,null,false);
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