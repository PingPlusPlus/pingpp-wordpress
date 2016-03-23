<!DOCTYPE html>
<html lang="en">
<head>
    <script src="<?php echo PINGPP_WP_PAY_PLUGIN_URL.'assets/js/pingpp_pc.js';?>"></script>
</head>
<body>

<script>
    var charge = <?php echo $GLOBALS["pingpp_charge_object"]; ;?>;
    pingppPc.createPayment(charge, function(result, err){
        // 处理错误信息
        console.log(charge);
    });
</script>
</body>
</html>



