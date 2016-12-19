

( function( $ ) {

    var App = {

        cache: {},


        updateCache: function( cache ) {
            cache.$tabs = $( '#tasks-dash-container' );
        },


        init: function() {
            var self = this,
                cache = this.cache;

            self.updateCache( cache );

            $( document ).ready( function() {
                self.initTabs( cache.$tabs );
            });
        },


        initTabs: function( $container ) {
            var cache = App.cache;

            cache.$tabHeader = $container.find( '.tasks-dash-tab' );
            cache.$tabContent = $container.find( '.tasks-dash-category' );

            // Set tab colors and targets
            cache.$tabHeader.each( function() {
                var $tab = $( this ),
                    $target = $( $tab.find( 'a' ).attr( 'href' ) ),
                    $flag = $tab.find( '.tasks-dash-tab-flag' ),
                    color = $tab.data( 'color' );

                $tab.data( 'target', $target );
                $flag.css( { background: color } );
            });

            // Set up category data
            cache.$tabContent.each( function() {
                var $category = $( this ),
                    $tasks = $category.find( '.tasks-dash-item' );

                $category.data( {
                    taskTotal: $tasks.length,
                    taskDone: $tasks.find( '.tasks-dash-toggle input[type="checkbox"]:checked' ).length
                });
            });

            // Initialize tabs UI
            cache.tabsUI = $container.tabs();
            cache.sortableUI = cache.tabsUI.find( '.ui-tabs-nav' ).sortable({
                placeholder: 'tasks-dash-tab-placeholder',
                forcePlaceholderSize: true,
                stop: function() {
                    tabs.tabs( 'refresh' );
                }
            });

            // Initialize progress bars
            cache.$tabHeader.each( function() {
                var $tab = $( this ),
                    $target = $tab.data( 'target' ),
                    $bar = $tab.find( '.tasks-dash-tab-progressbar' ),
                    $label = $tab.find( '.tasks-dash-tab-progresslabel' );

                $bar.progressbar( {
                    value: $target.data( 'taskDone' ),
                    max: $target.data( 'taskTotal' ),
                    change: function() {
                        $label.text( $bar.progressbar( 'value' ) + '/' + $target.data( 'taskTotal' ) );
                    }
                });

                $label.text( $bar.progressbar( 'value' ) + '/' + $target.data( 'taskTotal' ) );
            });
        }
    };

    App.init();

} )( jQuery );