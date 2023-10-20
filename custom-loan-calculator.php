<?php
/**
 * Plugin Name: Custom Loan Calculator
 * Plugin URI: https://koutkod.com/
 * Description: A customizable loan calculator for WordPress.
 * Version: 1.0
 * Author: Apollonnius Alex Fils Desir
 * Author URI: https://koutkod.com/
 * License: GPL2
 */

function custom_loan_calculator_enqueue_styles() {
    wp_enqueue_style('custom-loan-calculator', plugin_dir_url(__FILE__) . 'calculator.php');
}

add_action('wp_enqueue_scripts', 'custom_loan_calculator_enqueue_styles');

function custom_loan_calculator_shortcode() {
    ob_start();
    include 'calculator.html';
    return ob_get_clean();
}

add_shortcode('custom_loan_calculator', 'custom_loan_calculator_shortcode');

// Register a new settings page in the WordPress admin area
function custom_loan_calculator_settings_menu() {
    add_options_page(
        'Custom Loan Calculator',
        'Custom Loan Calculator',
        'manage_options',
        'custom-loan-calculator',
        'custom_loan_calculator_settings_page'
    );
}

add_action('admin_menu', 'custom_loan_calculator_settings_menu');

// Create a callback function for the settings page
function custom_loan_calculator_settings_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <p>
            <strong>To customize the calculator's appearance, use the following class names in your custom CSS:</strong><br>
            - <strong>Background color, Font color, Container padding, Container border and Container border radius:</strong> .custom-loan-calculator-container<br>
            - <strong>Input fields and labels:</strong> .custom-loan-calculator-container input, .custom-loan-calculator-container label, .custom-loan-calculator-container select<br>
            - <strong>Result container:</strong> .custom-loan-calculator-container .resultado<br>
        </p>
        <form action="options.php" method="post">
            <?php
            settings_fields('custom_loan_calculator');
            do_settings_sections('custom_loan_calculator');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

// Register the settings and sections for the settings page
function custom_loan_calculator_settings_init() {
    register_setting('custom_loan_calculator', 'custom_loan_calculator_settings');

    add_settings_section(
        'custom_loan_calculator_section_colors',
        'Colors',
        null,
        'custom_loan_calculator'
    );

        add_settings_field(
        'custom_css',
        'Custom CSS',
        'custom_loan_calculator_field_custom_css_cb',
        'custom_loan_calculator',
        'custom_loan_calculator_section_colors',
        [
            'label_for' => 'custom_css',
            'class' => 'custom_loan_calculator_row',
            'custom_loan_calculator_custom_data' => 'custom',
        ]
    );
}

add_action('admin_init', 'custom_loan_calculator_settings_init');

// Create a callback function for the custom CSS field
function custom_loan_calculator_field_custom_css_cb($args) {
    $options = get_option('custom_loan_calculator_settings');
    
    // Default CSS code
    $default_css = "
/* Default styles for the Custom Loan Calculator */
/* Replace or modify the properties as needed */

.custom-loan-calculator-container {
    background-color: #049ba4;
    padding: 20px;
    border: none;
    border-radius: 30px;
    color: #000000;
}

.custom-loan-calculator-container input,
.custom-loan-calculator-container select {
    border: 1px solid #ccc;
}
";
    
    if (!isset($options[$args['label_for']])) {
        $options[$args['label_for']] = $default_css;
        update_option('custom_loan_calculator_settings', $options);
    }
    
    $css_value = $options[$args['label_for']] ?? $default_css;
    ?>
    <textarea id="<?= esc_attr($args['label_for']); ?>" name="custom_loan_calculator_settings[<?= esc_attr($args['label_for']); ?>]" rows="10" cols="50"><?= esc_textarea($css_value); ?></textarea>
    <?php
}

