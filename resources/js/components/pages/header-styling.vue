<template>
    <div>
        <div class="amt-element-title amt-element-titlecontent" v-if="displayColorSettings">
            <h6>{{ trans('lang.menu_color') }}</h6>
            <verte menuPosition="right" model="hex" v-model="form.headerStyling.menuColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent" v-if="displayColorSettings">
            <h6>{{ trans('lang.hover_color') }}</h6>
            <verte menuPosition="right" model="hex" v-model="form.headerStyling.menuHoverColor"></verte>
        </div>
        <div class="amt-element-title amt-element-titlecontent" v-if="displayColorSettings">
            <h6>{{ trans('lang.color') }}</h6>
            <verte menuPosition="right" model="hex" v-model="form.headerStyling.color"></verte>
        </div>
        <div class="amt-section-select">
            <div class="at-profile-setting__upload page_logo dc-settingscontent" id="page_logo_wrapper">
                <page-media
                    :parent_id="'page_logo_wrapper'"
                    :id="'page_logo'"
                    :img_ref="'page_logo'"
                    :name="'page_logo'"
                    :url="baseURL+'/admin/pages/upload-temp-image/page_logo'"
                    :preview_class="'page_logo_preview'"
                    :hidden_input_id="'hidden_input_id_page_logo'"
                    :list_id="'list_id_page_logo'"
                    :upload_title="'upload image'"
                    :btn_text="'select logo'"
                    :img_label="trans('lang.page_logo')"
                    @addedFile="imageAdded()"
                    @fileRemoved="imageRemoved()"
                >
                </page-media>
                <div class="at-profile-setting__imgs">
                    <ul class="page_logo_preview">
                        <li id="pageLogoID" v-if="form.headerStyling.logo">
                            <input id="radio1" type="radio" name="radio">
                            <label for="radio1">
                                <span>
                                    <img :src="baseURL+'/uploads/pages/'+pageID+'/'+form.headerStyling.logo" v-if="pageID">
                                    <img :src="tempUrl+form.headerStyling.logo" v-else>
                                    <span class="at-trash">
                                        <a href="javascript:void(0);" v-on:click="removeImage()">
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
                            <input type="hidden" :value="form.headerStyling.logo" name="page_logo" id="hidden">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['form','pageID', 'displayColorSettings'],
    data() {
        return {
            baseURL: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
        }
    },
    methods:{
        imageAdded: function() {
            var self = this
            setTimeout(function(){ 
               if (document.querySelector('#page_logo_wrapper .at-profile-setting__imgs ul li input[type=hidden]')) {
                    var hidddenIcon = document.querySelector('#page_logo_wrapper .at-profile-setting__imgs ul li input[type=hidden]');
                    let image = document.getElementById(hidddenIcon.id).value
                    self.form.headerStyling.logo = image
                } else {
                    self.form.headerStyling.logo = null
                }
            }, 50);
            setTimeout(function(){ 
                if (document.getElementById('pageLogoID')) {
                    document.getElementById('pageLogoID').remove()
                }
            }, 60);
        },
        removeImage: function() {
            this.form.headerStyling.logo = null
            document.getElementById('pageLogoID').remove()
        },
        imageRemoved: function() {
            if (this.form.headerStyling.logo) {
                this.form.headerStyling.logo = null
            }
        },
    }
}
</script>