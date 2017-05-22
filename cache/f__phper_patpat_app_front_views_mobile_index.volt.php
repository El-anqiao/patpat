<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo $this->security->getToken() ?>">
    <meta name="p:domain_verify" content="21ca919dd56d245ea0eb548244d0fefb"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?php echo $this->tag->getTitle() ?>
    <script>
        //        var OneSignal = OneSignal || [];
        //        OneSignal.push(function() {
        //            // This registers the workers at the root scope, which is allowed by the HTTP header "Service-Worker-Allowed: /"
        //            OneSignal.SERVICE_WORKER_PARAM = { scope: '/' };w
        //        });
        //        OneSignal.push(["init", {
        //            appId: "67ed8009-9d50-44c1-a8fa-c7b85071c9e2",
        //            autoRegister: true,
        //            notifyButton: {
        //                enable: false
        //            },
        //            persistNotification: false,
        //            safari_web_id: 'web.onesignal.auto.145f18a4-510a-4781-b676-50fa3f7fa700',
        //            httpPermissionRequest: {
        //                enabled: true
        //            }
        //        }]);
    </script>
    <link href="/assets/css/style.min-cda82a08b4.css" rel="stylesheet"/>
    <link href="/assets/css/index_test.min-edb4de340d.css" rel="stylesheet"/>
    <link href="/favicon.ico" rel="shortcut icon" type="image/ico"/>
    <script src="/assets/js/jquery.min.js"></script>
</head>
<body ontouchstart="">
<?php echo $this->getContent() ?>
</body>
</html>