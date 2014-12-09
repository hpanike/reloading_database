<?php
	$this->assign('title','RELOADING | CleaningSolutions');
	$this->assign('nav','cleaningsolutions');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/cleaningsolutions.js").wait(function(){
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
	<i class="icon-th-list"></i> CleaningSolutions
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="cleaningSolutionCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_SolutionId">Solution Id<% if (page.orderBy == 'SolutionId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Formula">Formula<% if (page.orderBy == 'Formula') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Cost">Cost<% if (page.orderBy == 'Cost') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Amount">Amount<% if (page.orderBy == 'Amount') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_UltrasonicCleaner">Ultrasonic Cleaner<% if (page.orderBy == 'UltrasonicCleaner') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('solutionId')) %>">
				<td><%= _.escape(item.get('solutionId') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
				<td><%= _.escape(item.get('formula') || '') %></td>
				<td><%= _.escape(item.get('cost') || '') %></td>
				<td><%= _.escape(item.get('amount') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('ultrasonicCleaner') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="cleaningSolutionModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="solutionIdInputContainer" class="control-group">
					<label class="control-label" for="solutionId">Solution Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="solutionId"><%= _.escape(item.get('solutionId') || '') %></span>
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
				<div id="formulaInputContainer" class="control-group">
					<label class="control-label" for="formula">Formula</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="formula" placeholder="Formula" value="<%= _.escape(item.get('formula') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="costInputContainer" class="control-group">
					<label class="control-label" for="cost">Cost</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cost" placeholder="Cost" value="<%= _.escape(item.get('cost') || '') %>">
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
				<div id="ultrasonicCleanerInputContainer" class="control-group">
					<label class="control-label" for="ultrasonicCleaner">Ultrasonic Cleaner</label>
					<div class="controls inline-inputs">
						<select id="ultrasonicCleaner" name="ultrasonicCleaner"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteCleaningSolutionButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteCleaningSolutionButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete CleaningSolution</button>
						<span id="confirmDeleteCleaningSolutionContainer" class="hide">
							<button id="cancelDeleteCleaningSolutionButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteCleaningSolutionButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="cleaningSolutionDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit CleaningSolution
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="cleaningSolutionModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveCleaningSolutionButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="cleaningSolutionCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newCleaningSolutionButton" class="btn btn-primary">Add CleaningSolution</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
