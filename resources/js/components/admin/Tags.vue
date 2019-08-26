<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="addTagLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTagLabel">إضافة وسم جديدة</h5>
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
    <form @submit.prevent="addTag" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="الإسم" v-model="tag.name">
        <span>{{ errors.first('name') }}</span>
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

    
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">الإسم باللغة العربية</th>
      <th scope="col">الإسم باللغة الإنجليزية</th>
      <th scope="col">العمليات</th>
    </tr>
  </thead>
  <tbody>


      
    
      <tr v-for="tag in tags" v-bind:key="tag.id">
        <th scope="row">{{ tag.id }}</th>
        <td>{{ tag.name_ar }}</td>
        <td>{{ tag.name_en }}</td>
        <td> <button @click="editTag(tag)" class="btn btn-warning"><i class="fas fa-edit"></i></button>
        <button @click="deleteTag(tag.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchTags(pagination.prev_page_url)">السابق</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">الصفحة {{ pagination.current_page }} من أصل {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchTags(pagination.next_page_url)">التالى</a></li>
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
      tags: [],
      tag: {
        id: '',
        name: '',
        user_add: this.auth_user_id
      },
      tag_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchTags();
  },
  methods: {
    fetchTags(page_url) {
      let vm = this;
      page_url = page_url || '../public/api/gettags';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.tags = res.data;
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
    deleteTag(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/deletetag/${id}`, {
          method: 'post',
        })
          .then(res => res.json())
          .then(data => {
            alert('Tag Removed');
            this.fetchTags();
          })
          .catch(err => console.log(err));
      }
    },
    addTag() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/addtag', {
          method: 'post',
          body: JSON.stringify(this.tag),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Tag Added');
            this.fetchTags();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../public/api/updatetag', {
          method: 'post',
          body: JSON.stringify(this.tag),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Tag Updated');
            this.fetchTags();
          })
          .catch(err => console.log(err));
      }
    },
    editTag(tag) {
      this.edit = true;
      this.tag.id = tag.id;
      this.tag.tag_id = tag.id;
      this.tag.name = tag.name;
    },
    clearForm() {
      this.edit = false;
      this.tag.id = null;
      this.tag.tag_id = null;
      this.tag.name = '';
    },
    validation(){
      this.verrors = [];
      if(this.tag.name_ar === ''){this.verrors.push('الرجاء إدخال الإسم باللغة العربية');}
      if(this.tag.name_en === ''){this.verrors.push('الرجاء إدخال الإسم باللغة الإنجليزية');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>