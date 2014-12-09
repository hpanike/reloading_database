<?php
/** @package    RELOADING::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Recipe.php");

/**
 * RecipeController is the controller class for the Recipe object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package RELOADING::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class RecipeController extends AppBaseController
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
	 * Displays a list view of Recipe objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Recipe records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new RecipeCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('RecipeId,RecipeName,Bullet,Powder,PowderAmountInGrains,Casing,Primer,BallisticData,CostPerBullet,AmountAvailable'
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

				$recipes = $this->Phreezer->Query('Recipe',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $recipes->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $recipes->TotalResults;
				$output->totalPages = $recipes->TotalPages;
				$output->pageSize = $recipes->PageSize;
				$output->currentPage = $recipes->CurrentPage;
			}
			else
			{
				// return all results
				$recipes = $this->Phreezer->Query('Recipe',$criteria);
				$output->rows = $recipes->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Recipe record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('recipeId');
			$recipe = $this->Phreezer->Get('Recipe',$pk);
			$this->RenderJSON($recipe, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Recipe record and render response as JSON
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

			$recipe = new Recipe($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $recipe->RecipeId = $this->SafeGetVal($json, 'recipeId');

			$recipe->RecipeName = $this->SafeGetVal($json, 'recipeName');
			$recipe->Bullet = $this->SafeGetVal($json, 'bullet');
			$recipe->Powder = $this->SafeGetVal($json, 'powder');
			$recipe->PowderAmountInGrains = $this->SafeGetVal($json, 'powderAmountInGrains');
			$recipe->Casing = $this->SafeGetVal($json, 'casing');
			$recipe->Primer = $this->SafeGetVal($json, 'primer');
			$recipe->BallisticData = $this->SafeGetVal($json, 'ballisticData');
			$recipe->CostPerBullet = $this->SafeGetVal($json, 'costPerBullet');
			$recipe->AmountAvailable = $this->SafeGetVal($json, 'amountAvailable');

			$recipe->Validate();
			$errors = $recipe->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$recipe->Save();
				$this->RenderJSON($recipe, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Recipe record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('recipeId');
			$recipe = $this->Phreezer->Get('Recipe',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $recipe->RecipeId = $this->SafeGetVal($json, 'recipeId', $recipe->RecipeId);

			$recipe->RecipeName = $this->SafeGetVal($json, 'recipeName', $recipe->RecipeName);
			$recipe->Bullet = $this->SafeGetVal($json, 'bullet', $recipe->Bullet);
			$recipe->Powder = $this->SafeGetVal($json, 'powder', $recipe->Powder);
			$recipe->PowderAmountInGrains = $this->SafeGetVal($json, 'powderAmountInGrains', $recipe->PowderAmountInGrains);
			$recipe->Casing = $this->SafeGetVal($json, 'casing', $recipe->Casing);
			$recipe->Primer = $this->SafeGetVal($json, 'primer', $recipe->Primer);
			$recipe->BallisticData = $this->SafeGetVal($json, 'ballisticData', $recipe->BallisticData);
			$recipe->CostPerBullet = $this->SafeGetVal($json, 'costPerBullet', $recipe->CostPerBullet);
			$recipe->AmountAvailable = $this->SafeGetVal($json, 'amountAvailable', $recipe->AmountAvailable);

			$recipe->Validate();
			$errors = $recipe->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$recipe->Save();
				$this->RenderJSON($recipe, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Recipe record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('recipeId');
			$recipe = $this->Phreezer->Get('Recipe',$pk);

			$recipe->Delete();

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
