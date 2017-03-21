/** global jQuery, Backbone, _, WordCampMentors, wp, userSettings */

( function( window, $ ) {

	'use strict';

	window.wordcamp = window.wordcamp || {};

	if ( ! wordcamp.mentors instanceof wordcamp.MentorsApp ) {
		return;
	}

	var $document = $( document ),
		prefix = wordcamp.mentors.prefix;

	/**
	 * A Backbone view for the list of tasks.
	 */
	wordcamp.mentors.views.List = Backbone.View.extend( {
		/**
		 * Time increment in ms for polling the server.
		 */
		tick: 5000,

		/**
		 * Unix timestamp of the last activity within the app.
		 */
		lastActive: 0,

		/**
		 *
		 */
		hibernating: false,

		/**
		 * Data to submit when fetching a task collection.
		 */
		taskRequest: {
			data: {
				per_page: 300,
				orderby: 'menu_order',
				order: 'asc'
			},
			remove: false
		},

		/**
		 * Initialize the List view.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		initialize: function() {
			var view = this,
				origContent = this.$el.html();

			this.setLastActive();

			this.tasks      = new wp.api.collections.Wcm_task( WordCampMentorsTaskData );
			this.categories = new wp.api.collections.Wcm_task_category( WordCampMentorsTaskCategoryData );
			this.filter     = new wordcamp.mentors.views.Filter( { el: '#tasks-filter', list: this } );
			this.reset      = new wordcamp.mentors.views.Reset( { el: '#tasks-reset' } );

			if ( this.tasks.length ) {
				view.render();

				view.ticker = setInterval( function() {
					view.trigger( 'tick:' + view.tick );
				}, view.tick );
			} else {
				view.$el.html( origContent );
			}

			this.listeners();

			return this;
		},

		/**
		 * Render the List view.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		render: function() {
			var view = this;

			this.$el.empty();

			this.tasks.each( function( model ) {
				var categories, task;

				categories = _.filter( view.categories.models, function( category ) {
					return _.contains( model.get( prefix + '_task_category' ), category.get( 'id' ) );
				});

				task = new wordcamp.mentors.views.Task( {
					model: model,
					list: view,
					categories: categories
				});

				view.$el.append( task.$el );
			});

			this.trigger( 'setFilter', { skipHighlight: true } );

			return this;
		},

		/**
		 * Set up event listeners.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		listeners: function() {
			this.listenTo( this, 'tick:' + this.tick,   this.pollCollectionOrHibernate );
			this.listenTo( this, 'hibernate',           this.hibernate );
			this.listenTo( this.filter, 'filter:tasks', this.updateVisibleTasks );

			return this;
		},

		/**
		 * Poll the task collection for changes, or stop polling if the user is inactive.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		pollCollectionOrHibernate: function() {
			var elapsed = Date.now() - this.lastActive;

			if ( elapsed < 30000 ) {
				this.tasks.fetch( this.taskRequest );
			} else if ( ! this.hibernating ) {
				this.trigger( 'hibernate' );
			}

			return this;
		},

		/**
		 * Get an array of models that should be visible based on filter parameters.
		 *
		 * @private
		 *
		 * @param filter object
		 * @returns array
		 */
		_getVisibleTasks: function( filter ) {
			var visibleTasks = new Backbone.Collection( this.tasks.models );

			if ( 'any' !== filter[ prefix + '_task_category' ] ) {
				visibleTasks = new Backbone.Collection( _.filter( visibleTasks.models, function( task ) {
					return _.contains( task.get( prefix + '_task_category' ), parseInt( filter[ prefix + '_task_category' ] ) );
				}) );
			}

			if ( 'any' !== filter.status ) {
				visibleTasks = new Backbone.Collection( visibleTasks.where( { status: filter.status } ) );
			}

			return visibleTasks.models;
		},

		/**
		 * Update the visibility of tasks in the list based on filter parameters.
		 *
		 * @param filter object Required parameters to determine which tasks should be visible.
		 * @param data   object Optional parameters to pass to the event trigger.
		 * @returns {wordcamp.mentors.views.List}
		 */
		updateVisibleTasks: function( filter, data ) {
			var visibleTasks = this._getVisibleTasks( filter ),
				$parentTable = this.$el.parents( 'table' );

			// Remove row stripes if not showing everything
			if ( _.every( filter, function( value ) { return 'any' === value } ) ) {
				$parentTable.addClass( 'striped' );
			} else {
				$parentTable.removeClass( 'striped' );
			}

			this.tasks.each( function( task ) {
				if ( ! _.contains( visibleTasks, task ) ) {
					task.trigger( 'visibility:hide', data );
				}
			});

			_.each( visibleTasks, function( task ) {
				task.trigger( 'visibility:show', data );
			});

			return this;
		},

		/**
		 * Set or update the application as active so that it will poll for changes.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		setLastActive: function() {
			this.lastActive  = Date.now();
			this.hibernating = false;

			// Stop listening for activity
			$document.off( '.' + prefix + '-tasks' );

			return this;
		},

		/**
		 * Set the application as inactive so that it won't poll for changes.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		hibernate: function() {
			var view = this;

			this.hibernating = true;

			$document.on(
				'mouseover.' + prefix + '-tasks keyup.' + prefix + '-tasks touchend.' + prefix + '-tasks',
				function() {
					view.setLastActive();
				}
			);

			return this;
		}
	});

	/**
	 * A Backbone view for an individual task.
	 */
	wordcamp.mentors.views.Task = Backbone.View.extend( {
		/**
		 * HTML element to use as a container.
		 */
		tagName: 'tr',

		/**
		 * HTML element ID attribute.
		 *
		 * @returns {string}
		 */
		id: function() {
			return prefix + '-task-' + this.model.get( 'id' );
		},

		/**
		 * HTML element class attribute.
		 */
		className: prefix + '-task',

		/**
		 * The templating function for rendering the task.
		 */
		template: wp.template( prefix + '-task' ),

		/**
		 * Combine model attributes with other data necessary for rendering.
		 *
		 * @private
		 *
		 * @param model object
		 */
		_compileData: function( model ) {
			return $.extend( {}, model.attributes, {
				task_category: this.categories,
				stati: wordcamp.mentors.stati
			} );
		},

		/**
		 * Initialize a task view.
		 *
		 * @param options
		 * @returns {wordcamp.mentors.views.Task}
		 */
		initialize: function( options ) {
			this.list       = options.list;
			this.categories = options.categories;

			this.render( this._compileData( this.model ) );

			this.listeners();

			return this;
		},

		/**
		 * Render a task.
		 *
		 * @param data
		 * @returns {wordcamp.mentors.views.Task}
		 */
		render: function( data ) {
			this.$el.html( this.template( data ) );

			return this;
		},

		/**
		 * Set up event listeners.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		listeners: function() {
			this.listenTo( this.model, 'visibility:show', this.showMe );
			this.listenTo( this.model, 'visibility:hide', this.hideMe );
			this.listenTo( this.model, 'change:status',   this.changeStatus );
			this.listenTo( this.model, 'change:modified', this.changeModified );

			return this;
		},

		/**
		 * Make this task visible.
		 *
		 * @param data object
		 */
		showMe: function( data ) {
			var data = data || {},
				duration = 800;

			if ( 'undefined' !== typeof data.skipHighlight ) {
				duration = 0;
			} else {
				this.$el.addClass( prefix + '-highlight' );
			}

			this.$el.fadeIn( duration, function() {
				$( this ).removeClass( prefix + '-highlight' );
			});
		},

		/**
		 * Make this task hidden.
		 *
		 * @param data object
		 */
		hideMe: function( data ) {
			var data = data || {},
				duration = 500;

			if ( 'undefined' !== typeof data.skipHighlight ) {
				duration = 0;
			} else {
				this.$el.addClass( prefix + '-highlight' );
			}

			this.$el.fadeOut( duration, function() {
				$( this ).removeClass( prefix + '-highlight' );
			});
		},

		/**
		 * Re-render this task when the status changes.
		 *
		 * @param model
		 */
		changeStatus: function( model ) {
			var list = this.list;

			this.$el.addClass( prefix + '-highlight' );

			this.render( this._compileData( model ) );

			// Slight delay before re-filtering the list
			setTimeout( function() {
				list.trigger( 'setFilter' );
			}, 1000 );
		},

		/**
		 * Re-render this task when the modified timestamp changes.
		 *
		 * @param model
		 */
		changeModified: function( model ) {
			this.render( this._compileData( model ) );
		},

		/**
		 * Event binding.
		 */
		events: {
			'change .column-status select': 'updateStatus'
		},

		/**
		 * Update this task's model when the user chooses a new status in the UI.
		 *
		 * @param event
		 * @returns {wordcamp.mentors.views.Task}
		 */
		updateStatus: function( event ) {
			var value = $( event.target ).val();

			this.model.set( 'status', value );
			this.model.save();

			return this;
		}
	});

	/**
	 * A Backbone view for the controls that filter visible tasks.
	 */
	wordcamp.mentors.views.Filter = Backbone.View.extend( {
		/**
		 * Initialize the filter view.
		 *
		 * @param options
		 */
		initialize: function( options ) {
			this.list = options.list;

			this.listeners();
		},

		/**
		 * Set up event listeners.
		 *
		 * @returns {wordcamp.mentors.views.List}
		 */
		listeners: function() {
			this.listenTo( this.list, 'setFilter', function( data ) {
				this.$el.trigger( 'submit', data );
			} );

			return this;
		},

		/**
		 * Event binding.
		 */
		events: {
			'submit': 'setFilter'
		},

		/**
		 * Gather the parameters set for the list filter and pass them via event trigger.
		 *
		 * @param event
		 * @param data
		 */
		setFilter: function( event, data ) {
			event.preventDefault();

			var filter = {},
				settingPrefix = wordcamp.mentors.prefix;

			$( event.target ).find( 'select' ).each( function() {
				var attribute = $( this ).data( 'attribute' ),
					value     = $( this ).val();

				filter[ attribute ] = value;
			});

			// Save filter values as user settings
			_.each( filter, function( value, key ) {
				setUserSetting(
					settingPrefix + '-' + key,
					value
				);
			});

			this.trigger( 'filter:tasks', filter, data );
		}
	});

	/**
	 * A Backbone view for the button to reset task data.
	 */
	wordcamp.mentors.views.Reset = Backbone.View.extend( {
		events: {
			'submit': 'confirm'
		},

		confirm: function( event ) {
			if ( ! window.confirm( wordcamp.mentors.l10n.confirmReset ) ) {
				event.preventDefault();
			}
		}
	});

} )( window, jQuery );