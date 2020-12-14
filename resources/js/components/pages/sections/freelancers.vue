<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="freelancer.sectionClass + ' wt-haslayout  wt-main-section'"
            :id="freelancer.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(freelancer).length != 0"
        >
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-8">
                        <div class="wt-sectionhead wt-textcenter">
                            <div class="wt-sectiontitle">
                                <h2 :style="{color:freelancer.titleColor}" >{{freelancer.title}}</h2>
                                <span :style="{color:freelancer.subtitleColor}">{{freelancer.subtitle}}</span>
                            </div>
                            <div class="wt-description" v-if="freelancer.description" v-html="freelancer.description"></div>
                        </div>
                    </div>
                    <div class="wt-topfreelancers">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 float-left" v-for="(freelancer, index) in topFreelancers" :key="index">
                            <div class="wt-freelanceritems">
                                <div class="wt-userlistinghold wt-featured">
                                    <div class="wt-userlistingcontent">
                                        <figure>
                                            <img :src="freelancer.image" alt="image">
                                            <div class="wt-userdropdown wt-away template-content tipso_style wt-tipso" data-tipso="Offline"></div>
                                        </figure>
                                        <div class="wt-contenthead">
                                            <div class="wt-title">
                                                <a :href="baseUrl+'/profile/'+freelancer.slug"><i class="fa fa-check-circle"></i> {{freelancer.name}}</a>
                                                <h2>{{freelancer.tagline}}</h2>
                                            </div>
                                        </div>
                                        <div class="wt-viewjobholder">
                                            <ul>
                                                <li><span><i class="far fa-money-bill-alt"></i>{{freelancer.symbol}}{{freelancer.hourly_rate}} / hr</span></li>
                                                <li><span><em><img :src="baseUrl+freelancer.flag" alt="img description"></em>{{freelancer.location}}</span></li>
                                                <li v-if="freelancer.save_freelancers.includes(freelancer.id)" class="wt-btndisbaled">
                                                    <a href="javascript:void(0);" class="wt-clicksave"><i class="fa fa-heart"></i>{{ trans('lang.saved') }}</a>
                                                </li>
                                                <li v-else>
                                                    <a href="javascrip:void(0);" class="wt-clicklike" :id="'freelancer-'+freelancer.id" @click.prevent="add_wishlist('freelancer-'+freelancer.id, freelancer.id, 'saved_freelancer')">
                                                        <i class="fa fa-heart"></i><span class="save_text">{{trans("lang.click_to_save")}}</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript:void(0);" class="wt-freestars"><i class="fas fa-star"> </i>{{freelancer.average_rating_count}}{{ trans('lang.5') }} <em> ({{freelancer.total_reviews}} {{ trans('lang.feedbacks') }})</em></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'freelancers', 'pageID'],
    data() {
        return {
            freelancer:{},
            topFreelancers:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
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
        Event.$on('freelancer-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        getTopFreelancers: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-top-freelancers")
            .then(function(response) {
                if (response.data.type == "success") {
                    self.topFreelancers =response.data.freelancers
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
