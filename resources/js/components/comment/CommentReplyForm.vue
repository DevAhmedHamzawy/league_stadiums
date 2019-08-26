<template>
        <!--start replay-comment-form-->
            <div class="replay-comment-form">
                <form class="needs-validation" @submit.prevent="onSubmit" novalidate>

                    <div class="form-group">
                        <textarea class="form-control" v-model="comment.text" placeholder="اكتب تعليقك" required></textarea>
                        <div class="invalid-feedback">
                            من فضلك أدخل تعليق صحيح

                        </div>
                    </div>
                    <div class="form-group left-btn">
                        <button type="submit" class="custom_btn subscripe-btn" data-hover="ارسال"><span class="btn_text">ارسال</span></button>
                    </div>

                </form>
            </div>
        <!--end replay-comment-form-->
</template>

<script>
export default {
        props: ['match_id','league_id','player_id','parent_id'],
        data() {
            return {
                err: [],
                saved: false,
                comment: {
                    text: '',
                }
            };
        },

        

        methods: {
            onSubmit() {
                this.saved = false;
                
                if(this.match_id !== null) { this.comment.match_id = this.match_id }
                else if(this.league_id !== null){ this.comment.league_id = this.league_id }
                else{ this.comment.player_id = this.player_id }

                this.comment.parent_id = this.parent_id;

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

           
        }
}
</script>