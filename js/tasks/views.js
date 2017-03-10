/** global jQuery, Backbone, _, WordCampMentors, wp, userSettings */

( function( window, $ ) {

	'use strict';

	window.wordcamp = window.wordcamp || {};

	if ( ! wordcamp.mentors instanceof wordcamp.MentorsApp ) {
		return;
	}


	wordcamp.mentors.views.List = Backbone.View.extend( {

		pfx: wordcamp.mentors.prefix,


		tick: 5000,


		initialize: function() {
			this.tasks      = new wp.api.collections.Wcm_task();
			this.categories = new wp.api.collections.Wcm_task_category();
			this.filter     = new wordcamp.mentors.views.Filter( { el: '#tasks-filter', list: this } );

			var view = this,
				taskData = {
					filter: {
						'orderby': 'menu_order',
						'order': 'ASC'
					}
				};

			$.when( this.tasks.fetch( taskData ), this.categories.fetch() ).done( function() {
				if ( view.tasks.length ) {
					view.render();
				}

				view.ticker = setInterval( function() {
					view.trigger( 'tick:' + view.tick );
				}, view.tick );
			});

			this.listeners();
		},

		render: function() {
			var view = this;

			view.$el.html( '' );

			this.tasks.each( function( model ) {
				var categories, task;

				categories = _.filter( view.categories.models, function( category ) {
					return _.contains( model.get( view.pfx + '_task_category' ), category.get( 'id' ) );
				});

				task = new wordcamp.mentors.views.Task( {
					model: model,
					list: view,
					categories: categories
				});

				view.$el.append( task.$el );
			});

			this.trigger( 'setFilter', { skipHighlight: true } );
		},


		listeners: function() {
			this.listenTo( this.filter, 'filter:tasks', this.updateVisibleTasks );
			this.listenTo( this, 'tick:' + this.tick, this.pollCollection );
		},


		pollCollection: function() {
			this.tasks.fetch( { reset: false } );
		},


		_getVisibleTasks: function( filter ) {
			var view = this,
				taskCollection = this.tasks,
				tasks;

			if ( 'any' !== filter[ view.pfx + '_task_category' ] ) {
				taskCollection = new Backbone.Collection( _.filter( taskCollection.models, function ( task ) {
					return _.contains( task.get( view.pfx + '_task_category' ), parseInt( filter[ view.pfx + '_task_category' ] ) );
				}) );
			}

			if ( 'any' !== filter.status ) {
				tasks = taskCollection.where( { status: filter.status } );
			} else {
				tasks = taskCollection.models;
			}

			return tasks;
		},


		updateVisibleTasks: function( filter, data ) {
			var visibleTasks = this._getVisibleTasks( filter );

			_.each( this.tasks.models, function( task ) {
				if ( ! _.contains( visibleTasks, task ) ) {
					task.trigger( 'visibility:hide', data );
				}
			});

			_.each( visibleTasks, function( task ) {
				task.trigger( 'visibility:show', data );
			});
		}
	});


	wordcamp.mentors.views.Task = Backbone.View.extend( {

		tagName: 'tr',


		id: function() {
			return wordcamp.mentors.prefix + '-task-' + this.model.get( 'id' );
		},


		className: wordcamp.mentors.prefix + '-task',


		template: wp.template( wordcamp.mentors.prefix + '-task' ),


		_compileData: function( model ) {
			return $.extend( {}, model.attributes, {
				wcm_task_category: this.categories,
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
		},


		showMe: function( data ) {
			var data = data || {},
				duration = 800;

			if ( 'undefined' !== typeof data.skipHighlight ) {
				duration = 0;
			} else {
				this.$el.addClass( 'wcm-highlight' );
			}

			this.$el.fadeIn( duration, function() {
				$( this ).removeClass( 'wcm-highlight' );
			});
		},


		hideMe: function( data ) {
			var data = data || {},
				duration = 800;

			if ( 'undefined' !== typeof data.skipHighlight ) {
				duration = 0;
			} else {
				this.$el.addClass( 'wcm-highlight' );
			}

			this.$el.fadeOut( duration, function() {
				$( this ).removeClass( 'wcm-highlight' );
			});
		},


		changeStatus: function( model ) {
			var list = this.list;

			this.$el.addClass( 'wcm-highlight' );

			this.render( this._compileData( model ) );

			// Slight delay before re-filtering the list
			setTimeout( function() {
				list.trigger( 'setFilter' );
			}, 1500 );
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

			var filter = {};

			$( event.target ).find( 'select' ).each( function() {
				var attribute = $( this ).data( 'attribute' ),
					value     = $( this ).val();

				filter[ attribute ] = value;
			});

			this.trigger( 'filter:tasks', filter, data );
		}
	});

} )( window, jQuery );