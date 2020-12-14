<template>
    <div class="element-preview-wrapper" v-on:click="editElement">
        <section 
            :class="pkg.sectionClass + ' wt-main-section wt-packages-wrap'"
            :id="pkg.sectionId" 
            :style="sectionStyle" 
            v-if="Object.entries(pkg).length != 0"
        >
            <div class="wt-overlay-5" :style="[newBgImage ?
                {'background-image': 'url('+tempUrl+pkg.backgroundImg+')'} :
                pageID && pkg.backgroundImg ?
                {'background-image': 'url('+imageUrl+pkg.backgroundImg+')'} : '']"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="wt-sectionheadvthree wt-textcenter">
                            <div class="wt-sectiontitlevtwo">
                                <h2 :style="{color:pkg.titleColor}">{{pkg.title}} 
                                    <em :style="{color:pkg.titleTwoColor}">{{pkg.titleTwo}}</em>
                                </h2>
                            </div>
                            <div class="wt-description"  v-if="pkg.description" v-html="pkg.description">
                            </div>
                        </div>
                    </div>
                    <div class="wt-packagestwo">
                        <div class="col-12">
                            <div class="wt-switcharea">
                                <div class="wt-switchtitle">
                                    <h6>{{ trans('lang.i_m_freelancer') }}</h6>
                                </div>
                                <div class="wt-switch">
                                    <input type="checkbox" id="wt-switch" name="switch" @change="getPackages" v-model="roleType">
                                    <label for="wt-switch"><i></i></label>
                                </div>
                                <div class="wt-switchtitle">
                                    <h6>{{ trans('lang.i_m_employer') }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4" v-for="(pkgItem, index) in topPackages" :key="index">
                            <div class="wt-packagetwo">
                                <div class="wt-package-content">
                                    <h5>{{pkgItem.title}}</h5>
                                    <img :src="baseUrl+'/uploads/packages/' + pkgItem.image" alt="img description" v-if="pkgItem.image">
                                    <img :src="baseUrl + '/images/packages.png'" alt="img description" v-else>
                                    <strong><sup>{{ pkgItem.symbol }}</sup>{{ pkgItem.cost }} <sub>/ {{ getPackageDurationList(pkgItem.options['duration']) }}</sub></strong>
                                    <em>{{ trans('lang.include_all_taxes') }} <i class="ti-info-alt toltip-content tipso_style" data-tipso="Plus Member"></i></em>
                                </div>
                                <div class="jb-package-feature">
                                    <h6>{{ trans('lang.pkg_features') }}:</h6>
                                    <ul>
                                        <li v-for="(option, key) in package_options" :key="key">
                                            <p>{{option}}:</p>
                                            <span v-if="key=='banner_option' || key =='private_chat'" :class="[pkgItem.options[key] ? 'jb-available': 'jb-not-available']">
                                                <i :class="[pkgItem.options[key] ? 'fas fa-check-circle': 'fas fa-times-circle']" ></i>
                                            </span>
                                            <span v-else-if="key=='duration'" >{{ getPackageDurationList(pkgItem.options[key]) }}</span>
                                            <span v-else>{{pkgItem.options[key]}}</span>
                                        </li>
                                    </ul>
                                    <div class="wt-btnarea">
                                        <a href="javascript:void(0);" class="wt-btntwo">{{ trans('lang.buy_now') }}</a>
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
import carousel from 'vue-owl-carousel'

export default {
    props:['parent_index', 'element_id', 'packages', 'pageID'],
    components:{carousel},
    data() {
        return {
            pkg:{},
            topPackages:[],
            package_options:[],
            roleType:false,
            isActive:false,
            baseUrl: APP_URL,
            tempUrl:APP_URL+'/uploads/pages/temp/',
            imageUrl:APP_URL+'/uploads/pages/'+this.pageID+'/',
            filtersApplied: false,
            newBgImage:false,
        }
    },
    computed: {
        sectionStyle() {
            return {
                padding: this.pkg.padding ? `${this.pkg.padding.top}${this.pkg.padding.unit} ${this.pkg.padding.right}${this.pkg.padding.unit} ${this.pkg.padding.bottom}${this.pkg.padding.unit} ${this.pkg.padding.left}${this.pkg.padding.unit}` : '',
                margin: this.pkg.margin ? `${this.pkg.margin.top}${this.pkg.margin.unit} ${this.pkg.margin.right}${this.pkg.margin.unit} ${this.pkg.margin.bottom}${this.pkg.margin.unit} ${this.pkg.margin.left}${this.pkg.margin.unit}` : '',
                'text-align': this.pkg.alignment,
                background: this.pkg.sectionColor
            }
        },
        contentSectionStyle() {
            return {
                background:this.pkg.contentBackground,
                color:this.pkg.contentColor
            }
        },
    },
    updated: function() {
        var index = this.getArrayIndex(this.packages, 'id', this.element_id)
        if (this.pkg[index]) {
            this.pkg = this.pkg[index]
        }
        this.pkg.id = this.element_id
    },
    mounted: function() {
        this.isActive = false
        var self= this
        Event.$on('pkg-section-update', (data) => {
            setTimeout(function(){ 
                self.isActive = !self.isActive;
            }, 10);
        })
        Event.$on('new-pkg-bg-image'+this.element_id, (data) => {
            this.newBgImage = true
        })
    },
    methods:{
        editElement: function() {
            var self = this
            this.$emit("editData");
        },
        getPackages: function() {
            var self = this;
            let role = ''
            if (this.roleType) {
                role = 'employer'
            } else {
                role = 'freelancer'
            }
            axios
            .get(APP_URL + '/get-top-packages/' + role)
            .then(function(response) {
                if (response.data.type == "success") {
                    self.topPackages = response.data.packages
                    self.package_options = response.data.package_options
                    self.filtersApplied = true
                }
            })
            .catch(function(error) {  });
        }
    },
    created: function() {
        var self = this
        setTimeout(function(){ 
            var index = self.getArrayIndex(self.packages, 'id', self.element_id)
            if (self.packages[index]) {
                self.pkg = self.packages[index]
            }
        }, 100);
        this.getPackages()
    },
};
</script>
