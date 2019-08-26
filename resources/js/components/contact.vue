<template>
    <div>
         <!--start contact-pg
             ================-->
    <section class="contact-pg  marg-sec">
        <div class="container">
            <div class="row">


                <div id="map">
                      <GmapMap
                            :center="{lat:31.0454418, lng:31.385583}"
                            :zoom="15"
                            map-type-id="terrain"
                            style="width: 100%; height: 300px"
                            >
                            <gmap-marker :position="{lat:31.0454418, lng:31.3855839}" />
                            </GmapMap>
                </div>

                <!--start contact-form-grid-->
                <div class="col-lg-7  contact-form-grid">
                    <div class="contact-info-form wow fadeIn">
                        <h3 class="contact-title"><i class="fa fa-envelope-o"></i>إترك<span class="contact-title-span">رسالتك</span></h3>
                        <form @submit.prevent="onSubmit()" class="needs-validation border-form row" novalidate>
                            <div class="form-group  col-12">
                                <input type="text" class="form-control" v-model="contact.name" placeholder="اسمك الكريم" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل إسم صحيح
                                </div>
                            </div>



                            <div class="form-group  col-12">
                                <input type="email" class="form-control" v-model="contact.email" placeholder="البريد الالكتروني" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل بريد إلكتروني صحيح
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <input type="number" class="form-control" v-model="contact.mobile" placeholder="رقم الموبايل" required>
                                <div class="invalid-feedback">
                                    من فضلك أدخل رقم صحيح
                                </div>
                            </div>

                           

                            <div class="form-group  col-12">
                                <textarea class="form-control" v-model="contact.text" placeholder="الرساله" required></textarea>
                                <div class="invalid-feedback">
                                    من فضلك أدخل الرساله
                                </div>
                            </div>


                            <div class="form-group submit-form-group col-12">
                                <button type="submit" class="arrow_btn">إرسال</button>
                            </div>



                        </form>
                    </div>
                </div>
                <!--end contact-form-grid-->



                <!--start contact-info-grid-->
                <div class="col-lg-5  contact-info-grid">
                    <div class="contact-info wow fadeIn">
                        <h3 class="contact-title"><i class="fa fa-envelope-o"></i>معلومات<span class="contact-title-span">الاتصال</span></h3>
                        <ul class="list-unstyled">
                            <li class="wow fadeInUp">
                                <span class="square-icon"><i class="fa fa-map-marker"></i></span>
                                <div class="contact-side-info">
                                    <p>
                                       لأى شكوى أو إقتراح الرجاء تواصل معانا على الأرقام دى
                                    </p>
                                </div>
                            </li>

                            <li class="wow fadeInUp">
                                <span class="square-icon"><i class="fa fa-phone"></i></span>
                                <div class="contact-side-info">
                                    <span class="contact-info-span num-span">1064626369</span>
                                    <span class="contact-info-span num-span">1064626369</span>
                                </div>
                            </li>

                            <li class="wow fadeInUp">
                                <span class="square-icon"><i class="fa fa-envelope"></i></span>
                                <div class="contact-side-info">
                                    <a class="contact-info-span" href="mailto:Admin@domainname">Admin@domainname</a>
                                    <a class="contact-info-span" href="mailto:Admin@domainname">Admin@domainname</a>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
                <!--end contact-info-grid-->


            </div>
        </div>
    </section>
    <!--end contact-pg -->

    </div>
</template>

<script>
export default  {
  data(){
      return{
          contact: {
              name: '',
              email: '',
              mobile: '',
              text: '',
          }
      }
  },

  methods: {
        onSubmit() {
            this.saved = false;

            axios.post('api/add_or_update_contacts', this.contact)
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