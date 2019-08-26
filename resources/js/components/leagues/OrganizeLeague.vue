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
                    <a class="no-bord-rad big-btn custom_btn" @click="organize"  v-if="this.teams.length === this.league.teams_no && this.league.matches.length === 0" data-hover="تنظيم الدورى"><span class="btn_text">تنظيم الدورى</span></a>
                    <a class="no-bord-rad big-btn custom_btn" @click="check" v-if="this.league.matches.length != 0" data-hover="عرض التصفيات"><span class="btn_text">عرض التصفيات</span></a>

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
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" v-if="this.league.matches.length === 0" style="width:100%">
                        <thead>
                            <tr>
                                <th> الفريق </th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="team in teams" :key="team.id">
                                <td>{{ team.user_name }}</td>  
                            </tr>
                        </tbody>
                    </table>

                    <template v-if="this.league.regulation === 'groups'">
                     <table id="example" class="table table-striped table-bordered dt-responsive nowrap"  v-for="group in groups" :key="group.id" style="width:100%">
                        <thead>
                            <tr>
                                <th> {{ group.group }} </th> 
                                <th>لعب</th>
                                <th>فاز</th>
                                <th>إتعادل</th>
                                <th>خسر</th>
                                <th>أهداف للفريق</th>
                                <th>أهداف ضد الفريق</th>
                                <th>فارق الأهداف</th>
                                <th>النقاط</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="team in group.leaguegroups" :key="team.id">
                                <td>{{ team.user.user_name }}</td>
                                <td>{{ team.played }}</td>
                                <td>{{ team.won }}</td>
                                <td>{{ team.drawn }}</td>
                                <td>{{ team.lost }}</td>
                                <td>{{ team.gf }}</td>
                                <td>{{ team.ga }}</td>
                                <td>{{ team.gd }}</td>
                                <td>{{ team.pts }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </template>

                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" v-if="mv == 1 || this.league.matches.length != 0" style="width:100%">
                        <thead>
                            <tr>
                                <th>الفريق الأول</th> 
                                <th>الفريق الثانى</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="match in league.matches" :key="match.id">
                                <template v-for="user in users">
                                    <td v-if="user.id == match.team1" :key="user.id">{{ user.user_name }}</td>
                                </template>
                                <template v-for="user in users">
                                    <td v-if="user.id == match.team2" :key="user.id">{{ user.user_name }}</td>
                                </template>
                                <td>{{ match.datetime }}</td>  
                            </tr>
                        </tbody>
                    </table>


                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" v-for="type in types" :key="type.id" style="width:100%">
                        <thead>
                            <tr>
                                {{ type.type }}
                            </tr>
                            <tr>
                                <th>الفريق الأول</th> 
                                <th>الفريق الثانى</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="match in type.matches" :key="match.id">
                                <template v-for="user in users">
                                    <td v-if="user.id == match.team1" :key="user.id">{{ user.user_name }}</td>
                                </template>
                                <template v-for="user in users">
                                    <td v-if="user.id == match.team2" :key="user.id">{{ user.user_name }}</td>
                                </template>
                                <td>{{ match.datetime }}</td>  
                            </tr>
                        </tbody>
                    </table>

                    <h1>الفائز بالدورى</h1>                    
                    <template v-for="user in users">
                        <td v-if="user.id == champion" :key="user.id">{{ user.user_name }}</td>
                    </template>

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

            league: [],
            groups: [],
            teams: [],
            users: [],
            matches: [],
            mv : 0,
            ml: 0,
            ms: 0,
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem('Authorization'),
            },

        }
    },
    mounted() {

         axios.get('../../api/league/'+this.id , { headers: this.headers })
           .then(response => {
            this.league = response.data.data;
            this.teams = response.data.data.teams;
            this.groups = response.data.groups;
            this.types = response.data.types;
            this.champion = response.data.champion;
            //console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
            }),

         axios.get('../../api/users' , { headers: this.headers })
           .then(response => {
            this.users = response.data.data;
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
          })
               

    },
    methods: {
        shuffle(a) {
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        },

        organize(){
            if(this.league.groups_no !== null && this.ms === 0) {
                let sL = this.shuffle(this.teams);
                
                axios.post('../api/creategroups' , { headers: this.headers, teams: sL, league: this.league })
                .then(response => {
                    //console.log(response.data.data);
                    this.ml = 1;

                });    

            }else{
                //console.log('type');
                axios.post('../api/createtype' , { headers: this.headers, teams: this.teams, league: this.league })
                .then(response => {
                    //console.log(response.data.data);


                axios.get('../api/matches/'+this.league.id , { headers: this.headers })
                .then(response => {
                    this.mv = 1;
                    this.matches = response.data.data;
                    //console.log(response.data.data);
                    })
                    .catch(error =>{
                        this.errors.push(error);
                        //console.log(error);
                    })
                    })
                    .catch(error =>{
                        this.errors.push(error);
                        //console.log(error);
                    })

            }
        },
        check(){

             axios.post('../api/check/'+this.league.id , { headers: this.headers })
            .then(response => {
                this.ms = 1;
                this.teams = response.data;
                console.log(response.data);
                if(this.teams !== 'winner'){
                    this.organize(response.data);
                }
                //console.log(response.data);
                })
                .catch(error =>{
                    this.errors.push(error);
                    //console.log(error);
                })
            

        }


    }
    
}
</script>