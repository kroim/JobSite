<template>
    <div class="element-form-wrapper" v-if="welcome">
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading">
                <h3>{{trans('lang.first_sec_detail')}}</h3>
            </div>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <!-- First Tab -->
                <div class="form-group">
                    <input placeholder="Title" v-model="welcome.first_title" type="text" value="" class="form-control">
                </div> 
                <div class="form-group">
                    <input placeholder="First Section Button Text" v-model="welcome.first_url_button" type="text" value="" class="form-control">
                </div>
                <div class="form-group">
                    <input placeholder="First Section Url" v-model="welcome.first_url" type="text" value="" class="form-control">
                </div>
                <div class="form-group">
                    <tinymce-editor v-model="welcome.first_description" :init="{height: 350, plugins: 'paste link code advlist autolink lists link charmap print', toolbar1: 'undo redo code | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist', menubar:false, statusbar: false, extended_valid_elements:'span[style],i[class]'}"></tinymce-editor>
                </div>
                <!-- Second Tab -->
                <div class="amt-dhb-main_content">
                    <div class="amt-dhb-heading">
                        <h3>{{trans('lang.second_tab')}}</h3>
                    </div>
                </div>
                <div class="form-group">
                    <input placeholder="Title" v-model="welcome.second_title" type="text" value="" class="form-control">
                </div> 
                <div class="form-group">
                    <input placeholder="Second Section Button Text" v-model="welcome.second_url_button" type="text" value="" class="form-control">
                </div>
                <div class="form-group">
                    <input placeholder="Second Section Url" v-model="welcome.second_url" type="text" value="" class="form-control">
                </div>
                <div class="form-group">
                    <tinymce-editor v-model="welcome.second_description" :init="{height: 350, plugins: 'paste link code advlist autolink lists link charmap print', toolbar1: 'undo redo code | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist', menubar:false, statusbar: false, extended_valid_elements:'span[style],i[class]'}"></tinymce-editor>
                </div>
                <!-- Background Image -->
                <div 
                    class="at-profile-setting__upload bg_img dc-settingscontent" 
                    :id="'bg_img_wrapper'+currentElementID" v-if="changeFound"
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
                            <li :id="'bg_hiddenImage'+currentElementID" v-if="welcome.welcome_background">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+welcome.welcome_background" @error="OldImageError('bgImg')" v-if="pageID && !newBgImg">
                                        <img :src="tempUrl+welcome.welcome_background" @error="TempImageError('bgImg')" v-else-if="!pageID || newBgImg">
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
                                <input type="hidden" :value="welcome.welcome_background" name="image" :id="'bg_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"><h3>{{ trans('lang.style') }}</h3></div>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{trans('lang.first_sec_style')}}</h6>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.title_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="welcome.firstTitleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="welcome.firstDescColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.btn_text_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="welcome.firstBtnColor"></verte>
        </div>
        <!-- Second Sec Style -->
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{trans('lang.second_sec_style')}}</h6>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.title_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="welcome.secondTitleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="welcome.secondDescColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.btn_text_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="welcome.secondBtnColor"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"> <h3>{{ trans('lang.sec_style') }}</h3></div>
        </div>
          <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.section_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="welcome.sectionColor"></verte>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group" v-if="welcome.padding">
                    <div class="amt-element-title">
                         <h6>{{ trans('lang.padding') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="welcome.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="welcome.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="welcome.padding.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="welcome.padding.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="welcome.padding.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="welcome.padding.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group" v-if="welcome.margin">
                    <div class="amt-element-title">
                        <h6>{{ trans('lang.margin') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="welcome.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="welcome.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="welcome.margin.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="welcome.margin.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="welcome.margin.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="welcome.margin.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group"><input type="text" v-model="welcome.sectionClass" :placeholder="trans('lang.sec_class')" class="form-control"></div>
                <div class="form-group"><input type="text" v-model="welcome.sectionId" :placeholder="trans('lang.sec_id')" class="form-control"></div>
            </fieldset>
        </div>
    </div>
</template>
<script>
import Event from '../../../event'
import Editor from '@tinymce/tinymce-vue'
export default {
    props:['parent_index', 'element_id', 'welcome', 'pageID', 'cloneElement', 'currentElementID'],
    components: {
        'tinymce-editor': Editor
    },
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            newBgImg:false,
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
                            self.welcome.welcome_background = image
                            Event.$emit('new-welcome-background-image'+self.currentElementID)
                            this.newBgImg = true
                        } else {
                            self.welcome.welcome_background = null
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
            if (this.cloneElement == false) {
                if (imageType == 'bgImg') {
                    if (this.welcome.welcome_background) {
                        this.welcome.welcome_background = null
                    }
                }
            }
        },
        removeImage: function(imageType, hiddenID) {
            if (imageType == 'bgImg') {
                if (this.welcome.welcome_background) {
                    this.welcome.welcome_background = null
                }
            }
            document.getElementById(hiddenID).remove()
        },
        TempImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = false
            } 
        },
        OldImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = true
            }
        }
    }
};
</script>
