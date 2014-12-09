<?php
	$this->assign('title','RELOADING | Bullets');
	$this->assign('nav','bullets');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/bullets.js").wait(function(){
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
	<i class="icon-th-list"></i> Bullets
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="bulletCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_BulletId">Bullet Id<% if (page.orderBy == 'BulletId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BulletName">Bullet Name<% if (page.orderBy == 'BulletName') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Caliber">Caliber<% if (page.orderBy == 'Caliber') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BulletType">Bullet Type<% if (page.orderBy == 'BulletType') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Manufacture">Manufacture<% if (page.orderBy == 'Manufacture') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Grain">Grain<% if (page.orderBy == 'Grain') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_BallisticCoefficient">Ballistic Coefficient<% if (page.orderBy == 'BallisticCoefficient') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_CostPerBullet">Cost Per Bullet<% if (page.orderBy == 'CostPerBullet') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Amount">Amount<% if (page.orderBy == 'Amount') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Material">Material<% if (page.orderBy == 'Material') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('bulletId')) %>">
				<td><%= _.escape(item.get('bulletId') || '') %></td>
				<td><%= _.escape(item.get('bulletName') || '') %></td>
				<td><%= _.escape(item.get('caliber') || '') %></td>
				<td><%= _.escape(item.get('bulletType') || '') %></td>
				<td><%= _.escape(item.get('manufacture') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('grain') || '') %></td>
				<td><%= _.escape(item.get('ballisticCoefficient') || '') %></td>
				<td><%= _.escape(item.get('costPerBullet') || '') %></td>
				<td><%= _.escape(item.get('amount') || '') %></td>
				<td><%= _.escape(item.get('material') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="bulletModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="bulletIdInputContainer" class="control-group">
					<label class="control-label" for="bulletId">Bullet Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="bulletId"><%= _.escape(item.get('bulletId') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="bulletNameInputContainer" class="control-group">
					<label class="control-label" for="bulletName">Bullet Name</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="bulletName" placeholder="Bullet Name" value="<%= _.escape(item.get('bulletName') || '') %>">
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
				<div id="bulletTypeInputContainer" class="control-group">
					<label class="control-label" for="bulletType">Bullet Type</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="bulletType" placeholder="Bullet Type" value="<%= _.escape(item.get('bulletType') || '') %>">
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
				<div id="grainInputContainer" class="control-group">
					<label class="control-label" for="grain">Grain</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="grain" placeholder="Grain" value="<%= _.escape(item.get('grain') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="ballisticCoefficientInputContainer" class="control-group">
					<label class="control-label" for="ballisticCoefficient">Ballistic Coefficient</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="ballisticCoefficient" placeholder="Ballistic Coefficient" value="<%= _.escape(item.get('ballisticCoefficient') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="costPerBulletInputContainer" class="control-group">
					<label class="control-label" for="costPerBullet">Cost Per Bullet</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="costPerBullet" placeholder="Cost Per Bullet" value="<%= _.escape(item.get('costPerBullet') || '') %>">
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
				<div id="materialInputContainer" class="control-group">
					<label class="control-label" for="material">Material</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="material" placeholder="Material" value="<%= _.escape(item.get('material') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteBulletButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteBulletButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Bullet</button>
						<span id="confirmDeleteBulletContainer" class="hide">
							<button id="cancelDeleteBulletButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteBulletButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="bulletDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Bullet
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="bulletModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveBulletButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="bulletCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newBulletButton" class="btn btn-primary">Add Bullet</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
