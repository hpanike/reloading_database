<?php
/** @package    RELOADING::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Bullet.php");

/**
 * BulletController is the controller class for the Bullet object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package RELOADING::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class BulletController extends AppBaseController
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
	 * Displays a list view of Bullet objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Bullet records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new BulletCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('BulletId,BulletName,Caliber,BulletType,Manufacture,Grain,BallisticCoefficient,CostPerBullet,Amount,Material'
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

				$bullets = $this->Phreezer->Query('Bullet',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $bullets->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $bullets->TotalResults;
				$output->totalPages = $bullets->TotalPages;
				$output->pageSize = $bullets->PageSize;
				$output->currentPage = $bullets->CurrentPage;
			}
			else
			{
				// return all results
				$bullets = $this->Phreezer->Query('Bullet',$criteria);
				$output->rows = $bullets->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Bullet record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('bulletId');
			$bullet = $this->Phreezer->Get('Bullet',$pk);
			$this->RenderJSON($bullet, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Bullet record and render response as JSON
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

			$bullet = new Bullet($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $bullet->BulletId = $this->SafeGetVal($json, 'bulletId');

			$bullet->BulletName = $this->SafeGetVal($json, 'bulletName');
			$bullet->Caliber = $this->SafeGetVal($json, 'caliber');
			$bullet->BulletType = $this->SafeGetVal($json, 'bulletType');
			$bullet->Manufacture = $this->SafeGetVal($json, 'manufacture');
			$bullet->Grain = $this->SafeGetVal($json, 'grain');
			$bullet->BallisticCoefficient = $this->SafeGetVal($json, 'ballisticCoefficient');
			$bullet->CostPerBullet = $this->SafeGetVal($json, 'costPerBullet');
			$bullet->Amount = $this->SafeGetVal($json, 'amount');
			$bullet->Material = $this->SafeGetVal($json, 'material');

			$bullet->Validate();
			$errors = $bullet->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$bullet->Save();
				$this->RenderJSON($bullet, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Bullet record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('bulletId');
			$bullet = $this->Phreezer->Get('Bullet',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $bullet->BulletId = $this->SafeGetVal($json, 'bulletId', $bullet->BulletId);

			$bullet->BulletName = $this->SafeGetVal($json, 'bulletName', $bullet->BulletName);
			$bullet->Caliber = $this->SafeGetVal($json, 'caliber', $bullet->Caliber);
			$bullet->BulletType = $this->SafeGetVal($json, 'bulletType', $bullet->BulletType);
			$bullet->Manufacture = $this->SafeGetVal($json, 'manufacture', $bullet->Manufacture);
			$bullet->Grain = $this->SafeGetVal($json, 'grain', $bullet->Grain);
			$bullet->BallisticCoefficient = $this->SafeGetVal($json, 'ballisticCoefficient', $bullet->BallisticCoefficient);
			$bullet->CostPerBullet = $this->SafeGetVal($json, 'costPerBullet', $bullet->CostPerBullet);
			$bullet->Amount = $this->SafeGetVal($json, 'amount', $bullet->Amount);
			$bullet->Material = $this->SafeGetVal($json, 'material', $bullet->Material);

			$bullet->Validate();
			$errors = $bullet->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$bullet->Save();
				$this->RenderJSON($bullet, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Bullet record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('bulletId');
			$bullet = $this->Phreezer->Get('Bullet',$pk);

			$bullet->Delete();

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
