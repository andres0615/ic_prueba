<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InnCloud Prueba tecnica</title>
    <script src="{{ asset('js/vue/vue2.js') }}"></script>
    <script src="{{ asset('js/vue/vue-router.js') }}"></script>
    <script src="{{ asset('js/vue/axios.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div id="app">
        <!-- <nav>
            <router-link to="/">Clients</router-link>
        </nav> -->
        <router-view></router-view>
    </div>

    <!-- Templates de los componentes -->
    @include('components/clients/clients-template')
    @include('components/products/products-template')
    @include('components/orders/successful-order-template')


    <!-- Scripts de los componentes -->
    @include('components/clients/clients-script')
    @include('components/products/products-script')
    @include('components/orders/successful-order-script')

    <script>

        // se usa blade para capturar la url base de la aplicacion
        const baseUrl = "{{ config('app.url') }}";
        const apiUrl = baseUrl + '/api';

        // Definir las rutas
        const routes = [
            { path: '/', component: ClientsComponent },
            { path: '/products/:client_id', component: ProductsComponent },
            { path: '/successful-order/:order_id', component: SuccessfulOrderComponent },
        ];

        const router = new VueRouter({
            routes
        });

        // Crear la aplicación
        const app = new Vue({
            mode: 'history',
            router
        });
        app.$mount('#app');
    </script>
</body>
</html>