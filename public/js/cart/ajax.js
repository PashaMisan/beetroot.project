function tableUpdate(product_id, route, val=false) {

    let value = [product_id, val];

    getFetchPromise(csrf, route, value)
        .then((data) => {

            if (typeof data.html !== 'undefined') {
                document.getElementById('table-cart').innerHTML = data.html
            }

            if (typeof data.fullPrice !== 'undefined') {
                document.getElementById('totalPrice' + product_id).innerHTML = data.fullPrice
            }

            //console.log(data)
        })
}
