<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserLabel">إضافة أدمن جديد</h5>
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
    <form @submit.prevent="addUser" class="mb-3">
      <div class="form-group">
        <input type="text" name="user_name" v-validate="'required'" class="form-control" placeholder="إسم المستخدم" v-model="user.user_name">
        <span>{{ errors.first('user_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="first_name" v-validate="'required'" class="form-control" placeholder="الإسم الأول" v-model="user.first_name">
        <span>{{ errors.first('first_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="last_name" v-validate="'required'" class="form-control" placeholder="الإسم الأخير" v-model="user.last_name">
        <span>{{ errors.first('last_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="age" v-validate="'required'" class="form-control" placeholder="السن" v-model="user.age">
        <span>{{ errors.first('age') }}</span>
      </div>
      <div class="form-group">
        <input type="date" name="birthdate" v-validate="'required'" class="form-control" placeholder="تاريخ الميلاد" v-model="user.birthdate">
        <span>{{ errors.first('birthdate') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="mobile" v-validate="'required'" class="form-control" placeholder="رقم الموبايل" v-model="user.mobile">
        <span>{{ errors.first('mobile') }}</span>
      </div>
      <div class="form-group">
        <input type="email" name="email" v-validate="'required'" class="form-control" placeholder="البريد الإلكترونى" v-model="user.email">
        <span>{{ errors.first('email') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="city" v-validate="'required'" class="form-control" placeholder="المدينة" v-model="user.city">
        <span>{{ errors.first('city') }}</span>
      </div>
      <div class="form-group">
        <select class="form-control" name="role" v-validate="'required'" v-model="user.role">
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
        <input type="password" name="password" v-validate="'required'" class="form-control" placeholder="كلمة المرور" v-model="user.password">
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


      
    
      <tr v-for="user in users" v-bind:key="user.id">
        <th scope="row">{{ user.id }}</th>
        <td>{{ user.user_name }}</td>
        <td>{{ user.role }}</td>
        <td> <button @click="editUser(user)" class="btn btn-warning"><i class="fas fa-edit"></i></button>
        <button @click="deleteUser(user.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.prev_page_url)">السابق</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">الصفحة {{ pagination.current_page }} من أصل {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.next_page_url)">التالى</a></li>
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
      users: [],
      user: {
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
        user_add: this.auth_user_id
      },
      user_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers(page_url) {
      let vm = this;
      page_url = page_url || '../public/api/getusers';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.users = res.data;
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
    deleteUser(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/deleteuser/${id}`, {
          method: 'post',
        })
          .then(res => res.json())
          .then(data => {
            alert('User Removed');
            this.fetchUsers();
          })
          .catch(err => console.log(err));
      }
    },
    addUser() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/adduser', {
          method: 'post',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('User Added');
            this.fetchUsers();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../public/api/updateuser', {
          method: 'post',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('User Updated');
            this.fetchUsers();
          })
          .catch(err => console.log(err));
      }
    },
    editUser(user) {
      this.edit = true;
      this.user.id = user.id;
      this.user.user_id = user.id;
      this.user.user_name = user.user_name;
      this.user.first_name = user.first_name;
      this.user.last_name = user.last_name;
      this.user.age = user.age;
      this.user.birthdate = user.birthdate;
      this.user.mobile = user.mobile;
      this.user.email = user.email;
      this.user.city = user.city;
      this.user.image = user.image;
      this.user.password = user.password;

    },
    clearForm() {
      this.edit = false;
      this.user.id = null;
      this.user.user_id = null;
      this.user.user_name = '';
      this.user.first_name = '';
      this.user.last_name = '';
      this.user.age = '';
      this.user.birthdate = '';
      this.user.mobile = '';
      this.user.email = '';
      this.user.city = '';
      this.user.image = '';
      this.user.password = '';

    },
    validation(){
      this.verrors = [];
      if(this.user.name_ar === ''){this.verrors.push('الرجاء إدخال الإسم باللغة العربية');}
      if(this.user.name_en === ''){this.verrors.push('الرجاء إدخال الإسم باللغة الإنجليزية');}
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