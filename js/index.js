function checkOccupation() {
    const occupation = document.getElementById("occupationSelect").value;
    const additionalInputs = document.getElementById("additionalInputs");

    additionalInputs.innerHTML = ''

    switch (occupation) {
        case 'Medico':
            additionalInputs.innerHTML = `
                <div class="contenedor-opciones">
                    <input type="text" name="medicLicense" placeholder="Número de licencia médica" required/>
                    <input type="text" name="specialty" placeholder="Especialidad médica" required/>
                </div>
            `;
            break;
    }
}