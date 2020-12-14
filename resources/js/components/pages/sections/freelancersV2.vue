<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="freelancer.sectionClass + ' wt-main-section wt-section-bg wt-freelancers-wrap'"
            :id="freelancer.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(freelancer).length != 0"
        >
            <div class="wt-overlay-4" :style="[newBgImage ?
                {'background-image': 'url('+tempUrl+freelancer.backgroundImg+')'} :
                pageID && freelancer.backgroundImg ?
                {'background-image': 'url('+imageUrl+freelancer.backgroundImg+')'} : '']"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="wt-sectionheadvthree wt-textcenter">
                            <div class="wt-sectiontitlevtwo">
                                <h2 :style="{color:freelancer.titleColor}">{{freelancer.title}} 
                                    <em :style="{color:freelancer.titleTwoColor}">{{freelancer.titleTwo}}</em>
                                </h2>
                            </div>
                            <div class="wt-description" v-if="freelancer.description" v-html="freelancer.description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- <carousel id="wt-freelancers-silder" class="wt-freelancers-silder" :items='3' :loop='true' :nav='false' :dots='true' 
                    :autoplay='false' :margin='30' v-if="filtersApplied"> -->
                        <div id="wt-freelancers-silder" class="wt-freelancers-silder owl-carousel">
                            <div class="wt-freelancer" v-for="(freelancer, index) in topFreelancers" :key="index">
                                <figure class="wt-freelancer-img">
                                    <img :src="freelancer.image" alt="image">
                                </figure>
                                <div class="wt-freelancer-head">
                                    <div class="wt-freelancer-tag">
                                        <a :href="baseUrl+'/profile/'+freelancer.slug">{{freelancer.name}}</a>
                                    </div>
                                    <div class="wt-title">
                                        <h3>{{freelancer.tagline}}</h3>
                                    </div>
                                    <div class="wt-freelancer-about">
                                        <div class="wt-freelancer-price"><span><i class="fas fa-money-bill-alt"></i> {{freelancer.symbol}}{{freelancer.hourly_rate}} / hr </span></div>
                                        <div class="wt-rating">
                                            <span class="wt-stars wt-starstwo"><span></span></span> <em>{{freelancer.average_rating_count}}{{ trans('lang.5') }}</em>
                                        </div>
                                    </div>
                                    <div class="wt-freelancer-social">
                                        <ul>
                                            <li v-for="(skill, item) in freelancer.skills" :key="item">
                                                <a href="javascript:void(0)">{{skill}}</a>
                                            </li>
                                            <li>
                                                <span>[<a href="javascript:void(0)">...</a>]</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <ul class="wt-freelancer-footer">
                                    <li>
                                        <address><i class="ti-location-pin"></i>{{freelancer.location}}</address>
                                    </li>
                                    <li v-if="freelancer.save_freelancers.includes(freelancer.id)">
                                        <a href="javascript:void(0);"  :id="'freelancer-'+freelancer.id" @click.prevent="add_wishlist('freelancer-'+freelancer.id, freelancer.id, 'saved_freelancer')">
                                        <i class="ti-heart"></i> {{trans("lang.saved")}}</a>
                                    </li>
                                    <li><a href="javascript:void(0);"  :id="'freelancer-'+freelancer.id" @click.prevent="add_wishlist('freelancer-'+freelancer.id, freelancer.id, 'saved_freelancer')">
                                        <i class="ti-heart"></i> {{trans("lang.save")}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <!-- </carousel> -->
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Event from '../../../event'
import carousel from 'vue-owl-carousel'

export default {
    props:['parent_index', 'element_id', 'freelancers', 'pageID'],
    components:{carousel},
    data() {
        return {
            freelancer:{},
            topFreelancers:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            filtersApplied: false,
            newBgImage:false,
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.freelancer.padding ? `${this.freelancer.padding.top}${this.freelancer.padding.unit} ${this.freelancer.padding.right}${this.freelancer.padding.unit} ${this.freelancer.padding.bottom}${this.freelancer.padding.unit} ${this.freelancer.padding.left}${this.freelancer.padding.unit}` : '',
                margin: this.freelancer.margin ? `${this.freelancer.margin.top}${this.freelancer.margin.unit} ${this.freelancer.margin.right}${this.freelancer.margin.unit} ${this.freelancer.margin.bottom}${this.freelancer.margin.unit} ${this.freelancer.margin.left}${this.freelancer.margin.unit}` : '',
                'text-align': this.freelancer.alignment,
                background: this.freelancer.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.freelancer.contentBackground,
                color:this.freelancer.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.freelancers, 'id', this.element_id)
        if (this.freelancer[index]) {
            this.freelancer = this.freelancer[index]
        }
        this.freelancer.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('freelancer-sectionV2-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
        Event.$on('new-freelancer-bg-image'+self.element_id, (data) => {
            this.newBgImage = true
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        add_wishlist: function (element_id, id, column, saved_text) {
            var self = this;
            axios.post(APP_URL + '/user/add-wishlist', {
                id: id,
                column: column,
            })
            .then(function (response) {
                if (response.data.authentication == true) {
                    if (response.data.type == 'success') {
                        if (column == 'saved_freelancer') {
                            jQuery('#' + element_id).parents('li').addClass('wt-btndisbaled');
                            jQuery('#' + element_id).addClass('wt-clicksave');
                            jQuery('#' + element_id).find('.save_text').text(Vue.prototype.trans('lang.saved'));
                            self.disable_btn = 'wt-btndisbaled';
                            self.text = Vue.prototype.trans('lang.btn_save');
                            self.saved_class = 'fa fa-heart';
                            self.click_to_save = 'wt-clicksave'
                        }
                        self.showMessage(response.data.message);
                    } else {
                        self.showError(response.data.message);
                    }
                } else {
                    self.showError(response.data.message);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getTopFreelancers: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-top-freelancers")
            .then(function(response) {
                if (response.data.type == "success") {
                    self.topFreelancers =response.data.freelancers
                    self.filtersApplied = true
                    /* Freelancer Slider */
                    Vue.nextTick(function() {
                        var wt_freelancers_silder = jQuery(".wt-freelancers-silder")
                        wt_freelancers_silder.owlCarousel({
                            item: 3,
                            loop:true,
                            nav:false,
                            margin: 30,
                            rtl:true,
                            autoplay:false,
                            dots: true,
                            dotsClass: 'wt-sliderdots',
                            responsiveClass:true,
                        
                        });
                    })
                }
            })
            .catch(function(error) {  });
        }
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.freelancers, 'id', self.element_id)
            if (self.freelancers[index]) {
                self.freelancer = self.freelancers[index]
            }
        }, 100);
        this.getTopFreelancers()
    },
};
</script>
