require('./bootstrap');

window.addEventListener("load", function () {
    const deleteForms = document.querySelectorAll('.delete_form');

    deleteForms.forEach(form => {

        form.addEventListener("submit", (event) => {
            if (!confirm("Vuoi cancellare DEFINITIVAMENTE il post?")) {
                event.preventDefault();
            }
        })

    })

});