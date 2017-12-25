<template>
    <div class="row">
        <div v-for="(shop,index) in shops" class="col-md-3">
            <div class="panel panel-default">
                <div class="text-center panel-heading">
                    <h2>{{ shop.name }}</h2>
                    <img :src="shop.picture" :alt="shop.name">
                </div>
                <div class="panel-body flex">
                    <button @click="removeShop(shop._id,index)" class="btn btn-danger pull-left btn-block">Remove</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                shops : []
            }
        },
        mounted() {
            this.getPreferred()
        },
        methods : {
            getPreferred(sorted = false) {
                let self = this
                this.shops = []
                axios.post('/preferred-shops',{
                })
                    .then(function (response) {
                        self.shops = response.data.shops
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            removeShop(id,index) {
                let self = this
                axios.post(`/shops/${id}/destroy`,{
                })
                    .then(function (response) {
                        self.shops.splice(index, 1);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
