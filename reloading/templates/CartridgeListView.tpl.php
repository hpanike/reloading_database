<?php
	$this->assign('title','RELOADING | Cartridges');
	$this->assign('nav','cartridges');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/cartridges.js").wait(function(){
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
	<i class="icon-th-list"></i> Cartridges
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="cartridgeCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Name">Name<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_YearCreated">Year Created<% if (page.orderBy == 'YearCreated') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_AverageCost">Average Cost<% if (page.orderBy == 'AverageCost') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Availability">Availability<% if (page.orderBy == 'Availability') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('name')) %>">
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= _.escape(item.get('yearCreated') || '') %></td>
				<td><%= _.escape(item.get('averageCost') || '') %></td>
				<td><%= _.escape(item.get('availability') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="cartridgeModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="nameInputContainer" class="control-group">
					<label class="control-label" for="name">Name</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="name" placeholder="Name" value="<%= _.escape(item.get('name') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="yearCreatedInputContainer" class="control-group">
					<label class="control-label" for="yearCreated">Year Created</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="yearCreated" placeholder="Year Created" value="<%= _.escape(item.get('yearCreated') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="averageCostInputContainer" class="control-group">
					<label class="control-label" for="averageCost">Average Cost</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="averageCost" placeholder="Average Cost" value="<%= _.escape(item.get('averageCost') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="availabilityInputContainer" class="control-group">
					<label class="control-label" for="availability">Availability</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="availability" placeholder="Availability" value="<%= _.escape(item.get('availability') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteCartridgeButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteCartridgeButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Cartridge</button>
						<span id="confirmDeleteCartridgeContainer" class="hide">
							<button id="cancelDeleteCartridgeButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteCartridgeButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="cartridgeDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Cartridge
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="cartridgeModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveCartridgeButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="cartridgeCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newCartridgeButton" class="btn btn-primary">Add Cartridge</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
