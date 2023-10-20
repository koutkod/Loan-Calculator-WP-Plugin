<?php

function loan_calculator_shortcode() {
    ob_start();
    ?>
    <div class="container">
        <label for="tipo">Tipo de préstamo:</label>
        <select id="tipo">
            <option value="personales">Personales</option>
            <option value="vehículos">Vehículos</option>
            <option value="productivos">Productivos</option>
        </select>
        <label for="monto">Monto del préstamo:</label>
        <input type="text" id="monto" placeholder="Monto en pesos dominicanos">
        <label for="tasa">Tasa de interés anual (%):</label>
        <input type="number" id="tasa" placeholder="Tasa de interés anual">
        <label for="plazo">Plazo (en meses):</label>
        <input type="number" id="plazo" placeholder="Plazo en meses" min="6">
        <button-calc onclick="calcular()">Calcular</button>
        <div class="resultado" id="resultado"></div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('loan_calculator', 'loan_calculator_shortcode');
