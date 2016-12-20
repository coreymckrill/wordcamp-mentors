
/** global ajaxurl */

( function( $ ) {

    var App = {

        cache: {},


        updateCache: function( cache ) {
            cache.$tabs = $( '#tasks-dash-container' );
            cache.$tasks = $( '.tasks-dash-item' );
        },


        sendRequest: function( data, callback ) {
            var cache = App.cache,
                nonce = cache.$tabs.data( 'nonce' ),
                request = {
                    action: 'wordcamp-mentors-tasks-dashboard',
                    nonce:  nonce,
                    data:   data
                };

            $.post( ajaxurl, request, function( response ) {
                if ( 'function' === typeof callback ) {
                    callback( response );
                }
            });
        },


        init: function() {
            var self = this,
                cache = this.cache;

            self.updateCache( cache );

            $( document ).ready( function() {
                self.initTabs( cache.$tabs );
                self.initTasks( cache.$tasks );
            });
        },


        initTabs: function( $container ) {
            var cache = App.cache;

            cache.$tabHeader = $container.find( '.tasks-dash-tab' );
            cache.$tabContent = $container.find( '.tasks-dash-category' );

            // Set up category data
            cache.$tabContent.each( function() {
                var $category = $( this ),
                    $tasks = $category.find( '.tasks-dash-item' );

                $category.data( {
                    taskTotal: $tasks.length,
                    taskDone: $tasks.filter( '.complete' ).length
                });
            });

            // Initialize tabs UI
            cache.tabsUI = $container.tabs();
            cache.sortableUI = cache.tabsUI.find( '.ui-tabs-nav' ).sortable( {
                handle: '.tasks-dash-tab-flag',
                placeholder: 'tasks-dash-tab-placeholder',
                forcePlaceholderSize: true,
                stop: function() {
                    var newOrder = cache.sortableUI.sortable( 'toArray', { attribute: 'data-category' } ),
                        data;

                    data = {
                        action: 'tab-order',
                        'tab-order': newOrder
                    };

                    App.sendRequest( data );

                    // Refresh the Tabs UI
                    cache.tabsUI.tabs( 'refresh' );
                }
            });

            // Initialize progress bars
            cache.progressbar = [];
            cache.$tabHeader.each( function() {
                var $tab = $( this ),
                    $target = $( $tab.find( 'a' ).attr( 'href' ) ),
                    $bar = $tab.find( '.tasks-dash-tab-progressbar' ),
                    $label = $tab.find( '.tasks-dash-tab-progresslabel' );

                cache.progressbar[ $tab.data( 'category' ) ] = $bar.progressbar( {
                    value: $target.data( 'taskDone' ),
                    max: $target.data( 'taskTotal' ),
                    change: function() {
                        $label.text( $bar.progressbar( 'value' ) + '/' + $target.data( 'taskTotal' ) );
                    }
                });

                $label.text( $bar.progressbar( 'value' ) + '/' + $target.data( 'taskTotal' ) );
            });
        },


        initTasks: function( $tasks ) {
            var cache = App.cache;

            $tasks.each( function() {
                var $task = $( this ),
                    $toggle = $task.find( '.tasks-dash-item-toggle' ),
                    $spinner = $task.find( '.spinner' ),
                    $content = $task.find( '.tasks-dash-item-content' ),
                    $category = $task.parents( '.tasks-dash-category' ),
                    id = $task.attr( 'id' ).replace( 'tasks-dash-item-', '' );

                $toggle.on( 'click', function() {
                    $spinner.addClass( 'is-active' );

                    if ( $task.hasClass( 'complete' ) ) {
                        App.sendRequest( { action: 'uncheck-task', 'task-id': id }, function( response ) {
                            $spinner.removeClass( 'is-active' );

                            if ( response.success ) {
                                $task.removeClass( 'complete' );
                                $toggle.removeClass( 'dashicons-yes' );

                                $content.find( '.completed-by' ).remove();

                                App.updateProgressbar( $category );
                            }
                        });
                    } else {
                        App.sendRequest( { action: 'check-task', 'task-id': id }, function( response ) {
                            var $completedBy = $( '<span>' ).addClass( 'completed-by' );

                            $spinner.removeClass( 'is-active' );

                            if ( response.success ) {
                                $task.addClass( 'complete' );
                                $toggle.addClass( 'dashicons-yes' );

                                if ( 'undefined' !== typeof response.data['completed_by'] ) {
                                    $completedBy.text( '(' + response.data['completed_by'] + ')' );
                                    $content.append( $completedBy );
                                }

                                App.updateProgressbar( $category );
                            }
                        });
                    }
                });
            });
        },


        updateProgressbar: function( $category ) {
            var cache = App.cache,
                category = $category.data( 'category' ),
                $tasks = $category.find( '.tasks-dash-item' );

            cache.progressbar[ category ].progressbar( 'value', $tasks.filter( '.complete' ).length );
        }
    };

    App.init();

} )( jQuery );