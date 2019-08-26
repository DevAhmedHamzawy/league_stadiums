<template>
    <div>
        <div class="add">
            <form @submit.prevent="onSubmit" class="needs-validation icons-form row" novalidate>
                        <div class="form-group  col-12">
                            <i class="fa fa-user main-form-icon"></i>
                            <input type="text" class="form-control" v-model="stadium.name" placeholder="إسم الملعب" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل إسم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12 wow fadeIn">

                            <GmapMap
                            :center="{lat:25.923467, lng:29.293294}"
                            :zoom="7"
                            map-type-id="terrain"
                            style="width: 100%; height: 300px"
                            >
                            <gmap-marker :position="{lat:25.923467, lng:29.293294}" :draggable="true" @drag="updateCoordinates" />
                            </GmapMap>

                        </div>

                        <div class="form-group  col-12 wow fadeIn">
                            <i class="fa fa-phone main-form-icon"></i>
                            <input type="text" class="form-control" v-model="stadium.telephone" placeholder="رقم التليفون أو الموبايل" minlength="10" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم التليفون أو الموبايل
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-map-marker main-form-icon"></i>
                            <input type="text" class="form-control" v-model="stadium.address" placeholder="العنوان" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل العنوان 
                            </div>
                        </div>

                         <div class="form-group  col-12">
                            <i class="fa fa-map-marker main-form-icon"></i>
                            <input type="text" class="form-control" v-model="stadium.city" placeholder="المدينة" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل المدينة 
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="stadium.rent_by_hour" minlength="1" placeholder="السعر للساعه" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="stadium.rent_by_league" minlength="1" placeholder="السعر للدورى" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div> 
                        
                        <div class="form-group  full-width-btn text-center submit-form-group col-12">
                            <button type="submit" class="custom_btn" data-hover="التعديل على الإستاد"><span class="btn_text">التعديل</span></button>
                        </div>


                    </form>

        </div>
    </div>
</template>

<script>

export default  {  
  props: ['stadium','id'],  
  data(){
      return{
          stadium_id: this.stadium.id,
          authUser: '',
          coordinates: null,
          headers: {
            'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
          },

      }
  },
  mounted() {
  },
  methods: {
        onSubmit() {
            this.stadium.user_id = this.id;
            this.stadium.lat = this.coordinates.lat;
            this.stadium.lon = this.coordinates.lng;
            this.stadium.stadium_id = this.stadium_id;
            axios.post('../api/add_or_update_stadium', this.stadium, this.stadium_id)
                .then(({data}) => this.setSuccessMessage())
                .catch(({response}) => this.setErrors(response));

        },

        setErrors(response) {
            this.errors = response.data.errors;
            console.log(this.errors);
        },

        setSuccessMessage() {
            const options = {title: 'تم', size: 'md'}
            this.$dialogs.alert('تم التعديل على الملعب بنجاح', options)
            .then(res => {
                console.log(res) // {ok: true|false|undefined}
            })   
        },

        updateCoordinates(location) {
            this.coordinates = {
                lat: location.latLng.lat(),
                lng: location.latLng.lng(),
            };
            console.log(this.coordinates.lat);
            console.log(this.coordinates.lng);
        },
     
  }
}

</script>

