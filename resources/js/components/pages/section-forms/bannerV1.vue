<template>
    <div class="element-form-wrapper" v-if="banner">
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <input type="text" v-model="banner.title" :placeholder="trans('lang.sec_title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="banner.subtitle" :placeholder="trans('lang.sec_subtitle')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="banner.videoTitle" :placeholder="trans('lang.video_title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="banner.videoDesc" :placeholder="trans('lang.video_desc')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="banner.videoUrl" :placeholder="trans('lang.video_url')" class="form-control">
                </div>
                <div class="amt-switches-option">
                    <div class="at-account-checkbox">
                        <div class="at-on-off">
                            <input type="checkbox" id="show_banner_search_form" v-model="banner.showSearchForm">
                            <label for="show_banner_search_form"><i></i></label>
                        </div>
                        <p>{{ trans('lang.show_search_form') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="amt-select">
                        <select class="form-control" v-model="banner.backgroundType"> 
                        <option v-for="(type, index) in getBackgroundTypes()" :key="index" :value="type.value">{{type.title}}</option>
                        </select>
                    </div>
                </div>
                <div 
                    class="at-profile-setting__upload front_img dc-settingscontent" 
                    :id="'front_img_wrapper'+currentElementID"  v-if="changeFound"
                >
                    <page-media
                        :parent_id="'front_img_wrapper'+currentElementID"
                        :id="'front_img'+currentElementID"
                        :img_ref="'front_img'+currentElementID"
                        :name="'front_img'"
                        :url="baseURL+'/admin/pages/upload-temp-image/front_img'"
                        :preview_class="'front_img_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_front_img'+currentElementID"
                        :list_id="'list_id_front_img'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.front_img')"
                        @addedFile="imageAdded('front_img_wrapper'+currentElementID, 'frontImg', 'front_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('frontImg')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'front_img_preview'+currentElementID">
                            <li :id="'front_hiddenImage'+currentElementID" v-if="banner.frontImg">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+banner.frontImg" @error="OldImageError('frontImg')" v-if="pageID && !newFrontImg">
                                        <img :src="tempUrl+banner.frontImg" @error="TempImageError('frontImg')" v-else-if="!pageID || newFrontImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('frontImg', 'front_hiddenImage'+currentElementID)">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </span>
                                        <span class="at-tick">
                                            <span>
                                                <i class="fas fa-check"></i>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                                <input type="hidden" :value="banner.frontImg" name="image" :id="'front_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <div 
                    class="at-profile-setting__upload bg_img dc-settingscontent" 
                    :id="'bg_img_wrapper'+currentElementID"  v-if="changeFound"
                >
                    <page-media
                        :parent_id="'bg_img_wrapper'+currentElementID"
                        :id="'bg_img'+currentElementID"
                        :img_ref="'bg_img'+currentElementID"
                        :name="'bg_img'"
                        :url="baseURL+'/admin/pages/upload-temp-image/bg_img'"
                        :preview_class="'bg_img_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_bg_img'+currentElementID"
                        :list_id="'list_id_bg_img'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.bg_img')"
                        @addedFile="imageAdded('bg_img_wrapper'+currentElementID, 'bgImg', 'bg_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('bgImg')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'bg_img_preview'+currentElementID">
                            <li :id="'bg_hiddenImage'+currentElementID" v-if="banner.backgroundImg">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+banner.backgroundImg" @error="OldImageError('bgImg')" v-if="pageID && !newBgImg">
                                        <img :src="tempUrl+banner.backgroundImg" @error="TempImageError('bgImg')" v-else-if="!pageID || newBgImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('bgImg', 'bg_hiddenImage'+currentElementID)">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </span>
                                        <span class="at-tick">
                                            <span>
                                                <i class="fas fa-check"></i>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                                <input type="hidden" :value="banner.backgroundImg" name="image" :id="'bg_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="amt-dhb-main_content" v-if="banner.backgroundType =='gradient'">
            <div class="amt-dhb-heading"><h3>{{ trans('lang.background_gradient') }}</h3></div>
        </div>
        <div class="form-group" v-if="banner.backgroundType =='gradient'">
            <div class="amt-select">
                <select class="form-control" v-model="banner.gradientStyle"> 
                    <option v-for="(style, index) in getGradientStyles()" :key="index" :value="style.value">{{style.title}}</option>
                </select>
            </div>
        </div>
        <div class="amt-element-title amt-element-titlecontent" v-if="banner.backgroundType =='gradient'">
            <h6>{{ trans('lang.gradient_one') }}</h6>
            <verte menuPosition="right" model="hex" v-model="banner.gradient1"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent" v-if="banner.backgroundType =='gradient'">
            <h6>{{ trans('lang.gradient_two') }}</h6>
            <verte menuPosition="right" model="hex" v-model="banner.gradient2"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"><h3>{{ trans('lang.style') }}</h3></div>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.title_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="banner.titleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent" v-if="banner.style == 'style3'">
            <h6>{{ trans('lang.title_two_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="banner.titleTwoColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="banner.subtitleColor"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"> <h3>{{ trans('lang.sec_style') }}</h3></div>
        </div>
          <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.section_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="banner.sectionColor"></verte>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <div class="amt-element-title">
                         <h6>{{ trans('lang.padding') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="banner.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="banner.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="banner.padding.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="banner.padding.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="banner.padding.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="banner.padding.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="amt-element-title">
                        <h6>{{ trans('lang.margin') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="banner.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="banner.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="banner.margin.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="banner.margin.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="banner.margin.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="banner.margin.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group"><input type="text" v-model="banner.sectionClass" :placeholder="trans('lang.sec_class')" class="form-control"></div>
                <div class="form-group"><input type="text" v-model="banner.sectionId" :placeholder="trans('lang.sec_id')" class="form-control"></div>
            </fieldset>
        </div>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue'
import Event from '../../../event'

export default {
    components: {
        'tinymce-editor': Editor
    },
    props:['parent_index', 'element_id', 'banner', 'pageID', 'styles', 'currentElementID', 'cloneElement'],
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            newBgImg: false,
            newFrontImg: false,
            changeFound:true
        }
    },
    watch:{
        currentElementID: function (change) {
            this.changeFound = false
            setTimeout(() => {
                this.changeFound = true
            }, 200);
        }
    },
    methods:{
        imageAdded: function(hiddenID, imageType, hiddenGenerateImage) {
            var self = this
            setTimeout(function(){ 
               if (document.querySelector('#'+hiddenID+ ' .at-profile-setting__imgs ul li [type="hidden"]')) {
                    var hidddenImage = document.querySelector('#'+hiddenID+ ' .at-profile-setting__imgs ul li [type="hidden"]');
                    let image = hidddenImage.value
                    if (imageType == 'bgImg') {
                        if (image) {
                            self.banner.backgroundImg = image
                            Event.$emit('new-banner-bg-image'+self.currentElementID)
                            self.newBgImg = true
                        } else {
                            self.banner.backgroundImg = null
                        }
                    } else if (imageType == 'frontImg') {
                        if (image) {
                            self.banner.frontImg = image
                            Event.$emit('new-banner-front-image'+self.currentElementID)
                            self.newFrontImg = true
                        } else {
                            self.banner.frontImg = null
                        }
                    }
                } 
            }, 120);
            setTimeout(function(){ 
                if (document.getElementById(hiddenGenerateImage)) {
                    document.getElementById(hiddenGenerateImage).remove()
                }
            }, 130);
        },
        imageRemoved: function(imageType) {
            // if (this.cloneElement == false) {
                if (imageType == 'bgImg') {
                    if (this.banner.backgroundImg) {
                        this.banner.backgroundImg = null
                    }
                } else if (imageType == 'frontImg') {
                    if (this.banner.frontImg ) {
                        this.banner.frontImg = null
                    } 
                }
            // }
        },
        removeImage: function(imageType, hiddenID) {
            if (imageType == 'bgImg') {
                if (this.banner.backgroundImg) {
                    this.banner.backgroundImg = null
                }
            } else if (imageType == 'frontImg') {
                if (this.banner.frontImg ) {
                    this.banner.frontImg = null
                } 
            }
            document.getElementById(hiddenID).remove()
        },
        TempImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = false
            } else if (type == 'frontImg') {
                this.newFrontImg = false
            }
        },
        OldImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = true
            } else if (type == 'frontImg') {
                this.newFrontImg = true
            }
        }
    }
};
</script>
