<?php
	$this->assign('title','RELOADING | PowderDispensers');
	$this->assign('nav','powderdispensers');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/powderdispensers.js").wait(function(){
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
	<i class="icon-th-list"></i> PowderDispensers
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="powderDispenserCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_PowderDispenserId">Powder Dispenser Id<% if (page.orderBy == 'PowderDispenserId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PdispenserType">Pdispenser Type<% if (page.orderBy == 'PdispenserType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('powderDispenserId')) %>">
				<td><%= _.escape(item.get('powderDispenserId') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
				<td><%= _.escape(item.get('pdispenserType') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="powderDispenserModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="powderDispenserIdInputContainer" class="control-group">
					<label class="control-label" for="powderDispenserId">Powder Dispenser Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="powderDispenserId"><%= _.escape(item.get('powderDispenserId') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="manufactureInputContainer" class="control-group">
					<label class="control-label" for="manufacture">Manufacture</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="manufacture" placeholder="Manufacture" value="<%= _.escape(item.get('manufacture') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="pdispenserTypeInputContainer" class="control-group">
					<label class="control-label" for="pdispenserType">Pdispenser Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="pdispenserType" placeholder="Pdispenser Type" value="<%= _.escape(item.get('pdispenserType') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletePowderDispenserButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletePowderDispenserButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete PowderDispenser</button>
						<span id="confirmDeletePowderDispenserContainer" class="hide">
							<button id="cancelDeletePowderDispenserButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletePowderDispenserButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="powderDispenserDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit PowderDispenser
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="powderDispenserModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savePowderDispenserButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="powderDispenserCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newPowderDispenserButton" class="btn btn-primary">Add PowderDispenser</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
