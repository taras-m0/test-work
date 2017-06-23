<?php
  /** @var array $products */

  ?><!DOCTYPE html>
<html lang="ru"  ng-app>
<head>
    <meta charset="UTF-8">
    <title>Тестовое задание</title>

    <!-- script type="text/javascript" href="http://opensource.keycdn.com/angularjs/1.6.4/angular.min.js"></script -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script> <!-- 1.0.8 -->

    <script type="text/javascript">
        window.products = <?php print json_encode($products); ?>;
    </script>
    <script type="text/javascript" src="product.ctrl.js"></script>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <style>
        #ajax-load {
            background-image: url("http://i.imgur.com/VTFXRtv.gif");
            background-position: center center;
            background-repeat: no-repeat;
            background-size: contain;
            background-color: rgba(255, 255, 255, .5);
            background-size: auto ;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
        }

        th[ng-click] { cursor: pointer; }
        td input{
            border: none;
            padding: .5em 1em;
            background-color: transparent;
            margin: 1px;
        }
        td input:hover, td input:active, td label input {
            border: 1px solid #555;
            background-color: white;
            margin: 0;
        }
    </style>
</head>
<body>
    <div id="ajax-load"></div>

    <h4>Тестовое задание</h4>
    <em>Для редактирования свойства, наведите курсор</em><br>
    <em>кликните по загловку таблицы для сортировки по этому полю</em>
    <table class="table table-bordered table-hover" ng-controller="ProductsCtrl">
        <thead>
            <tr>
                <th>ID</th>
                <th ng-click="setOrder('name')">наименование</th>
                <th>описание</th>
                <th ng-click="setOrder('price')">цена р.</th>
                <th>вес г.</th>
                <th>ширина мм.</th>
                <th>высота мм.</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <tr ng-repeat="product in products | orderBy:orderParam">
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td><input type="text" ng-model="product.weight" ng-change="change(product)"></td>
                <td><input type="text" ng-model="product.width" ng-change="change(product)"></td>
                <td><input type="text" ng-model="product.height" ng-change="change(product)"></td>
                <td><button ng-hide="save" ng-click="update(product)">
                        <span class="glyphicon glyphicon-pencil"></span></button>
                    <button ng-click="delete(product)">
                        <span class="glyphicon glyphicon-remove"></span></button></td>
            </tr>
            <tr>
                <td colspan="8">
                    <label>Наименование: <input type="text" ng-model="newproduct"></label>
                    <label>Описание: <input type="text" ng-model="newdescription"></label>
                    <label>Цена р.: <input type="text" ng-model="newprice"></label>
                    <button ng-click="addnew()">Добавить</button>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>