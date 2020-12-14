<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="article.sectionClass + ' wt-haslayout  wt-main-section'"
            :id="article.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(article).length != 0"
        >
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-8">
                        <div class="wt-sectionhead wt-textcenter">
                            <div class="wt-sectiontitle">
                                <h2 :style="{color:article.titleColor}">{{article.title}}</h2>
                                <span :style="{color:article.subtitleColor}">{{article.subtitle}}</span>
                            </div>
                            <div class="wt-description" v-if="article.description" v-html="article.description"></div>
                        </div>
                    </div>
                    <div class="wt-articlesholder">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left" v-for="(articleData, index) in articleList" :key="index">
                            <div class="wt-articles">
                                <figure class="wt-articleimg">
                                    <img :src="articleData.banner" alt="img description">
                                </figure>
                                <div class="wt-articlecontents">
                                    <div class="wt-title">
                                        <div class="wt-article-tag">
                                            <a :href="baseUrl + '/articles/'+cat.slug" class="wt-articleby" v-for="(cat, catIndex) in articleData.cat" :key="catIndex">{{cat.title}}</a>
                                        </div>
                                        <h3><a :href="baseUrl + '/article/'+articleData.slug">{{articleData.title}}</a></h3>
                                        <span class="wt-datetime"><i class="ti-calendar"></i> {{articleData.published_date}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import Event from '../../../event'
export default {
    props:['parent_index', 'element_id', 'articles', 'pageID'],
    data() {
        return {
            article:{},
            articleList:[],
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.article.padding ? `${this.article.padding.top}${this.article.padding.unit} ${this.article.padding.right}${this.article.padding.unit} ${this.article.padding.bottom}${this.article.padding.unit} ${this.article.padding.left}${this.article.padding.unit}` : '',
                margin: this.article.margin ? `${this.article.margin.top}${this.article.margin.unit} ${this.article.margin.right}${this.article.margin.unit} ${this.article.margin.bottom}${this.article.margin.unit} ${this.article.margin.left}${this.article.margin.unit}` : '',
                'text-align': this.article.alignment ? this.article.alignment : '',
                background: this.article.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.article.contentBackground,
                color:this.article.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.articles, 'id', this.element_id)
        if (this.article[index]) {
            this.article = this.article[index]
        }
        this.article.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('article-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        getArticles: function() {
            var self = this;
            axios
            .get(APP_URL + "/get-articles")
            .then(function(response) {
                if (response.data.type == "success") {
                    self.articleList =response.data.articles
                }
            })
            .catch(function(error) {  });
        }
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.articles, 'id', self.element_id)
            if (self.articles[index]) {
                self.article = self.articles[index]
            }
        }, 100);
        this.getArticles()
    },
};
</script>
