function initializePayPal() {
    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'gold',
            shape: 'pill',
            label: 'paypal',
            tagline: false
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '0.01'
                    }
                }]
            })
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert( 'Transaction completed by ' + details. payer.name.given_name);
            });
        }
        /*createOrder: function() {
            return fetch("/my-server/create-paypal-order", {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                },
                body: JSON.stringify({
                cart: [
                    {
                    sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                    quantity: "YOUR_PRODUCT_QUANTITY",
                    },
                ],
                }),
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(order) {
                return order.id;
            });
        },
        onApprove: function(data) {
            return fetch("/my-server/capture-paypal-order", {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                },
                body: JSON.stringify({
                orderID: data.orderID
                })
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            });
        }*/
    }).render('.paypal');
}

window.addEventListener('load', function() {
    var script = document.createElement('script');
    script.src = "https://www.paypal.com/sdk/js?client-id=sb&currency=EUR";
    script.onload = initializePayPal;
    document.body.appendChild(script);
});