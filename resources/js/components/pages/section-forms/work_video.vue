<template>
    <div class="element-form-wrapper" v-if="work_video">
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group">
                    <input type="text" v-model="work_video.title" :placeholder="trans('lang.sec_title')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="work_video.subtitle" :placeholder="trans('lang.sec_subtitle')" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" v-model="work_video.video_link" :placeholder="trans('lang.video_link')" class="form-control">
                </div>
                <div class="form-group">
                    <tinymce-editor v-model="work_video.description" :init="{height: 350, plugins: 'paste link code advlist autolink lists link charmap print', toolbar1: 'undo redo code | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist', menubar:false, statusbar: false, extended_valid_elements:'span[style],i[class]'}"></tinymce-editor>
                </div>
                <!-- Video Poster -->
                <div 
                    class="at-profile-setting__upload video_poster dc-settingscontent" 
                    :id="'video_poster_wrapper'+currentElementID" v-if="changeFound"
                >
                    <page-media
                        :parent_id="'video_poster_wrapper'+currentElementID"
                        :id="'video_poster'+currentElementID"
                        :img_ref="'video_poster'+currentElementID"
                        :name="'video_poster'"
                        :url="baseURL+'/admin/pages/upload-temp-image/video_poster'"
                        :preview_class="'video_poster_preview'+currentElementID"
                        :hidden_input_id="'hidden_input_id_video_poster'+currentElementID"
                        :list_id="'list_id_video_poster'+currentElementID"
                        :upload_title="'upload image'"
                        :btn_text="'select file'"
                        :img_label="trans('lang.video_poster')"
                        @addedFile="imageAdded('video_poster_wrapper'+currentElementID, 'video_poster', 'bg_hiddenImage'+currentElementID)"
                        @fileRemoved="imageRemoved('video_poster')"
                    >
                    </page-media>
                    <div class="at-profile-setting__imgs">
                        <ul :class="'video_poster_preview'+currentElementID">
                            <li :id="'bg_hiddenImage'+currentElementID" v-if="work_video.video_poster">
                                <input id="radio1" type="radio" name="radio">
                                <label for="radio1">
                                    <span>
                                        <img :src="baseURL+'/uploads/pages/'+pageID+'/'+work_video.video_poster" @error="OldImageError('video_poster')" v-if="pageID && !newVideoImg">
                                        <img :src="tempUrl+work_video.video_poster" @error="TempImageError('video_poster')" v-else-if="!pageID || newVideoImg">
                                        <span class="at-trash">
                                            <a href="javascript:void(0);" v-on:click="removeImage('video_poster', 'bg_hiddenImage'+currentElementID)">
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
                                <input type="hidden" :value="work_video.video_poster" name="image" :id="'bg_hiddenImage'+currentElementID">
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
            <verte menuPosition="right" model="hex" v-model="work_video.titleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.sutitle_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="work_video.subtitleColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.desc_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="work_video.descColor"></verte>
        </div>
        <div class="amt-dhb-main_content">
            <div class="amt-dhb-heading"> <h3>{{ trans('lang.sec_style') }}</h3></div>
        </div>
          <div class="amt-element-title amt-element-titlecontent">
            <h6>{{ trans('lang.section_clr') }}</h6>
            <verte menuPosition="right" model="hex" v-model="work_video.sectionColor"></verte>
        </div>
        <div class="amt-formcontactus">
            <fieldset>
                <div class="form-group" v-if="work_video.padding">
                    <div class="amt-element-title">
                         <h6>{{ trans('lang.padding') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-padding-pixal" type="radio" v-model="work_video.padding.unit" value="px"> <label for="at-padding-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-padding-percent" type="radio" v-model="work_video.padding.unit" value="%"> <label for="at-padding-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="work_video.padding.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work_video.padding.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work_video.padding.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work_video.padding.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group" v-if="work_video.margin">
                    <div class="amt-element-title">
                        <h6>{{ trans('lang.margin') }}</h6>
                        <div class="amt-guests-radioholder">
                            <span class="amt-radio"><input id="at-margin-pixal" type="radio" v-model="work_video.margin.unit" value="px"> <label for="at-margin-pixal">px</label></span>   
                            <span class="amt-radio"><input id="at-margin-percent" type="radio" v-model="work_video.margin.unit" value="%"> <label for="at-margin-percent">%</label></span>   
                        </div>
                    </div>
                    <div class="amt-spacing">
                        <ul class="amt-guestsinfo">
                            <li> 
                                <div class="amt-guests-radioholder">
                                    <span class="amt-radio"><input type="number" v-model="work_video.margin.top"> <label for="at-top">{{ trans('lang.top') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work_video.margin.right"> <label for="at-right">{{ trans('lang.right') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work_video.margin.bottom"> <label for="at-bottom">{{ trans('lang.bottom') }}</label></span>   
                                    <span class="amt-radio"><input type="number" v-model="work_video.margin.left"> <label for="at-left">{{ trans('lang.left') }}</label></span>   
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="form-group"><input type="text" v-model="work_video.sectionClass" :placeholder="trans('lang.sec_class')" class="form-control"></div>
                <div class="form-group"><input type="text" v-model="work_video.sectionId" :placeholder="trans('lang.sec_id')" class="form-control"></div>
            </fieldset>
        </div>
    </div>
</template>
<script>
import Event from '../../../event'
import Editor from '@tinymce/tinymce-vue'
export default {
    props:['parent_index', 'element_id', 'work_video', 'pageID', 'cloneElement', 'currentElementID'],
    components: {
        'tinymce-editor': Editor
    },
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            newVideoImg:false,
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
                    if (imageType == 'video_poster') {
                        if (image) {
                            self.work_video.video_poster = image
                            Event.$emit('new-video-poster-image'+self.currentElementID)
                            self.newVideoImg = true
                        } else {
                            self.work_video.video_poster = null
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
                if (imageType == 'video_poster') {
                    if (this.work_video.video_poster) {
                        this.work_video.video_poster = null
                    }
                }
            // }
        },
        removeImage: function(imageType, hiddenID) {
            if (imageType == 'video_poster') {
                if (this.work_video.video_poster) {
                    this.work_video.video_poster = null
                }
            }
            document.getElementById(hiddenID).remove()
        },
        TempImageError (type) {
            if (type == 'video_poster') {
                this.newVideoImg = false
            } 
        },
        OldImageError (type) {
            if (type == 'video_poster') {
                this.newVideoImg = true
            }
        }
    }
};
</script>
