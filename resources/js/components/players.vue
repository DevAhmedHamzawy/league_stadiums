<template>
    <div>       
         <!--start availabe-staduim 
             ================-->
    <section class="availabe-staduim studuims-pg marg-sec wow fadeIn">
        <div class="container">
            <div class="row">


                <!-- start owl-item -->
                <div class="item col-lg-4 col-md-6 wow fadeIn  text-center load-div" v-for="player in players" :key="player.id">
                    <div class="studim-div">
                        <div class="studim-img static-st-img full-width-img" v-for="image in player.images" :key="image.id">
                            <img :src="image.file" alt="slider" />
                        </div>

                        <h3>{{ player.user_name }}</h3>

                        
                        <div class="text-center">
                            <a href="/" class="custom_btn" data-hover="تشوف اللاعب"><span class="btn_text">تفاصيل اللاعب</span></a>
                            <br/>
                            <vue-goodshare-facebook page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-facebook>
                            <vue-goodshare-twitter page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-twitter>
                            <vue-goodshare-telegram page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-telegram>
                            <vue-goodshare-viber page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-viber>
                            <vue-goodshare-whatsapp page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-whatsapp>
                            <vue-goodshare-line page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-line>
                            <a @click="invite(player.id)"><i class="fa fa-envelope-square"></i></a>
                        </div>
                    </div>

                </div>
                <!-- end owl-item -->

                <div class="text-center col-12">
                    <div class="dark_btn big-btn custom_btn no-bord-rad" id="loadMore" data-hover="إعرض المزيد"><span class="btn_text"><i class="fa fa-plus"></i>إعرض المزيد</span></div>
                </div>

            </div>
        </div>
    </section>
    <!--end availabe-staduim  -->

    </div>
</template>

<script>
export default {
  props: ['user_id'],  
  data(){
      return{
          players: {
              name: '',

          },
          
      }
  },
  mounted(){
     this.fetchPlayers();

     this.fetchUser();

  },
  methods: {

       fetchUser(){
            axios.get(`api/profile/${this.user_id}`)
           .then(response => {
            this.user = response.data.data;
            console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                console.log(error);
            })       
      },
      fetchPlayers(){
            axios.get(`api/fetch_players`)
           .then(response => {
            this.players = response.data.data;
            console.log(response.data);
            })
            .catch(error =>{
                this.errors.push(error);
                console.log(error);
            })       
      },


      invite(id){
            axios.post(`api/invite/${id}/${this.user.ref}`)
           .then(response => {
            this.player = response.data.data;
            console.log(response.data);
            })
            .catch(error =>{
                this.errors.push(error);
                console.log(error);
            })       
      },
  },  
}

</script>

