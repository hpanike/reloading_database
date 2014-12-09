<?php
/** @package    RELOADING::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Press.php");

/**
 * PressController is the controller class for the Press object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package RELOADING::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class PressController extends AppBaseController
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
	 * Displays a list view of Press objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Press records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new PressCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('PressId,Manufacture,ProductionRate,PressType,Thread'
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

				$presses = $this->Phreezer->Query('Press',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $presses->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $presses->TotalResults;
				$output->totalPages = $presses->TotalPages;
				$output->pageSize = $presses->PageSize;
				$output->currentPage = $presses->CurrentPage;
			}
			else
			{
				// return all results
				$presses = $this->Phreezer->Query('Press',$criteria);
				$output->rows = $presses->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Press record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('pressId');
			$press = $this->Phreezer->Get('Press',$pk);
			$this->RenderJSON($press, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Press record and render response as JSON
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

			$press = new Press($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $press->PressId = $this->SafeGetVal($json, 'pressId');

			$press->Manufacture = $this->SafeGetVal($json, 'manufacture');
			$press->ProductionRate = $this->SafeGetVal($json, 'productionRate');
			$press->PressType = $this->SafeGetVal($json, 'pressType');
			$press->Thread = $this->SafeGetVal($json, 'thread');

			$press->Validate();
			$errors = $press->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$press->Save();
				$this->RenderJSON($press, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Press record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('pressId');
			$press = $this->Phreezer->Get('Press',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $press->PressId = $this->SafeGetVal($json, 'pressId', $press->PressId);

			$press->Manufacture = $this->SafeGetVal($json, 'manufacture', $press->Manufacture);
			$press->ProductionRate = $this->SafeGetVal($json, 'productionRate', $press->ProductionRate);
			$press->PressType = $this->SafeGetVal($json, 'pressType', $press->PressType);
			$press->Thread = $this->SafeGetVal($json, 'thread', $press->Thread);

			$press->Validate();
			$errors = $press->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$press->Save();
				$this->RenderJSON($press, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Press record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('pressId');
			$press = $this->Phreezer->Get('Press',$pk);

			$press->Delete();

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
