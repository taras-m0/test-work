/**
 * Created by ttt on 23.06.2017.
 */
function ProductsCtrl ($scope, $http) {

    $scope.products = window.products;

    /**
     * действие добавление нового продукта
     */
    $scope.addnew = function(){
        var name = $scope.newproduct;
        var description = $scope.newdescription;
        var price = $scope.newprice;
        ajax( 'add', { name: name, description: description, price: price }, function (data) {
            $scope.products.push( {
                id: data.id,
                name: name,
                description: description,
                price: price
            });
        });
    };

    /**
     * действие изменения полей ввода
     * @param product
     */
    $scope.change =function(product){
        product.width = parseInt(product.width);
        product.height = parseInt(product.height);
        product.weight = parseInt(product.weight);
        product.save = true;
    };

    /**
     * действие редактирования продукта
     * @param product
     */
    $scope.update = function(product){
        ajax( 'update', {
            id: product.id,
            name: product.name,
            weight: product.weight,
            height: product.height,
            width: product.width
        },
            function (data) {
        });
    };

    $scope.delete = function (product) {
        ajax( 'delete', {
            id: product.id
        },
            function (data) {
                for(var indx in $scope.products ){
                    if($scope.products[indx] === product){
                        $scope.products.splice( indx, 1);
                        $scope.$apply();
                        break;
                    }
                }
            }
        )
    };

    /**
     * общая функция отправки подзапросов
     * @param action // действие
     * @param data // параметры
     * @param callback // функция обработки результата
     */
    function ajax(action, data, callback) {

        document.getElementById('ajax-load').style.display = 'block';
        $http.post('', data, { params: { action: action }}).success(function (data, status) {
            document.getElementById('ajax-load').style.display = 'none';
            if(!data.error){
                callback(data);
            }else{
                /** @todo обработка ошибок */
            }
        });
    }

    /**
     * установки сортировки
     * @type {string}
     */
    $scope.orderParam = 'id';
    $scope.setOrder = function (paramName) {
        $scope.orderParam = paramName;
    }
}