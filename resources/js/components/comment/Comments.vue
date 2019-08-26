<template>
    <!--start comments-template-->
    <div class="comments-template col-12">
        <h3 class="login-title comment-title">التعليقات</h3>
        <!--start main-comment-->
        <div class="main-comment wow fadeInUp" v-for="comment in comments" :key="comment.id">
            <div class="comment-img full-width-img">
                <img src="images/main/man.png" class="converted-img" alt="user" />
            </div>
            <div class="side-comment">
                <h3>
                    {{ comment.name }}
                </h3>
                <span class="rep-form-link">رد علي التعليق</span>

                <p>
                    {{ comment.text }}
                </p>
                <!--start replay-div-->

                <div class="replay-div" v-for="reply in comment.replies" :key="reply.id">
                    <h3>
                        الرد
                    </h3>
                    <p>
                        {{ reply.text }}
                    </p>
                </div>
                <!--end replay-div-->
                
                <reply :parent_id="comment.id" />

            </div>

        </div>
        <!--end main-comment-->
        
    </div>
    <!--end comments-template-->
</template>
<script>
 export default {
        props: ['league_id','match_id','stadium_id','player_id'],
        data() {
            return {
                saved: false,
                comments: {
                    name: '',
                    email: '',
                    text: '',
                }
            };
        },
        mounted() {
                 this.fetchComments();
        },
        methods: {

           fetchComments(){
                if(this.match_id !== undefined){
                    axios.post('../api/get_comments' , { match_id: this.match_id })
                    .then(response => {
                        this.comments = response.data.data;
                        //console.log(response.data);
                        })
                        .catch(error =>{
                            //this.errors.push(error);
                            console.log(error);
                        }) 
                }else if(this.league_id !== undefined){
                    axios.post('../api/get_comments' , { league_id: this.league_id })
                    .then(response => {
                        this.comments = response.data.data;
                        //console.log(response.data);
                        })
                        .catch(error =>{
                            //this.errors.push(error);
                            console.log(error);
                        }) 

                }else if(this.stadium_id !== undefined){
                    axios.post('../api/get_comments' , { stadium_id: this.stadium_id })
                    .then(response => {
                        this.comments = response.data.data;
                        //console.log(response.data);
                        })
                        .catch(error =>{
                            //this.errors.push(error);
                            console.log(error);
                        }) 

                }else{
                    axios.post('../api/get_comments' , { player_id: this.player_id })
                    .then(response => {
                        this.comments = response.data.data;
                        //console.log(response.data);
                        })
                        .catch(error =>{
                            //this.errors.push(error);
                            console.log(error);
                        }) 
                }
            
            },



        }
    }
</script>
