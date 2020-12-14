<template>
    <section 
        :class="slider.sectionClass + ' wt-haslayout  wt-bannerholder'"
        :style="sectionStyle" 
        :id="slider.sectionId"
        v-if="Object.entries(slider).length != 0"
    >
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                    <div class="wt-bannerimages">
                        <figure class="wt-bannermanimg">
                            <!-- Inner Banner Image -->
                            <img 
                                :src="tempUrl+slider.inner_banner_image" 
                                alt="image"
                                v-if="newInnerBannerImage && slider.inner_banner_image"
                            >
                            <img 
                                :src="imageUrl+slider.inner_banner_image" 
                                alt="img description" 
                                v-else-if="pageID && slider.inner_banner_image"
                            />
                            <!-- Floating Image -->
                            <img 
                                :src="tempUrl+slider.floating_image01" 
                                alt="image"
                                class="wt-bannermanimgone"
                                v-if="newFloatingImg1 && slider.floating_image01"
                            >
                            <img 
                                :src="imageUrl+slider.floating_image01" 
                                alt="img description" 
                                class="wt-bannermanimgone"
                                v-else-if="pageID && slider.floating_image01"
                            />
                            <!-- Floating Image 2-->
                            <img 
                                :src="tempUrl+slider.floating_image02" 
                                alt="image"
                                class="wt-bannermanimgtwo"
                                v-if="newFloatingImg2 && slider.floating_image02"
                            >
                            <img 
                                :src="imageUrl+slider.floating_image02" 
                                alt="img description" 
                                class="wt-bannermanimgtwo"
                                v-else-if="pageID && slider.floating_image02"
                            />
                        </figure>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                    <div class="wt-bannercontent">
                        <div class="wt-bannerhead">
                            <div class="wt-title">
                                <h1 :style="{color:slider.subtitleColor}">
                                    <span :style="{color:slider.titleColor}">{{slider.title}}</span>
                                    {{slider.subtitle}}
                                </h1>
                            </div>
                            <div class="wt-description" v-html="slider.description"></div>
                        </div>
                        <search-form
                        :widget_type="'home'"
                        :placeholder="trans('lang.looking_for')"
                        :freelancer_placeholder="trans('lang.search_filter_list.freelancer')"
                        :employer_placeholder="trans('lang.search_filter_list.employers')"
                        :job_placeholder="trans('lang.search_filter_list.jobs')"
                        :service_placeholder="trans('lang.search_filter_list.services')"
                        :no_record_message="trans('lang.no_record')"
                        >
                        </search-form>
                        <div class="wt-videoholder" v-if="slider.video_link">
                            <div class="wt-videoshow">
                                <a data-rel="prettyPhoto[video]" :href="slider.video_link"><i class="fa fa-play"></i></a>
                            </div>
                            <div class="wt-videocontent">
                                <span>{{slider.video_title}}<em>{{slider.video_description}}</em></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Event from '../../../../event'
export default {
    props:['slider', 'pageID', 'element_id'],
    data() {
        return {
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            newSliderImage:false,
            newInnerBannerImage:false,
            newFloatingImg1:false,
            newFloatingImg2:false,
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.slider.padding ? `${this.slider.padding.top}${this.slider.padding.unit} ${this.slider.padding.right}${this.slider.padding.unit} ${this.slider.padding.bottom}${this.slider.padding.unit} ${this.slider.padding.left}${this.slider.padding.unit}` : '',
                margin: this.slider.margin ? `${this.slider.margin.top}${this.slider.margin.unit} ${this.slider.margin.right}${this.slider.margin.unit} ${this.slider.margin.bottom}${this.slider.margin.unit} ${this.slider.margin.left}${this.slider.margin.unit}` : '',
                'text-align': this.slider.alignment,
                background: this.newSliderImage ? 'url('+ this.tempUrl + this.slider.slider_image[0] +')' : this.pageID ? 'url('+ this.imageUrl + this.slider.slider_image[0] +')' : this.slider.sectionColor
            }
        },
    },
    mounted: function () {
        Event.$on('new-slider-inner-image'+this.element_id, (data) => {
            this.newInnerBannerImage = true
        })
        Event.$on('new-slider-floating-image1'+this.element_id, (data) => {
            this.newFloatingImg1 = true
        })
        Event.$on('new-slider-floating-image2'+this.element_id, (data) => {
            this.newFloatingImg2 = true
        })
        Event.$on('new-slider-slides-image'+this.element_id, (data) => {
            this.newSliderImage = true
        })
    } 
};
</script>