<?php
	$this->assign('title','RELOADING | Brushes');
	$this->assign('nav','brushes');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/brushes.js").wait(function(){
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
	<i class="icon-th-list"></i> Brushes
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="brushCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_BrushId">Brush Id<% if (page.orderBy == 'BrushId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Caliber">Caliber<% if (page.orderBy == 'Caliber') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Thread">Thread<% if (page.orderBy == 'Thread') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Material">Material<% if (page.orderBy == 'Material') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Handle">Handle<% if (page.orderBy == 'Handle') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('brushId')) %>">
				<td><%= _.escape(item.get('brushId') || '') %></td>
				<td><%= _.escape(item.get('caliber') || '') %></td>
				<td><%= _.escape(item.get('thread') || '') %></td>
				<td><%= _.escape(item.get('material') || '') %></td>
				<td><%= _.escape(item.get('handle') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="brushModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="brushIdInputContainer" class="control-group">
					<label class="control-label" for="brushId">Brush Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="brushId"><%= _.escape(item.get('brushId') || '') %></span>
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
				<div id="threadInputContainer" class="control-group">
					<label class="control-label" for="thread">Thread</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="thread" placeholder="Thread" value="<%= _.escape(item.get('thread') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="materialInputContainer" class="control-group">
					<label class="control-label" for="material">Material</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="material" placeholder="Material" value="<%= _.escape(item.get('material') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="handleInputContainer" class="control-group">
					<label class="control-label" for="handle">Handle</label>
					<div class="controls inline-inputs">
						<select id="handle" name="handle"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteBrushButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteBrushButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Brush</button>
						<span id="confirmDeleteBrushContainer" class="hide">
							<button id="cancelDeleteBrushButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteBrushButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="brushDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Brush
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="brushModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveBrushButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="brushCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newBrushButton" class="btn btn-primary">Add Brush</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
