<?php
/** @package    RELOADING::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Powder.php");

/**
 * PowderController is the controller class for the Powder object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package RELOADING::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class PowderController extends AppBaseController
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
	 * Displays a list view of Powder objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Powder records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new PowderCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('PowderId,Name,PowderType,BurnRate,QuantityInGrains,CostPerGrain'
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

				$powders = $this->Phreezer->Query('Powder',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $powders->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $powders->TotalResults;
				$output->totalPages = $powders->TotalPages;
				$output->pageSize = $powders->PageSize;
				$output->currentPage = $powders->CurrentPage;
			}
			else
			{
				// return all results
				$powders = $this->Phreezer->Query('Powder',$criteria);
				$output->rows = $powders->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Powder record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('powderId');
			$powder = $this->Phreezer->Get('Powder',$pk);
			$this->RenderJSON($powder, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Powder record and render response as JSON
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

			$powder = new Powder($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $powder->PowderId = $this->SafeGetVal($json, 'powderId');

			$powder->Name = $this->SafeGetVal($json, 'name');
			$powder->PowderType = $this->SafeGetVal($json, 'powderType');
			$powder->BurnRate = $this->SafeGetVal($json, 'burnRate');
			$powder->QuantityInGrains = $this->SafeGetVal($json, 'quantityInGrains');
			$powder->CostPerGrain = $this->SafeGetVal($json, 'costPerGrain');

			$powder->Validate();
			$errors = $powder->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$powder->Save();
				$this->RenderJSON($powder, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Powder record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('powderId');
			$powder = $this->Phreezer->Get('Powder',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $powder->PowderId = $this->SafeGetVal($json, 'powderId', $powder->PowderId);

			$powder->Name = $this->SafeGetVal($json, 'name', $powder->Name);
			$powder->PowderType = $this->SafeGetVal($json, 'powderType', $powder->PowderType);
			$powder->BurnRate = $this->SafeGetVal($json, 'burnRate', $powder->BurnRate);
			$powder->QuantityInGrains = $this->SafeGetVal($json, 'quantityInGrains', $powder->QuantityInGrains);
			$powder->CostPerGrain = $this->SafeGetVal($json, 'costPerGrain', $powder->CostPerGrain);

			$powder->Validate();
			$errors = $powder->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$powder->Save();
				$this->RenderJSON($powder, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Powder record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('powderId');
			$powder = $this->Phreezer->Get('Powder',$pk);

			$powder->Delete();

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
