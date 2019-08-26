<template>
    <!--start team-flags-reasult-->
    <div class="col-12 text-center team-flags-reasult">
        <div class="flag-div">
            <div class="flag-img">
                <img src="images/teams/1.png" alt="team" />
            </div>
            <template v-for="user in users">
                <span v-if="user.id == match.team1" :key="user.id" class="team-flag-name">{{ user.user_name }}</span>
            </template>
        </div>

        <div v-if="match.statistics !== null" class="flag-div-result">
            <span class="res-text finish">إنتهت</span>

            <span class="vs-text">vs</span>

            <span class="res-text">{{ match.statistics.goals_t1 }} - {{ match.statistics.goals_t2 }}</span>
            <ul class="list-inline date-list">
                <li><i class="fa fa-clock-o"></i>05 : 30</li>
                <li><i class="fa fa-calendar"></i>10 / 4 / 2019</li>
            </ul>
        </div>

        <div v-if="match.statistics === null" class="flag-div-result">
            <span class="res-text finish">النتيجة متحددتش</span>
        </div>

        <div class="flag-div">
            <div class="flag-img">
                <img src="images/teams/2.png" alt="team" />
            </div>
            <template v-for="user in users">
                <span v-if="user.id == match.team2" :key="user.id" class="team-flag-name">{{ user.user_name }}</span>
            </template>
        </div>
        

    <br/>    
    <vue-goodshare-facebook page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-facebook>
    <vue-goodshare-twitter page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-twitter>
    <vue-goodshare-telegram page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-telegram>
    <vue-goodshare-viber page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-viber>
    <vue-goodshare-whatsapp page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-whatsapp>
    <vue-goodshare-line page_url="http://localhost/league_stadiums/register" has_icon></vue-goodshare-line>


    </div>
    <!--end team-flags-reasult-->


    
    
</template>

<script>

export default{
    data(){
      return{
        users: [],
      }
    },
    mounted() {
       
        axios.get('../api/users' , { headers: this.headers })
           .then(response => {
            this.users = response.data.data;
            //console.log(response.data.data);
            })
            .catch(error =>{
                this.errors.push(error);
                //console.log(error);
          });

          this.fetchPlayers(1)
                    
    },
    methods: {

        fetchPlayers(id){
             axios.get('../api/match/'+id , { headers: this.headers })
            .then(response => {
                this.match = response.data.data;
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


