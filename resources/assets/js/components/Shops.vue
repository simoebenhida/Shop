<template>
    <div class="row">
        <div class="block" style="margin-bottom: 20px;margin-left: 20px;">
            <button @click="getLocation()" class="btn btn-default">Sort By Distance</button>
        </div>
        <div v-for="(shop,index) in shops" class="col-md-3">
            <div class="panel panel-default">
                <div class="text-center panel-heading">
                     <h2>{{ shop.name }}</h2>
                     <img :src="shop.picture" :alt="shop.name">
                </div>
                 <div class="panel-body flex">
                     <a href="#" class="btn btn-danger pull-left" :class="{'disabled' : !shop.like}">Dislike</a>
                     <button @click="likeShop(shop._id,index)" class="btn btn-success pull-right" :class="{'disabled' : shop.like}">Like</button>
                 </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                location : '',
                shops : []
            }
        },
        mounted() {
            this.getShops();
        },
        methods : {
            getLocation() {
                let self = this
                axios.post('https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCHkSW1vr4MJML1SjrmfPujGXyZxcooQjM')
                    .then(function (response) {
                        self.location = response.data.location
                        self.getShops(true)
                    })
                    .catch(function (error) {
                    });
            },
            getShops(sorted = false) {
                let self = this
                this.shops = []
                axios.post('/shops',{
                        location : this.location,
                        sorted : sorted.toString()
                    })
                    .then(function (response) {
                        self.shops = response.data.shops
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            likeShop(id,index) {
                let self = this

                axios.post(`/shops/${id}/like`)
                    .then(function (response) {
                        self.shops[index].like = true
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
