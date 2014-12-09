<?php
	$this->assign('title','RELOADING | WorkBenches');
	$this->assign('nav','workbenches');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/workbenches.js").wait(function(){
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
	<i class="icon-th-list"></i> WorkBenches
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="workBenchCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_WorkBenchId">Work Bench Id<% if (page.orderBy == 'WorkBenchId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Name">Name<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_WorkBenchType">Work Bench Type<% if (page.orderBy == 'WorkBenchType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_WworkBenchSize">Wwork Bench Size<% if (page.orderBy == 'WworkBenchSize') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('workBenchId')) %>">
				<td><%= _.escape(item.get('workBenchId') || '') %></td>
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= _.escape(item.get('workBenchType') || '') %></td>
				<td><%= _.escape(item.get('wworkBenchSize') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="workBenchModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="workBenchIdInputContainer" class="control-group">
					<label class="control-label" for="workBenchId">Work Bench Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="workBenchId"><%= _.escape(item.get('workBenchId') || '') %></span>
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
				<div id="workBenchTypeInputContainer" class="control-group">
					<label class="control-label" for="workBenchType">Work Bench Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="workBenchType" placeholder="Work Bench Type" value="<%= _.escape(item.get('workBenchType') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="wworkBenchSizeInputContainer" class="control-group">
					<label class="control-label" for="wworkBenchSize">Wwork Bench Size</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="wworkBenchSize" placeholder="Wwork Bench Size" value="<%= _.escape(item.get('wworkBenchSize') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteWorkBenchButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteWorkBenchButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete WorkBench</button>
						<span id="confirmDeleteWorkBenchContainer" class="hide">
							<button id="cancelDeleteWorkBenchButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteWorkBenchButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="workBenchDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit WorkBench
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="workBenchModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveWorkBenchButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="workBenchCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newWorkBenchButton" class="btn btn-primary">Add WorkBench</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
