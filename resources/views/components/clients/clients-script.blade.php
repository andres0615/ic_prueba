<script>
    const ClientsComponent = { 
        template: '#clients-template',
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
                clients: {}
            }
        },
        mounted(){
            console.log(apiUrl);
            this.getClients();
        }
    };
</script>