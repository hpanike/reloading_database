<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * BrushMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the BrushDAO to the Brush datastore.
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
class BrushMap implements IDaoMap, IDaoMap2
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
			self::$FM["BrushId"] = new FieldMap("BrushId","Brush","brush_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Caliber"] = new FieldMap("Caliber","Brush","caliber",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["Thread"] = new FieldMap("Thread","Brush","thread",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Material"] = new FieldMap("Material","Brush","material",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Handle"] = new FieldMap("Handle","Brush","handle",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["Brush_ibfk_1"] = new KeyMap("Brush_ibfk_1", "Handle", "Handle", "HandleId", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>