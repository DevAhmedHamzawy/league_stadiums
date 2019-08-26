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
                                <a :href="'../public/images/leagues/'+league.image" class="html5lightbox">
                                    <div class="why-img full-width-img" :style="{ 'background-image' : 'url(' + path + ')' }" >
                                        <img :src="'../public/images/leagues/'+league.image" alt="slider" class="converted-img" />
                                    </div>
                                </a>
                            </div>
                            <!-- end owl-item -->

                            <!-- start owl-item -->
                            <div class="item">
                                <a :href="'../public/images/leagues/'+league.image" class="html5lightbox">
                                    <div class="why-img full-width-img" :style="{ 'background-image' : 'url(' + path + ')' }" >
                                        <img :src="'../public/images/leagues/'+league.image" alt="slider" class="converted-img" />
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
                        <h3>{{ league.name }}</h3>
                        <ul class="list-unstyled player-prof-list">
                            <li>
                                <span> <i class="fa fa-map-marker"></i> تنظيم الدورى :</span>
                                {{ league.regulation == 'groups' ? 'تنظيم المجموعات' : 'تنظيم الأدوار' }}
                            </li>
                            <li>
                                <span><i class="fa fa-futbol-o"></i> عدد الفرق : </span>
                                {{ league.teams_no }} فريق
                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> الوصف : </span>
                                {{ league.description }}
                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> الجائزة : </span>
                                {{ league.prize }}

                            </li>

                        </ul>

                        <ul class="list-unstyled player-prof-list">

                            <li>
                                <span>التقييم : </span>
                               
                                <star-rating @rating-selected="setRating"></star-rating>
                                <div>Currently Selected: {{rating}}</div>
                                <div><a href="#" @click.prevent="rating = 0">Reset Rating</a></div> 

                            </li>

                        </ul>
                    </div>
                </div>
                <!--end  player-prof-details-->

                <!--start player-map-->
                <div class="col-lg-4 col-md-12 wow fadeIn">
                    <div class="two-btns text-center">
                        <a class="no-bord-rad big-btn dark_btn custom_btn" @click="join" data-hover="الإنضمام للدورى"><span class="btn_text">الإنضمام للدورى</span></a>
                        <a href="#" class="follow-btn no-bord-rad  big-btn custom_btn" data-hover="تقييم الدورى"><span class="btn_text">تقييم الدورى</span></a>
                    </div>
                    <!--start map-->
                    <GmapMap
                        :center="{lat:25.923467, lng:29.293294}"
                        :zoom="7"
                        map-type-id="terrain"
                        style="width: 100%; height: 300px"
                        >
                        <gmap-marker :position="{lat:25.923467, lng:29.293294}" />
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
            league: [],
            authUser: [],
            path: '',
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
            },
            rating: 0,
        }
    },

    mounted(){
           axios.get('../api/fetch_league/'+this.id)
           .then(response => {
            this.league = response.data.data;
            this.path = '../public/images/leagues/'+this.league.image;
            console.log(response.data);
            })
            .catch(error =>{
                console.log(error);
            })
    },
    methods: {
        join(){
            axios.post('../api/join_league/'+this.id+'/'+this.user_id)
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

