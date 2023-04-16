// /resources/js/main.js

// Bootstrap
import 'bootstrap';

(() => {
'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            // Set name
            var firstName = document.getElementById("firstName");
            var lastName = document.getElementById("lastName");
            var fullName = document.getElementById("name");
            fullName.value = firstName.value + ' ' + lastName.value;

            // Set subject
            var subjectSelect = document.getElementById("subjectSelect");
            var subject = document.getElementById("subject");
            subject.value = subjectSelect.value + ' | ' + fullName.value;

            form.classList.add('was-validated')
        }, false)
    })
})()
