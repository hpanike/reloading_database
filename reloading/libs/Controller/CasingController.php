<?php
/** @package    RELOADING::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Casing.php");

/**
 * CasingController is the controller class for the Casing object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package RELOADING::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class CasingController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Casing objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Casing records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new CasingCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('CasingId,CasingName,Caliber,WallThickness,UseExpectancy,Amount,CostPerCasing,PocketSize'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$casings = $this->Phreezer->Query('Casing',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $casings->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $casings->TotalResults;
				$output->totalPages = $casings->TotalPages;
				$output->pageSize = $casings->PageSize;
				$output->currentPage = $casings->CurrentPage;
			}
			else
			{
				// return all results
				$casings = $this->Phreezer->Query('Casing',$criteria);
				$output->rows = $casings->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Casing record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('casingId');
			$casing = $this->Phreezer->Get('Casing',$pk);
			$this->RenderJSON($casing, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Casing record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$casing = new Casing($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $casing->CasingId = $this->SafeGetVal($json, 'casingId');

			$casing->CasingName = $this->SafeGetVal($json, 'casingName');
			$casing->Caliber = $this->SafeGetVal($json, 'caliber');
			$casing->WallThickness = $this->SafeGetVal($json, 'wallThickness');
			$casing->UseExpectancy = $this->SafeGetVal($json, 'useExpectancy');
			$casing->Amount = $this->SafeGetVal($json, 'amount');
			$casing->CostPerCasing = $this->SafeGetVal($json, 'costPerCasing');
			$casing->PocketSize = $this->SafeGetVal($json, 'pocketSize');

			$casing->Validate();
			$errors = $casing->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$casing->Save();
				$this->RenderJSON($casing, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Casing record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('casingId');
			$casing = $this->Phreezer->Get('Casing',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $casing->CasingId = $this->SafeGetVal($json, 'casingId', $casing->CasingId);

			$casing->CasingName = $this->SafeGetVal($json, 'casingName', $casing->CasingName);
			$casing->Caliber = $this->SafeGetVal($json, 'caliber', $casing->Caliber);
			$casing->WallThickness = $this->SafeGetVal($json, 'wallThickness', $casing->WallThickness);
			$casing->UseExpectancy = $this->SafeGetVal($json, 'useExpectancy', $casing->UseExpectancy);
			$casing->Amount = $this->SafeGetVal($json, 'amount', $casing->Amount);
			$casing->CostPerCasing = $this->SafeGetVal($json, 'costPerCasing', $casing->CostPerCasing);
			$casing->PocketSize = $this->SafeGetVal($json, 'pocketSize', $casing->PocketSize);

			$casing->Validate();
			$errors = $casing->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$casing->Save();
				$this->RenderJSON($casing, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Casing record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('casingId');
			$casing = $this->Phreezer->Get('Casing',$pk);

			$casing->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
