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

                       
                        <div id="my-strictly-unique-vue-upload-multiple-image" class="form-group col-12" style="display: flex; justify-content: center;">

                            <vue-upload-multiple-image
                            @upload-success="uploadImageSuccess"
                            @before-remove="beforeRemove"
                            @edit-image="editImage"
                            @data-change="dataChange"
                            :data-images="images"
                            ></vue-upload-multiple-image>

                        </div>

                        <div class="form-group  full-width-btn text-center submit-form-group col-12">
                            <button type="submit" class="custom_btn" data-hover="إضافة إستاد جديد"><span class="btn_text">تسجيل </span></button>
                        </div>


                    </form>

        </div>
    </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'

export default  {
  props: ["id"],  
  data(){
      return{
          stadium: {
              user_id: this.id,
              name: '',
              telephone: '',
              rent_by_hour: '',
              rent_by_league: '',
              address: '',
              city: '',
              lat: '',
              lon: '',
          },
          main: 1,
          authUser: [],
          coordinates: null,
          images: [],
          stadiumImages: [],
          headers: {
            'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
          },

      }
  },
  components: {
    VueUploadMultipleImage
  },
  mounted() {
  },
  methods: {
        onSubmit() {
            this.stadium.user_id = this.id;
            this.stadium.lat = this.coordinates.lat;
            this.stadium.lon = this.coordinates.lng;

            axios.post('api/add_or_update_stadium', this.stadium)
                .then(({data}) => this.upload(data))
                .catch(({response}) => this.setErrors(response));

        },

        setErrors(response) {
            this.errors = response.data.errors;
            //console.log(this.errors);
        },

        setSuccessMessage() {
            const options = {title: 'تم', size: 'md'}
            this.$dialogs.alert('تم إضافة ملعب جديد بنجاح', options)
            .then(res => {
                if(res) { window.location.href = '/league_stadiums/stadiums'; }
                //console.log(res) // {ok: true|false|undefined}
            })   
        },

        upload(data) {
            this.stadiumImages.map(function(entry) { entry.stadium_id = data.data.id; return entry});
             // Upload image api
            axios.post('api/add_or_update_stadiumimages', this.stadiumImages)
                .then(response => { this.setSuccessMessage() })
                .catch(({response}) => this.setErrors(response));     
        },

        updateCoordinates(location) {
            this.coordinates = {
                lat: location.latLng.lat(),
                lng: location.latLng.lng(),
            };
            //console.log(this.coordinates.lat);
            //console.log(this.coordinates.lng);
        },

        uploadImageSuccess(formData, index, fileList) {
         //console.log('imagename',  fileList[index].name)
         this.stadiumImages.push({ text: fileList[index].name, main: this.main ,file: fileList[index].path  });
         this.main = 0;
         //console.log('sis', this.stadiumImages);

     
    },
    beforeRemove (index, done, fileList) {
      //console.log('index', index, fileList)
      var r = confirm("remove image")
      if (r == true) {
        done()
      } else {
      }
    },
    editImage (formData, index, fileList) {
      //console.log('edit data', formData, index, fileList)
    },
    dataChange (data) {
      //console.log(data)
    }
  }
}

</script>

<style scoped>
#my-strictly-unique-vue-upload-multiple-image {
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>