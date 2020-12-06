function deleteAction (endpoint, token) {
    event.preventDefault();

    fetch(endpoint, {
        method: 'delete',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({_token: token})
    }).then(r => location.reload());
}
