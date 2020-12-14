<template>
    <section 
        :class="job.sectionClass + ' wt-haslayout wt-main-section wt-section-bg wt-latestjobs-wrap'"
        :id="job.sectionId" 
        :style="sectionStyle" 
        v-if="Object.entries(job).length != 0"
    >
        <div class="wt-border-bg">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 109"><defs></defs><title>img-06</title><path class="cls-3" style="fill: #f5f7fa;fill-rule: evenodd;" d="M0,0c392.2,126.94,699.94,121.9,932.18,75.56,42.25-8.42,62.22-14.27,109.76-24.18,340.48-70.91,642-47.06,878.06,0V109H.17Z"/></svg>
        </div>
        <div class="wt-overlay-2" :style="[pageID ?
                {'background-image': 'url('+imageUrl+job.backgroundImg+')'} : '']"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="wt-sectionheadvthree wt-textcenter">
                        <div class="wt-sectiontitlevtwo">
                            <h2 :style="{color:job.titleColor}">{{job.title}} 
                                <em :style="{color:job.titleTwoColor}">{{job.titleTwo}}</em>
                            </h2>
                        </div>
                        <div class="wt-description"  v-if="job.description" v-html="job.description">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="wt-latestjobs">
                        <ul>
                            <li  v-for="(job, index) in latestJobs" :key="index" @mouseover="mouseOver">
                                <div class="wt-latestjob-holder">
                                    <div class="wt-latestjob-head">
                                        <figure class="wt-latestjob-logo">
                                            <img :src="job.user_image" alt="img description">
                                        </figure>
                                        <div class="wt-latestjob-title">
                                            <div class="wt-latestjob-tag">
                                                <a :href="baseUrl+'/profile/'+job.user_slug"> {{ job.user_name }} </a>
                                            </div>
                                            <h4> 
                                                <a :href="baseUrl+'/job/'+job.slug">{{ job.title }}</a>
                                            </h4>
                                            <span>{{ job.location }}</span>
                                        </div>
                                        <div class="wt-latestjob-right">
                                            <span>{{trans("lang.remuneration")}}</span>
                                            <h4><sup>{{ job.symbol }}</sup>{{ job.price }}</h4>
                                            <span>{{ job.duration }}</span>
                                        </div>
                                    </div>
                                    <div class="wt-latestjob-footer">
                                        <div class="wt-widgettag">
                                            <a :href="baseUrl+'/search-results?type=job&skills%5B%5D='+skill.slug" v-for="(skill, item) in job.skills" :key="item">{{skill.title}}</a>
                                        </div>
                                        <div class="wt-btnarea">
                                            <a v-if="job.saved_jobs.includes(job.id)" class="wt-btnlike liked wt-btndisbaled">
                                                <i class="ti-heart"></i>
                                            </a>
                                            <a v-else href="javascript:void(0);" class="wt-btnlike"  :id="'job-'+job.id" @click.prevent="add_wishlist('job-'+job.id, job.id, 'saved_jobs', trans('lang.saved'))">
                                                <i class="ti-heart"></i>
                                            </a>
                                            <a :href="baseUrl+'/job/'+job.slug" class="wt-btntwo">{{trans("lang.view_job")}}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="wt-btnarea">
                            <a href="javascript:void(0);" class="wt-btntwo" v-if="current_page < last_page" @click="loadJobs">{{trans("lang.load_more")}}</a>
                            <div v-if="is_loading" class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import carousel from 'vue-owl-carousel'

export default {
    props:['parent_index', 'element_id', 'jobs', 'pageID'],
    components:{carousel},
    data() {
        return {
            job:{},
            latestJobs:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            page: 1,
            pageSize: 4,
            last_page: 0,
            current_page: 0,
            is_loading:false
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.job.padding ? `${this.job.padding.top}${this.job.padding.unit} ${this.job.padding.right}${this.job.padding.unit} ${this.job.padding.bottom}${this.job.padding.unit} ${this.job.padding.left}${this.job.padding.unit}` : '',
                margin: this.job.margin ? `${this.job.margin.top}${this.job.margin.unit} ${this.job.margin.right}${this.job.margin.unit} ${this.job.margin.bottom}${this.job.margin.unit} ${this.job.margin.left}${this.job.margin.unit}` : '',
                'text-align': this.job.alignment,
                background: this.job.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.job.contentBackground,
                color:this.job.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.jobs, 'id', this.element_id)
        if (this.job[index]) {
            this.job = this.job[index]
        }
        this.job.id = this.element_id
    },
    methods:{
        mouseOver () {
             $(".wt-latestjobs ul li").hover(function() {
                $(this).addClass('active')
                    .siblings().removeClass('active')
            });
        },
        loadJobs: function () {
            this.page = this.page + 1
            this.getLatestJobs(this.page, this.pageSize, true)
        },
        getLatestJobs: function(page, per_page, load_more) {
            var self = this;
            if (load_more) {
                self.is_loading = true
                $('.wt-btnarea').addClass('wt-btnloader')
            }
            axios
            .post(APP_URL + "/get-latest-jobs", {
                page: page,
                per_page: per_page
            })
            .then(function(response) {
                if (response.data.type == "success") {
                    if (load_more) {
                        response.data.jobs.forEach(element => {
                            self.latestJobs.push(element)
                            self.is_loading = false
                            $('.wt-btnarea').removeClass('wt-btnloader')
                        });
                    } else {
                        self.latestJobs = response.data.jobs
                        setTimeout(function() {

                            if ($('.wt-latestjobs ul li:nth-child(2)')) {
                                $('.wt-latestjobs ul li:nth-child(2)').addClass("active")
                            }
                        },1000)
                    }
                    self.current_page = response.data.current_page
                    self.last_page = response.data.last_page
                }
            })
            .catch(function(error) {  });
        },
        add_wishlist: function (element_id, id, column, saved_text) {
            var self = this;
            axios.post(APP_URL + '/user/add-wishlist', {
                id: id,
                column: column,
            })
                .then(function (response) {
                    if (response.data.authentication == true) {
                        if (column == 'saved_jobs') {
                            jQuery('#' + element_id).addClass('wt-btndisbaled');
                            jQuery('#' + element_id).addClass('liked');
                        }
                        if (column == 'saved_employers') {
                            self.disable_follow = 'wt-btndisbaled';
                            self.follow_text = saved_text;
                        }
                        self.showMessage(response.data.message);
                    } else {
                        self.showError(response.data.message);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
    created: function () {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.jobs, 'id', self.element_id)
            if (self.jobs[index]) {
                self.job = self.jobs[index]
            }
        }, 100);
        this.getLatestJobs(this.page, this.pageSize, false)
    },
};
</script>
