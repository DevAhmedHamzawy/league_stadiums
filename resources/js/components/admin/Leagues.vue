<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addLeague" tabindex="-1" role="dialog" aria-labelledby="addLeagueLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addLeagueLabel">إضافة دورى جديد</h5>
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
    <form @submit.prevent="addLeague" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="إسم الدورى" v-model="league.name">
        <span>{{ errors.first('name') }}</span>
      </div>
      <div class="form-group">
        <select class="form-control" name="regulation" v-validate="'required'" v-model="league.regulation">
            <option selected disabled>...نوع التنظيم</option>
            <option value="1">مجموعات</option>
            <option value="0">أدوار</option>
        </select>
        <span>{{ errors.first('role') }}</span>
      </div>
      <div class="form-group">
        <input type="number" name="groups_no" v-validate="'required'" class="form-control" placeholder="عدد المجموعات" v-model="league.groups_no">
        <span>{{ errors.first('groups_no') }}</span>
      </div>
      <div class="form-group">
        <select class="form-control" name="type_id" v-validate="'required'" v-model="league.type_id">
            <option selected disabled>... الدور</option>
            <option value="0">2</option>
            <option value="1">4</option>
            <option value="2">8</option>
            <option value="3">16</option>
            <option value="4">32</option>
            <option value="5">64</option>
        </select>
        <span>{{ errors.first('type_id') }}</span>
      </div>
      <div class="form-group">
        <input type="number" name="teams_no" v-validate="'required'" class="form-control" placeholder="عدد الفرق" v-model="league.teams_no">
        <span>{{ errors.first('teams_no') }}</span>
      </div>
      <div class="form-group">
        <select class="form-control" name="stadium_id" v-validate="'required'" v-model="league.stadium_id">
            <option selected disabled>...اختر الإستاد</option>
            <option v-for="stadium in stadiums" :key="stadium.id" :value="stadium.id" >{{ stadium.name }}</option>
        </select>
        <span>{{ errors.first('stadium_id') }}</span>
      </div>
      <div class="form-group">
        <tinymce id="d1" v-model="league.description" placeholder="وصف الدورى" required></tinymce>
        <span>{{ errors.first('description') }}</span>
      </div>
     
      <div class="form-group">
        <tinymce id="d2" v-model="league.prize"  placeholder="الجائزة" required></tinymce>
        <span>{{ errors.first('prize') }}</span>
      </div>
      <div class="form-group">
        <div class="file-upload">
          <div class="file-select">
            <i class="fa fa-file-image-o main-form-icon"></i>
            <div class="file-select-button" id="fileName"><i class="fa fa-upload main-form-icon"></i></div>
            <div class="file-select-name" id="noFile">صورة الدورى</div>
            <input type="file" ref="image" name="chooseFile" class="form-control" id="chooseFile" @change="onImageChange" required>
          </div>
        </div>
        <span>{{ errors.first('image') }}</span>
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
      <th scope="col">إسم الدورى</th>
      <th scope="col">العمليات</th>
    </tr>
  </thead>
  <tbody>


      
    
      <tr v-for="league in leagues" v-bind:key="league.id">
        <th scope="row">{{ league.id }}</th>
        <td>{{ league.name }}</td>
        <td> <button @click="editLeague(league)" data-toggle="modal" data-target="#addLeague" class="btn btn-warning"><i class="fas fa-edit"></i></button>
        <button @click="deleteLeague(league.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchLeagues(pagination.prev_page_url)">السابق</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">الصفحة {{ pagination.current_page }} من أصل {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchLeagues(pagination.next_page_url)">التالى</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  props: ['auth_user_id'],
  data() {
    return {
      verrors: [],
      leagues: [],
      stadiums: [],
      league: {
        name: '',
        regulation: '',
        groups_no: '',
        type_id: '',
        teams_no: '',
        stadium_id: '',
        description: '<h5 text-align="left">وصف الدورى</h5>',
        prize: '<h5 text-align="left">الجائزة</h5>',
        selection: 1,
        teams_asc: 1,
        league_add: this.auth_user_id
      },
      league_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchLeagues();
  },
  mounted(){
    axios.get('../api/fetch_stadiums/' , { headers: this.headers })
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
    fetchLeagues(page_url) {
      let vm = this;
      page_url = page_url || '../public/api/fetch_leagues';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.leagues = res.data;
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
    deleteLeague(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/delete_league/${id}`, {
          method: 'post',
        })
          .then(res => res.json())
          .then(data => {
            alert('تم حذف الدورى');
            this.fetchLeagues();
          })
          .catch(err => console.log(err));
      }
    },
    addLeague() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../api/add_or_update_league', {
          method: 'post',
          body: JSON.stringify(this.league),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('تم إضافة دورى جديد');
            $('#addLeague').modal('hide');
            $('.modal-backdrop').remove();
            this.fetchLeagues();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/add_or_update_league', {
          method: 'post',
          body: JSON.stringify(this.league),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('تم تحديث بيانات الدورى');
            $('#addLeague').modal('hide');
            $('.modal-backdrop').remove();
            this.fetchLeagues();
          })
          .catch(err => console.log(err));
      }
    },
    editLeague(league) {
      this.edit = true;
      this.league.id = league.id;
      this.league.league_id = league.id;
      this.league.name = league.name;
      this.league.regulation = league.regulation;
      this.league.groups_no = league.groups_no;
      this.league.type_id = league.type_id;
      this.league.teams_no = league.teams_no;
      this.league.stadium_id = league.stadium_id;
      this.league.description = league.description;
      this.league.prize = league.prize;
      this.league.selection = league.selection;
      this.league.teams_asc = league.teams_asc;

    },
    clearForm() {
      this.edit = false;
      this.league.id = null;
      this.league.league_id = null;
      this.league.name = '';
      this.league.regulation = '';
      this.league.groups_no = '';
      this.league.type_id = '';
      this.league.teams_no = '';
      this.league.stadium_id = '';
      this.league.description = '';
      this.league.prize = '';
      this.league.selection = '';
      this.league.teams_asc = '';

    },
    validation(){
      this.verrors = [];
      if(this.league.name === ''){this.verrors.push('الرجاء إدخال الإسم');}
      if(this.league.regulation === ''){this.verrors.push('الرجاء إدخال نوع التنظيم');}
      if(this.league.groups_no === ''){this.verrors.push('الرجاء إدخال عدد المجموعات');}
      if(this.league.type_id === ''){this.verrors.push('الرجاء إدخال عدد الأدوار');}
      if(this.league.teams_no === ''){this.verrors.push('الرجاء إدخال عدد الفرق');}
      if(this.league.stadium_id === ''){this.verrors.push('الرجاء إدخال الإستاد');}
      if(this.league.description === ''){this.verrors.push('الرجاء إدخال الوصف');}
      if(this.league.prize === ''){this.verrors.push('الرجاء إدخال الجائرة');}

      return this.verrors.length > 0 ? false : true;
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
};
</script>