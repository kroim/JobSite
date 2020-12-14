<template>
    <section
        :class="app.sectionClass + ' wt-haslayout wt-main-section wt-mobapp'"
        :style="sectionStyle" 
        :id="app.sectionId"
        v-if="Object.entries(app).length != 0"
    >
        <div class="wt-overlay-3" :style="[newBgImage ?
                {'background-image': 'url('+tempUrl+app.background_image+')'} :
                pageID && app.background_image?
                {'background-image': 'url('+imageUrl+app.background_image+')'} : '']"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="wt-mobapp-wrap">
                        <div class="wt-sectionheadvthree">
                            <div class="wt-sectiontitlevtwo">
                                <span :style="{color:app.subtitleColor}">{{app.subtitle}}</span>
                                <h2 :style="{color:app.titleColor}">{{app.title}}
                                    <em :style="{color:app.titleTwoColor}">{{app.titleTwo}}</em>
                                </h2>
                            </div>
                            <div class="wt-description">
                                <p v-html="app.description"></p>
                            </div>
                        </div>
                        <div class="wt-mobapp-btns">
                            <a :href="app.ios_url" class="wt-appbtn">
                                <img 
                                    :src="tempUrl+app.ios_image" 
                                    alt="image"
                                    v-if="newIosImg && app.ios_image"
                                />
                                <img 
                                    :src="imageUrl+app.ios_image" 
                                    alt="img description" 
                                    v-else-if="pageID && app.ios_image"
                                />
                            </a>
                            <a :href="app.andriod_url" class="wt-appbtn wt-android">
                                <img 
                                    :src="tempUrl+app.android_image" 
                                    alt="image"
                                    v-if="newAndroidImg && app.android_image"
                                />
                                <img 
                                    :src="imageUrl+app.android_image" 
                                    alt="img description" 
                                    v-else-if="pageID && app.android_image"
                                />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <figure class="wt-mobapp-img" v-if="app.app_image">
                        <img 
                            :src="tempUrl+app.app_image" 
                            alt="image"
                            v-if="newAppImage"
                        >
                        <img 
                            :src="imageUrl+app.app_image" 
                            alt="img description" 
                            v-else-if="pageID"
                        />
                    </figure>
                </div>
            </div>
        </div>
    </section>		
</template>
<script>
import Event from '../../../../event'
export default {
    props:['app', 'pageID', 'sectionStyle', 'element_id'],
    data() {
        return {
            baseUrl: APP_URL,
            newAppImage:false,
            newBgImage:false,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            newIosImg:false,
            newAndroidImg:false,
        }
    },
    mounted: function() {
        Event.$on('new-app-image'+this.element_id, (data) => {
            this.newAppImage = true
        })
        Event.$on('new-bg-image'+this.element_id, (data) => {
            this.newBgImage = true
        })
        Event.$on('new-ios-image'+this.element_id, (data) => {
            this.newIosImg = true
        })
        Event.$on('new-android-image'+this.element_id, (data) => {
            this.newAndroidImg = true
        })
    }  
};
</script>