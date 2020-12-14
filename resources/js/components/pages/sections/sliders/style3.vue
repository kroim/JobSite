<template>
     <section 
        :class="slider.sectionClass + ' wt-haslayout  wt-bannerholdervtwo wt-bannerholderthree'"
        :style="sectionStyle" 
        :id="slider.sectionId"
        v-if="Object.entries(slider).length != 0"
    >
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="wt-bannercontent">
                        <div class="wt-bannerhead">
                            <div class="wt-title">
                                <h1 :style="{color:slider.subtitleColor}">
                                    <span><em :style="{color:slider.titleColor}">{{slider.title}}</em></span>
                                    {{slider.subtitle}}
                                </h1>
                            </div>
                            <div class="wt-description" v-if="slider.description" v-html="slider.description"></div>
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
                        <div class="wt-videoholder" v-if="slider.video_link && slider.video_link !='#'">
                            <div class="wt-videoshow">
                                <a data-rel="prettyPhoto[video]" :href="slider.video_link" rel="prettyPhoto[video]"><i class="fa fa-play"></i></a>
                            </div>
                            <div class="wt-videocontent" v-if="slider.video_description">
                                 <span><em>{{slider.video_description}}</em></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="wt-bannerslider-holder">
                        <div id="wt-bannerslider-two" class="wt-bannerslider-two owl-carousel" v-if="newSliderImage || page_id">
                            <div class="item" v-for="(slide, index) in slider.slider_image" :key="index">
                                <figure class="wt-bannerimg">
                                    <img 
                                        :src="tempUrl+slide" 
                                        alt="image"
                                        v-if="newSliderImage"
                                    >
                                    <img 
                                        :src="imageUrl+slide" 
                                        alt="img description" 
                                        v-else-if="pageID"
                                    />
                                </figure>
                            </div>
                        </div>
                        <figure class="wt-slidericons">
                            <!-- Floating Img 1 -->
                            <img 
                                :src="tempUrl+slider.floating_image01" 
                                alt="image"
                                class="wt-bannermanimgone"
                                v-if="newFloatingImg1"
                            >
                            <img 
                                :src="imageUrl+slider.floating_image01" 
                                alt="img description" 
                                class="wt-bannermanimgone"
                                v-else-if="pageID"
                            />
                            <!-- Floating Img 2 -->
                            <img 
                                :src="tempUrl+slider.floating_image02" 
                                alt="image"
                                class="wt-bannermanimgtwo"
                                v-if="newFloatingImg2"
                            >
                            <img 
                                :src="imageUrl+slider.floating_image02" 
                                alt="img description" 
                                class="wt-bannermanimgtwo"
                                v-else-if="pageID"
                            />
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import carousel from 'vue-owl-carousel'
import Event from '../../../../event'

export default {
    props:['slider', 'pageID', 'element_id'],
    components:{carousel},
    data () {
        return {
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            newSliderImage:false,
            newFloatingImg1:false,
            newFloatingImg2:false,
            page_id: this.pageID
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.slider.padding ? `${this.slider.padding.top}${this.slider.padding.unit} ${this.slider.padding.right}${this.slider.padding.unit} ${this.slider.padding.bottom}${this.slider.padding.unit} ${this.slider.padding.left}${this.slider.padding.unit}` : '',
                margin: this.slider.margin ? `${this.slider.margin.top}${this.slider.margin.unit} ${this.slider.margin.right}${this.slider.margin.unit} ${this.slider.margin.bottom}${this.slider.margin.unit} ${this.slider.margin.left}${this.slider.margin.unit}` : '',
                'text-align': this.slider.alignment,
                background: this.slider.sectionColor
            }
        },
    },
    mounted () {
        Event.$on('new-slider-floating-image1'+this.element_id, (data) => {
            this.newFloatingImg1 = true
        })
        Event.$on('new-slider-floating-image2'+this.element_id, (data) => {
            this.newFloatingImg2 = true
        })
        Event.$on('new-slider-slides-image'+this.element_id, (data) => {
            if (this.page_id) {
                this.page_id = false
            }
            this.newSliderImage = false
            var self = this
            setTimeout(function(){ 
                self.newSliderImage = true
            }, 10)
        })
        var slider = jQuery('.wt-bannerslider-two')
        slider.owlCarousel({
            items: 1,
            rtl:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            loop:true,
            nav:false,
            margin: 0,
            autoplay:true,
        });
    },
    updated () {
        var slider = jQuery('.wt-bannerslider-two')
        slider.owlCarousel({
            items: 1,
            rtl:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            loop:true,
            nav:false,
            margin: 0,
            autoplay:true,
        });
    }
};
</script>