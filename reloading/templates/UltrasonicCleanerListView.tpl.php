<?php
	$this->assign('title','RELOADING | UltrasonicCleaners');
	$this->assign('nav','ultrasoniccleaners');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/ultrasoniccleaners.js").wait(function(){
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
	<i class="icon-th-list"></i> UltrasonicCleaners
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="ultrasonicCleanerCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_UltrasonicCleanerId">Ultrasonic Cleaner Id<% if (page.orderBy == 'UltrasonicCleanerId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_UltrasonicCleanerSize">Ultrasonic Cleaner Size<% if (page.orderBy == 'UltrasonicCleanerSize') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_UltrasonicCleanerType">Ultrasonic Cleaner Type<% if (page.orderBy == 'UltrasonicCleanerType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('ultrasonicCleanerId')) %>">
				<td><%= _.escape(item.get('ultrasonicCleanerId') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
				<td><%= _.escape(item.get('ultrasonicCleanerSize') || '') %></td>
				<td><%= _.escape(item.get('ultrasonicCleanerType') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="ultrasonicCleanerModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="ultrasonicCleanerIdInputContainer" class="control-group">
					<label class="control-label" for="ultrasonicCleanerId">Ultrasonic Cleaner Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="ultrasonicCleanerId"><%= _.escape(item.get('ultrasonicCleanerId') || '') %></span>
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
				<div id="ultrasonicCleanerSizeInputContainer" class="control-group">
					<label class="control-label" for="ultrasonicCleanerSize">Ultrasonic Cleaner Size</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="ultrasonicCleanerSize" placeholder="Ultrasonic Cleaner Size" value="<%= _.escape(item.get('ultrasonicCleanerSize') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="ultrasonicCleanerTypeInputContainer" class="control-group">
					<label class="control-label" for="ultrasonicCleanerType">Ultrasonic Cleaner Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="ultrasonicCleanerType" placeholder="Ultrasonic Cleaner Type" value="<%= _.escape(item.get('ultrasonicCleanerType') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteUltrasonicCleanerButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteUltrasonicCleanerButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete UltrasonicCleaner</button>
						<span id="confirmDeleteUltrasonicCleanerContainer" class="hide">
							<button id="cancelDeleteUltrasonicCleanerButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteUltrasonicCleanerButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="ultrasonicCleanerDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit UltrasonicCleaner
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="ultrasonicCleanerModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveUltrasonicCleanerButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="ultrasonicCleanerCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newUltrasonicCleanerButton" class="btn btn-primary">Add UltrasonicCleaner</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
