@verbatim
<template id="clients-template">
    <div>
        <h1>Clientes</h1>
        <table>
            <tbody>
                <tr v-for="client in clients" >
                    <td class="borderedc" >
                        <router-link :to="'/products/' + client.id">{{ client.name }}</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
@endverbatim