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
                        self.$set(product, 'productQuantity', 0);
                        self.$set(product, 'selected', false);
                        // product.productQuantity = 0;
                        // product.selected = false;
                        return product;
                    });
                });
            },
            buy(event){
                event.preventDefault();
                // console.log('comprar');
                // console.log(this.products);

                let self = this;

                let url = apiUrl + '/order';

                let requestData = {
                    clientId: this.clientId,
                    products: this.products
                };

                axios.post(url,requestData).then(function(response){
                    let success = response.data.success;
                    
                    if(success){

                    } else {
                        self.errorMessages = response.data.errorMessages;
                    }
                });
            }
        },
        data(){
            return {
                products: {},
                clientId: null,
                errorMessages: {}
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