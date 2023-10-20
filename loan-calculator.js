document.getElementById("monto").addEventListener("input", formatCurrency);

        function formatCurrency() {
            const monto = document.getElementById("monto");
            let value = monto.value.replace(/,/g, "");
            let formattedValue = new Intl.NumberFormat("en-US").format(value);
            monto.value = formattedValue;
        }

        function calcular() {
            const montoValue = parseFloat(document.getElementById("monto").value.replace(/,/g, ""));
            const tasa = parseFloat(document.getElementById("tasa").value) / 100;
            const plazo = parseFloat(document.getElementById("plazo").value);

            if (isNaN(montoValue) || isNaN(tasa) || isNaN(plazo)) {
                alert("Por favor, complete todos los campos.");
                return;
            }

            const tasaMensual = tasa / 12;
            const factor = (1 + tasaMensual) ** plazo;
const cuotaMensual = montoValue * tasaMensual * factor / (factor - 1);

    const resultadoDiv = document.getElementById("resultado");
    resultadoDiv.innerHTML = `
        <p><strong>Cuota mensual:</strong> RD$ ${cuotaMensual.toFixed(2)}</p>
    `;
}