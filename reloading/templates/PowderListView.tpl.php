<?php
	$this->assign('title','RELOADING | Powders');
	$this->assign('nav','powders');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/powders.js").wait(function(){
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
	<i class="icon-th-list"></i> Powders
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="powderCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_PowderId">Powder Id<% if (page.orderBy == 'PowderId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Name">Name<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PowderType">Powder Type<% if (page.orderBy == 'PowderType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BurnRate">Burn Rate<% if (page.orderBy == 'BurnRate') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_QuantityInGrains">Quantity In Grains<% if (page.orderBy == 'QuantityInGrains') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_CostPerGrain">Cost Per Grain<% if (page.orderBy == 'CostPerGrain') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('powderId')) %>">
				<td><%= _.escape(item.get('powderId') || '') %></td>
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= _.escape(item.get('powderType') || '') %></td>
				<td><%= _.escape(item.get('burnRate') || '') %></td>
				<td><%= _.escape(item.get('quantityInGrains') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('costPerGrain') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="powderModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="powderIdInputContainer" class="control-group">
					<label class="control-label" for="powderId">Powder Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="powderId"><%= _.escape(item.get('powderId') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nameInputContainer" class="control-group">
					<label class="control-label" for="name">Name</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="name" placeholder="Name" value="<%= _.escape(item.get('name') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="powderTypeInputContainer" class="control-group">
					<label class="control-label" for="powderType">Powder Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="powderType" placeholder="Powder Type" value="<%= _.escape(item.get('powderType') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="burnRateInputContainer" class="control-group">
					<label class="control-label" for="burnRate">Burn Rate</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="burnRate" placeholder="Burn Rate" value="<%= _.escape(item.get('burnRate') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="quantityInGrainsInputContainer" class="control-group">
					<label class="control-label" for="quantityInGrains">Quantity In Grains</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="quantityInGrains" placeholder="Quantity In Grains" value="<%= _.escape(item.get('quantityInGrains') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="costPerGrainInputContainer" class="control-group">
					<label class="control-label" for="costPerGrain">Cost Per Grain</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="costPerGrain" placeholder="Cost Per Grain" value="<%= _.escape(item.get('costPerGrain') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletePowderButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletePowderButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Powder</button>
						<span id="confirmDeletePowderContainer" class="hide">
							<button id="cancelDeletePowderButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletePowderButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="powderDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Powder
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="powderModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savePowderButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="powderCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newPowderButton" class="btn btn-primary">Add Powder</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
