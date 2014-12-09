<?php
	$this->assign('title','RELOADING | PocketCleaners');
	$this->assign('nav','pocketcleaners');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/pocketcleaners.js").wait(function(){
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
	<i class="icon-th-list"></i> PocketCleaners
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="pocketCleanerCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_PocketCleanerId">Pocket Cleaner Id<% if (page.orderBy == 'PocketCleanerId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PocketCleanerSize">Pocket Cleaner Size<% if (page.orderBy == 'PocketCleanerSize') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PocketCleanerType">Pocket Cleaner Type<% if (page.orderBy == 'PocketCleanerType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('pocketCleanerId')) %>">
				<td><%= _.escape(item.get('pocketCleanerId') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
				<td><%= _.escape(item.get('pocketCleanerSize') || '') %></td>
				<td><%= _.escape(item.get('pocketCleanerType') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="pocketCleanerModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="pocketCleanerIdInputContainer" class="control-group">
					<label class="control-label" for="pocketCleanerId">Pocket Cleaner Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="pocketCleanerId"><%= _.escape(item.get('pocketCleanerId') || '') %></span>
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
				<div id="pocketCleanerSizeInputContainer" class="control-group">
					<label class="control-label" for="pocketCleanerSize">Pocket Cleaner Size</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="pocketCleanerSize" placeholder="Pocket Cleaner Size" value="<%= _.escape(item.get('pocketCleanerSize') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="pocketCleanerTypeInputContainer" class="control-group">
					<label class="control-label" for="pocketCleanerType">Pocket Cleaner Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="pocketCleanerType" placeholder="Pocket Cleaner Type" value="<%= _.escape(item.get('pocketCleanerType') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletePocketCleanerButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletePocketCleanerButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete PocketCleaner</button>
						<span id="confirmDeletePocketCleanerContainer" class="hide">
							<button id="cancelDeletePocketCleanerButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletePocketCleanerButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="pocketCleanerDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit PocketCleaner
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="pocketCleanerModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savePocketCleanerButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="pocketCleanerCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newPocketCleanerButton" class="btn btn-primary">Add PocketCleaner</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
