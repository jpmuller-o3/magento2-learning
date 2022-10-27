define([
    'uiComponent',
    'ko',
    'Onetree_DefaultPaymentMethod/js/model/paymentMethod',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/payment-service',
    'Magento_Checkout/js/model/step-navigator',
], function(
    Component,
    ko,
    paymentMethodModel,
    quote,
    paymentService,
    stepNavigator
) {
    'use strict';

    const PAYMENT_STEP_CODE = 'payment';
    let availablePaymentMethods = {}
    return Component.extend({
        defaults: {
            paymentMethod: paymentMethodModel.paymentMethod,
            isPaymentStep: ko.observable(false)
        },
        initialize() {
            this._super();
            console.log('component loaded');

            stepNavigator.steps.subscribe((val) => val.map( i => {
                if (i.isVisible() && i.code === PAYMENT_STEP_CODE) {
                  this.isPaymentStep(true)
                } else {
                    this.isPaymentStep(false)
                }
            }));

            quote.getPaymentMethod().subscribe((value) => { console.log(value); this.paymentMethod(value.method)})
        },
    });
});
