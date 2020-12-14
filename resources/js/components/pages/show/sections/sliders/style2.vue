<template>
    <div 
        :class="slider.sectionClass + ' wt-haslayout wt-bannerholdervtwo'"
        :style="sectionStyle" 
        :id="slider.sectionId"
        v-if="Object.entries(slider).length != 0"
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="wt-bannercontent">
                        <div class="wt-bannerhead">
                            <div class="wt-title">
                                <h1><span>{{slider.title}}</span>{{slider.subtitle}}</h1>
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
                        <div class="wt-videoholder" v-if="slider.video_link && slider.video_link !='#'">
                            <div class="wt-videoshow">
                                <a data-rel="prettyPhoto[video]" :href="slider.video_link" rel="prettyPhoto[video]"><i class="fa fa-play"></i></a>
                            </div>
                            <div class="wt-videocontent">
                                <span>{{slider.video_title}} <em>{{slider.video_description}}</em></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wt-bgworkslider" class="wt-bgworkslider owl-carousel">
            <div class="item" v-for="(slide, index) in slider.slider_image" :key="index">
                <figure>
                    <img :src="imageUrl+slide" alt="slideimg">
                </figure>
            </div>
        </div>
    </div>	
</template>
<script>
export default {
    props:['page_id'],
    data() {
        return {
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.page_id+'/',
            slider:[],
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.slider.padding ? `${this.slider.padding.top}${this.slider.padding.unit} ${this.slider.padding.right}${this.slider.padding.unit} ${this.slider.padding.bottom}${this.slider.padding.unit} ${this.slider.padding.left}${this.slider.padding.unit}` : '',
                margin: this.slider.margin ? `${this.slider.margin.top}${this.slider.margin.unit} ${this.slider.margin.right}${this.slider.margin.unit} ${this.slider.margin.bottom}${this.slider.margin.unit} ${this.slider.margin.left}${this.slider.margin.unit}` : '',
                'text-align': this.slider.alignment,
                background: this.slider.slider_image.length > 0 ? '' : this.slider.sectionColor
            }
        },
    },
    updated() {
        jQuery("a[data-rel]").each(function () {
            jQuery(this).attr("rel", jQuery(this).data("rel"));
        });
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'dark_square',
            slideshow: 3000,
            default_width: 800,
            default_height: 500,
            allowfullscreen: true,
            autoplay_slideshow: false,
            social_tools: false,
            iframe_markup: "<iframe src='{path}' width='{width}' height='{height}' frameborder='no' allowfullscreen='true'></iframe>",
            deeplinking: false
        });
    },
    methods:{
        async getSlider () {
            var self = this;
            await axios
            .get(APP_URL + "/get-home-slider/"+self.page_id)
            .then(function(response) {
                if (response.data.type == "success") {
                   self.slider = response.data.slider
                   Vue.nextTick(function() {
                        var slider = jQuery('.wt-bgworkslider')
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
                   }.bind(self))
                }
            })
            .catch(function(error) {  });
        }
    },
    created: function() {
        this.getSlider()
    },
};
</script>