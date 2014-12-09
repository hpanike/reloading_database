<?php
	$this->assign('title','RELOADING | Dies');
	$this->assign('nav','dies');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/dies.js").wait(function(){
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
	<i class="icon-th-list"></i> Dies
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="dieCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_DieId">Die Id<% if (page.orderBy == 'DieId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Grade">Grade<% if (page.orderBy == 'Grade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DieType">Die Type<% if (page.orderBy == 'DieType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Caliber">Caliber<% if (page.orderBy == 'Caliber') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Press">Press<% if (page.orderBy == 'Press') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('dieId')) %>">
				<td><%= _.escape(item.get('dieId') || '') %></td>
				<td><%= _.escape(item.get('grade') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
				<td><%= _.escape(item.get('dieType') || '') %></td>
				<td><%= _.escape(item.get('caliber') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('press') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="dieModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="dieIdInputContainer" class="control-group">
					<label class="control-label" for="dieId">Die Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="dieId"><%= _.escape(item.get('dieId') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="gradeInputContainer" class="control-group">
					<label class="control-label" for="grade">Grade</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="grade" placeholder="Grade" value="<%= _.escape(item.get('grade') || '') %>">
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
				<div id="dieTypeInputContainer" class="control-group">
					<label class="control-label" for="dieType">Die Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="dieType" placeholder="Die Type" value="<%= _.escape(item.get('dieType') || '') %>">
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
				<div id="pressInputContainer" class="control-group">
					<label class="control-label" for="press">Press</label>
					<div class="controls inline-inputs">
						<select id="press" name="press"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteDieButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteDieButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Die</button>
						<span id="confirmDeleteDieContainer" class="hide">
							<button id="cancelDeleteDieButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteDieButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="dieDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Die
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="dieModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveDieButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="dieCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newDieButton" class="btn btn-primary">Add Die</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
