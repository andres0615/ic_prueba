<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InnCloud Prueba tecnica</title>
    <script src="{{ asset('js/vue/vue2.js') }}"></script>
    <script src="{{ asset('js/vue/vue-router.js') }}"></script>
    <script src="{{ asset('js/vue/axios.min.js') }}"></script>
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

    <!-- Scripts de los componentes -->
    @include('components/clients/clients-script')

    <script>

        // Definir las rutas
        const routes = [
            { path: '/', component: ClientsComponent },
        ];

        const router = new VueRouter({
            routes
        });

        // Crear la aplicación
        const app = new Vue({
            router
        });
        app.$mount('#app');
    </script>
</body>
</html>