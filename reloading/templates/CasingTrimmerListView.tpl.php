<?php
	$this->assign('title','RELOADING | CasingTrimmers');
	$this->assign('nav','casingtrimmers');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/casingtrimmers.js").wait(function(){
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
	<i class="icon-th-list"></i> CasingTrimmers
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="casingTrimmerCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_TrimmerId">Trimmer Id<% if (page.orderBy == 'TrimmerId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_TrimmerType">Trimmer Type<% if (page.orderBy == 'TrimmerType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('trimmerId')) %>">
				<td><%= _.escape(item.get('trimmerId') || '') %></td>
				<td><%= _.escape(item.get('trimmerType') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="casingTrimmerModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="trimmerIdInputContainer" class="control-group">
					<label class="control-label" for="trimmerId">Trimmer Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="trimmerId"><%= _.escape(item.get('trimmerId') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="trimmerTypeInputContainer" class="control-group">
					<label class="control-label" for="trimmerType">Trimmer Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="trimmerType" placeholder="Trimmer Type" value="<%= _.escape(item.get('trimmerType') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteCasingTrimmerButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteCasingTrimmerButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete CasingTrimmer</button>
						<span id="confirmDeleteCasingTrimmerContainer" class="hide">
							<button id="cancelDeleteCasingTrimmerButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteCasingTrimmerButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="casingTrimmerDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit CasingTrimmer
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="casingTrimmerModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveCasingTrimmerButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="casingTrimmerCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newCasingTrimmerButton" class="btn btn-primary">Add CasingTrimmer</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
