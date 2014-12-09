/**
 * backbone model definitions for RELOADING
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false;

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 5000;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;


/**
 * a default sort method for sorting collection items.  this will sort the collection
 * based on the orderBy and orderDesc property that was used on the last fetch call
 * to the server. 
 */
model.AbstractCollection = Backbone.Collection.extend({
	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	lastRequestParams: null,
	collectionHasChanged: true,
	
	/**
	 * fetch the collection from the server using the same options and 
	 * parameters as the previous fetch
	 */
	refetch: function() {
		this.fetch({ data: this.lastRequestParams })
	},
	
	/* uncomment to debug fetch event triggers
	fetch: function(options) {
            this.constructor.__super__.fetch.apply(this, arguments);
	},
	// */
	
	/**
	 * client-side sorting baesd on the orderBy and orderDesc parameters that
	 * were used to fetch the data from the server.  Backbone ignores the
	 * order of records coming from the server so we have to sort them ourselves
	 */
	comparator: function(a,b) {
		
		var result = 0;
		var options = this.lastRequestParams;
		
		if (options && options.orderBy) {
			
			// lcase the first letter of the property name
			var propName = options.orderBy.charAt(0).toLowerCase() + options.orderBy.slice(1);
			var aVal = a.get(propName);
			var bVal = b.get(propName);
			
			if (isNaN(aVal) || isNaN(bVal)) {
				// treat comparison as case-insensitive strings
				aVal = aVal ? aVal.toLowerCase() : '';
				bVal = bVal ? bVal.toLowerCase() : '';
			} else {
				// treat comparision as a number
				aVal = Number(aVal);
				bVal = Number(bVal);
			}
			
			if (aVal < bVal) {
				result = options.orderDesc ? 1 : -1;
			} else if (aVal > bVal) {
				result = options.orderDesc ? -1 : 1;
			}
		}
		
		return result;

	},
	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, options) {

		// the response is already decoded into object form, but it's easier to
		// compary the stringified version.  some earlier versions of backbone did
		// not include the raw response so there is some legacy support here
		var responseText = options && options.xhr ? options.xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastRequestParams = options ? options.data : undefined;
		
		// if the collection has changed then we need to force a re-sort because backbone will
		// only resort the data if a property in the model has changed
		if (this.lastResponseText && this.collectionHasChanged) this.sort({ silent:true });
		
		this.lastResponseText = responseText;
		
		var rows;

		if (response.currentPage) {
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		} else {
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Brush Backbone Model
 */
model.BrushModel = Backbone.Model.extend({
	urlRoot: 'api/brush',
	idAttribute: 'brushId',
	brushId: '',
	caliber: '',
	thread: '',
	material: '',
	handle: '',
	defaults: {
		'brushId': null,
		'caliber': '',
		'thread': '',
		'material': '',
		'handle': ''
	}
});

/**
 * Brush Backbone Collection
 */
model.BrushCollection = model.AbstractCollection.extend({
	url: 'api/brushes',
	model: model.BrushModel
});

/**
 * Bullet Backbone Model
 */
model.BulletModel = Backbone.Model.extend({
	urlRoot: 'api/bullet',
	idAttribute: 'bulletId',
	bulletId: '',
	bulletName: '',
	caliber: '',
	bulletType: '',
	manufacture: '',
	grain: '',
	ballisticCoefficient: '',
	costPerBullet: '',
	amount: '',
	material: '',
	defaults: {
		'bulletId': null,
		'bulletName': '',
		'caliber': '',
		'bulletType': '',
		'manufacture': '',
		'grain': '',
		'ballisticCoefficient': '',
		'costPerBullet': '',
		'amount': '',
		'material': ''
	}
});

/**
 * Bullet Backbone Collection
 */
model.BulletCollection = model.AbstractCollection.extend({
	url: 'api/bullets',
	model: model.BulletModel
});

/**
 * Cartridge Backbone Model
 */
model.CartridgeModel = Backbone.Model.extend({
	urlRoot: 'api/cartridge',
	idAttribute: 'name',
	name: '',
	yearCreated: '',
	averageCost: '',
	availability: '',
	defaults: {
		'name': null,
		'yearCreated': '',
		'averageCost': '',
		'availability': ''
	}
});

/**
 * Cartridge Backbone Collection
 */
model.CartridgeCollection = model.AbstractCollection.extend({
	url: 'api/cartridges',
	model: model.CartridgeModel
});

/**
 * Casing Backbone Model
 */
model.CasingModel = Backbone.Model.extend({
	urlRoot: 'api/casing',
	idAttribute: 'casingId',
	casingId: '',
	casingName: '',
	caliber: '',
	wallThickness: '',
	useExpectancy: '',
	amount: '',
	costPerCasing: '',
	pocketSize: '',
	defaults: {
		'casingId': null,
		'casingName': '',
		'caliber': '',
		'wallThickness': '',
		'useExpectancy': '',
		'amount': '',
		'costPerCasing': '',
		'pocketSize': ''
	}
});

/**
 * Casing Backbone Collection
 */
model.CasingCollection = model.AbstractCollection.extend({
	url: 'api/casings',
	model: model.CasingModel
});

/**
 * CasingTrimmer Backbone Model
 */
model.CasingTrimmerModel = Backbone.Model.extend({
	urlRoot: 'api/casingtrimmer',
	idAttribute: 'trimmerId',
	trimmerId: '',
	trimmerType: '',
	defaults: {
		'trimmerId': null,
		'trimmerType': ''
	}
});

/**
 * CasingTrimmer Backbone Collection
 */
model.CasingTrimmerCollection = model.AbstractCollection.extend({
	url: 'api/casingtrimmers',
	model: model.CasingTrimmerModel
});

/**
 * CleaningSolution Backbone Model
 */
model.CleaningSolutionModel = Backbone.Model.extend({
	urlRoot: 'api/cleaningsolution',
	idAttribute: 'solutionId',
	solutionId: '',
	manufacture: '',
	formula: '',
	cost: '',
	amount: '',
	ultrasonicCleaner: '',
	defaults: {
		'solutionId': null,
		'manufacture': '',
		'formula': '',
		'cost': '',
		'amount': '',
		'ultrasonicCleaner': ''
	}
});

/**
 * CleaningSolution Backbone Collection
 */
model.CleaningSolutionCollection = model.AbstractCollection.extend({
	url: 'api/cleaningsolutions',
	model: model.CleaningSolutionModel
});

/**
 * Die Backbone Model
 */
model.DieModel = Backbone.Model.extend({
	urlRoot: 'api/die',
	idAttribute: 'dieId',
	dieId: '',
	grade: '',
	manufacture: '',
	dieType: '',
	caliber: '',
	press: '',
	defaults: {
		'dieId': null,
		'grade': '',
		'manufacture': '',
		'dieType': '',
		'caliber': '',
		'press': ''
	}
});

/**
 * Die Backbone Collection
 */
model.DieCollection = model.AbstractCollection.extend({
	url: 'api/dies',
	model: model.DieModel
});

/**
 * HandPrimer Backbone Model
 */
model.HandPrimerModel = Backbone.Model.extend({
	urlRoot: 'api/handprimer',
	idAttribute: 'anufacture',
	anufacture: '',
	defaults: {
		'anufacture': null
	}
});

/**
 * HandPrimer Backbone Collection
 */
model.HandPrimerCollection = model.AbstractCollection.extend({
	url: 'api/handprimers',
	model: model.HandPrimerModel
});

/**
 * Handle Backbone Model
 */
model.HandleModel = Backbone.Model.extend({
	urlRoot: 'api/handle',
	idAttribute: 'handleId',
	handleId: '',
	manufacture: '',
	thread: '',
	defaults: {
		'handleId': null,
		'manufacture': '',
		'thread': ''
	}
});

/**
 * Handle Backbone Collection
 */
model.HandleCollection = model.AbstractCollection.extend({
	url: 'api/handles',
	model: model.HandleModel
});

/**
 * PocketCleaner Backbone Model
 */
model.PocketCleanerModel = Backbone.Model.extend({
	urlRoot: 'api/pocketcleaner',
	idAttribute: 'pocketCleanerId',
	pocketCleanerId: '',
	manufacture: '',
	pocketCleanerSize: '',
	pocketCleanerType: '',
	defaults: {
		'pocketCleanerId': null,
		'manufacture': '',
		'pocketCleanerSize': '',
		'pocketCleanerType': ''
	}
});

/**
 * PocketCleaner Backbone Collection
 */
model.PocketCleanerCollection = model.AbstractCollection.extend({
	url: 'api/pocketcleaners',
	model: model.PocketCleanerModel
});

/**
 * Powder Backbone Model
 */
model.PowderModel = Backbone.Model.extend({
	urlRoot: 'api/powder',
	idAttribute: 'powderId',
	powderId: '',
	name: '',
	powderType: '',
	burnRate: '',
	quantityInGrains: '',
	costPerGrain: '',
	defaults: {
		'powderId': null,
		'name': '',
		'powderType': '',
		'burnRate': '',
		'quantityInGrains': '',
		'costPerGrain': ''
	}
});

/**
 * Powder Backbone Collection
 */
model.PowderCollection = model.AbstractCollection.extend({
	url: 'api/powders',
	model: model.PowderModel
});

/**
 * PowderDispenser Backbone Model
 */
model.PowderDispenserModel = Backbone.Model.extend({
	urlRoot: 'api/powderdispenser',
	idAttribute: 'powderDispenserId',
	powderDispenserId: '',
	manufacture: '',
	pdispenserType: '',
	defaults: {
		'powderDispenserId': null,
		'manufacture': '',
		'pdispenserType': ''
	}
});

/**
 * PowderDispenser Backbone Collection
 */
model.PowderDispenserCollection = model.AbstractCollection.extend({
	url: 'api/powderdispensers',
	model: model.PowderDispenserModel
});

/**
 * Press Backbone Model
 */
model.PressModel = Backbone.Model.extend({
	urlRoot: 'api/press',
	idAttribute: 'pressId',
	pressId: '',
	manufacture: '',
	productionRate: '',
	pressType: '',
	thread: '',
	defaults: {
		'pressId': null,
		'manufacture': '',
		'productionRate': '',
		'pressType': '',
		'thread': ''
	}
});

/**
 * Press Backbone Collection
 */
model.PressCollection = model.AbstractCollection.extend({
	url: 'api/presses',
	model: model.PressModel
});

/**
 * Primer Backbone Model
 */
model.PrimerModel = Backbone.Model.extend({
	urlRoot: 'api/primer',
	idAttribute: 'primerId',
	primerId: '',
	name: '',
	manufacture: '',
	primerSize: '',
	quanity: '',
	costPerPrimer: '',
	defaults: {
		'primerId': null,
		'name': '',
		'manufacture': '',
		'primerSize': '',
		'quanity': '',
		'costPerPrimer': ''
	}
});

/**
 * Primer Backbone Collection
 */
model.PrimerCollection = model.AbstractCollection.extend({
	url: 'api/primers',
	model: model.PrimerModel
});

/**
 * Recipe Backbone Model
 */
model.RecipeModel = Backbone.Model.extend({
	urlRoot: 'api/recipe',
	idAttribute: 'recipeId',
	recipeId: '',
	recipeName: '',
	bullet: '',
	powder: '',
	powderAmountInGrains: '',
	casing: '',
	primer: '',
	ballisticData: '',
	costPerBullet: '',
	amountAvailable: '',
	defaults: {
		'recipeId': null,
		'recipeName': '',
		'bullet': '',
		'powder': '',
		'powderAmountInGrains': '',
		'casing': '',
		'primer': '',
		'ballisticData': '',
		'costPerBullet': '',
		'amountAvailable': ''
	}
});

/**
 * Recipe Backbone Collection
 */
model.RecipeCollection = model.AbstractCollection.extend({
	url: 'api/recipes',
	model: model.RecipeModel
});

/**
 * ShellHolder Backbone Model
 */
model.ShellHolderModel = Backbone.Model.extend({
	urlRoot: 'api/shellholder',
	idAttribute: 'shellHolderId',
	shellHolderId: '',
	manufacture: '',
	number: '',
	defaults: {
		'shellHolderId': null,
		'manufacture': '',
		'number': ''
	}
});

/**
 * ShellHolder Backbone Collection
 */
model.ShellHolderCollection = model.AbstractCollection.extend({
	url: 'api/shellholders',
	model: model.ShellHolderModel
});

/**
 * UltrasonicCleaner Backbone Model
 */
model.UltrasonicCleanerModel = Backbone.Model.extend({
	urlRoot: 'api/ultrasoniccleaner',
	idAttribute: 'ultrasonicCleanerId',
	ultrasonicCleanerId: '',
	manufacture: '',
	ultrasonicCleanerSize: '',
	ultrasonicCleanerType: '',
	defaults: {
		'ultrasonicCleanerId': null,
		'manufacture': '',
		'ultrasonicCleanerSize': '',
		'ultrasonicCleanerType': ''
	}
});

/**
 * UltrasonicCleaner Backbone Collection
 */
model.UltrasonicCleanerCollection = model.AbstractCollection.extend({
	url: 'api/ultrasoniccleaners',
	model: model.UltrasonicCleanerModel
});

/**
 * WorkBench Backbone Model
 */
model.WorkBenchModel = Backbone.Model.extend({
	urlRoot: 'api/workbench',
	idAttribute: 'workBenchId',
	workBenchId: '',
	name: '',
	workBenchType: '',
	wworkBenchSize: '',
	defaults: {
		'workBenchId': null,
		'name': '',
		'workBenchType': '',
		'wworkBenchSize': ''
	}
});

/**
 * WorkBench Backbone Collection
 */
model.WorkBenchCollection = model.AbstractCollection.extend({
	url: 'api/workbenches',
	model: model.WorkBenchModel
});

