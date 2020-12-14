<template>
    <div 
        :class="slider.sectionClass + ' wt-bannerholdervthree'"
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
                                :symbol="symbol"
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
        <div id="particles-js" class="wt-particles particles-js"></div>
        <!-- <carousel 
            id="wt-home-slider" 
            class="wt-home-slider"
            :items='1'
            :animateOut="'fadeOut'"
            :animateIn="'fadeIn'"
            :loop='true'
            :nav='false'
            :dots='false'
            :margin='0'
            :autoplay='true'
        > -->
        <div id="wt-home-slider" class="wt-home-slider owl-carousel owl-loaded owl-drag">
            <figure class="item" v-for="(slide, index) in slider.slider_image" :key="index">
                <img 
                    :src="imageUrl+slide" 
                    alt="img description" 
                    v-if="page_id"
                />
            </figure>
        </div>
        <!-- </carousel> -->
    </div>
</template>
<script>
import carousel from 'vue-owl-carousel'

export default {
    props:['slider', 'page_id', 'element_id', 'symbol'],
    components:{carousel},
    data () {
        return {
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.page_id+'/',
        }
    },
    mounted () {
        var self =this
        setTimeout(function(){ 
            self.intParticles()
        }, 3000);
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
    methods:{
        intParticles() {
            var particle1 = document.getElementById('particles-js')
            if (particle1 !== null) {
                particlesJS("particles-js",{
                    "particles": {
                        "number": {
                            "value": 65,
                            "density": {
                            "value_area": 600
                            }
                        },
                        "size": {
                        "value": 4,
                        "random": true,
                        },
                        "opacity": {
                        "value": 0.9,
                        },
                        "move": {
                        "enable": true,
                        "speed": 6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                            }
                        }
                    }
                })
            }
        },
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
    }
};
</script>