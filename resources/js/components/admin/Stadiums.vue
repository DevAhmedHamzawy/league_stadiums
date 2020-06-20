<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addStadium" tabindex="-1" role="dialog" aria-labelledby="addStadiumLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStadiumLabel">إضافة إستاد جديد</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p v-if="verrors.length">
    <b>الرجاء قم بتصحيح الأخطاء التالية :</b>
    <ul>
      <li v-for="error in verrors" :key="error">{{ error }}</li>
    </ul>
    </p>
    <form @submit.prevent="addStadium" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="إسم الإستاد" v-model="stadium.name">
        <span>{{ errors.first('name') }}</span>
    </div>
    <div class="form-group">
        <select class="form-control" name="user_id" v-validate="'required'" v-model="stadium.user_id">
            <option selected disabled>...اختر صاحب الإستاد</option>
            <option v-for="owner in stadiumowners" :key="owner.id" :value="owner.id" >{{ owner.user_name }}</option>
        </select>
        <span>{{ errors.first('user_id') }}</span>
      </div>
    <div class="form-group">
        <GmapMap
        :center="{lat:25.923467, lng:29.293294}"
        :zoom="7"
        map-type-id="terrain"
        style="width: 100%; height: 300px"
        >
        <gmap-marker :position="{lat:25.923467, lng:29.293294}" :draggable="true" @drag="updateCoordinates" />
        </GmapMap>
    </div>
      <div class="form-group">
        <input type="number" name="telephone" v-validate="'required'" class="form-control" placeholder="رقم التليفون" v-model="stadium.telephone">
        <span>{{ errors.first('telephone') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="address" v-validate="'required'" class="form-control" placeholder="العنوان" v-model="stadium.address">
        <span>{{ errors.first('address') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="city" v-validate="'required'" class="form-control" placeholder="المدينة" v-model="stadium.city">
        <span>{{ errors.first('city') }}</span>
      </div>
      <div class="form-group">
        <input type="number" name="rent_by_hour" v-validate="'required'" class="form-control" placeholder="سعر الإيجار بالساعة" v-model="stadium.rent_by_hour">
        <span>{{ errors.first('rent_by_hour') }}</span>
      </div>
      <div class="form-group">
        <input type="number" name="rent_by_league" v-validate="'required'" class="form-control" placeholder="سعر الإيجار بالدورى" v-model="stadium.rent_by_league">
        <span>{{ errors.first('rent_by_league') }}</span>
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

      <div class="modal-footer">
        <button type="button" @click="clearForm()" data-dismiss="modal" class="btn btn-danger btn-block">إلغاء</button>
        <button type="submit" class="btn btn-light btn-block">إضافة</button>
      </div>
    </form>
      </div>
    </div>
  </div>
</div>

    
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">إسم الملعب</th>
      <th scope="col">العمليات</th>
    </tr>
  </thead>
  <tbody>


      
    
      <tr v-for="stadium in stadiums" v-bind:key="stadium.id">
        <th scope="row">{{ stadium.id }}</th>
        <td>{{ stadium.name }}</td>
        <td> <button @click="editStadium(stadium)" data-toggle="modal" data-target="#addStadium" class="btn btn-warning"><i class="fas fa-edit"></i></button>
        <button @click="deleteStadium(stadium.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStadiums(pagination.prev_page_url)">السابق</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">الصفحة {{ pagination.current_page }} من أصل {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStadiums(pagination.next_page_url)">التالى</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image';

export default {
  props: ['auth_user_id'],
  data() {
    return {
      verrors: [],
      stadiums: [],
      stadium: {
        user_id: '',
        name: '',
        telephone: '',
        rent_by_hour: '',
        rent_by_league: '',
        address: '',
        city: '',
        lat: '',
        lon: '',
        stadium_add: this.auth_user_id
      },
      main: 1,
      coordinates: null,
      stadiumowners: [],
      images: [],
      stadiumImages: [],
      stadium_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchStadiums();
  },
  mounted(){
      axios.get('../api/getownerstadiums/' , { headers: this.headers })
      .then(response => {
      this.stadiumowners = response.data.data;
      console.log(response.data.data);
      })
      .catch(error =>{
          this.errors.push(error);
          console.log(error);
      })        
  },
  components: {
    VueUploadMultipleImage
  },
  methods: {
    fetchStadiums(page_url) {

      let vm = this;
      page_url = page_url || '../public/api/fetch_stadiums';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.stadiums = res.data;
          vm.makePagination(res.meta, res.links);
      })
      .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    deleteStadium(id) {
      if (confirm('هل أنت متأكد من الحذف ؟')) {
        fetch(`../public/api/delete_stadium/${id}`, {
          method: 'post',
        })
          .then(res => res.json())
          .then(data => {
            alert('تم حذف الإستاد');
            this.fetchStadiums();
          })
          .catch(err => console.log(err));
      }
    },
    addStadium() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
          this.stadium.lat = this.coordinates.lat;
          this.stadium.lon = this.coordinates.lng;
        fetch('../api/add_or_update_stadium', {
          method: 'post',
          body: JSON.stringify(this.stadium),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.upload(data)
            this.clearForm();
            alert('تم إضافة إستاد جديد');
            $('#addStadium').modal('hide');
            $('.modal-backdrop').remove();
            this.fetchStadiums();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        this.stadium.lat = this.coordinates.lat;
        this.stadium.lon = this.coordinates.lng;
        fetch('../public/api/add_or_update_stadium', {
          method: 'post',
          body: JSON.stringify(this.stadium),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('تم تحديث بيانات الإستاد');
            $('#addStadium').modal('hide');
            $('.modal-backdrop').remove();
            this.fetchStadiums();
          })
          .catch(err => console.log(err));
      }
    },
    editStadium(stadium) {
      this.edit = true;
      this.stadium.id = stadium.id;
      this.stadium.stadium_id = stadium.id;
      this.stadium.name = stadium.name;
      this.stadium.telephone = stadium.telephone;
      this.stadium.rent_by_hour = stadium.rent_by_hour;
      this.stadium.rent_by_league = stadium.rent_by_league;
      this.stadium.address = stadium.address;
      this.stadium.city = stadium.city;
      this.stadium.lat = stadium.lat;
      this.stadium.lon = stadium.lon;
     

    },
    clearForm() {
      this.edit = false;
      this.stadium.id = null;
      this.stadium.stadium_id = null;
      this.stadium.name = '';
      this.stadium.telephone = '';
      this.stadium.rent_by_hour = '';
      this.stadium.rent_by_league = '';
      this.stadium.address = '';
      this.stadium.city = '';
      this.stadium.lat = '';
      this.stadium.lon = '';

    },
    validation(){
      this.verrors = [];
      if(this.stadium.name === ''){this.verrors.push('الرجاء إدخال الإسم');}
      if(this.stadium.telephone === ''){this.verrors.push('الرجاء إدخال رقم الهاتف');}
      if(this.stadium.rent_by_hour === ''){this.verrors.push('الرجاء إدخال سعر الإيجار بالساعة');}
      if(this.stadium.rent_by_league === ''){this.verrors.push('الرجاء إدخال سعر الإيجار بالدورى');}
      if(this.stadium.address === ''){this.verrors.push('الرجاء إدخال العنوان');}
      if(this.stadium.city === ''){this.verrors.push('الرجاء إدخال المدينة');}
      return this.verrors.length > 0 ? false : true;
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
};
</script>