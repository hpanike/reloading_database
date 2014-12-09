<?php
	$this->assign('title','RELOADING | ShellHolders');
	$this->assign('nav','shellholders');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/shellholders.js").wait(function(){
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
	<i class="icon-th-list"></i> ShellHolders
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="shellHolderCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_ShellHolderId">Shell Holder Id<% if (page.orderBy == 'ShellHolderId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Number">Number<% if (page.orderBy == 'Number') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('shellHolderId')) %>">
				<td><%= _.escape(item.get('shellHolderId') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
				<td><%= _.escape(item.get('number') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="shellHolderModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="shellHolderIdInputContainer" class="control-group">
					<label class="control-label" for="shellHolderId">Shell Holder Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="shellHolderId"><%= _.escape(item.get('shellHolderId') || '') %></span>
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
				<div id="numberInputContainer" class="control-group">
					<label class="control-label" for="number">Number</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="number" placeholder="Number" value="<%= _.escape(item.get('number') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteShellHolderButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteShellHolderButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete ShellHolder</button>
						<span id="confirmDeleteShellHolderContainer" class="hide">
							<button id="cancelDeleteShellHolderButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteShellHolderButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="shellHolderDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit ShellHolder
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="shellHolderModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveShellHolderButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="shellHolderCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newShellHolderButton" class="btn btn-primary">Add ShellHolder</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
