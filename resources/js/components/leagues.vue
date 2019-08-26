<template>
    <div>       
         <!--start availabe-staduim 
             ================-->
    <section class="availabe-staduim studuims-pg marg-sec wow fadeIn">
        <div class="container">
            <div class="row">


                <!-- start owl-item -->
                <div class="item col-lg-4 col-md-6 wow fadeIn  text-center" v-for="league in leagues" :key="league.id">
                    <div class="studim-div" v-if="league !== null">
                        <div class="studim-img static-st-img full-width-img">
                            <img :src="'public/images/leagues/'+league.image" alt="slider" />
                        </div>
                        

                        <h3>{{ league.name }}</h3>

                        <p class="dark-prg">
                            سعر اللعب بالساعة : {{ league.rent_by_hour }}
                        </p>
                        <div class="text-center">
                            <a :href="'league/'+league.id" class="custom_btn" data-hover="تشوف الدورى"><span class="btn_text">تفاصيل الدورى</span></a>
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
  props: ["id"],  
  data(){
      return{
          leagues: {
              name: '',
              teams_no: 0,
              groups_no: 0,
              description: '',
              prize: '',
              image: '',
              selection: 0,
              teams_asc: 0,
              regulation: 0,
          },
          
      }
  },
  mounted(){
     this.fetchLeagues();
  },
  methods: {


      fetchLeagues(){
           
            
           axios.get(`api/fetch_leagues`)
           .then(response => {
            this.leagues = response.data.data;
            console.log(response.data);
            })
            .catch(error =>{
                this.errors.push(error);
                console.log(error);
            }) 

            
           
      },
  }
      
  
}

</script>
