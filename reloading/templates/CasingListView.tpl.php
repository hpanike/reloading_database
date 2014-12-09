<?php
	$this->assign('title','RELOADING | Casings');
	$this->assign('nav','casings');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/casings.js").wait(function(){
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
	<i class="icon-th-list"></i> Casings
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="casingCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_CasingId">Casing Id<% if (page.orderBy == 'CasingId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CasingName">Casing Name<% if (page.orderBy == 'CasingName') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Caliber">Caliber<% if (page.orderBy == 'Caliber') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_WallThickness">Wall Thickness<% if (page.orderBy == 'WallThickness') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_UseExpectancy">Use Expectancy<% if (page.orderBy == 'UseExpectancy') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Amount">Amount<% if (page.orderBy == 'Amount') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CostPerCasing">Cost Per Casing<% if (page.orderBy == 'CostPerCasing') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PocketSize">Pocket Size<% if (page.orderBy == 'PocketSize') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('casingId')) %>">
				<td><%= _.escape(item.get('casingId') || '') %></td>
				<td><%= _.escape(item.get('casingName') || '') %></td>
				<td><%= _.escape(item.get('caliber') || '') %></td>
				<td><%= _.escape(item.get('wallThickness') || '') %></td>
				<td><%= _.escape(item.get('useExpectancy') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('amount') || '') %></td>
				<td><%= _.escape(item.get('costPerCasing') || '') %></td>
				<td><%= _.escape(item.get('pocketSize') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="casingModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="casingIdInputContainer" class="control-group">
					<label class="control-label" for="casingId">Casing Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="casingId"><%= _.escape(item.get('casingId') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="casingNameInputContainer" class="control-group">
					<label class="control-label" for="casingName">Casing Name</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="casingName" placeholder="Casing Name" value="<%= _.escape(item.get('casingName') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="caliberInputContainer" class="control-group">
					<label class="control-label" for="caliber">Caliber</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="caliber" placeholder="Caliber" value="<%= _.escape(item.get('caliber') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="wallThicknessInputContainer" class="control-group">
					<label class="control-label" for="wallThickness">Wall Thickness</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="wallThickness" placeholder="Wall Thickness" value="<%= _.escape(item.get('wallThickness') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="useExpectancyInputContainer" class="control-group">
					<label class="control-label" for="useExpectancy">Use Expectancy</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="useExpectancy" placeholder="Use Expectancy" value="<%= _.escape(item.get('useExpectancy') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="amountInputContainer" class="control-group">
					<label class="control-label" for="amount">Amount</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="amount" placeholder="Amount" value="<%= _.escape(item.get('amount') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="costPerCasingInputContainer" class="control-group">
					<label class="control-label" for="costPerCasing">Cost Per Casing</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="costPerCasing" placeholder="Cost Per Casing" value="<%= _.escape(item.get('costPerCasing') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="pocketSizeInputContainer" class="control-group">
					<label class="control-label" for="pocketSize">Pocket Size</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="pocketSize" placeholder="Pocket Size" value="<%= _.escape(item.get('pocketSize') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteCasingButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteCasingButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Casing</button>
						<span id="confirmDeleteCasingContainer" class="hide">
							<button id="cancelDeleteCasingButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteCasingButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="casingDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Casing
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="casingModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveCasingButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="casingCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newCasingButton" class="btn btn-primary">Add Casing</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
