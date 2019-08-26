<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="addAdminLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAdminLabel">إضافة أدمن جديد</h5>
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
    <form @submit.prevent="addAdmin" class="mb-3">
      <div class="form-group">
        <input type="text" name="user_name" v-validate="'required'" class="form-control" placeholder="إسم المستخدم" v-model="admin.user_name">
        <span>{{ errors.first('user_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="first_name" v-validate="'required'" class="form-control" placeholder="الإسم الأول" v-model="admin.first_name">
        <span>{{ errors.first('first_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="last_name" v-validate="'required'" class="form-control" placeholder="الإسم الأخير" v-model="admin.last_name">
        <span>{{ errors.first('last_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="age" v-validate="'required'" class="form-control" placeholder="السن" v-model="admin.age">
        <span>{{ errors.first('age') }}</span>
      </div>
      <div class="form-group">
        <input type="date" name="birthdate" v-validate="'required'" class="form-control" placeholder="تاريخ الميلاد" v-model="admin.birthdate">
        <span>{{ errors.first('birthdate') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="mobile" v-validate="'required'" class="form-control" placeholder="رقم الموبايل" v-model="admin.mobile">
        <span>{{ errors.first('mobile') }}</span>
      </div>
      <div class="form-group">
        <input type="email" name="email" v-validate="'required'" class="form-control" placeholder="البريد الإلكترونى" v-model="admin.email">
        <span>{{ errors.first('email') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="city" v-validate="'required'" class="form-control" placeholder="المدينة" v-model="admin.city">
        <span>{{ errors.first('city') }}</span>
      </div>
      <div class="form-group">
        <select class="form-control" name="role" v-validate="'required'" v-model="admin.role">
            <option selected disabled>... الدور</option>
            <option value="5">أدمن رئيسى</option>
            <option value="6">مسئول عن الملاعب</option>
            <option value="7">مسئول عن الفرق</option>
            <option value="8">مسئول عن الدوريات</option>
            <option value="9">مستقبل الشكاوى والإقتراحات</option>
            <option value="10">محرر</option>
        </select>
        <span>{{ errors.first('role') }}</span>
      </div>
      <div class="form-group">
        <input type="password" name="password" v-validate="'required'" class="form-control" placeholder="كلمة المرور" v-model="admin.password">
        <span>{{ errors.first('password') }}</span>
      </div>
      <div class="form-group">
        <div class="file-upload">
          <div class="file-select">
            <i class="fa fa-file-image-o main-form-icon"></i>
            <div class="file-select-button" id="fileName"><i class="fa fa-upload main-form-icon"></i></div>
            <div class="file-select-name" id="noFile">الصوره  الشخصية</div>
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
      <th scope="col">الإسم باللغة العربية</th>
      <th scope="col">الإسم باللغة الإنجليزية</th>
      <th scope="col">العمليات</th>
    </tr>
  </thead>
  <tbody>


      
    
      <tr v-for="admin in admins" v-bind:key="admin.id">
        <th scope="row">{{ admin.id }}</th>
        <td>{{ admin.user_name }}</td>
        <td>{{ admin.role }}</td>
        <td> <button @click="editAdmin(admin)" class="btn btn-warning"><i class="fas fa-edit"></i></button>
        <button @click="deleteAdmin(admin.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchAdmins(pagination.prev_page_url)">السابق</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">الصفحة {{ pagination.current_page }} من أصل {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchAdmins(pagination.next_page_url)">التالى</a></li>
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
      admins: [],
      admin: {
        id: '',
        user_name: '',
        first_name: '',
        last_name: '',
        age: '',
        birthdate: '',
        mobile: '',
        email: '',
        city: '',
        password: '',
        avatar: '',
        //user_add: this.auth_user_id
      },
      admin_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchAdmins();
  },
  methods: {
    fetchAdmins(page_url) {
      let vm = this;
      page_url = page_url || '../public/api/getadmins';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.admins = res.data;
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
    deleteAdmin(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/deleteadmin/${id}`, {
          method: 'post',
        })
          .then(res => res.json())
          .then(data => {
            alert('Admin Removed');
            this.fetchAdmins();
          })
          .catch(err => console.log(err));
      }
    },
    addAdmin() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/addadmin', {
          method: 'post',
          body: JSON.stringify(this.admin),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Admin Added');
            this.fetchAdmins();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../public/api/updateadmin', {
          method: 'post',
          body: JSON.stringify(this.admin),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Admin Updated');
            this.fetchAdmins();
          })
          .catch(err => console.log(err));
      }
    },
    editAdmin(admin) {
      this.edit = true;
      this.admin.id = admin.id;
      this.admin.admin_id = admin.id;
      this.admin.user_name = admin.user_name;
      this.admin.first_name = admin.first_name;
      this.admin.last_name = admin.last_name;
      this.admin.age = admin.age;
      this.admin.birthdate = admin.birthdate;
      this.admin.mobile = admin.mobile;
      this.admin.email = admin.email;
      this.admin.city = admin.city;
      this.admin.image = admin.image;
      this.admin.password = admin.password;

    },
    clearForm() {
      this.edit = false;
      this.admin.id = null;
      this.admin.admin_id = null;
      this.admin.user_name = '';
      this.admin.first_name = '';
      this.admin.last_name = '';
      this.admin.age = '';
      this.admin.birthdate = '';
      this.admin.mobile = '';
      this.admin.email = '';
      this.admin.city = '';
      this.admin.image = '';
      this.admin.password = '';

    },
    validation(){
      this.verrors = [];
      if(this.admin.name_ar === ''){this.verrors.push('الرجاء إدخال الإسم باللغة العربية');}
      if(this.admin.name_en === ''){this.verrors.push('الرجاء إدخال الإسم باللغة الإنجليزية');}
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
                vm.admin.photo = e.target.result;
            };
            reader.readAsDataURL(file);
        },
  }
};
</script>