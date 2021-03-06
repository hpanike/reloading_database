<?php
	$this->assign('title','RELOADING | Recipes');
	$this->assign('nav','recipes');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/recipes.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Recipes
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="recipeCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_RecipeName">Recipe Name<% if (page.orderBy == 'RecipeName') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BallisticData">Ballistic Data<% if (page.orderBy == 'BallisticData') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CostPerBullet">Cost Per Bullet<% if (page.orderBy == 'CostPerBullet') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_AmountAvailable">Amount Available<% if (page.orderBy == 'AmountAvailable') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_RecipeId">Recipe Id<% if (page.orderBy == 'RecipeId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Bullet">Bullet<% if (page.orderBy == 'Bullet') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Powder">Powder<% if (page.orderBy == 'Powder') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PowderAmountInGrains">Powder Amount In Grains<% if (page.orderBy == 'PowderAmountInGrains') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Casing">Casing<% if (page.orderBy == 'Casing') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Primer">Primer<% if (page.orderBy == 'Primer') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>				
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('recipeId')) %>">
				<td><%= _.escape(item.get('recipeName') || '') %></td>
				<td><%= _.escape(item.get('ballisticData') || '') %></td>
				<td><%= _.escape(item.get('costPerBullet') || '') %></td>
				<td><%= _.escape(item.get('amountAvailable') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('recipeId') || '') %></td>
				<td><%= _.escape(item.get('bullet') || '') %></td>
				<td><%= _.escape(item.get('powder') || '') %></td>
				<td><%= _.escape(item.get('powderAmountInGrains') || '') %></td>
				<td><%= _.escape(item.get('casing') || '') %></td>
				<td><%= _.escape(item.get('primer') || '') %></td>			
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="recipeModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="recipeIdInputContainer" class="control-group">
					<label class="control-label" for="recipeId">Recipe Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="recipeId"><%= _.escape(item.get('recipeId') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="recipeNameInputContainer" class="control-group">
					<label class="control-label" for="recipeName">Recipe Name</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="recipeName" placeholder="Recipe Name" value="<%= _.escape(item.get('recipeName') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="bulletInputContainer" class="control-group">
					<label class="control-label" for="bullet">Bullet</label>
					<div class="controls inline-inputs">
						<select id="bullet" name="bullet"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="powderInputContainer" class="control-group">
					<label class="control-label" for="powder">Powder</label>
					<div class="controls inline-inputs">
						<select id="powder" name="powder"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="powderAmountInGrainsInputContainer" class="control-group">
					<label class="control-label" for="powderAmountInGrains">Powder Amount In Grains</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="powderAmountInGrains" placeholder="Powder Amount In Grains" value="<%= _.escape(item.get('powderAmountInGrains') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="casingInputContainer" class="control-group">
					<label class="control-label" for="casing">Casing</label>
					<div class="controls inline-inputs">
						<select id="casing" name="casing"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="primerInputContainer" class="control-group">
					<label class="control-label" for="primer">Primer</label>
					<div class="controls inline-inputs">
						<select id="primer" name="primer"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="ballisticDataInputContainer" class="control-group">
					<label class="control-label" for="ballisticData">Ballistic Data</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="ballisticData" placeholder="Ballistic Data" value="<%= _.escape(item.get('ballisticData') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="costPerBulletInputContainer" class="control-group">
					<label class="control-label" for="costPerBullet">Cost Per Bullet</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="costPerBullet" placeholder="Cost Per Bullet" value="<%= _.escape(item.get('costPerBullet') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="amountAvailableInputContainer" class="control-group">
					<label class="control-label" for="amountAvailable">Amount Available</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="amountAvailable" placeholder="Amount Available" value="<%= _.escape(item.get('amountAvailable') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteRecipeButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteRecipeButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Recipe</button>
						<span id="confirmDeleteRecipeContainer" class="hide">
							<button id="cancelDeleteRecipeButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteRecipeButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="recipeDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Recipe
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="recipeModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveRecipeButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="recipeCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newRecipeButton" class="btn btn-primary">Add Recipe</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
