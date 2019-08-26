<template>
    <div>
    <!--start dawry-table
             ================-->
    <section class="dawry-table marg-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>الفريق الأول</th>
                                <th>الفريق الثانى</th>
                                <th>إضافة النتيجة</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr v-for="match in matches" :key="match.id">

                               <template v-for="user in users">
                                    <td v-if="user.id == match.team1" :key="user.id">{{ user.user_name }}</td>
                                </template>
                                <template v-for="user in users">
                                    <td v-if="user.id == match.team2" :key="user.id">{{ user.user_name }}</td>
                                </template>
                               <td>
                                    <a :href="'matches/'+match.id" class="custom_btn" data-hover="إضافة نتيجة"><span class="btn_text">إضافة نتيجة</span></a>
                               </td>
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

            matches: [],
            users:[],
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
            },

        }
    },
    mounted() {

         axios.get('api/matches/' , { headers: this.headers })
           .then(response => {
            this.matches = response.data.data;
            //console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
            }),

         axios.get('api/users' , { headers: this.headers })
           .then(response => {
            this.users = response.data.data;
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
          })
               

    }
}
</script>