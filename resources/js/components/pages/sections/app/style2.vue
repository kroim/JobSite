<template>
    <section
        :class="app.sectionClass + ' wt-haslayout'"
        :style="sectionStyle" 
        :id="app.sectionId"
        v-if="Object.entries(app).length != 0"
    >
        <div class="wt-haslayout wt-main-section wt-nativeholder" 
        :style="[newBgImage ? {'background-image': 'url('+tempUrl+app.background_image+')'} : pageID && app.background_image ? {'background-image': 'url('+imageUrl+app.background_image+')'} : '']"
        >
            <div class="container">
                <div class="row justify-content-center align-self-center">
                    <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-8 push-lg-2">
                        <div class="wt-sectionhead wt-textcenter wt-howswork">
                            <div class="wt-sectiontitle">
                                <h2 :style="{color:app.titleColor}">{{app.title}}</h2>
                                <h3 :style="{color:app.subtitleColor}">{{app.subtitle}}</h3>
                            </div>
                            <div class="wt-description" v-html="app.description"></div>
                            <ul class="wt-appicons">
                                <li>
                                    <a :href="app.andriod_url">
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
                                </li>
                                <li>
                                    <a :href="app.ios_url">
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
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="wt-nativemobile">
                            <figure>
                                <img 
                                    :src="tempUrl+app.app_image" 
                                    alt="image"
                                    v-if="newAppImage && app.app_image"
                                >
                                <img 
                                    :src="imageUrl+app.app_image" 
                                    alt="img description" 
                                    v-else-if="pageID && app.app_image"
                                />
                            </figure>										
                        </div>
                    </div>
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