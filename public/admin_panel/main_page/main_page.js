document.addEventListener('DOMContentLoaded', function() {
    setInterval(() => getFetchPromise(csrf, route, dataTime)
        .then((data) => {

            document.getElementById('waiters_status_table').innerHTML = data.waiters_status_table

            if (typeof data.tables_status !== 'undefined') {
                document.getElementById('tables_status').innerHTML = data.tables_status
            }

            if (typeof data.my_tables !== 'undefined') {
                document.getElementById('my_tables').innerHTML = data.my_tables
            }

            dataTime = data.last_change_of_orders
            //console.log(data)
        }), 2000);
}, false);
