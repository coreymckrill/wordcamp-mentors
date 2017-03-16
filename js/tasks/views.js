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

		tick: 5000,

		lastActive: 0,

		hibernating: false,

		taskRequest: {
			data: {
				per_page: 300,
				orderby: 'menu_order',
				order: 'asc'
			},
			remove: false
		},

		categoryRequest: {
			data: {
				per_page: 100
			}
		},

		initialize: function() {
			var view = this,
				origContent = this.$el.html();

			this.$el
				.addClass( 'loading-content' )
				.html( '<tr><td colspan="4"><span class="spinner"></span></td></tr>' );

			this.setLastActive();

			this.tasks      = new wp.api.collections.Wcm_task();
			this.categories = new wp.api.collections.Wcm_task_category();
			this.filter     = new wordcamp.mentors.views.Filter( { el: '#tasks-filter', list: this } );
			this.reset      = new wordcamp.mentors.views.Reset( { el: '#tasks-reset' } );

			$.when( this.tasks.fetch( this.taskRequest ), this.categories.fetch( this.categoryRequest ) ).done( function() {
				view.$el.removeClass( 'loading-content' );

				if ( view.tasks.length ) {
					view.render();

					view.ticker = setInterval( function() {
						view.trigger( 'tick:' + view.tick );
					}, view.tick );
				} else {
					view.$el.html( origContent );
				}
			});

			this.listeners();
		},

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

		listeners: function() {
			this.listenTo( this, 'tick:' + this.tick,   this.pollCollectionOrHibernate );
			this.listenTo( this, 'hibernate',           this.hibernate );
			this.listenTo( this.filter, 'filter:tasks', this.updateVisibleTasks );
		},

		pollCollectionOrHibernate: function() {
			var elapsed = Date.now() - this.lastActive;

			if ( elapsed < 30000 ) {
				this.tasks.fetch( this.taskRequest );
			} else if ( ! this.hibernating ) {
				this.trigger( 'hibernate' );
			}

			return this;
		},

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

		setLastActive: function() {
			this.lastActive  = Date.now();
			this.hibernating = false;

			$document.find( 'body' ).fadeTo( 200, 1 );
			$document.off( '.' + prefix + '-tasks' );

			return this;
		},

		hibernate: function() {
			var view = this;

			this.hibernating = true;

			$document.find( 'body' ).fadeTo( 400, 0.5 );
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

		tagName: 'tr',

		id: function() {
			return prefix + '-task-' + this.model.get( 'id' );
		},

		className: prefix + '-task',

		template: wp.template( prefix + '-task' ),

		_compileData: function( model ) {
			return $.extend( {}, model.attributes, {
				task_category: this.categories,
				stati: wordcamp.mentors.stati
			} );
		},

		initialize: function( options ) {
			this.list       = options.list;
			this.categories = options.categories;

			this.render( this._compileData( this.model ) );

			this.listeners();

			return this;
		},

		render: function( data ) {
			this.$el.html( this.template( data ) );

			return this;
		},

		listeners: function() {
			this.listenTo( this.model, 'visibility:show', this.showMe );
			this.listenTo( this.model, 'visibility:hide', this.hideMe );
			this.listenTo( this.model, 'change:status',   this.changeStatus );
			this.listenTo( this.model, 'change:modified', this.changeModified );
		},

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

		changeStatus: function( model ) {
			var list = this.list;

			this.$el.addClass( prefix + '-highlight' );

			this.render( this._compileData( model ) );

			// Slight delay before re-filtering the list
			setTimeout( function() {
				list.trigger( 'setFilter' );
			}, 1000 );
		},

		changeModified: function( model ) {
			this.render( this._compileData( model ) );
		},

		events: {
			'change .column-status select': 'updateStatus'
		},

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

		initialize: function( options ) {
			this.list = options.list;

			this.listeners();
		},

		listeners: function() {
			this.listenTo( this.list, 'setFilter', function( data ) {
				this.$el.trigger( 'submit', data );
			} );
		},

		events: {
			'submit': 'setFilter'
		},

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