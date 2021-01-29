/* Функция принимает позицию, секцию и значение шага продукта. Контроллер для обработки - Admin_panel\ProductsController*/
function changePosition(position, section_id, move) {

    let value = [position, section_id, move];

    getFetchPromise(csrf, change_position_route, value)
        .then((data) => {
            document.getElementById('products-table').innerHTML = data.html
            /*console.log(data)*/
        })
}
