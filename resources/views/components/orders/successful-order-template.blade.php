@verbatim
<template id="successful-order">
    <div>
        <router-link to="/">Listado de clientes</router-link>
        <h1>Orden generada con exito</h1>
        <table>
            <tbody>
                <tr>
                    <th>Order ID:</th>
                    <td>12345</td>
                    <th>Cliente:</th>
                    <td>Carlos Alfonso</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th colspan="3" >Detalle</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>Product</td>
                    <td>Cantidad</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
@endverbatim