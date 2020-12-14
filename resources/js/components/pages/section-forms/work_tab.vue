<template>
    <div class="element-form-wrapper" v-if="work">
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <input type="text" v-model="work.title" :placeholder="trans('lang.sec_title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="work.subtitle" :placeholder="trans('lang.sec_subtitle')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="work.description" :placeholder="trans('lang.sec_desc')" class="form-control">
                </div>
                <!-- Background Img -->
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
                            <li :id="'bg_hiddenImage'+currentElementID" v-if="work.background_image">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+work.background_image" @error="OldImageError('bgImg')" v-if="pageID && !newBgImg">
                                        <img :src="tempUrl+work.background_image" @error="TempImageError('bgImg')" v-else-if="!pageID || newBgImg">
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
                                <input type="hidden" :value="work.background_image" name="image" :id="'bg_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- First Tab -->
                <div class="amt-element-title amt-element-titlecontent">
                    <h6>{{trans('lang.first_tab')}}</h6>
                </div>
                <div class="form-group form-group-half">
                    <input placeholder="Title" v-model="work.first_tab_title" type="text" value="" class="form-control">
                    <input placeholder="Subtitle" v-model="work.first_tab_subtitle" type="text" value="" class="form-control">
                </div> 
                <div 
                    class="at-profile-setting__upload first_tab_icon dc-settingscontent" 
                    :id="'first_tab_icon_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'first_tab_icon_wrapper'+currentElementID"
                        :id="'first_tab_icon'+currentElementID"
                        :img_ref="'first_tab_icon'+currentElementID"
                        :name="'first_tab_icon'"
                        :url="baseURL+'/admin/pages/upload-temp-image/first_tab_icon'"
                        :preview_class="'first_tab_icon_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_first_tab_icon'+currentElementID"
                        :list_id="'list_id_first_tab_icon'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.first_tab_icon')"
                        @addedFile="imageAdded('first_tab_icon_wrapper'+currentElementID, 'first_tab_icon', 'first_tab_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('first_tab_icon')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'first_tab_icon_preview'+currentElementID">
                            <li :id="'first_tab_hiddenImage'+currentElementID" v-if="work.first_tab_icon">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+work.first_tab_icon" @error="OldImageError('first_tab_icon')" v-if="pageID && !newFirstTabImg">
                                        <img :src="tempUrl+work.first_tab_icon" @error="TempImageError('first_tab_icon')" v-else-if="!pageID || newFirstTabImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('first_tab_icon', 'first_tab_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="work.first_tab_icon" name="image" :id="'first_tab_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Second Tab -->
                <div class="amt-element-title amt-element-titlecontent">
                    <h6>{{trans('lang.second_tab')}}</h6>
                </div>
                <div class="form-group form-group-half">
                    <input placeholder="Title" v-model="work.second_tab_title" type="text" value="" class="form-control">
                    <input placeholder="Subtitle" v-model="work.second_tab_subtitle" type="text" value="" class="form-control">
                </div> 
                <div 
                    class="at-profile-setting__upload second_tab_icon dc-settingscontent" 
                    :id="'second_tab_icon_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'second_tab_icon_wrapper'+currentElementID"
                        :id="'second_tab_icon'+currentElementID"
                        :img_ref="'second_tab_icon'+currentElementID"
                        :name="'second_tab_icon'"
                        :url="baseURL+'/admin/pages/upload-temp-image/second_tab_icon'"
                        :preview_class="'second_tab_icon_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_second_tab_icon'+currentElementID"
                        :list_id="'list_id_second_tab_icon'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.second_tab_icon')"
                        @addedFile="imageAdded('second_tab_icon_wrapper'+currentElementID, 'second_tab_icon', 'second_tab_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('second_tab_icon')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'second_tab_icon_preview'+currentElementID">
                            <li :id="'second_tab_hiddenImage'+currentElementID" v-if="work.second_tab_icon">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+work.second_tab_icon" @error="OldImageError('second_tab_icon')" v-if="pageID && !newSecondTabImg">
                                        <img :src="tempUrl+work.second_tab_icon" @error="TempImageError('second_tab_icon')" v-else-if="!pageID || newSecondTabImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('second_tab_icon', 'second_tab_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="work.second_tab_icon" name="image" :id="'second_tab_hiddenImage'+currentElementID">
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Third Tab -->
                <div class="amt-element-title amt-element-titlecontent">
                    <h6>{{trans('lang.third_tab')}}</h6>
                </div>
                <div class="form-group form-group-half">
                    <input placeholder="Title" v-model="work.third_tab_title" type="text" value="" class="form-control">
                    <input placeholder="Subtitle" v-model="work.third_tab_subtitle" type="text" value="" class="form-control">
                </div> 
                <div 
                    class="at-profile-setting__upload third_tab_icon dc-settingscontent" 
                    :id="'third_tab_icon_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'third_tab_icon_wrapper'+currentElementID"
                        :id="'third_tab_icon'+currentElementID"
                        :img_ref="'third_tab_icon'+currentElementID"
                        :name="'third_tab_icon'"
                        :url="baseURL+'/admin/pages/upload-temp-image/third_tab_icon'"
                        :preview_class="'third_tab_icon_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_third_tab_icon'+currentElementID"
                        :list_id="'list_id_third_tab_icon'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.third_tab_icon')"
                        @addedFile="imageAdded('third_tab_icon_wrapper'+currentElementID, 'third_tab_icon', 'third_tab_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('third_tab_icon')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'third_tab_icon_preview'+currentElementID">
                            <li :id="'third_tab_hiddenImage'+currentElementID" v-if="work.third_tab_icon">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+work.third_tab_icon" @error="OldImageError('third_tab_icon')" v-if="pageID && !newThirdTabImg">
                                        <img :src="tempUrl+work.third_tab_icon" @error="TempImageError('third_tab_icon')" v-else-if="!pageID || newThirdTabImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('third_tab_icon', 'third_tab_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="work.third_tab_icon" name="image" :id="'third_tab_hiddenImage'+currentElementID">
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
            <verte menuPosition="right" model="hex" v-model="work.titleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="work.subtitleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.desc_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="work.descColor"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"> <h3>{{ trans('lang.sec_style') }}</h3></div>
        </div>
          <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.section_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="work.sectionColor"></verte>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group" v-if="work.padding">
                    <div class="amt-element-title">
                         <h6>{{ trans('lang.padding') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="work.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="work.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="work.padding.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work.padding.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work.padding.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work.padding.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group" v-if="work.margin">
                    <div class="amt-element-title">
                        <h6>{{ trans('lang.margin') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="work.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="work.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="work.margin.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work.margin.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work.margin.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work.margin.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group"><input type="text" v-model="work.sectionClass" :placeholder="trans('lang.sec_class')" class="form-control"></div>
                <div class="form-group"><input type="text" v-model="work.sectionId" :placeholder="trans('lang.sec_id')" class="form-control"></div>
            </fieldset>
        </div>
    </div>
</template>
<script>
import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'work', 'pageID', 'cloneElement', 'currentElementID'],
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            newBgImg:false,
            newFirstTabImg:false,
            newSecondTabImg:false,
            newThirdTabImg:false,
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
                            self.work.background_image = image
                            Event.$emit('new-bg-image'+self.currentElementID)
                            self.newBgImg = true
                        } else {
                            self.work.background_image = null
                        }
                    } else if (imageType == 'first_tab_icon') {
                        if (image) {
                            self.work.first_tab_icon = image
                            Event.$emit('new-first-tab-image'+self.currentElementID)
                            self.newFirstTabImg = true
                        } else {
                            self.work.first_tab_icon = null
                        }
                    } else if (imageType == 'second_tab_icon') {
                        if (image) {
                            self.work.second_tab_icon = image
                            Event.$emit('new-second-tab-image'+self.currentElementID)
                            self.newSecondTabImg = true
                        } else {
                            self.work.second_tab_icon = null
                        }
                    } else if (imageType == 'third_tab_icon') {
                        if (image) {
                            self.work.third_tab_icon = image
                            Event.$emit('new-third-tab-image'+self.currentElementID)
                            self.newThirdTabImg = true
                        } else {
                            self.work.third_tab_icon = null
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
                    if (this.work.background_image) {
                        this.work.background_image = null
                    }
                } else if (imageType == 'first_tab_icon') {
                    if (this.work.first_tab_icon ) {
                        this.work.first_tab_icon = null
                    } 
                } else if (imageType == 'second_tab_icon') {
                    if (this.work.second_tab_icon ) {
                        this.work.second_tab_icon = null
                    } 
                } else if (imageType == 'third_tab_icon') {
                    if (this.work.third_tab_icon ) {
                        this.work.third_tab_icon = null
                    } 
                }
            // }
        },
        removeImage: function(imageType, hiddenID) {
            if (imageType == 'bgImg') {
                if (this.work.background_image) {
                    this.work.background_image = null
                }
            } else if (imageType == 'first_tab_icon') {
                if (this.work.first_tab_icon ) {
                    this.work.first_tab_icon = null
                } 
            } else if (imageType == 'second_tab_icon') {
                if (this.work.second_tab_icon ) {
                    this.work.second_tab_icon = null
                } 
            } else if (imageType == 'third_tab_icon') {
                if (this.work.third_tab_icon ) {
                    this.work.third_tab_icon = null
                } 
            }
            document.getElementById(hiddenID).remove()
        },
        TempImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = false
            } else if (type =='first_tab_icon') {
                this.newFirstTabImg = false
            } else if (type =='second_tab_icon') {
                this.newSecondTabImg = false
            } else if (type == 'third_tab_icon') {
                this.newThirdTabImg = false
            }
        },
        OldImageError (type) {
            if (type == 'bgImg') {
                this.newBgImg = true
            } else if (type =='first_tab_icon') {
                this.newFirstTabImg = true
            } else if (type =='second_tab_icon') {
                this.newSecondTabImg = true
            } else if (type == 'third_tab_icon') {
                this.newThirdTabImg = true
            }
        }
    }
};
</script>
