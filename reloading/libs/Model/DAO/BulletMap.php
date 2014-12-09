<?php
/** @package    Reloading::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * BulletMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the BulletDAO to the Bullet datastore.
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
class BulletMap implements IDaoMap, IDaoMap2
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
			self::$FM["BulletId"] = new FieldMap("BulletId","Bullet","bullet_id",true,FM_TYPE_INT,11,null,true);
			self::$FM["BulletName"] = new FieldMap("BulletName","Bullet","bullet_name",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Caliber"] = new FieldMap("Caliber","Bullet","caliber",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["BulletType"] = new FieldMap("BulletType","Bullet","bullet_type",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Manufacture"] = new FieldMap("Manufacture","Bullet","manufacture",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Grain"] = new FieldMap("Grain","Bullet","grain",false,FM_TYPE_INT,11,null,false);
			self::$FM["BallisticCoefficient"] = new FieldMap("BallisticCoefficient","Bullet","ballistic_coefficient",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["CostPerBullet"] = new FieldMap("CostPerBullet","Bullet","cost_per_bullet",false,FM_TYPE_FLOAT,null,null,false);
			self::$FM["Amount"] = new FieldMap("Amount","Bullet","amount",false,FM_TYPE_INT,11,null,false);
			self::$FM["Material"] = new FieldMap("Material","Bullet","material",false,FM_TYPE_VARCHAR,255,null,false);
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
			self::$KM["Recipe_ibfk_4"] = new KeyMap("Recipe_ibfk_4", "BulletId", "Recipe", "Bullet", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
		}
		return self::$KM;
	}

}

?>