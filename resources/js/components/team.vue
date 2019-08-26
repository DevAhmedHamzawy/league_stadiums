<template>
    <div>
         <!--start pages-header
             ================-->
    <section class="pages-header  text-center wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-12 pages-title">
                    <h1 class="wow fadeInUp">جدول الدوري - الدور الاول</h1>
                    <p class="white-prg wow fadeInUp">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على</p>
                </div>
            </div>
        </div>
    </section>
    <!--end pages-header-->

    

    <!--start dawry-table
             ================-->
    <section class="dawry-table marg-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                   
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>اللاعب</th>
                                <th>لاعب أساسى</th>
                                <th>لاعب إحتياطى</th>
                                <th>كابتن الفريق</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="player in players" :key="player.id">
                                <td>{{ player.player.user_name }}</td>
                                <td><input type="checkbox" id="checkbox" :checked="checkMain(player)" v-on:click="status(player.player_id,1)"></td>  
                                <td><input type="checkbox" id="checkbox" :checked="checkSpare(player)" v-on:click="status(player.player_id,0)"></td>
                                <td><input type="radio" :checked="checkCaptain(player)" v-on:click="captain(player.player_id)" ></td>
                            </tr>
                        </tbody>
                    </table>


                    

                </div>
            </div>
        </div>
    </section>
    <!--end dawry-table  -->



    </div>
</template>

<script>
export default {
    props: ['id'],
    data(){
        return{

           players: [],
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
            },

        }
    },
    mounted() {

        axios.get('../api/fetch_team/'+this.id , { headers: this.headers })
           .then(response => {
            this.players = response.data.data;
            //console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
        })
       
               
    },
    methods: {
    
       checkMain(player){
           return player.play == "main";
       },
       
       checkSpare(player){
           return player.play == "spare";
       },
       
       checkCaptain(player){
           return player.captain == 1
       },



       status(id,status){
           axios.post('../api/post_player_status/'+id+'/'+status , { headers: this.headers })
           .then(response => {
            this.players = response.data.data;
            //console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
           })
       },


       
       captain(id){
           axios.post('../api/post_captain/'+id , { headers: this.headers })
           .then(response => {
            this.players = response.data.data;
            //console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
           })
       }
       

    }
    
}
</script>