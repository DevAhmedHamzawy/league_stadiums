<template>
    <div>
         <!--start profile-pg
             ================-->
    <section class="profile-pg marg-sec">
        <div class="container">
            <div class="row">
                <!--start player-carousel-->
                <div class="col-lg-4 col-md-6 wow fadeIn">
                    <!--start carousel-->
                    <div class="single-pg-carousel profile-carousel studim-pictures wow fadeIn">
                        <div id="owl-demo" class="owl-carousel owl-theme second-owl">

                            <!-- start owl-item -->
                            <div class="item">
                                <a href="images/players/2.png" class="html5lightbox">
                                    <div class="why-img full-width-img">
                                        <img src="images/players/2.png" alt="slider" class="converted-img" />
                                    </div>
                                </a>
                            </div>
                            <!-- end owl-item -->

                            <!-- start owl-item -->
                            <div class="item">
                                <a href="images/players/6.png" class="html5lightbox">
                                    <div class="why-img full-width-img">
                                        <img src="images/players/6.png" alt="slider" class="converted-img" />
                                    </div>
                                </a>
                            </div>
                            <!-- end owl-item -->

                        </div>
                    </div>
                    <!--end carousel-->
                </div>
                <!--end player-carousel-->


                <!--start player-prof-details-->
                <div class="col-lg-4 col-md-6 player-prof-details wow fadeIn">
                    <div class="prof-list">
                        <h3>{{ stadium.name }}</h3>
                        <ul class="list-unstyled player-prof-list">
                            <li>
                                <span> <i class="fa fa-map-marker"></i> سعر الإيجار بالساعة :</span>
                                {{ stadium.rent_by_hour }}
                            </li>
                            <li>
                                <span><i class="fa fa-futbol-o"></i> سعر الإيجار بالدورى  : </span>
                                {{ stadium.rent_by_league }}
                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> العنوان : </span>
                                {{ stadium.address }}
                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> المدينة : </span>
                                {{ stadium.city }}

                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> للتواصل عن طريق تليفون رقم  : </span>
                                {{ stadium.telephone }}

                            </li>


                        </ul>

                        <ul class="list-unstyled player-prof-list">

                            <li>
                                <span>التقييم : </span>
                               
                                <star-rating v-model="rating"></star-rating>
                                <div>Currently Selected: {{rating}}</div>
                                <div><a href="#" @click.prevent="rating = 0">Reset Rating</a></div> 

                            </li>

                        </ul>
                    </div>

                    <div class="player-team-parteners">
                        <h4><i class="fa fa-chevron-circle-right"></i> اعضاء الفريق</h4>
                        <div class="inner-player-team-parteners">
                            <a href="player.html">
                                <div class="pl-partener full-width-img"><img src="images/players/1.png" class="converted-img" alt="player" /></div>
                            </a>
                            <a href="player.html">
                                <div class="pl-partener full-width-img"><img src="images/players/2.png" class="converted-img" alt="player" /></div>
                            </a>
                            <a href="player.html">
                                <div class="pl-partener full-width-img"><img src="images/players/3.png" class="converted-img" alt="player" /></div>
                            </a>
                            <a href="player.html">
                                <div class="pl-partener full-width-img"><img src="images/players/4.png" class="converted-img" alt="player" /></div>
                            </a>
                            <a href="player.html">
                                <div class="pl-partener full-width-img"><img src="images/players/5.png" class="converted-img" alt="player" /></div>
                            </a>
                        </div>
                    </div>


                </div>
                <!--end  player-prof-details-->

                <!--start player-map-->
                <div class="col-lg-4 col-md-12 wow fadeIn">
                    <!--start map-->
                    <GmapMap
                        :center="{lat:parseInt(stadium.lat), lng:parseInt(stadium.lon)}"
                        :zoom="7"
                        map-type-id="terrain"
                        style="width: 100%; height: 300px"
                        >
                        <gmap-marker :position="{lat:parseInt(stadium.lat), lng:parseInt(stadium.lon)}" />
                    </GmapMap>                   
                </div>


                <!--end player-map-->


            </div>
        </div>

    </section>
    <!--end profile-pg  -->

    </div>
</template>

<script>
import {StarRating} from 'vue-rate-it';
export default {
    props: ['id','user_id'],
    data(){
        return{
            user: [],
            authUser: [],
            stadium: [],
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
            },
            rating: 0,
        }
    },

    mounted(){
           axios.get('../api/fetch_stadium/'+this.id)
           .then(response => {
            this.stadium = response.data.data;
            console.log(response.data);
            })
            .catch(error =>{
                console.log(error);
            })
    },
    methods: {
        join(){
            axios.post('../api/join_stadium/'+this.id+'/'+this.user_id)
           .then(response => {
            this.user = response.data;
            console.log(response.data);
            })
            .catch(error =>{
                console.log(error);
            })
        },

        setRating: (rating) => {
            this.rating= rating;
            axios.post('/rating/'+this.authUser.id , this.rating)
           .then(response => {
            this.rating = response.data;
            console.log(response.data);
            })
            .catch(error =>{
                console.log(error);
            })
        }
    },
    components: {
        StarRating
    }
}
</script>

