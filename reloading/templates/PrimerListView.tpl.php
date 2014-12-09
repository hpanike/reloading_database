<?php
	$this->assign('title','RELOADING | Primers');
	$this->assign('nav','primers');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/primers.js").wait(function(){
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
	<i class="icon-th-list"></i> Primers
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="primerCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_PrimerId">Primer Id<% if (page.orderBy == 'PrimerId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Name">Name<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PrimerSize">Primer Size<% if (page.orderBy == 'PrimerSize') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Quanity">Quanity<% if (page.orderBy == 'Quanity') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_CostPerPrimer">Cost Per Primer<% if (page.orderBy == 'CostPerPrimer') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('primerId')) %>">
				<td><%= _.escape(item.get('primerId') || '') %></td>
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
				<td><%= _.escape(item.get('primerSize') || '') %></td>
				<td><%= _.escape(item.get('quanity') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('costPerPrimer') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="primerModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="primerIdInputContainer" class="control-group">
					<label class="control-label" for="primerId">Primer Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="primerId"><%= _.escape(item.get('primerId') || '') %></span>
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
				<div id="manufactureInputContainer" class="control-group">
					<label class="control-label" for="manufacture">Manufacture</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="manufacture" placeholder="Manufacture" value="<%= _.escape(item.get('manufacture') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="primerSizeInputContainer" class="control-group">
					<label class="control-label" for="primerSize">Primer Size</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="primerSize" placeholder="Primer Size" value="<%= _.escape(item.get('primerSize') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="quanityInputContainer" class="control-group">
					<label class="control-label" for="quanity">Quanity</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="quanity" placeholder="Quanity" value="<%= _.escape(item.get('quanity') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="costPerPrimerInputContainer" class="control-group">
					<label class="control-label" for="costPerPrimer">Cost Per Primer</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="costPerPrimer" placeholder="Cost Per Primer" value="<%= _.escape(item.get('costPerPrimer') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deletePrimerButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deletePrimerButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Primer</button>
						<span id="confirmDeletePrimerContainer" class="hide">
							<button id="cancelDeletePrimerButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeletePrimerButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="primerDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Primer
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="primerModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="savePrimerButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="primerCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newPrimerButton" class="btn btn-primary">Add Primer</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
