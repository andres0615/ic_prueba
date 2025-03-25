<script>
    const ProductsComponent = { 
        template: '#products-template',
        methods: {
            getProducts(){
                let self = this;

                let url = apiUrl + '/product/' + this.clientId;

                axios.get(url).then(function(response){
                    console.log(response.data);

                    let products = response.data.products;
                    self.products = products.map((product) => {
                        product.productQuantity = 0;
                        product.selected = false;
                        return product;
                    });
                });
            },
            buy(event){
                event.preventDefault();
                console.log('comprar');
                console.log(this.products);
            }
        },
        data(){
            return {
                products: {},
                clientId: null
            }
        },
        mounted(){
            // console.log(apiUrl);
            this.clientId = this.$route.params.client_id;
            // console.log(this.clientId);
            this.getProducts();
        }
    };
</script>