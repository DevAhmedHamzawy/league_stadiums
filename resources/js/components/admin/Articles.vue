<template>
  <div>
   
<!-- Modal -->
<div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addArticleLabel">إضافة حالة جديدة</h5>
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
    <form @submit.prevent="addArticle" class="mb-3">
      <div class="form-group">
        <input type="text" name="title" v-validate="'required'" class="form-control" placeholder="العنوان" v-model="article.title">
        <span>{{ errors.first('title') }}</span>
      </div>
      <div class="form-group">
        <input type="date" name="date" v-validate="'required'" class="form-control" placeholder="التاريخ" v-model="article.date">
        <span>{{ errors.first('date') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="description" v-validate="'required'" class="form-control" placeholder="الوصف" v-model="article.description">
        <span>{{ errors.first('description') }}</span>
      </div>
      <div class="form-group">
        <tinymce id="d1" name="text" v-model="article.text" placeholder="نص المقال ....." required></tinymce>
        <span>{{ errors.first('text') }}</span>
      </div>
      <div class="form-group">
        <vue-upload-multiple-image
        @upload-success="uploadImageSuccess"
        @before-remove="beforeRemove"
        @edit-image="editImage"
        @data-change="dataChange"
        :data-images="images"
        ></vue-upload-multiple-image>
        <span>{{ errors.first('image') }}</span>
      </div>
      <div class="form-group">
       <vue-tags-input
          v-model="tag"
          :tags="tags"
          @tags-changed="newTags => tags = newTags"
        />
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


      
    
      <tr v-for="article in articles" v-bind:key="article.id">
        <th scope="row">{{ article.id }}</th>
        <td>{{ article.name_ar }}</td>
        <td>{{ article.name_en }}</td>
        <td> <button @click="editArticle(article)" class="btn btn-warning"><i class="fas fa-edit"></i></button>
        <button @click="deleteArticle(article.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">السابق</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">الصفحة {{ pagination.current_page }} من أصل {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">التالى</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import VueTagsInput from '@johmun/vue-tags-input';

export default {
  props: ['auth_user_id'],
  data() {
    return {
      verrors: [],
      articles: [],
      tag: '',
      tags: [],
      article: {
        id: '',
        title: '',
        date: '',
        description: '',
        text: '',
        //user_add: this.auth_user_id
      },
      images: [],
      articleImages: [],
      article_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchArticles();
  },
  components: {
    VueUploadMultipleImage,
    VueTagsInput,
  },
  methods: {
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || '../public/api/getarticles';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.articles = res.data;
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
    deleteArticle(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/deletearticle/${id}`, {
          method: 'post',
        })
          .then(res => res.json())
          .then(data => {
            alert('Article Removed');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    addArticle() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/addarticle', {
          method: 'post',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Article Added');
            this.fetchArticles();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../public/api/updatearticle', {
          method: 'post',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Article Updated');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    editArticle(article) {
      this.edit = true;
      this.article.id = article.id;
      this.article.article_id = article.id;
      this.article.title = article.title;
      this.article.date = article.date;
      this.article.description = article.description;
      this.article.text = article.text;
    },
    clearForm() {
      this.edit = false;
      this.article.id = null;
      this.article.article_id = null;
      this.article.title = '';
      this.article.date = '';
      this.article.description = '';
      this.article.text = '';
    },
    validation(){
      this.verrors = [];
      if(this.article.name === ''){this.verrors.push('الرجاء إدخال الإسم');}
      if(this.article.name_en === ''){this.verrors.push('الرجاء إدخال الإسم باللغة الإنجليزية');}
      return this.verrors.length > 0 ? false : true;
    },

     upload(data) {
            this.articleImages.map(function(entry) { entry.article_id = data.data.id; return entry});
             // Upload image api
            axios.post('api/add_or_update_articleimages', this.articleImages)
                .then(response => { this.setSuccessMessage() })
                .catch(({response}) => this.setErrors(response));     
        },

        uploadImageSuccess(formData, index, fileList) {
         //console.log('imagename',  fileList[index].name)
         this.articleImages.push({ text: fileList[index].name, main: this.main ,file: fileList[index].path  });
         this.main = 0;
         //console.log('sis', this.articleImages);

     
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