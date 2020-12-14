<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="job.sectionClass + ' wt-haslayout wt-main-section wt-section-bg wt-latestjobs-wrap'"
            :id="job.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(job).length != 0"
        >
            <div class="wt-overlay-2" :style="[newBgImage ?
                {'background-image': 'url('+tempUrl+job.backgroundImg+')'} :
                pageID && job.backgroundImg ?
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
                                <li  v-for="(job, index) in latestJobs" :key="index">
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
                                                <a href="javascript:void(0);" class="wt-btnlike"><i class="ti-heart"></i></a>
                                                <a :href="baseUrl+'/job/'+job.slug" class="wt-btntwo">{{trans("lang.view_job")}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="wt-btnarea">
                                <a href="javascript:void(0);" class="wt-btntwo" v-if="current_page < last_page" @click="loadJobs">{{trans("lang.load_more")}}</a>
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
            newBgImage:false,
            page: 1,
            pageSize: 4,
            last_page: 0,
            current_page: 0,
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
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('job-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
        Event.$on('new-job-bg-image'+self.element_id, (data) => {
            this.newBgImage = true
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        loadJobs: function () {
            this.page = this.page + 1
            this.getLatestJobs(this.page, this.pageSize, true)
        },
        getLatestJobs: function(page, per_page, load_more) {
            var self = this;
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
                        });
                    } else {
                        self.latestJobs = response.data.jobs
                    }
                    self.current_page = response.data.current_page
                    self.last_page = response.data.last_page
                }
            })
            .catch(function(error) {  });
        }
    },
    created: function() {
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
