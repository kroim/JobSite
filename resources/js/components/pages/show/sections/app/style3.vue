<template>
    <section
        :class="app.sectionClass + ' wt-haslayout wt-main-section wt-mobapp'"
        :style="sectionStyle" 
        :id="app.sectionId"
        v-if="Object.entries(app).length != 0"
    >
        <div class="wt-overlay-3" :style="[pageID ?
                {'background-image': 'url('+imageUrl+app.background_image+')'} : '']"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="wt-mobapp-wrap">
                        <div class="wt-sectionheadvthree">
                            <div class="wt-sectiontitlevtwo">
                                <span :style="{color:app.subtitleColor}">{{app.subtitle}}</span>
                                <h2 :style="{color:app.titleColor}">{{app.title}}
                                    <em :style="{color:app.titleTwoColor}">{{app.titleTwo}}</em>
                                </h2>
                            </div>
                            <div class="wt-description" v-html="app.description">
                            </div>
                        </div>
                        <div class="wt-mobapp-btns">
                            <a :href="app.ios_url" class="wt-appbtn" v-if="app.ios_image">
                                <img 
                                    :src="imageUrl+app.ios_image" 
                                    alt="img description" 
                                />
                            </a>
                            <a :href="app.andriod_url" class="wt-appbtn wt-android" v-if="app.android_image">
                                <img 
                                    :src="imageUrl+app.android_image" 
                                    alt="img description" 
                                />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <figure class="wt-mobapp-img">
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
export default {
    props:['app', 'pageID', 'sectionStyle'],
    data() {
        return {
            baseUrl: APP_URL,
            newAppImage:false,
            newBgImage:false,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
        }
    },
    mounted: function() {
        Event.$on('new-app-image', (data) => {
            this.newAppImage = true
        })
    }  
};
</script>