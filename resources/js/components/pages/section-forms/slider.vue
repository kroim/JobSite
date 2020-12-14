<template>
    <div class="element-form-wrapper" v-if="slider">
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <div class="amt-select">
                        <select class="form-control" v-model="slider.style">
                        <option value= null>{{ trans('lang.select_style') }}</option> 
                        <option v-for="(style, index) in styles" :key="index" :value="style.value">{{style.title}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" v-model="slider.title" :placeholder="trans('lang.title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="slider.subtitle" :placeholder="trans('lang.subtitle')" class="form-control">
                </div>
                <div class="form-group" v-if="slider.style == 'style4'">
                    <input type="text" v-model="slider.tagline" :placeholder="trans('lang.tagline')" class="form-control">
                </div>
                <div class="form-group">
                    <tinymce-editor v-model="slider.description" :init="{height: 250, plugins: 'paste link code advlist autolink lists link charmap print', toolbar1: 'undo redo code | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist', menubar:false, statusbar: false, extended_valid_elements:'span[style],i[class]'}"></tinymce-editor>
                </div>
                <div class="form-group">
                    <input type="text" v-model="slider.video_title" :placeholder="trans('lang.video_title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="slider.video_description" :placeholder="trans('lang.video_desc')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="slider.video_link" :placeholder="trans('lang.video_url')" class="form-control">
                </div>
                <!-- Slider Multiple Image -->
                <div class="wt-settingscontent wt-multipleimgs" v-if="slider.style == 'style1' || slider.style == 'style2' || slider.style == 'style3' || slider.style == 'style4'">
                    <div class="wt-formtheme wt-userform">
                        <upload-image 
                            :id="'slider_image'+currentElementID" 
                            :img_ref="'slider_banner_ref'+currentElementID" 
                            :url="baseURL+'/admin/pages/upload-temp-image/slider_image'+currentElementID"
                            :name="'slider_image'+currentElementID"
                            :max_images="10"
                            :hidden_name="'slider_hiddenImg'+currentElementID"
                            @addedFile="fileAdded('preview-wrapper'+currentElementID, 'hidden_inner_slider_image'+currentElementID, 'slider_image', currentElementID)"
                            @addedSuccess="addedSuccess()"
                            >
                        </upload-image>
                        <div :class="'slider_image'+currentElementID" :id="'preview-wrapper'+currentElementID">
                            <div :class="'wt-uploadingbox'+ ' db-pre'+currentElementID" v-for="(slide, slideIndex) in slider.slider_image" :key="slideIndex" :id="'list_id_image'+currentElementID+slideIndex" v-if="slider.slider_image">
                                <div class="dz-preview dz-file-preview">
                                    <figure>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+slide" @error="OldImageError('slider_image')" v-if="pageID && !newSliderImage">
                                        <img :src="tempUrl+slide" @error="TempImageError('slider_image')" v-else-if="!pageID || newSliderImage">
                                    </figure>
                                    <div class="wt-uploadingbar">
                                        <div class="dz-filename" v-if="slide">{{slide}}</div>
                                        <em><a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeMultiImage('list_id_image'+currentElementID+slideIndex, slideIndex)"></a></em>
                                    </div>
                                </div>
                                <input type="hidden" :name="'slider_hiddenImg'+currentElementID" :id="'attachment-'+slideIndex" :value="slide"> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Inner Banner Image -->
                <div 
                    class="at-profile-setting__upload inner_banner_image dc-settingscontent" 
                    :id="'inner_banner_image_wrapper'+currentElementID"
                    v-if="slider.style == 'style1'"
                >
                    <page-media
                        :parent_id="'inner_banner_image_wrapper'+currentElementID"
                        :id="'inner_banner_image'+currentElementID"
                        :img_ref="'inner_banner_image'+currentElementID"
                        :name="'inner_banner_image'"
                        :url="baseURL+'/admin/pages/upload-temp-image/inner_banner_image'"
                        :preview_class="'inner_banner_image_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_inner_banner_image'+currentElementID"
                        :list_id="'list_id_inner_banner_image'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.inner_banner_img')"
                        @addedFile="imageAdded('inner_banner_image_wrapper'+currentElementID, 'innerBannerImage', 'inner_banner_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('innerBannerImage')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'inner_banner_image_preview'+currentElementID">
                            <li :id="'inner_banner_hiddenImage'+currentElementID" v-if="slider.inner_banner_image">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+slider.inner_banner_image" @error="OldImageError('innerBannerImage')" v-if="pageID && !newInnerBannerImage">
                                        <img :src="tempUrl+slider.inner_banner_image" @error="TempImageError('innerBannerImage')" v-else-if="!pageID || newInnerBannerImage">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('innerBannerImage', 'inner_banner_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="slider.inner_banner_image" name="image" :id="'inner_banner_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Floating Image 1 -->
                <div 
                    class="at-profile-setting__upload floating_image01 dc-settingscontent" 
                    :id="'floating_image01_wrapper'+currentElementID"
                    v-if="slider.style == 'style1' || slider.style == 'style3'"
                >
                    <page-media
                        :parent_id="'floating_image01_wrapper'+currentElementID"
                        :id="'floating_image01'+currentElementID"
                        :img_ref="'floating_image01'+currentElementID"
                        :name="'floating_image01'"
                        :url="baseURL+'/admin/pages/upload-temp-image/floating_image01'"
                        :preview_class="'floating_image01_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_floating_image01'+currentElementID"
                        :list_id="'list_id_floating_image01'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.floating_img1')"
                        @addedFile="imageAdded('floating_image01_wrapper'+currentElementID, 'floatingImage01', 'floating01_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('floatingImage01')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'floating_image01_preview'+currentElementID">
                            <li :id="'floating01_hiddenImage'+currentElementID" v-if="slider.floating_image01">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+slider.floating_image01" @error="OldImageError('floatingImage01')" v-if="pageID && !newFloatingImg1">
                                        <img :src="tempUrl+slider.floating_image01" @error="TempImageError('floatingImage01')" v-else-if="!pageID || newFloatingImg1">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('floatingImage01', 'floating01_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="slider.floating_image01" name="image" :id="'floating01_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Floating Image 2 -->
                <div 
                    class="at-profile-setting__upload floating_image02 dc-settingscontent" 
                    :id="'floating_image02_wrapper'+currentElementID"
                    v-if="slider.style == 'style1' || slider.style == 'style3'"
                >
                    <page-media
                        :parent_id="'floating_image02_wrapper'+currentElementID"
                        :id="'floating_image02'+currentElementID"
                        :img_ref="'floating_image02'+currentElementID"
                        :name="'floating_image02'"
                        :url="baseURL+'/admin/pages/upload-temp-image/floating_image02'"
                        :preview_class="'floating_image02_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_floating_image02'+currentElementID"
                        :list_id="'list_id_floating_image02'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.floating_img2')"
                        @addedFile="imageAdded('floating_image02_wrapper'+currentElementID, 'floatingImage02', 'floating02_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('floatingImage02')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'floating_image02_preview'+currentElementID">
                            <li :id="'floating02_hiddenImage'+currentElementID" v-if="slider.floating_image02">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+slider.floating_image02" @error="OldImageError('floatingImage02')" v-if="pageID && !newFloatingImg2">
                                        <img :src="tempUrl+slider.floating_image02" @error="TempImageError('floatingImage02')" v-else-if="!pageID || newFloatingImg2">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('floatingImage02', 'floating02_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="slider.floating_image02" name="image" :id="'floating02_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="amt-element-title amt-element-titlecontent" v-if="slider.style == 'style4'">
                    <h6>{{trans('lang.search_form')}}:</h6>
                </div>
                <div class="amt-switches-option" v-if="slider.style == 'style4'">
                    <div class="at-account-checkbox">
                        <div class="at-on-off">
                            <input type="checkbox" id="show_banner_search_form" v-model="slider.enable_search_form">
                            <label for="show_banner_search_form"><i></i></label>
                        </div>
                        <p>{{ trans('lang.show_search_form') }}</p>
                    </div>
                </div>
                <div class="form-group" v-if="slider.style == 'style4'">
                    <input type="text" v-model="slider.search_form_title" :placeholder="trans('lang.search_title')" class="form-control">
                </div>
                <div class="form-group" v-if="slider.style == 'style4'">
                    <input type="text" v-model="slider.search_form_subtitle" :placeholder="trans('lang.search_subtitle')" class="form-control">
                </div>
                <div class="form-group" v-if="slider.style == 'style4'">
                    <input type="text" v-model="slider.price_range_title" :placeholder="trans('lang.pricing_title')" class="form-control">
                </div>
                <div class="form-group" v-if="slider.style == 'style4'">
                    <input type="text" v-model="slider.listing_tagline" :placeholder="trans('lang.listing_tagline')" class="form-control">
                </div>
            </fieldset>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"><h3>{{ trans('lang.style') }}</h3></div>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.title_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="slider.titleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="slider.subtitleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.tagline_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="slider.taglineColor"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"> <h3>{{ trans('lang.sec_style') }}</h3></div>
        </div>
          <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.section_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="slider.sectionColor"></verte>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group" v-if="slider.padding">
                    <div class="amt-element-title">
                         <h6>{{ trans('lang.padding') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="slider.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="slider.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="slider.padding.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="slider.padding.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="slider.padding.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="slider.padding.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group" v-if="slider.margin">
                    <div class="amt-element-title">
                        <h6>{{ trans('lang.margin') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="slider.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="slider.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="slider.margin.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="slider.margin.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="slider.margin.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="slider.margin.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group"><input type="text" v-model="slider.sectionClass" :placeholder="trans('lang.sec_class')" class="form-control"></div>
                <div class="form-group"><input type="text" v-model="slider.sectionId" :placeholder="trans('lang.sec_id')" class="form-control"></div>
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
    props:['parent_index', 'element_id', 'slider', 'pageID', 'styles', 'currentElementID', 'cloneElement'],
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            newFloatingImg1: false,
            newFloatingImg2: false,
            newInnerBannerImage: false,
            newSliderImage: false,
        }
    },
    methods:{
        addedSuccess: function () {
            Event.$emit('new-slider-slides-image'+this.currentElementID)
        },
        imageAdded: function(hiddenID, imageType, hiddenGenerateImage) {
            var self = this
            setTimeout(function(){ 
               if (document.querySelector('#'+hiddenID+ ' .at-profile-setting__imgs ul li [type="hidden"]')) {
                    var hidddenImage = document.querySelector('#'+hiddenID+ ' .at-profile-setting__imgs ul li [type="hidden"]');
                    let image = hidddenImage.value
                    if (imageType == 'floatingImage01') {
                        if (image) {
                            self.slider.floating_image01 = image
                            Event.$emit('new-slider-floating-image1'+self.currentElementID)
                            self.newFloatingImg1 = true
                        } else {
                            self.slider.floating_image01 = null
                        }
                    } else if (imageType == 'floatingImage02') {
                        if (image) {
                            self.slider.floating_image02 = image
                            Event.$emit('new-slider-floating-image2'+self.currentElementID)
                            self.newFloatingImg2 = true
                        } else {
                            self.slider.floating_image02 = null
                        }
                    } else if (imageType == 'innerBannerImage') {
                        if (image) {
                            self.slider.inner_banner_image = image
                            Event.$emit('new-slider-inner-image'+self.currentElementID)
                            self.newInnerBannerImage = true
                        } else {
                            self.slider.inner_banner_image = null
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
        fileAdded: function(id, hiddenID, imageType, parentIndex) {
            if(imageType == 'slider_image') {
                var imageWrapper = document.getElementById(id)
                var childEmelemt = []
                var i;
                for(i = 0; i < imageWrapper.childNodes.length; i++){
                    var child = imageWrapper.childNodes[i];
                    childEmelemt.push(document.getElementById(child.id))
                }
                this.slider.slider_image  = this.getUploadedImages(childEmelemt)
                Event.$emit('new-slider-slides-image'+this.currentElementID)
                this.newSliderImage = true
                setTimeout(function(){ jQuery('.db-pre'+parentIndex).remove() }, 1000);
            }
        },
        getUploadedImages (listitems) {
            var i;
            var imageList = [];
            if (listitems.length > 0) {
                for (i=0; i<listitems.length; i++) {
                    var hidddenImage = document.querySelector('#'+listitems[i].id + ' input[type=hidden]');
                    let image = document.getElementById(hidddenImage.id).value
                    imageList.push(image)
                }
                return imageList
            } else {
                return imageList
            }
        },
        imageRemoved: function(imageType) {
            // if (this.cloneElement == false) {
                if (imageType == 'floatingImage01') {
                    if (this.slider.floating_image01) {
                        this.slider.floating_image01 = null
                    }
                } else if (imageType == 'floatingImage02') {
                    if (this.slider.floating_image02) {
                        this.slider.floating_image02 = null
                    }
                } else if (imageType == 'innerBannerImage') {
                    if (this.slider.inner_banner_image ) {
                        this.slider.inner_banner_image = null
                    } 
                }
            // }
        },
        removeImage: function(imageType, hiddenID) {
            if (imageType == 'floatingImage01') {
                if (this.slider.floating_image01) {
                    this.slider.floating_image01 = null
                }
            } else if (imageType == 'floatingImage02') {
                if (this.slider.floating_image02) {
                    this.slider.floating_image02 = null
                }
            } else if (imageType == 'innerBannerImage') {
                if (this.slider.inner_banner_image ) {
                    this.slider.inner_banner_image = null
                } 
            }
            document.getElementById(hiddenID).remove()
        },
        removeMultiImage (id, index) {
            this.slider.slider_image.splice(index, 1) 
        },
        TempImageError (type) {
            if (type == 'floatingImage01') {
                this.newFloatingImg1 = false
            } else if (type == 'floatingImage02') {
                this.newFloatingImg2 = false
            } else if (type == 'innerBannerImage') {
                this.newInnerBannerImage = false
            } else if (type == 'slider_image') {
                this.newSliderImage = false
            }
        },
        OldImageError (type) {
            if (type == 'floatingImage01') {
                this.newFloatingImg1 = true
            } else if (type == 'floatingImage02') {
                this.newFloatingImg2 = true
            } else if (type == 'innerBannerImage') {
                this.newInnerBannerImage = true
            } else if (type == 'slider_image') {
                this.newSliderImage = true
            }
        }
    }
};
</script>
