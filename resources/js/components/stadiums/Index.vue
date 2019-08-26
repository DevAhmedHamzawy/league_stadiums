<template>
    <div>       
         <!--start availabe-staduim 
             ================-->
    <section class="availabe-staduim studuims-pg marg-sec wow fadeIn">
        <div class="container">
            <div class="row">


                <!-- start owl-item -->
                <div class="item col-lg-4 col-md-6 wow fadeIn  text-center load-div" v-for="stadium in stadiums" :key="stadium.id">
                    <div class="studim-div">
                        <div class="studim-img static-st-img full-width-img" v-for="image in stadium.images" :key="image.id">
                            <img :src="image.file" alt="slider" />
                        </div>

                        <h3>{{ stadium.name }}</h3>

                        <p class="dark-prg">
                            سعر اللعب بالساعة : {{ stadium.rent_by_hour }}
                        </p>
                        <div class="text-center">
                            <a href="/" class="custom_btn" data-hover="تشوف الملعب"><span class="btn_text">تفاصيل الملعب</span></a>
                            <a :href="'edit_stadium/'+stadium.id" class="custom_btn" data-hover="تعديل البيانات"><span class="btn_text">تعديل</span></a>
                            <a @click="onDelete(stadium.id)" class="custom_btn" data-hover="حذف الإستاد"><span class="btn_text">حذف</span></a>

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
          headers: {
            'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
          },
          stadiums: {
              user_id: '',
              name: '',
              telephone: '',
              rent_by_hour: '',
              rent_by_league: '',
              address: '',
              city: '',
              lat: '',
              lon: '',
              images: {
                  name: '',
                  text: '',
                  file: ''
              }
          },
          
      }
  },
  mounted(){
     this.fetchStadiums();
  },
  methods: {
      onDelete(id){
          
            axios.post('api/delete_stadiumimages/'+id)
                .then(response => {})
                .catch(({response}) => this.setErrors(response));  
                
            axios.post('api/delete_stadium/'+id)
                .then(response => { this.setSuccessMessage() })
                .catch(({response}) => this.setErrors(response));  

      },
      setSuccessMessage() {
            const options = {title: 'تم', size: 'md'}
            this.$dialogs.alert('تم حذف  الملعب جديد بنجاح', options)
            .then(res => {
                this.fetchStadiums();
            })   
        },
      fetchStadiums(){

            axios.get(`api/fetch_owner_stadiums/${this.id}`)
           .then(response => {
            this.stadiums = response.data.data;
            console.log(response.data);
            })
            .catch(error =>{
                this.errors.push(error);
                console.log(error);
            }) 

            
      }
  },
  
      
  
}

</script>

