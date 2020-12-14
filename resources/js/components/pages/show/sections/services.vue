<template>
    <section 
        :class="service.sectionClass + ' wt-haslayout  wt-main-section'"
        :id="service.sectionId" 
        :style="sectionStyle" 
        v-if="Object.entries(service).length != 0"
    >
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                    <div class="wt-sectionhead wt-textcenter wt-topservices-title">
                        <div class="wt-sectiontitle">
                            <h2 :style="{color:service.titleColor}" v-if="service.title">{{ service.title }}</h2>
                            <span :style="{color:service.subtitleColor}" v-if="service.subtitle">{{ service.subtitle }}</span>
                        </div>
                        <div class="wt-description" v-if="service.description" v-html="service.description"></div>
                    </div>
                </div>
                <div class="wt-freelancers-holder wt-freelancers-home row" v-if="access_type == 'service' || access_type == 'both'">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left" v-for="(service_item, index) in serviceList" :key="index">
                        <div :class="'wt-freelancers-info ' +service_item.no_attachments">
                            <!-- <carousel id="wt-freelancers-silder" class="wt-freelancers wt-freelancers-silder" :items='1' :loop='true' :nav='false' :dots='false' :autoplay='false' v-if="service_item.attachments && service_item.seller.length > 0"> -->
                                <div :class="'wt-freelancers ' +service_item.enable_slider" v-if="service_item.attachments && service_item.seller.length > 0">
                                    <figure class="item" v-for="(attachment, attachmentIndex) in service_item.attachments" :key="attachmentIndex">
                                        <a :href="baseUrl+'/profile/'+service_item.seller[0].slug" v-if="service_item.seller[0].slug"><img :src="attachment" alt="img description" class="item"></a>
                                    </figure>
                                </div>
                            <!-- </carousel> -->
                            <span class="wt-featuredtagvtwo" v-if="service_item.is_featured = 'true'">{{ trans('lang.featured') }}</span>
                            <div class="wt-freelancers-details">
                                <figure class="wt-freelancers-img" v-if="service_item.seller_count > 0">
                                    <img :src="service_item.seller_image" alt="img description">
                                </figure>
                                <div class="wt-freelancers-content">
                                    <div class="dc-title">
                                        <a :href="baseUrl+'/profile/'+service_item.seller[0].slug" v-if="service_item.seller_count > 0">
                                            <i class="fa fa-check-circle"></i> {{service_item.seller_name}}
                                        </a>
                                        <a :href="baseUrl+'/service/'+service_item.slug"><h3>{{service_item.title}}</h3></a>
                                        <span><strong>{{ service_item.symbol }} {{service_item.price}}</strong> {{trans('lang.starting_from')}}</span>
                                    </div>
                                </div>
                                <div class="wt-freelancers-rating">
                                    <ul>
                                        <li><span><i class="fa fa-star"></i>{{service_item.service_rating}}/<i>5</i> ({{service_item.service_reviews}})</span></li>
                                        <li>
                                            <i class="fa fa-spinner fa-spin" v-if="service_item.total_orders > 0"></i>
                                            {{service_item.total_orders}} {{ trans('lang.in_queue') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
// import Event from '../../../event'
import carousel from 'vue-owl-carousel'

export default {
    props:['parent_index', 'element_id', 'services', 'pageID', 'access_type'],
    components:{carousel},
    data() {
        return {
            service:{},
            serviceList:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.service.padding ? `${this.service.padding.top}${this.service.padding.unit} ${this.service.padding.right}${this.service.padding.unit} ${this.service.padding.bottom}${this.service.padding.unit} ${this.service.padding.left}${this.service.padding.unit}` : '',
                margin: this.service.margin ? `${this.service.margin.top}${this.service.margin.unit} ${this.service.margin.right}${this.service.margin.unit} ${this.service.margin.bottom}${this.service.margin.unit} ${this.service.margin.left}${this.service.margin.unit}` : '',
                'text-align': this.service.alignment,
                background: this.service.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.service.contentBackground,
                color:this.service.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.services, 'id', this.element_id)
        if (this.service[index]) {
            this.service = this.service[index]
        }
        this.service.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('service-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    methods:{
        getServices: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-services")
            .then(function(response) {
                if (response.data.type == "success") {
                    self.serviceList =response.data.services
                    Vue.nextTick(function(){
                        var _wt_freelancerslider = jQuery('.wt-freelancerslider')
                        _wt_freelancerslider.owlCarousel({
                            items: 1,
                            loop:true,
                            rtl:true,
                            nav:true,
                            margin: 0,
                            autoplay:false,
                            navClass: ['wt-prev', 'wt-next'],
                            navContainerClass: 'wt-search-slider-nav',
                            navText: ['<span class="lnr lnr-chevron-left"></span>', '<span class="lnr lnr-chevron-right"></span>'],
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
            var index = self.getArrayIndex(self.services, 'id', self.element_id)
            if (self.services[index]) {
                self.service = self.services[index]
            }
        }, 100);
        this.getServices()
    },
};
</script>
