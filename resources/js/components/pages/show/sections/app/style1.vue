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
                            v-if="newAppImage"
                        >
                        <img 
                            :src="imageUrl+app.app_image" 
                            alt="img description" 
                            v-else-if="pageID"
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
                                <li v-if="app.android_image">
                                    <a :href="app.andriod_url">
                                        <img 
                                            :src="imageUrl+app.android_image" 
                                            alt="img description" 
                                        />
                                    </a>
                                </li>
                                <li v-if="app.ios_image">
                                    <a :href="app.ios_url">
                                        <img 
                                            :src="imageUrl+app.ios_image" 
                                            alt="img description" 
                                        />
                                    </a>
                                </li>
                            </ul>
                            <!-- <ul class="wt-appicon">
                                <li>
                                    <a :href="app.andriod_url">
                                        <figure><img :src="baseUrl+'/images/android.png'" alt="image"></figure>
                                    </a>
                                </li>
                                <li>
                                    <a :href="app.ios_url">
                                        <figure><img :src="baseUrl+'/images/ios.png'" alt="image"></figure>
                                    </a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
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
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            newAppImage:false,
        }
    },
    mounted: function() {
        Event.$on('new-app-image', (data) => {
            this.newAppImage = true
        })
    } 
};
</script>