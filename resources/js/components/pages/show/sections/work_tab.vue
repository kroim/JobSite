<template>
    <section 
        :class="work.sectionClass + ' wt-haslayout  wt-main-section wt-workholder'"
        :id="work.sectionId" 
        :style="sectionStyle" 
        v-if="Object.entries(work).length != 0"
    >
        <div class="container">
            <div class="row justify-content-center align-self-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-8 push-lg-2">
                    <div class="wt-sectionhead wt-textcenter wt-howswork">
                        <div class="wt-sectiontitle">
                            <h2 v-if="work.title" :style="{color:work.titleColor}">{{work.title}}</h2>
                            <span v-if="work.subtitle" :style="{color:work.subtitleColor}">{{work.subtitle}}</span>
                        </div>
                        <div class="wt-description" :style="{color:work.descColor}" v-if="work.description" v-html="work.description"></div>
                    </div>
                </div>
            </div>
            <div class="wt-haslayout wt-workprocess">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="wt-workdetails">
                                <div class="wt-workdetail" v-if="work.first_tab_icon">
                                    <figure>
                                        <img 
                                            :src="tempUrl+work.first_tab_icon" 
                                            alt="image"
                                            v-if="newFirstTabImage"
                                        >
                                        <img 
                                            :src="imageUrl+work.first_tab_icon" 
                                            alt="img description" 
                                            v-else-if="pageID"
                                        />
                                    </figure>
                                </div>
                                <div class="wt-title">
                                    <span v-if="work.first_tab_subtitle">{{work.first_tab_subtitle}}</span>
                                    <h3 v-if="work.first_tab_title"><a href="javascript:void(0);">{{work.first_tab_title}}</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="wt-workdetails wt-workdetails-border">
                                <div class="wt-workdetail" v-if="work.second_tab_icon">
                                    <figure>
                                        <img 
                                            :src="tempUrl+work.second_tab_icon" 
                                            alt="image"
                                            v-if="newSecondTabImage"
                                        >
                                        <img 
                                            :src="imageUrl+work.second_tab_icon" 
                                            alt="img description" 
                                            v-else-if="pageID"
                                        />
                                    </figure>
                                </div>
                                <div class="wt-title">
                                    <span v-if="work.second_tab_subtitle">{{work.second_tab_subtitle}}</span>
                                    <h3 v-if="work.second_tab_title"><a href="javascript:void(0);">{{work.second_tab_title}}</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="wt-workdetails wt-workdetails-bordertwo">
                                <div class="wt-workdetail" v-if="work.third_tab_icon">
                                    <figure>
                                        <img 
                                            :src="tempUrl+work.third_tab_icon" 
                                            alt="image"
                                            v-if="newThirdTabImage"
                                        >
                                        <img 
                                            :src="imageUrl+work.third_tab_icon" 
                                            alt="img description" 
                                            v-else-if="pageID"
                                        />
                                    </figure>
                                </div>
                                <div class="wt-title">
                                    <span v-if="work.third_tab_subtitle">{{work.third_tab_subtitle}}</span>
                                    <h3 v-if="work.third_tab_title"><a href="javascript:void(0);">{{work.third_tab_title}}</a></h3>
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
export default {
    props:['parent_index', 'element_id', 'work_sec', 'pageID'],
    data() {
        return {
            work:{},
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            newFirstTabImage:false,
            newSecondTabImage:false,
            newThirdTabImage:false
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.work.padding ? `${this.work.padding.top}${this.work.padding.unit} ${this.work.padding.right}${this.work.padding.unit} ${this.work.padding.bottom}${this.work.padding.unit} ${this.work.padding.left}${this.work.padding.unit}` : '',
                margin: this.work.margin ? `${this.work.margin.top}${this.work.margin.unit} ${this.work.margin.right}${this.work.margin.unit} ${this.work.margin.bottom}${this.work.margin.unit} ${this.work.margin.left}${this.work.margin.unit}` : '',
                'text-align': this.work.alignment,
                background: !this.work.background_image ? this.work.sectionColor : '',
                'background-image': this.pageID ? 'url('+ this.imageUrl + this.work.background_image+')' : 'url('+ this.tempUrl + this.work.background_image+')'
            }
        },
        contentSectionStyle() {
            return {
                background:this.work.contentBackground,
                color:this.work.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.work_sec, 'id', this.element_id)
        if (this.work[index]) {
            this.work = this.work[index]
        }
        this.work.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('work-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })

        Event.$on('new-first-tab-image', (data) => {
            this.newFirstTabImage = true
        })
        Event.$on('new-second-tab-image', (data) => {
            this.newSecondTabImage = true
        })
        Event.$on('new-third-tab-image', (data) => {
            this.newThirdTabImage = true
        })
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.work_sec, 'id', self.element_id)
            if (self.work_sec[index]) {
                self.work = self.work_sec[index]
            }
        }, 100);
    },
};
</script>
