<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addWidget" tabindex="-1" role="dialog" aria-labelledby="addWidgetLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addWidgetLabel">إضافة دورى جديد</h5>
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
    <form @submit.prevent="addWidget" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="الإسم" v-model="widget.name">
        <span>{{ errors.first('name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="title" v-validate="'required'" class="form-control" placeholder="العنوان" v-model="widget.title">
        <span>{{ errors.first('title') }}</span>
      </div>
      <div class="form-group">
        <tinymce id="d1" v-model="widget.description" placeholder="الوصف" required></tinymce>
        <span>{{ errors.first('description') }}</span>
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
      <th scope="col">الإسم</th>
      <th scope="col">العمليات</th>
    </tr>
  </thead>
  <tbody>


      
    
      <tr v-for="widget in widgets" v-bind:key="widget.id">
        <th scope="row">{{ widget.id }}</th>
        <td>{{ widget.name }}</td>
        <td> <button @click="editWidget(widget)" data-toggle="modal" data-target="#addWidget" class="btn btn-warning"><i class="fas fa-edit"></i></button>
        </td>
      </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchWidgets(pagination.prev_page_url)">السابق</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">الصفحة {{ pagination.current_page }} من أصل {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchWidgets(pagination.next_page_url)">التالى</a></li>
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
      widgets: [],
      widget: {
        user_id: this.id,
        name: '',
        title: '',
        description: '<h5 text-align="left">وصف الدورى</h5>',
        widget_add: this.auth_user_id
      },
      widget_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchWidgets();
  },
  methods: {
    fetchWidgets(page_url) {
      let vm = this;
      page_url = page_url || '../api/getwidgets';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.widgets = res.data;
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
    addWidget() {
        if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../api/add_or_update_widget', {
          method: 'post',
          body: JSON.stringify(this.widget),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('تم إضافة تركيب جديد للموقع ...... الرجاء إخبار المسئول عن الموقع لتفعيل التركيب');
            $('#addWidget').modal('hide');
            $('.modal-backdrop').remove();
            this.fetchWidgets();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/add_or_update_widget', {
          method: 'post',
          body: JSON.stringify(this.widget),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('تم تحديث بيانات التركيب');
            $('#addWidget').modal('hide');
            $('.modal-backdrop').remove();
            this.fetchWidgets();
          })
          .catch(err => console.log(err));
      }
    },
    editWidget(widget) {
      this.edit = true;
      this.widget.id = widget.id;
      this.widget.widget_id = widget.id;
      this.widget.name = widget.name;
      this.widget.title = widget.title;
      this.widget.description = widget.description;
    },
    clearForm() {
      this.edit = false;
      this.widget.id = null;
      this.widget.widget_id = null;
      this.widget.name = '';
      this.widget.title = '';      
      this.widget.description = '';
    },
    validation(){
      this.verrors = [];
      if(this.widget.name === ''){this.verrors.push('الرجاء إدخال الإسم');}
      if(this.widget.title === ''){this.verrors.push('الرجاء إدخال العنوان');}    
      if(this.widget.description === ''){this.verrors.push('الرجاء إدخال الوصف');}

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
                vm.widget.photo = e.target.result;
            };
            reader.readAsDataURL(file);
        },
  }
};
</script>