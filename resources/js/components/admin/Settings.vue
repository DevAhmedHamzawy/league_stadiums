<template>
  <div>
    <form @submit.prevent="updateSettings" class="mb-3">
      <div class="form-group">
        <tinymce id="d1" v-model="settings.about" placeholder="عن الموقع" required></tinymce>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Facebook" v-model="settings.facebook">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Twitter" v-model="settings.twitter">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Instagram" v-model="settings.instagram">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Youtube" v-model="settings.youtube">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Google+" v-model="settings.google_plus">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Phone" v-model="settings.phone">
      </div>
      <div class="form-group">
        <tinymce id="d2" v-model="settings.conditions" placeholder="شروط الإستخدام" required></tinymce>
      </div>
      

      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
  </div>
</template>

<script>
export default {
  props: ['settings'],  
  data() {
    return {
      settings_id: 1,
    };
  },
  methods: {
    updateSettings() {
        // Update
        fetch('../public/api/updatesettings/1', {
          method: 'post',
          body: JSON.stringify(this.settings),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            alert('تم تحديث إعدادات الموقع');
          })
          .catch(err => console.log(err));
      },
  }
};
</script>