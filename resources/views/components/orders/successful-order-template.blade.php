@verbatim
<template id="successful-order">
    <div>
        <router-link to="/">Listado de clientes</router-link>
        <h1>Orden generada con exito</h1>
        <table>
            <tbody>
                <tr>
                    <th>Order ID:</th>
                    <td>{{ order.orderId }}</td>
                    <th>Cliente:</th>
                    <td>{{ order.clientName }}</td>
                </tr>
            </tbody>
        </table>
        <table>
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