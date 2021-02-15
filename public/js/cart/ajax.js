function tableUpdate(product_id, route, val=false) {

    let value = [product_id, val];

    getFetchPromise(csrf, route, value)
        .then((data) => {

            document.getElementById('warning' + product_id).innerHTML="";

            if (data.status === 200) {

                if (typeof data.html !== 'undefined') {
                    document.getElementById('table-cart').innerHTML = data.html
                    document.getElementById('totalPrice').innerHTML = data.totalPrice
                }

                if (typeof data.fullPrice !== 'undefined') {
                    document.getElementById('totalPrice').innerHTML = data.totalPrice
                    document.getElementById('fullPrice' + product_id).innerHTML = data.fullPrice
                }

            }

            if (data.status === 400) {
                document.getElementById('warning' + product_id).innerHTML = 'Incorrect value'
            }

            //console.log(data)
        })
}
