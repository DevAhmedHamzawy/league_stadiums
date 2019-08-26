<template>
    <div>       
         <!--start availabe-staduim 
             ================-->
    <section class="availabe-staduim studuims-pg marg-sec wow fadeIn">
        <div class="container">
            <div class="row">


                <!-- start owl-item -->
                <div class="item col-lg-4 col-md-6 wow fadeIn  text-center" v-for="stadium in stadiums" :key="stadium.id">
                    <div class="studim-div" v-if="stadium !== null">
                        <div class="studim-img static-st-img full-width-img">
                            <img :src="'public/images/stadiums/'+stadium.image" alt="slider" />
                        </div>
                        

                        <h3>{{ stadium.name }}</h3>

                        <p class="dark-prg">
                            سعر اللعب بالساعة : {{ stadium.rent_by_hour }}
                        </p>
                        <div class="text-center">
                            <a :href="'stadium/'+stadium.id" class="custom_btn" data-hover="تشوف الملعب"><span class="btn_text">تفاصيل الملعب</span></a>
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
          stadiums: [],
      }
  },
  mounted(){
     this.fetchstadiums();
  },
  methods: {


      fetchstadiums(){
           
            
           axios.get(`api/fetch_stadiums`)
           .then(response => {
            this.stadiums = response.data.data;
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
