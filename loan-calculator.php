<?php
header("Content-type: text/css; charset: UTF-8");

$options = get_option('custom_loan_calculator_settings');
$background_color = $options['background_color'] ?? '#049ba4';
?>





        .container {
            max-width: 600px;
            padding: 20px;
            margin: auto;
            background-color: <?php echo $background_color; ?>;
            border-radius: 30px;
        }
.titlecalc {
    color: #fff !important;
}
        h1 {
            text-align: center;
            font-size: 24px;
        }
        label {
            display: block;
            margin-top: 20px;
            color: #fff !important;
        }
        input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        select {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #fff!important;
            border: none;
            border-radius: 5px;
            color: #049ba4 !important;
            font-weight: bold !important;
            cursor: pointer;
        }
        .resultado {
            margin-top: 20px;
            font-weight: bold;
            color: #fff !important;
        }
