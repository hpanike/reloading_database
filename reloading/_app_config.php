<?php
/**
 * @package RELOADING
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// Brush
	'GET:brushes' => array('route' => 'Brush.ListView'),
	'GET:brush/(:num)' => array('route' => 'Brush.SingleView', 'params' => array('brushId' => 1)),
	'GET:api/brushes' => array('route' => 'Brush.Query'),
	'POST:api/brush' => array('route' => 'Brush.Create'),
	'GET:api/brush/(:num)' => array('route' => 'Brush.Read', 'params' => array('brushId' => 2)),
	'PUT:api/brush/(:num)' => array('route' => 'Brush.Update', 'params' => array('brushId' => 2)),
	'DELETE:api/brush/(:num)' => array('route' => 'Brush.Delete', 'params' => array('brushId' => 2)),
		
	// Bullet
	'GET:bullets' => array('route' => 'Bullet.ListView'),
	'GET:bullet/(:num)' => array('route' => 'Bullet.SingleView', 'params' => array('bulletId' => 1)),
	'GET:api/bullets' => array('route' => 'Bullet.Query'),
	'POST:api/bullet' => array('route' => 'Bullet.Create'),
	'GET:api/bullet/(:num)' => array('route' => 'Bullet.Read', 'params' => array('bulletId' => 2)),
	'PUT:api/bullet/(:num)' => array('route' => 'Bullet.Update', 'params' => array('bulletId' => 2)),
	'DELETE:api/bullet/(:num)' => array('route' => 'Bullet.Delete', 'params' => array('bulletId' => 2)),
		
	// Cartridge
	'GET:cartridges' => array('route' => 'Cartridge.ListView'),
	'GET:cartridge/(:any)' => array('route' => 'Cartridge.SingleView', 'params' => array('name' => 1)),
	'GET:api/cartridges' => array('route' => 'Cartridge.Query'),
	'POST:api/cartridge' => array('route' => 'Cartridge.Create'),
	'GET:api/cartridge/(:any)' => array('route' => 'Cartridge.Read', 'params' => array('name' => 2)),
	'PUT:api/cartridge/(:any)' => array('route' => 'Cartridge.Update', 'params' => array('name' => 2)),
	'DELETE:api/cartridge/(:any)' => array('route' => 'Cartridge.Delete', 'params' => array('name' => 2)),
		
	// Casing
	'GET:casings' => array('route' => 'Casing.ListView'),
	'GET:casing/(:num)' => array('route' => 'Casing.SingleView', 'params' => array('casingId' => 1)),
	'GET:api/casings' => array('route' => 'Casing.Query'),
	'POST:api/casing' => array('route' => 'Casing.Create'),
	'GET:api/casing/(:num)' => array('route' => 'Casing.Read', 'params' => array('casingId' => 2)),
	'PUT:api/casing/(:num)' => array('route' => 'Casing.Update', 'params' => array('casingId' => 2)),
	'DELETE:api/casing/(:num)' => array('route' => 'Casing.Delete', 'params' => array('casingId' => 2)),
		
	// CasingTrimmer
	'GET:casingtrimmers' => array('route' => 'CasingTrimmer.ListView'),
	'GET:casingtrimmer/(:num)' => array('route' => 'CasingTrimmer.SingleView', 'params' => array('trimmerId' => 1)),
	'GET:api/casingtrimmers' => array('route' => 'CasingTrimmer.Query'),
	'POST:api/casingtrimmer' => array('route' => 'CasingTrimmer.Create'),
	'GET:api/casingtrimmer/(:num)' => array('route' => 'CasingTrimmer.Read', 'params' => array('trimmerId' => 2)),
	'PUT:api/casingtrimmer/(:num)' => array('route' => 'CasingTrimmer.Update', 'params' => array('trimmerId' => 2)),
	'DELETE:api/casingtrimmer/(:num)' => array('route' => 'CasingTrimmer.Delete', 'params' => array('trimmerId' => 2)),
		
	// CleaningSolution
	'GET:cleaningsolutions' => array('route' => 'CleaningSolution.ListView'),
	'GET:cleaningsolution/(:num)' => array('route' => 'CleaningSolution.SingleView', 'params' => array('solutionId' => 1)),
	'GET:api/cleaningsolutions' => array('route' => 'CleaningSolution.Query'),
	'POST:api/cleaningsolution' => array('route' => 'CleaningSolution.Create'),
	'GET:api/cleaningsolution/(:num)' => array('route' => 'CleaningSolution.Read', 'params' => array('solutionId' => 2)),
	'PUT:api/cleaningsolution/(:num)' => array('route' => 'CleaningSolution.Update', 'params' => array('solutionId' => 2)),
	'DELETE:api/cleaningsolution/(:num)' => array('route' => 'CleaningSolution.Delete', 'params' => array('solutionId' => 2)),
		
	// Die
	'GET:dies' => array('route' => 'Die.ListView'),
	'GET:die/(:num)' => array('route' => 'Die.SingleView', 'params' => array('dieId' => 1)),
	'GET:api/dies' => array('route' => 'Die.Query'),
	'POST:api/die' => array('route' => 'Die.Create'),
	'GET:api/die/(:num)' => array('route' => 'Die.Read', 'params' => array('dieId' => 2)),
	'PUT:api/die/(:num)' => array('route' => 'Die.Update', 'params' => array('dieId' => 2)),
	'DELETE:api/die/(:num)' => array('route' => 'Die.Delete', 'params' => array('dieId' => 2)),
		
	// HandPrimer
	'GET:handprimers' => array('route' => 'HandPrimer.ListView'),
	'GET:handprimer/(:any)' => array('route' => 'HandPrimer.SingleView', 'params' => array('anufacture' => 1)),
	'GET:api/handprimers' => array('route' => 'HandPrimer.Query'),
	'POST:api/handprimer' => array('route' => 'HandPrimer.Create'),
	'GET:api/handprimer/(:any)' => array('route' => 'HandPrimer.Read', 'params' => array('anufacture' => 2)),
	'PUT:api/handprimer/(:any)' => array('route' => 'HandPrimer.Update', 'params' => array('anufacture' => 2)),
	'DELETE:api/handprimer/(:any)' => array('route' => 'HandPrimer.Delete', 'params' => array('anufacture' => 2)),
		
	// Handle
	'GET:handles' => array('route' => 'Handle.ListView'),
	'GET:handle/(:num)' => array('route' => 'Handle.SingleView', 'params' => array('handleId' => 1)),
	'GET:api/handles' => array('route' => 'Handle.Query'),
	'POST:api/handle' => array('route' => 'Handle.Create'),
	'GET:api/handle/(:num)' => array('route' => 'Handle.Read', 'params' => array('handleId' => 2)),
	'PUT:api/handle/(:num)' => array('route' => 'Handle.Update', 'params' => array('handleId' => 2)),
	'DELETE:api/handle/(:num)' => array('route' => 'Handle.Delete', 'params' => array('handleId' => 2)),
		
	// PocketCleaner
	'GET:pocketcleaners' => array('route' => 'PocketCleaner.ListView'),
	'GET:pocketcleaner/(:num)' => array('route' => 'PocketCleaner.SingleView', 'params' => array('pocketCleanerId' => 1)),
	'GET:api/pocketcleaners' => array('route' => 'PocketCleaner.Query'),
	'POST:api/pocketcleaner' => array('route' => 'PocketCleaner.Create'),
	'GET:api/pocketcleaner/(:num)' => array('route' => 'PocketCleaner.Read', 'params' => array('pocketCleanerId' => 2)),
	'PUT:api/pocketcleaner/(:num)' => array('route' => 'PocketCleaner.Update', 'params' => array('pocketCleanerId' => 2)),
	'DELETE:api/pocketcleaner/(:num)' => array('route' => 'PocketCleaner.Delete', 'params' => array('pocketCleanerId' => 2)),
		
	// Powder
	'GET:powders' => array('route' => 'Powder.ListView'),
	'GET:powder/(:num)' => array('route' => 'Powder.SingleView', 'params' => array('powderId' => 1)),
	'GET:api/powders' => array('route' => 'Powder.Query'),
	'POST:api/powder' => array('route' => 'Powder.Create'),
	'GET:api/powder/(:num)' => array('route' => 'Powder.Read', 'params' => array('powderId' => 2)),
	'PUT:api/powder/(:num)' => array('route' => 'Powder.Update', 'params' => array('powderId' => 2)),
	'DELETE:api/powder/(:num)' => array('route' => 'Powder.Delete', 'params' => array('powderId' => 2)),
		
	// PowderDispenser
	'GET:powderdispensers' => array('route' => 'PowderDispenser.ListView'),
	'GET:powderdispenser/(:num)' => array('route' => 'PowderDispenser.SingleView', 'params' => array('powderDispenserId' => 1)),
	'GET:api/powderdispensers' => array('route' => 'PowderDispenser.Query'),
	'POST:api/powderdispenser' => array('route' => 'PowderDispenser.Create'),
	'GET:api/powderdispenser/(:num)' => array('route' => 'PowderDispenser.Read', 'params' => array('powderDispenserId' => 2)),
	'PUT:api/powderdispenser/(:num)' => array('route' => 'PowderDispenser.Update', 'params' => array('powderDispenserId' => 2)),
	'DELETE:api/powderdispenser/(:num)' => array('route' => 'PowderDispenser.Delete', 'params' => array('powderDispenserId' => 2)),
		
	// Press
	'GET:presses' => array('route' => 'Press.ListView'),
	'GET:press/(:num)' => array('route' => 'Press.SingleView', 'params' => array('pressId' => 1)),
	'GET:api/presses' => array('route' => 'Press.Query'),
	'POST:api/press' => array('route' => 'Press.Create'),
	'GET:api/press/(:num)' => array('route' => 'Press.Read', 'params' => array('pressId' => 2)),
	'PUT:api/press/(:num)' => array('route' => 'Press.Update', 'params' => array('pressId' => 2)),
	'DELETE:api/press/(:num)' => array('route' => 'Press.Delete', 'params' => array('pressId' => 2)),
		
	// Primer
	'GET:primers' => array('route' => 'Primer.ListView'),
	'GET:primer/(:num)' => array('route' => 'Primer.SingleView', 'params' => array('primerId' => 1)),
	'GET:api/primers' => array('route' => 'Primer.Query'),
	'POST:api/primer' => array('route' => 'Primer.Create'),
	'GET:api/primer/(:num)' => array('route' => 'Primer.Read', 'params' => array('primerId' => 2)),
	'PUT:api/primer/(:num)' => array('route' => 'Primer.Update', 'params' => array('primerId' => 2)),
	'DELETE:api/primer/(:num)' => array('route' => 'Primer.Delete', 'params' => array('primerId' => 2)),
		
	// Recipe
	'GET:recipes' => array('route' => 'Recipe.ListView'),
	'GET:recipe/(:num)' => array('route' => 'Recipe.SingleView', 'params' => array('recipeId' => 1)),
	'GET:api/recipes' => array('route' => 'Recipe.Query'),
	'POST:api/recipe' => array('route' => 'Recipe.Create'),
	'GET:api/recipe/(:num)' => array('route' => 'Recipe.Read', 'params' => array('recipeId' => 2)),
	'PUT:api/recipe/(:num)' => array('route' => 'Recipe.Update', 'params' => array('recipeId' => 2)),
	'DELETE:api/recipe/(:num)' => array('route' => 'Recipe.Delete', 'params' => array('recipeId' => 2)),
		
	// ShellHolder
	'GET:shellholders' => array('route' => 'ShellHolder.ListView'),
	'GET:shellholder/(:num)' => array('route' => 'ShellHolder.SingleView', 'params' => array('shellHolderId' => 1)),
	'GET:api/shellholders' => array('route' => 'ShellHolder.Query'),
	'POST:api/shellholder' => array('route' => 'ShellHolder.Create'),
	'GET:api/shellholder/(:num)' => array('route' => 'ShellHolder.Read', 'params' => array('shellHolderId' => 2)),
	'PUT:api/shellholder/(:num)' => array('route' => 'ShellHolder.Update', 'params' => array('shellHolderId' => 2)),
	'DELETE:api/shellholder/(:num)' => array('route' => 'ShellHolder.Delete', 'params' => array('shellHolderId' => 2)),
		
	// UltrasonicCleaner
	'GET:ultrasoniccleaners' => array('route' => 'UltrasonicCleaner.ListView'),
	'GET:ultrasoniccleaner/(:num)' => array('route' => 'UltrasonicCleaner.SingleView', 'params' => array('ultrasonicCleanerId' => 1)),
	'GET:api/ultrasoniccleaners' => array('route' => 'UltrasonicCleaner.Query'),
	'POST:api/ultrasoniccleaner' => array('route' => 'UltrasonicCleaner.Create'),
	'GET:api/ultrasoniccleaner/(:num)' => array('route' => 'UltrasonicCleaner.Read', 'params' => array('ultrasonicCleanerId' => 2)),
	'PUT:api/ultrasoniccleaner/(:num)' => array('route' => 'UltrasonicCleaner.Update', 'params' => array('ultrasonicCleanerId' => 2)),
	'DELETE:api/ultrasoniccleaner/(:num)' => array('route' => 'UltrasonicCleaner.Delete', 'params' => array('ultrasonicCleanerId' => 2)),
		
	// WorkBench
	'GET:workbenches' => array('route' => 'WorkBench.ListView'),
	'GET:workbench/(:num)' => array('route' => 'WorkBench.SingleView', 'params' => array('workBenchId' => 1)),
	'GET:api/workbenches' => array('route' => 'WorkBench.Query'),
	'POST:api/workbench' => array('route' => 'WorkBench.Create'),
	'GET:api/workbench/(:num)' => array('route' => 'WorkBench.Read', 'params' => array('workBenchId' => 2)),
	'PUT:api/workbench/(:num)' => array('route' => 'WorkBench.Update', 'params' => array('workBenchId' => 2)),
	'DELETE:api/workbench/(:num)' => array('route' => 'WorkBench.Delete', 'params' => array('workBenchId' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Brush","Brush_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("CleaningSolution","Cleaning_Solution_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Die","Die_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Recipe","Recipe_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Recipe","Recipe_ibfk_2",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Recipe","Recipe_ibfk_3",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Recipe","Recipe_ibfk_4",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>