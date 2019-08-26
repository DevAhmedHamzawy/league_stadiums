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
                        <h3>{{ this.user.user_name }}</h3>
                        <ul class="list-unstyled player-prof-list">
                            <li>
                                <span> <i class="fa fa-map-marker"></i> المدينة :</span>
                                المنصوره
                            </li>
                            <li>
                                <span><i class="fa fa-futbol-o"></i> عدد المباريات : </span>
                                12 مبارة
                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> القدم : </span>
                                اليمني
                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> المركز : </span>
                                مدافع

                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> الفريق الحالي : </span>
                                بلو ستاديم - بلو ستاديم

                            </li>

                            <li>
                                <span><i class="fa fa-futbol-o"></i> الفرق السابقة : </span>
                                بلو ستاديم - بلو ستاديم

                            </li>



                        </ul>

                        <ul class="list-unstyled player-prof-list">

                            <li>
                                <span>التقييم : </span>
                              

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

                


            </div>
        </div>

    </section>
    <!--end profile-pg  -->

    </div>
</template>

<script>

export default {
    props: ['id'],
    data(){
        return{
            user: [],
            authUser: [],
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
            },
        }
    },

    mounted(){
           axios.get('../api/profile/'+this.id)
           .then(response => {
            this.user = response.data.data;
            console.log(response.data);
            })
            .catch(error =>{
                console.log(error);
            })
    },
    methods: {
        sendRequest(){
            axios.get('../request/'+this.user.id+'/'+this.authUser.id)
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
    }
}
</script>

