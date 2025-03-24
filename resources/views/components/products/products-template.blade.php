@verbatim
<template id="products-template">
    <div>
        <h1>Products</h1>
        <table>
            <tbody>
                <tr v-for="product in products" >
                    <td class="borderedc" >{{ product.name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
@endverbatim