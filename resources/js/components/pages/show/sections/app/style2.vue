<template>
    <section
        :class="app.sectionClass + ' wt-haslayout'"
        :style="sectionStyle" 
        :id="app.sectionId"
        v-if="Object.entries(app).length != 0"
    >
        <div class="wt-haslayout wt-main-section wt-nativeholder" 
        
        :style="[pageID ?
         {'background-image': 'url('+imageUrl+app.background_image+')'} :
         {'background-image': 'url('+tempUrl+app.background_image+')'}]">
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
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="wt-nativemobile">
                            <figure>
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
        Event.$on('new-bg-image', (data) => {
            this.newBgImage = true
        })
    }  
};
</script>