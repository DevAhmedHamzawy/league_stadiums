<template>

        <!--start comments-form-->
        <div class="comments-form col-12">
            <div class="alert alert-success" v-if="saved">
                <strong>التعليق تم إضافته</strong> 
            </div>
            <h3 class="login-title comment-title">سيب تعليقك هنا</h3>
            <form class="needs-validation gray-form" @submit.prevent="onSubmit" novalidate>
                <div class="form-group">
                    <input type="text" class="form-control"  v-model="comment.name" placeholder="الإسم" required>
                    <div class="invalid-feedback">
                        من فضلك أدخل الإسم 
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" v-model="comment.email" placeholder="البريد الالكتروني" required>
                    <div class="invalid-feedback">
                        من فضلك أدخل البريد الالكتروني
                    </div>
                </div>
                <div class="form-group">
                    
                    <div  v-html="commentArea" @click="replace">
                       
                    </div>

                    <div v-if="this.tiny == 1">
                        <tinymce id="d2" v-model="comment.text"  placeholder="التعليق هنا ...." :plugins="['emoticons']" :toolbar="['emoticons']" required></tinymce>
                    </div>

                    <div class="invalid-feedback">
                        من فضلك أدخل تعليق صحيح

                    </div>
                </div>


                <div class="form-group  left-btn">
                    <button type="submit" class="custom_btn" data-hover="تعليق "><span class="btn_text">تعليق </span></button>
                </div>


            </form>
        </div>
</template>

<script>
    export default {
        props: ['match_id','league_id','stadium_id','player_id'],
        data() {
            return {
                err: [],
                saved: false,
                comment: {
                    name: '',
                    email: '',
                    text: '',
                },
                tiny : 0,
                commentArea: `<textarea class="form-control"  v-model="comment.text" placeholder="التعليق هنا ...." required></textarea>`
            };
        },
        methods: {
            onSubmit() {
                this.saved = false;
                
                if(this.match_id !== undefined) { this.comment.match_id = this.match_id }
                else if(this.league_id !== undefined){ this.comment.league_id = this.league_id }
                else if(this.stadium_id !== undefined){ this.comment.stadium_id = this.stadium_id }
                else{ this.comment.player_id = this.player_id }

                axios.post('../api/add_comment', this.comment)
                    .then(({data}) => this.setSuccessMessage())
                    .catch(({response}) => this.setErrors(response));
            },

            setErrors(response) {
                console.log(response.data.errors);
            },

            setSuccessMessage() {
                this.saved = true;
                window.location.reload();
            },

            replace() {
               this.commentArea = ``; 
               this.tiny = 1;
            }
            
        }
    }
</script>

<style>
.replay-comment-form {
     display: block; 
}
</style>
