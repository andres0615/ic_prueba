<script>
    const SuccessfulOrderComponent = { 
        template: '#successful-order',
        methods: {
            getOrder(){
                let self = this;

                let url = apiUrl + '/order/' + this.orderId;

                axios.get(url).then(function(response){
                    console.log(response.data);

                    let order = response.data.order;
                    let orderDetails = response.data.orderDetails;

                    self.order = order;
                    self.orderDetails = orderDetails;
                });
            }
        },
        data(){
            return {
                orderId: null,
                clients: {},
                order: {},
                orderDetails: {}
            }
        },
        mounted(){
            this.orderId = this.$route.params.order_id;
            this.getOrder();
        }
    };
</script>