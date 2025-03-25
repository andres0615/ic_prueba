@verbatim
<template id="products-template">
    <div>
        <router-link to="/">Listado de clientes</router-link>
        <h1>Productos</h1>
        <table>
            <thead>
                <th>Seleccionar</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Stock</th>
            </thead>
            <tbody>
                <tr v-for="product in products" >
                    <td class="borderedc" >
                        <input type="checkbox" :value="product.productId" v-model="product.selected">
                    </td>
                    <td class="borderedc" >{{ product.productId }}</td>
                    <td class="borderedc" >{{ product.productName }}</td>
                    <td class="borderedc" >
                        <input type="number" value="0" min="0" :max="product.productStock" v-model="product.productQuantity" />
                    </td>
                    <td class="borderedc" >{{ product.productStock }} disponibles</td>
                </tr>
            </tbody>
        </table>
        <br>
        <ul>
            <li v-for="errorMessage in errorMessages">{{ errorMessage }}</li>
        </ul>
        <br>
        <a href="#" @click="buy($event)">Comprar</a>
    </div>
</template>
@endverbatim