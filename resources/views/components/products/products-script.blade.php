<script>
    const ProductsComponent = { 
        template: '#products-template',
        methods: {
            getClients(){
                let self = this;

                let url = apiUrl + '/client';

                axios.get(url).then(function(response){
                    console.log(response.data);

                    let clients = response.data.clients;
                    self.clients = clients;
                });
            }
        },
        data(){
            return {
                products: {},
                clientId: null
            }
        },
        mounted(){
            console.log(apiUrl);
            // this.getClients();
            this.clientId = this.$route.params.client_id;
            console.log(this.clientId);
        }
    };
</script>