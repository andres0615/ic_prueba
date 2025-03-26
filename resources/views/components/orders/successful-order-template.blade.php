@verbatim
<template id="successful-order">
    <div>
        <router-link to="/" class="btn btn-primary">Listado de clientes</router-link>
        <br>
        <br>
        <div class="alert alert-success">
            La orden ha sido generada con exito.
        </div>
        <h1>Orden</h1>
        <table class="table table-bordered" >
            <tbody>
                <tr>
                    <th>Order ID:</th>
                    <td>{{ order.orderId }}</td>
                    <th>Cliente:</th>
                    <td>{{ order.clientName }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered" >
            <thead>
                <tr>
                    <th colspan="3" >Detalle</th>
                </tr>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="detail in orderDetails" >
                    <!-- <td>{{ detail.productId }}</td> -->
                    <td>{{ detail.productName }}</td>
                    <td>{{ detail.productQuantity }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
@endverbatim