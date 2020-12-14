<template>
    <div class="element-form-wrapper" v-if="app">
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <div class="amt-select">
                        <select class="form-control" v-model="app.style">
                        <option value= null>{{ trans('lang.select_style') }}</option> 
                        <option v-for="(style, index) in styles" :key="index" :value="style.value">{{style.title}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" v-model="app.title" :placeholder="trans('lang.sec_title')" class="form-control">
                </div>
                <div class="form-group" v-if="app.style == 'style3'">
                    <input type="text" v-model="app.titleTwo" :placeholder="trans('lang.sec_title2')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="app.subtitle" :placeholder="trans('lang.sec_subtitle')" class="form-control">
                </div>
                <div class="form-group">
                    <tinymce-editor v-model="app.description" :init="{height: 350, plugins: 'paste link code advlist autolink lists link charmap print', toolbar1: 'undo redo code | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist', menubar:false, statusbar: false, extended_valid_elements:'span[style],i[class]'}"></tinymce-editor>
                </div>
                <div class="form-group">
                    <input type="text" v-model="app.ios_url" :placeholder="trans('lang.ios_url')" class="form-control">
                </div>
                <div 
                    class="at-profile-setting__upload ios_img dc-settingscontent" 
                    :id="'ios_img_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'ios_img_wrapper'+currentElementID"
                        :id="'ios_img'+currentElementID"
                        :img_ref="'ios_img'+currentElementID"
                        :name="'ios_img'"
                        :url="baseURL+'/admin/pages/upload-temp-image/ios_img'"
                        :preview_class="'ios_img_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_ios_img'+currentElementID"
                        :list_id="'list_id_ios_img'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.ios_img')"
                        @addedFile="imageAdded('ios_img_wrapper'+currentElementID, 'iosImg', 'ios_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('iosImg')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'ios_img_preview'+currentElementID">
                            <li :id="'ios_hiddenImage'+currentElementID" v-if="app.ios_image">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+app.ios_image" @error="OldImageError('iosImg')" v-if="pageID && !newIosImg">
                                        <img :src="tempUrl+app.ios_image" @error="TempImageError('iosImg')" v-else-if="!pageID || newIosImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('iosImg', 'ios_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="app.ios_image" name="image" :id="'ios_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" v-model="app.andriod_url" :placeholder="trans('lang.android_url')" class="form-control">
                </div>
                <div 
                    class="at-profile-setting__upload android_img dc-settingscontent" 
                    :id="'android_img_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'android_img_wrapper'+currentElementID"
                        :id="'android_img'+currentElementID"
                        :img_ref="'android_img'+currentElementID"
                        :name="'android_img'"
                        :url="baseURL+'/admin/pages/upload-temp-image/android_img'"
                        :preview_class="'android_img_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_android_img'+currentElementID"
                        :list_id="'list_id_android_img'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.android_img')"
                        @addedFile="imageAdded('android_img_wrapper'+currentElementID, 'androidImg', 'android_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('androidImg')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'android_img_preview'+currentElementID">
                            <li :id="'android_hiddenImage'+currentElementID" v-if="app.android_image">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+app.android_image" @error="OldImageError('androidImg')" v-if="pageID && !newAndroidImg">
                                        <img :src="tempUrl+app.android_image" @error="TempImageError('androidImg')" v-else-if="!pageID || newAndroidImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('androidImg', 'android_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="app.android_image" name="image" :id="'android_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <div 
                    class="at-profile-setting__upload app_img dc-settingscontent" 
                    :id="'app_img_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'app_img_wrapper'+currentElementID"
                        :id="'app_img'+currentElementID"
                        :img_ref="'app_img'+currentElementID"
                        :name="'app_img'"
                        :url="baseURL+'/admin/pages/upload-temp-image/app_img'"
                        :preview_class="'app_img_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_app_img'+currentElementID"
                        :list_id="'list_id_app_img'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.app_img')"
                        @addedFile="imageAdded('app_img_wrapper'+currentElementID, 'appImg', 'app_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('appImg')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'app_img_preview'+currentElementID">
                            <li :id="'app_hiddenImage'+currentElementID" v-if="app.app_image">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+app.app_image" @error="OldImageError('appImg')" v-if="pageID && !newAppImg">
                                        <img :src="tempUrl+app.app_image" @error="TempImageError('appImg')" v-else-if="!pageID || newAppImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('appImg', 'app_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="app.app_image" name="image" :id="'app_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <div 
                    class="at-profile-setting__upload bg_img dc-settingscontent" 
                    :id="'bg_img_wrapper'+currentElementID" 
                    v-if="changeFound && (app.style == 'style2' || app.style == 'style3')"
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
                            <li :id="'bg_hiddenImage'+currentElementID" v-if="app.background_image">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+app.background_image" @error="OldImageError('bgImg')" v-if="pageID && !newBgImg">
                                        <img :src="tempUrl+app.background_image" @error="TempImageError('bgImg')" v-else-if="!pageID || newBgImg">
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
                                <input type="hidden" :value="app.app_image" name="image" :id="'bg_hiddenImage'+currentElementID">
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
            <h6>{{ trans('lang.title_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="app.titleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent" v-if="app.style == 'style3'">
            <h6>{{ trans('lang.title_two_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="app.titleTwoColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="app.subtitleColor"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"> <h3>{{ trans('lang.sec_style') }}</h3></div>
        </div>
          <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.section_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="app.sectionColor"></verte>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group" v-if="app.padding">
                    <div class="amt-element-title">
                         <h6>{{ trans('lang.padding') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="app.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="app.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="app.padding.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="app.padding.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="app.padding.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="app.padding.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group" v-if="app.margin">
                    <div class="amt-element-title">
                        <h6>{{ trans('lang.margin') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="app.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="app.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="app.margin.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="app.margin.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="app.margin.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="app.margin.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group"><input type="text" v-model="app.sectionClass" :placeholder="trans('lang.sec_class')" class="form-control"></div>
                <div class="form-group"><input type="text" v-model="app.sectionId" :placeholder="trans('lang.sec_id')" class="form-control"></div>
            </fieldset>
        </div>
    </div>
</template>
<script>
import Event from '../../../event'
import Editor from '@tinymce/tinymce-vue'

export default {
    components: {
        'tinymce-editor': Editor
    },
    props:['parent_index', 'element_id', 'app', 'pageID', 'styles', 'currentElementID', 'cloneElement'],
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            newBgImg:false,
            newAppImg:false,
            newIosImg:false,
            newAndroidImg:false,
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
                            self.app.background_image = image
                            Event.$emit('new-bg-image'+self.currentElementID)
                            self.newBgImg = false
                        } else {
                            self.app.image.url = null
                        }
                    } else if (imageType == 'appImg') {
                        if (image) {
                            self.app.app_image = image
                            Event.$emit('new-app-image'+self.currentElementID)
                            self.newAppImg = false
                        } else {
                            self.app.app_image = null
                        }
                    } else if (imageType == 'iosImg') {
                        if (image) {
                            self.app.ios_image = image
                            Event.$emit('new-ios-image'+self.currentElementID)
                            self.newIosImg = false
                        } else {
                            self.app.ios_image = null
                        }
                    } else if (imageType == 'androidImg') {
                        if (image) {
                            self.app.android_image = image
                            Event.$emit('new-android-image'+self.currentElementID)
                            self.newAndroidImg = false
                        } else {
                            self.app.android_image = null
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
                    if (this.app.background_image) {
                        this.app.background_image = null
                    }
                } else if (imageType == 'appImg') {
                    if (this.app.app_image ) {
                        this.app.app_image = null
                    } 
                } else if (imageType == 'iosImg') {
                    if (this.app.ios_image ) {
                        this.app.ios_image = null
                    } 
                } else if (imageType == 'androidImg') {
                   if (this.app.android_image ) {
                        this.app.android_image = null
                    } 
                }
            // }
        },
        removeImage: function(imageType, hiddenID) {
            if (imageType == 'bgImg') {
                if (this.app.background_image) {
                    this.app.background_image = null
                }
            } else if (imageType == 'appImg') {
                if (this.app.app_image ) {
                    this.app.app_image = null
                } 
            } else if (imageType == 'iosImg') {
                if (this.app.ios_image ) {
                    this.app.ios_image = null
                } 
            } else if (imageType == 'androidImg') {
                if (this.app.android_image ) {
                    this.app.android_image = null
                } 
            }
            document.getElementById(hiddenID).remove()
        },
        TempImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = false
            } else if (type == 'appImg') {
                this.newAppImg = false
            } 
        },
        OldImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = true
            } else if (type == 'appImg') {
                this.newAppImg = true
            } 
        }
    }
};
</script>
