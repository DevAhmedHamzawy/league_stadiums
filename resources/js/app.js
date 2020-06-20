require('./bootstrap');

window.Vue = require('vue');
import 'v-slim-dialog/dist/v-slim-dialog.css'
import SlimDialog from 'v-slim-dialog'
import * as VueGoogleMaps from 'vue2-google-maps'
import tinymce from 'vue-tinymce-editor'
import VueGoodshareFacebook from "vue-goodshare/src/providers/Facebook.vue";
import VueGoodshareTwitter from "vue-goodshare/src/providers/Twitter.vue";
import VueGoodshareTelegram from "vue-goodshare/src/providers/Telegram.vue";
import VueGoodshareViber from "vue-goodshare/src/providers/Viber.vue";
import VueGoodshareWhatsapp from "vue-goodshare/src/providers/Whatsapp.vue";
import VueGoodshareLine from "vue-goodshare/src/providers/Line.vue";
import VeeValidate from 'vee-validate';
import VeeValidateLaravel from 'vee-validate-laravel';


Vue.use(SlimDialog)

Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyDqET1nIDZzMGEieGANkEF_xB1RSCkJTjk',
      libraries: 'places',
      language: 'ar',
    },   
})

Vue.component('tinymce', tinymce)

Vue.component('VueGoodshareFacebook', VueGoodshareFacebook)
Vue.component('VueGoodshareTwitter', VueGoodshareTwitter)
Vue.component('VueGoodshareTelegram', VueGoodshareTelegram)
Vue.component('VueGoodshareViber', VueGoodshareViber)
Vue.component('VueGoodshareWhatsapp', VueGoodshareWhatsapp)
Vue.component('VueGoodshareLine', VueGoodshareLine)

Vue.use(VeeValidate);
Vue.use(VeeValidateLaravel);


/*----------- Visitors ------------*/
Vue.component('stadiums', require('./components/Stadiums.vue').default);
Vue.component('stadium', require('./components/Stadium.vue').default);

Vue.component('league', require('./components/League.vue').default);
Vue.component('leagues', require('./components/Leagues.vue').default);
/*----------- Visitors ------------*/


Vue.component('add-stadium', require('./components/stadiums/AddStadium.vue').default);
Vue.component('edit-stadium', require('./components/stadiums/EditStadium.vue').default);
Vue.component('owner-stadiums', require('./components/stadiums/Index.vue').default);


Vue.component('match', require('./components/matches/Show.vue').default);
Vue.component('matches', require('./components/matches/Index.vue').default);

Vue.component('add-match-statistics', require('./components/matches/AddMatchStatistics.vue').default);

Vue.component('teams-players-leagues', require('./components/TeamsPlayersLeagues.vue').default);

Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('edit-user', require('./components/users/EditUser.vue').default);


Vue.component('add-league', require('./components/leagues/AddLeague.vue').default);
Vue.component('edit-league', require('./components/leagues/EditLeague.vue').default);
Vue.component('organize-league', require('./components/leagues/OrganizeLeague.vue').default);


Vue.component('owner-leagues', require('./components/leagues/Index.vue').default);


Vue.component('contact', require('./components/Contact.vue').default);


Vue.component('comments', require('./components/comment/Comments.vue').default);

Vue.component('comment', require('./components/comment/CommentForm.vue').default);
Vue.component('reply', require('./components/comment/CommentReplyForm.vue').default);

Vue.component('players', require('./components/Players.vue').default);
Vue.component('team', require('./components/team.vue').default);


// Admin Panel
Vue.component('adminleagues', require('./components/admin/leagues.vue').default);
Vue.component('adminstadiums', require('./components/admin/stadiums.vue').default);
Vue.component('users', require('./components/admin/users/users.vue').default);
Vue.component('teamowners', require('./components/admin/users/teamowners.vue').default);
Vue.component('players', require('./components/admin/users/players.vue').default);
Vue.component('refrees', require('./components/admin/users/refrees.vue').default);
Vue.component('admins', require('./components/admin/admins/admins.vue').default);
Vue.component('articles', require('./components/admin/articles.vue').default);
Vue.component('tags', require('./components/admin/tags.vue').default);
Vue.component('settings', require('./components/admin/settings.vue').default);
Vue.component('widgets', require('./components/admin/widgets.vue').default);



const app = new Vue({
    el: '#app'
});
