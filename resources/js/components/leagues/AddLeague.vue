<template>
    <div>
        <div class="add">
            <form @submit.prevent="onSubmit" class="needs-validation icons-form row" novalidate>
                        <div class="form-group  col-12">
                            <i class="fa fa-user main-form-icon"></i>
                            <input type="text" class="form-control" v-model="league.name" placeholder="إسم الدورى" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل إسم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                           <select class="form-control" name="regulation" v-model="league.regulation" placeholder="...نوع التنظيم">
                                <option selected disabled>...نوع التنظيم</option>
                                <option value="1">مجموعات</option>
                                <option value="0">أدوار</option>
                           </select>
                            <div class="invalid-feedback">
                                من فضلك أدخل نوع التنظيم  
                            </div>
                        </div>

                        <div class="form-group  col-12" v-if="league.regulation == 1">
                            <i class="fa fa-list main-form-icon"></i>
                            <input type="number" class="form-control" v-model="league.groups_no" minlength="2" maxlength="16"  placeholder="عدد المجموعات" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>


                        <div class="form-group  col-12" v-if="league.regulation == 0">
                           <select class="form-control" name="type_id" v-model="league.type_id" placeholder="...الدور">
                                <option selected disabled>... الدور</option>
                                <option value="0">2</option>
                                <option value="1">4</option>
                                <option value="2">8</option>
                                <option value="3">16</option>
                                <option value="4">32</option>
                                <option value="5">64</option>
                           </select>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-user main-form-icon"></i>
                            <input type="number" class="form-control" v-model="league.teams_no" minlength="6" placeholder="عدد الفرق" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                           <select class="form-control" name="stadium_id" v-model="league.stadium_id">
                                <option selected disabled>...اختر الإستاد</option>
                                <option v-for="stadium in stadiums" :key="stadium.id" :value="stadium.id" >{{ stadium.name }}</option>
                           </select>
                            <div class="invalid-feedback">
                                من فضلك أدخل الوصف للدورى 
                            </div>
                        </div>


                        <div class="form-group  col-12">
                            <tinymce id="d1" v-model="league.description" placeholder="وصف الدورى" required></tinymce>

                            <div class="invalid-feedback">
                                من فضلك أدخل الوصف للدورى 
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <tinymce id="d2" v-model="league.prize"  placeholder="الجائزة" required></tinymce>

                            <div class="invalid-feedback">
                                من فضلك أدخل الجائزة  
                            </div>
                        </div>
                        

                        <div class="form-group  col-12">
                            <div class="file-upload">
                                <div class="file-select">
                                    <i class="fa fa-file-image-o main-form-icon"></i>
                                    <div class="file-select-button" id="fileName"><i class="fa fa-upload main-form-icon"></i></div>
                                    <div class="file-select-name" id="noFile">الصوره البارزه للدورى</div>
                                    <input type="file" ref="image" name="chooseFile" class="form-control" id="chooseFile" @change="onImageChange" required>
                                    <div class="invalid-feedback">
                                        من فضلك أرفق الصوره البارزه للدورى

                                    </div>
                                </div>
                            </div>

                        </div>

                        

                        <div class="form-group  full-width-btn text-center submit-form-group col-12">
                            <button type="submit" class="custom_btn" data-hover="هل إنتهيت ؟!"><span class="btn_text">أضف الدورى</span></button>
                        </div>


                    </form>

        </div>
    </div>
</template>

<script>
export default  {
  props: ['user'],  
  data(){
      return{
          league: {
              user_id: this.user.id,
              description: '<h5 text-align="left">وصف الدورى</h5>',
              prize: '<h5 text-align="left">الجائزة</h5>',
              selection: 1,
              teams_asc: 1,
          },
          authUser: [],
          stadiums: [],
          headers: {
            'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
          },
      }
  },
  mounted(){
     

            axios.get('../api/fetch_owner_stadiums/'+this.user.id , { headers: this.headers })
           .then(response => {
            this.stadiums = response.data.data;
            console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                console.log(error);
            })     
           
       
  },
  methods: {
        onSubmit() {
            axios.post('../api/add_or_update_league', this.league)
                .then(({data}) => this.setSuccessMessage())
                .catch(({response}) => this.setErrors(response));
        },

        setErrors(response) {
            this.errors = response.data.errors;
            console.log(this.errors);
        },

        setSuccessMessage() {
            const options = {title: 'تم', size: 'md'}
            this.$dialogs.alert('تم إضافة دورى جديد بنجاح', options)
            .then(res => {
                if(res) { window.location.href = '/league_stadiums/leagues'; }
                //console.log(res) // {ok: true|false|undefined}
            })  
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
                vm.league.photo = e.target.result;
            };
            reader.readAsDataURL(file);
        },
  }
}

</script>