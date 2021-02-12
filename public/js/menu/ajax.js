function callWaiter() {
    getFetchPromise(csrf, route)
        .then((data) => {
            document.getElementById('messageDiv').classList.remove("d-none");
            document.getElementById('message').innerHTML = data.message;
        })
}
