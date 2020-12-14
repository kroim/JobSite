<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="work_video.sectionClass + ' wt-haslayout  wt-main-section'"
            :id="work_video.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(work_video).length != 0"
        >
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                        <div class="wt-sectionhead wt-textcenter wt-topservices-title">
                            <div class="wt-sectiontitle">
                                <h2 v-if="work_video.title" :style="{color:work_video.titleColor}">{{work_video.title}}</h2>
                                <span v-if="work_video.subtitle" :style="{color:work_video.subtitleColor}">{{work_video.subtitle}}</span>
                            </div>
                            <div class="wt-description" v-if="work_video.description" :style="{color:work_video.descColor}" v-html="work_video.description"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 push-lg-1">
                        <div class="wt-workvideo-holder">
                            <figure class="wt-workvideo-img" v-if="work_video.video_poster">
                                <a data-rel="prettyPhoto[video]" :href="work_video.video_link" rel="prettyPhoto[video]">
                                    <img 
                                        :src="tempUrl+work_video.video_poster" 
                                        alt="image"
                                        v-if="newVideoPosterImage && work_video.video_poster"
                                    >
                                    <img 
                                        :src="imageUrl+work_video.video_poster" 
                                        alt="img description" 
                                        v-else-if="pageID && work_video.video_poster"
                                    />
                                </a>
                            </figure>
                            <figure class="wt-workvideo" v-else>
                                <a data-rel="prettyPhoto[video]" :href="work_video.video_link" rel="prettyPhoto[video]">
                                    <img :src="baseUrl+'/images/default-video.png'" alt="video img">
                                </a>
                            </figure>
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
    props:['parent_index', 'element_id', 'work_sec', 'pageID'],
    data() {
        return {
            work_video:{},
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            newVideoPosterImage: false
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.work_video.padding ? `${this.work_video.padding.top}${this.work_video.padding.unit} ${this.work_video.padding.right}${this.work_video.padding.unit} ${this.work_video.padding.bottom}${this.work_video.padding.unit} ${this.work_video.padding.left}${this.work_video.padding.unit}` : '',
                margin: this.work_video.margin ? `${this.work_video.margin.top}${this.work_video.margin.unit} ${this.work_video.margin.right}${this.work_video.margin.unit} ${this.work_video.margin.bottom}${this.work_video.margin.unit} ${this.work_video.margin.left}${this.work_video.margin.unit}` : '',
                'text-align': this.work_video.alignment,
                background: this.work_video.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.work_video.contentBackground,
                color:this.work_video.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.work_sec, 'id', this.element_id)
        if (this.work_video[index]) {
            this.work_video = this.work_video[index]
        }
        this.work_video.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('work-video-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })

        Event.$on('new-video-poster-image'+self.element_id, (data) => {
            this.newVideoPosterImage = true
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.work_sec, 'id', self.element_id)
            if (self.work_sec[index]) {
                self.work_video = self.work_sec[index]
            }
        }, 100);
    },
};
</script>
