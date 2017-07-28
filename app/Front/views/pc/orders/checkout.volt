
<html>
<head>
</head>
<body>
<div id="paypal-container"></div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-2.1.1.js"></script>
<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script>
    braintree.setup("<?php print $clientToken; ?>", "custom", {
        paypal: {
            container: "paypal-container",
            singleUse: true, // Required
            amount: 1.10, // Required
            currency: 'USD', // Required
            locale: 'en_us',
            enableShippingAddress: 'true',
            shippingAddressOverride: {
                recipientName: 'Scruff McGruff',
                streetAddress: '1234 Main St.',
                extendedAddress: 'Unit 1',
                locality: 'Chicago',
                countryCodeAlpha2: 'US',
                postalCode: '60652',
                region: 'IL',
                phone: '123.456.7890',
                editable: false
            }
        },
        onPaymentMethodReceived: function (obj) {
            //doSomethingWithTheNonce(obj.nonce);
            console.log(obj);
        }
    });
</script>

<?php


$aCustomerId = '654702981'; // can be generated from braintreegateway.com vault->New Customer
$clientToken = Braintree\ClientToken::generate(array(
"customerId" => $aCustomerId
));
;
?>




<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script>
    var clientToken = "<?php echo $clientToken ?>";
    braintree.setup(clientToken, "dropin", {
        container: "payment-form"
    });
</script>

<form>
    <div id="paypal-container"></div>
</form>
<script type="text/javascript">
    braintree.setup(clientToken, "paypal", {
        container: "paypal-container",

        onPaymentMethodReceived: function (obj) {
            console.log(obj.nonce,obj)
            window.location.href = 'http://patpat.dev/do?nounce='+obj.nonce;
        }
    });
</script>

</body>
</html>