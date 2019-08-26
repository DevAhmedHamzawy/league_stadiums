<template>
    <div>
        <div class="add">
            <form @submit.prevent="onSubmit" class="needs-validation icons-form row" novalidate>
                        
                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.goals_t1" minlength="1" placeholder="أهداف الفريق الأول" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                             {{ match.goals_t1 }}
                        </div>

                        <div class="form-group  col-12" v-for="(n,i) in match.goals_t1" :key="i">
                           <select class="form-control" name="goal" v-model="match.goals[i]">
                                <option selected disabled>... الهدف رفم {{ n }}</option>
                                <option v-for="player in players_team1" :key="player.id" :value="player.player_id" >{{ player.player.user_name }}</option>
                           </select>
                            <div class="invalid-feedback">
                                من فضلك أدخل الوصف للدورى 
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.goals_t2" minlength="1" placeholder="أهداف الفريق الثانى" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.yellowcards_t1" minlength="1" placeholder="الكروت الصفراء للفريق الأول" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.yellowcards_t2" minlength="1" placeholder="الكروت الصفراء للفريق الثانى" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.redcards_t1" minlength="1" placeholder="الكروت الحمراء للفريق الأول" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.redcards_t2" minlength="1" placeholder="الكروت الحمراء للفريق الثانى" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>


                        <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.penalties_t1" minlength="1" placeholder="ضربات الجزاء للفريق الأول" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                         <div class="form-group  col-12">
                            <i class="fa fa-cc-visa main-form-icon"></i>
                            <input type="number" class="form-control" v-model="match.penalties_t2" minlength="1" placeholder="ضربات الجزاء للفريق الثانى" required>
                            <div class="invalid-feedback">
                                من فضلك أدخل رقم صحيح
                            </div>
                        </div>

                        <div class="form-group  full-width-btn text-center submit-form-group col-12">
                            <button type="submit" class="custom_btn" data-hover="تسجيل "><span class="btn_text">تسجيل </span></button>
                        </div>


                    </form>

        </div>
    </div>
</template>

<script>
export default  {
  props: ['match_id'],   
  data(){
      return{
          match: {
              match_id: this.match_id,
              goals_t1: '',
              goals_t2: '',
              yellowcards_t1: '',
              yellowcards_t2: '',
              redcards_t1: '',
              redcards_t2: '',
              penalties_t1: '',
              penalties_t2: '',
              goals: [],
          },
          players_team1 : [],
      }
  },

  mounted() {
      
       axios.get('../../api/match/'+this.match_id , { headers: this.headers })
           .then(response => {
                this.match_data = response.data.data;

                axios.get('../../api/fetch_team/'+this.match_data.team1 , { headers: this.headers })
                .then(response => {
                    this.players_team1 = response.data.data;
                    //console.log(response.data.data);
                    })
                .catch(error =>{
                    this.errors.push(error);
                    //console.log(error);
                })


                axios.get('../../api/fetch_team/'+this.match_data.team2 , { headers: this.headers })
                .then(response => {
                    this.players_team2 = response.data.data;
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

  },

  methods: {
        onSubmit() {
            this.saved = false;

            axios.post('../../api/add_or_update_matchstatistics', this.match)
                .then(({data}) => this.setSuccessMessage())
                .catch(({response}) => this.setErrors(response));
        },

        setErrors(response) {
            this.errors = response.data.errors;
            console.log(this.errors);
        },

        setSuccessMessage() {
            this.reset();
            this.saved = true;
        },

        reset() {
            this.errors = [];
            this.signature = {name: null, email: null, body: null};
        }
  }
}

</script>