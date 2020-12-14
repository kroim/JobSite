<template>
     <section 
        :class="slider.sectionClass + ' wt-bannerholdervthree wt-bannervthree-wrap'"
        :style="sectionStyle" 
        :id="slider.sectionId"
        v-if="Object.entries(slider).length != 0"
    >
        <div class="wt-bannercontent-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="wt-bannerthree-content">
                            <search-form-v2 
                                :placeholder="trans('lang.looking_for')"
                                :no_record_message="trans('lang.no_record')"
                                :slider="slider"
                                v-if="slider.enable_search_form"
                            />
                            <div class="wt-bannerthree-title">
                                <span :style="{color:slider.taglineColor}">{{slider.tagline}}</span>
                                <h2 :style="{color:slider.subtitleColor}">
                                    <em :style="{color:slider.titleColor}">{{slider.title}}</em>
                                    {{slider.subtitle}}
                                </h2>
                                <div class="wt-description" v-if="slider.description" v-html="slider.description">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wt-home-slider" class="wt-home-slider owl-carousel owl-loaded owl-drag" v-if="newSliderImage || page_id">
            <figure class="item" v-for="(slide, index) in slider.slider_image" :key="index">
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
        var wt_home_slider = jQuery("#wt-home-slider")
        wt_home_slider.owlCarousel({
            items: 1,
            loop:true,
            nav:false,
            margin: 0,
            rtl:true,
            autoplay:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn'
        });
    },
    updated () {
        var wt_home_slider = jQuery("#wt-home-slider")
        wt_home_slider.owlCarousel({
            items: 1,
            loop:true,
            nav:false,
            margin: 0,
            rtl:true,
            autoplay:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn'
        });
    }
};
</script>