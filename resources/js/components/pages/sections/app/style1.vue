<template>
    <section 
        :class="app.sectionClass + ' wt-haslayout  wt-main-section'"
        :style="sectionStyle" 
        :id="app.sectionId"
        v-if="Object.entries(app).length != 0"
    >
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
                    <figure class="wt-mobileimg">
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
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
                    <div class="wt-experienceholder">
                        <div class="wt-sectionhead">
                            <div class="wt-sectiontitle">
                                <h2 :style="{color:app.titleColor}">{{app.title}}</h2>
                                <span :style="{color:app.subtitleColor}">{{app.subtitle}}</span>
                            </div>
                            <div class="wt-description" v-html="app.description"></div>
                            <ul class="wt-appicon">
                                <li>
                                    <a :href="app.andriod_url">
                                        <figure>
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
                                        </figure>
                                    </a>
                                </li>
                                <li>
                                    <a :href="app.ios_url">
                                        <figure>
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
                                        </figure>
                                    </a>
                                </li>
                            </ul>
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
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            newAppImage:false,
            newIosImg:false,
            newAndroidImg:false,
        }
    },
    mounted: function() {
        Event.$on('new-app-image'+this.element_id, (data) => {
            this.newAppImage = true
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