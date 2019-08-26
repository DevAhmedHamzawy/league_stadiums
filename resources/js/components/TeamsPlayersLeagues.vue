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
        
        
        
            <!--start search-pg
                     ================-->
            <section class="search-pg marg-sec">
                <div class="container">
                    <div class="row">
                        <div class="col-12 wow fadeInUp">
                            <p class="text-center">البحث عن ملعب ضع عنوانك او اسم الملعب ليظهر لك النتائج المحيطه </p>
                            <form @submit.prevent="search()" class="needs-validation icons-form row" novalidate>
                                <div class="form-group col-md-8">
                                    <i class="fa fa-search main-form-icon"></i>
                                    <input type="text" class="form-control" placeholder=" إبحث هنا من فضلك ..." v-model="query" required />
                                </div>
                                <div class="form-group col-md-4 text-center">
                                    <button class="dark_btn custom_btn big-btn" data-hover="إعرض النتائج "><span class="btn_text">إعرض النتائج <i class="fa fa-plus"></i> </span></button>
                                </div>
                            </form>
        
                        </div>
                    </div>
        
                    <!--start search-result-->
                    <div class="search-result">
                        <div class="row">
        
        
                            <!--start search-list-grid-->
                            <div class="col-xl-4 col-md-6 search-list-grid  load-div" v-for="result in results" :key="result.id">
                                <div class="search-list-div row col-12">
                                    <div class="full-width-img search-img col-sm-4">
                                        <img src="public/images/players/1.png" class="converted-img" alt="player" />
                                    </div>
                                    <div class="side-search col-sm-8">
                                        <div v-if="result.user_name !== ''">
                                            <h3>{{ result.user_name }}</h3>
                                        </div>
                                        <div v-if="result.name !== ''">
                                            <h3>{{ result.name }}</h3>
                                        </div>
                                        <div class="search-rate">
                                            <div class="inner-search-rate">
                                                القاهره
                                                <ul class="list-inline stars-list">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half"></i></li>
                                                </ul>
                                                <span class="rate-ratio">4.5</span>
                                            </div>
                                            <a href="user-profile.html" class="custom_btn" data-hover="تفاصيل "><span class="btn_text">تفاصيل <i class="fa fa-check"></i></span></a>
                                        </div>
                                    </div>
                                    <div class="player-qualifications row col-12">
        
        
                                        <div class="col-sm-3 col-6">
                                            <span>المركز</span>
                                            مدافع
                                        </div>
        
                                        <div class="col-sm-3 col-6">
                                            <span>السرعة</span>
                                            65%
                                        </div>
        
                                        <div class="col-sm-3 col-6">
                                            <span>المهارة</span>
                                            65%
                                        </div>
        
                                        <div class="col-sm-3 col-6">
                                            <span>التسديد</span>
                                            65%
                                        </div>
        
        
                                    </div>
                                </div>
                            </div>
                            <!--end search-list-grid-->
        
                          
                            
            
                
        
                     
        
        
                        </div>
        
                    </div>
                    <!--end search-result-->
        
                    <div class="text-center col-12">
                        <div class="dark_btn big-btn custom_btn no-bord-rad" id="loadMore" data-hover="إعرض المزيد"><span class="btn_text"><i class="fa fa-plus"></i>إعرض المزيد</span></div>
                    </div>
        
                </div>
            
                
            </section>
            <!--end search-pg  -->    
    </div>
</template>

<script>
export default {

    data() {
        return {

            results: [],
            query: ''

        }
    },   
    methods: {
        search() {
            // Clear the error message.
            this.error = '';
            // Empty the results array so we can fill it with the new results.
            this.results = [];
            
            // Making a get request to our API and passing the query to it.
            axios.get('api/search?q=' + this.query).then((response) => {
                // If there was an error set the error message, if not fill the results array.
                response.data.error ? this.error = response.data.error : this.results = response.data;
                // Clear the query.
                this.query = '';
            });
        }
    }
     
}
</script>
