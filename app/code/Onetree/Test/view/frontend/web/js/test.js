define([
    'uiComponent'
], function(
    Component
) {
    'use strict';

    return Component.extend({
        initialize() {
            this._super();

            console.log('The coso component has been loaded.');
        }
    });
});
