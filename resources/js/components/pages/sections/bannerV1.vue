<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <div 
            :class="[banner.backgroundType =='gradient' ? 'wt-bannersevenvtwo' :'' , banner.sectionClass + ' wt-homebannerseven']"
            :id="banner.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(banner).length != 0"
        >
            <div class="container">
				<div class="row">
					<div class="col-12 col-lg-8">
						<div class="wt-bannercontent wt-bannercontentseven">
							<div class="wt-bannerhead">
								<div class="wt-title">
									<h1 :style="{color:banner.subtitleColor}"><span :style="{color:banner.titleColor}" v-if="banner.title">{{ banner.title }}</span> {{ banner.subtitle }}</h1>
								</div>
							</div>
                            <search-form
                                :widget_type="'home'"
                                :placeholder="trans('lang.looking_for')"
                                :freelancer_placeholder="trans('lang.search_filter_list.freelancer')"
                                :employer_placeholder="trans('lang.search_filter_list.employers')"
                                :job_placeholder="trans('lang.search_filter_list.jobs')"
                                :service_placeholder="trans('lang.search_filter_list.services')"
                                :no_record_message="trans('lang.no_record')"
                                :style_type="'new'"
                                v-if="banner.showSearchForm"
                                >
                            </search-form>
							<div class="wt-videoholder">
								<div class="wt-videoshow">
									<a data-rel="prettyPhoto[video]" :href="banner.videoUrl" rel="prettyPhoto[video]"><i class="fa fa-play"></i></a>
								</div>
								<div class="wt-videocontent">
									<span>{{banner.videoTitle}}<em>{{banner.videoDesc}}</em></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-4">
						<figure class="wt-homeseven-img" v-if="banner.frontImg">
                            <img 
                                :src="tempUrl+banner.frontImg" 
                                alt="image"
                                v-if="newFrontImage"
                            >
                            <img 
                                :src="imageUrl+banner.frontImg" 
                                alt="img description" 
                                v-else-if="pageID"
                            />
						</figure>
					</div>
				</div>
			</div>
        </div>
    </div>
</template>
<script>
import Event from '../../../event'
import carousel from 'vue-owl-carousel'

export default {
    props:['parent_index', 'element_id', 'banner_sec', 'pageID'],
    components:{carousel},
    data() {
        return {
            banner:{},
            topPackages:[],
            package_options:[],
            roleType:false,
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            filtersApplied: false,
            newFrontImage: false,
            newBannerImage: false,
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.banner.padding ? `${this.banner.padding.top}${this.banner.padding.unit} ${this.banner.padding.right}${this.banner.padding.unit} ${this.banner.padding.bottom}${this.banner.padding.unit} ${this.banner.padding.left}${this.banner.padding.unit}` : '',
                margin: this.banner.margin ? `${this.banner.margin.top}${this.banner.margin.unit} ${this.banner.margin.right}${this.banner.margin.unit} ${this.banner.margin.bottom}${this.banner.margin.unit} ${this.banner.margin.left}${this.banner.margin.unit}` : '',
                'text-align': this.banner.alignment,
                // background: this.newBannerImage ? 'url('+ this.tempUrl + this.banner.backgroundImg+')' : this.pageID && this.banner.backgroundImg ? 'url('+ this.imageUrl + this.banner.backgroundImg+')' : '',
                // 'background-image': this.banner.backgroundType =='gradient' ? 'url(' + this.bg_check+'),' + 'linear-gradient(' + this.banner.gradientStyle + ','+ this.banner.gradient1 +',' + this.banner.gradient2 + ')' 
                //     : this.newBannerImage ? 'url('+ this.tempUrl + this.banner.backgroundImg+')' : this.pageID && this.banner.backgroundImg ? 'url('+ this.imageUrl + this.banner.backgroundImg+')' : ''
                'background-image': this.banner.backgroundType =='gradient' ? ['url(' +  (this.newBannerImage?  this.tempUrl + this.banner.backgroundImg : this.pageID && this.banner.backgroundImg ? this.imageUrl + this.banner.backgroundImg : '') +'),' + 'linear-gradient(' + this.banner.gradientStyle + ','+ this.banner.gradient1 +',' + this.banner.gradient2 + ')'] 
                    : [this.newBannerImage ? 'url('+ this.tempUrl + this.banner.backgroundImg+')' : this.pageID && this.banner.backgroundImg ? 'url('+ this.imageUrl + this.banner.backgroundImg+')' : '']
            }
        },
        contentSectionStyle() {
            return {
                background:this.banner.contentBackground,
                color:this.banner.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.banner_sec, 'id', this.element_id)
        if (this.banner[index]) {
            this.banner = this.banner[index]
        }
        this.banner.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('banner-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
        Event.$on('new-banner-front-image'+self.element_id, (data) => {
            this.newFrontImage = true
        })
        Event.$on('new-banner-bg-image'+self.element_id, (data) => {
            this.newBannerImage = true
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
            var index = self.getArrayIndex(self.banner_sec, 'id', self.element_id)
            if (self.banner_sec[index]) {
                self.banner = self.banner_sec[index]
            }
        }, 100);
    },
};
</script>
