<template>
    <div>
        <!--start register-pg-->
        <section class="login-pg marg-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 wow fadeIn">
                        <h3 class="login-title"><i class="fa fa-user"></i>   تعديل البيانات   </h3>
                        <form @submit.prevent="onSubmit" class="needs-validation icons-form row" novalidate>
                            <div class="form-group  col-12">
                                <i class="fa fa-user main-form-icon"></i>
                                <input type="text" class="form-control" v-model="user.user_name" placeholder="اسمك الكريم" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل إسم صحيح
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <i class="fa fa-user main-form-icon"></i>
                                <input type="text" class="form-control" v-model="user.first_name" placeholder="الإسم الأول" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل إسم صحيح
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <i class="fa fa-user main-form-icon"></i>
                                <input type="text" class="form-control" v-model="user.last_name" placeholder="الإسم الأخير" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل إسم صحيح
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <i class="fa fa-cc-visa main-form-icon"></i>
                                <input type="number" class="form-control" v-model="user.age" minlength="1" placeholder="العمر" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل رقم صحيح
                                </div>
                            </div>

                            <div class="form-group  col-12 wow fadeIn">
                                <i class="fa fa-calendar main-form-icon"></i>
                                <input type="date" class="form-control" v-model="user.birthdate" id="date" minlength="10" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل تاريخ الميلاد 
                                </div>
                            </div>

                            <div class="form-group  col-12 wow fadeIn">
                                <i class="fa fa-phone main-form-icon"></i>
                                <input type="text" class="form-control" v-model="user.mobile" id="phone" minlength="10" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل رقم الموبايل
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <i class="fa fa-envelope main-form-icon"></i>
                                <input type="email" class="form-control" v-model="user.email" placeholder="البريد الالكتروني" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل بريد إلكتروني صحيح
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <select class="form-control" name="role" v-model="user.role">
                                        <option selected disabled>هادخل الموقع بصفتى ....</option>
                                        <option value="1">صاحب ملعب</option>
                                        <option value="2">لاعب</option>
                                        <option value="3">معلق</option>

                                </select>
                                <div class="invalid-feedback">
                                    ده مهم جداً علشان نختار لك الخطوات الجاية فالموقع 
                                </div>
                            </div>

                            <div v-if="user.role == 3" class="form-group  col-12">
                                    <select class="form-control" name="position" v-model="user.position_id">
                                            <option selected disabled>... ومركزى فالملعب هيبقى</option>
                                            <option v-for="position in positions" :key="position.id" :value="position.id" >{{ position.name }}</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        مهم نعرف مركزك فالملعب 
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


                            <div class="form-group  col-12">
                                <i class="fa fa-map-marker main-form-icon"></i>
                                <input type="text" class="form-control" v-model="user.city" placeholder="المدينة" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل المدينة 
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <div class="file-upload">
                                    <div class="file-select">
                                        <i class="fa fa-file-image-o main-form-icon"></i>
                                        <div class="file-select-button" id="fileName"><i class="fa fa-upload main-form-icon"></i></div>
                                        <div class="file-select-name" id="noFile">الصوره الشخصية</div>
                                        <input type="file" ref="image" name="chooseFile" class="form-control" id="chooseFile" @change="onImageChange" required>
                                        <div class="invalid-feedback">
                                            من فضلك أرفق الصوره الشخصية 

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group  full-width-btn text-center submit-form-group col-12">
                                <button type="submit" class="custom_btn" data-hover="تسجيل "><span class="btn_text">تسجيل </span></button>
                            </div>

                            <div class="form-group col-12 forget-form-group">
                                <a href="/login" class="register-link">مسجل بالفعل ؟</a>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </section>
        <!--end register-pg  -->
    </div>
</template>


<script>
export default  {
  props: ['user'],  
  data(){
      return{
          user: {
              position_id: '',
              user_name: '',
              birthdate: '',
              mobile: '',
              email: '',
              role: '',
              city: '',
              lat: '',
              lon: '',
              avatar: '',
              image: '',
          },
          positions: [],
         
      }
  },

  mounted() {
      axios.get('../api/positions')
           .then(response => {
            this.positions = response.data.data;
            console.log(response.data);
            })
            .catch(error =>{
                this.errors.push(error);
                console.log(error);
            })
        
  },
  methods: {
        onSubmit() {

            if(this.coordinates.lat == null){
                const options = {title: 'من فضلك حدد مكانك على الخريطة', size: 'md'}
                this.$dialogs.alert(this.errors, options)
                .then(res => {
                    console.log(res) // {ok: true|false|undefined}
                })
            }

            this.user.lat = this.coordinates.lat;
            this.user.lon = this.coordinates.lng;

            axios.post('../api/editUser/'+this.user.id, this.user)
                .then(({data}) => this.setSuccessMessage())
                .catch(({response}) => this.setErrors(response));
        },

        setErrors(response) {
            this.errors = response.data.errors;
            const options = {title: 'برجاء تفقد الأخطاء التالية', size: 'md'}
            this.$dialogs.alert(this.errors, options)
            .then(res => {
                console.log(res) // {ok: true|false|undefined}
            })     
            console.log(this.errors);
        },

        setSuccessMessage() {
            const options = {title: 'Info', size: 'lg'}
            this.$dialogs.alert('تم تعديل بيانات الحساب بنجاح', options)
            .then(res => {
                if(res) { window.location.href = '/league_stadiums'; }
                console.log(res) // {ok: true|false|undefined}
            })        
        },
        updateCoordinates(location) {
            this.coordinates = {
                lat: location.latLng.lat(),
                lng: location.latLng.lng(),
            };
            //console.log(this.coordinates.lat);
            //console.log(this.coordinates.lng);
        },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.user.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
       
  }
}

</script>