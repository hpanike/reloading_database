<?php
/** @package    RELOADING::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/PocketCleaner.php");

/**
 * PocketCleanerController is the controller class for the PocketCleaner object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package RELOADING::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class PocketCleanerController extends AppBaseController
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
	 * Displays a list view of PocketCleaner objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for PocketCleaner records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new PocketCleanerCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('PocketCleanerId,Manufacture,PocketCleanerSize,PocketCleanerType'
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

				$pocketcleaners = $this->Phreezer->Query('PocketCleaner',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $pocketcleaners->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $pocketcleaners->TotalResults;
				$output->totalPages = $pocketcleaners->TotalPages;
				$output->pageSize = $pocketcleaners->PageSize;
				$output->currentPage = $pocketcleaners->CurrentPage;
			}
			else
			{
				// return all results
				$pocketcleaners = $this->Phreezer->Query('PocketCleaner',$criteria);
				$output->rows = $pocketcleaners->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single PocketCleaner record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('pocketCleanerId');
			$pocketcleaner = $this->Phreezer->Get('PocketCleaner',$pk);
			$this->RenderJSON($pocketcleaner, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new PocketCleaner record and render response as JSON
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

			$pocketcleaner = new PocketCleaner($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $pocketcleaner->PocketCleanerId = $this->SafeGetVal($json, 'pocketCleanerId');

			$pocketcleaner->Manufacture = $this->SafeGetVal($json, 'manufacture');
			$pocketcleaner->PocketCleanerSize = $this->SafeGetVal($json, 'pocketCleanerSize');
			$pocketcleaner->PocketCleanerType = $this->SafeGetVal($json, 'pocketCleanerType');

			$pocketcleaner->Validate();
			$errors = $pocketcleaner->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$pocketcleaner->Save();
				$this->RenderJSON($pocketcleaner, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing PocketCleaner record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('pocketCleanerId');
			$pocketcleaner = $this->Phreezer->Get('PocketCleaner',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $pocketcleaner->PocketCleanerId = $this->SafeGetVal($json, 'pocketCleanerId', $pocketcleaner->PocketCleanerId);

			$pocketcleaner->Manufacture = $this->SafeGetVal($json, 'manufacture', $pocketcleaner->Manufacture);
			$pocketcleaner->PocketCleanerSize = $this->SafeGetVal($json, 'pocketCleanerSize', $pocketcleaner->PocketCleanerSize);
			$pocketcleaner->PocketCleanerType = $this->SafeGetVal($json, 'pocketCleanerType', $pocketcleaner->PocketCleanerType);

			$pocketcleaner->Validate();
			$errors = $pocketcleaner->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$pocketcleaner->Save();
				$this->RenderJSON($pocketcleaner, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing PocketCleaner record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('pocketCleanerId');
			$pocketcleaner = $this->Phreezer->Get('PocketCleaner',$pk);

			$pocketcleaner->Delete();

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
