document.addEventListener("DOMContentLoaded", function () {
    const stateSelect = document.getElementById("State");
    stateSelect.addEventListener("change", function () {
        const selectedState = stateSelect.value;
        const citySelect = document.getElementById("City");

        function handleCityResponse(response) {
            citySelect.innerHTML = response;
        }

        
        function getCityForState(selectedState) {
            fetch(`cityDropdown.php?state=${selectedState}`)
                .then(response => response.text())
                .then(data => handleCityResponse(data))
                .catch(error => console.error('Fetch error:', error));
        }
        getCityForState(selectedState);
        document.getElementById("City").disabled = false;
    });
});