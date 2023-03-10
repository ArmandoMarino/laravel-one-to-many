// Prendo TUTTI i bottoni dal dom
const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    // EVENTO DA INTERCETTARE (e come evento) 
    form.addEventListener('submit', e => {
        e.preventDefault();
        const entity = form.getAttribute('data-entity') || 'item';
        const hasConfirmed = confirm(`Are you sure you want to delete this ${entity}?`);
        if (hasConfirmed) form.submit();
    })
});