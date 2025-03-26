@verbatim
<template id="products-template">
    <div>
        <router-link to="/" class="btn btn-primary">Listado de clientes</router-link>
        <h1>Productos</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <th>Seleccionar</th>
                <!-- <th>ID</th> -->
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Stock</th>
            </thead>
            <tbody>
                <tr v-for="product in products" >
                    <td class="borderedc" >
                        <input type="checkbox" :value="product.productId" v-model="product.selected">
                    </td>
                    <!-- <td class="borderedc" >{{ product.productId }}</td> -->
                    <td class="borderedc" >{{ product.productName }}</td>
                    <td class="borderedc" >
                        <input type="number" value="0" min="0" :max="product.productStock" v-model="product.productQuantity" />
                    </td>
                    <td class="borderedc" >{{ product.productStock }} disponibles</td>
                </tr>
            </tbody>
        </table>
        <ul v-if="errorMessages.length > 0" class="alert alert-danger">
            <li v-for="errorMessage in errorMessages" v-html="errorMessage"></li>
        </ul>
        <a href="#" @click="buy($event)" class="btn btn-success">Comprar</a>
    </div>
</template>
@endverbatim