<template>
  <div>
    <div v-for="(skeleton, index) in skeletons" :key="skeleton+index">
      <slider-skeleton v-if="sliderSkeleton && slider_style !== 'style2' && slider_style !== 'style3' && (skeleton == 'slider' || skeleton == 'bannerV1')"/>
      <div class="container wt-main-section" v-if="categorySkeleton && skeleton == 'category'">
        <category-skeleton />
     </div>
      <div class="container wt-main-section" v-if="welcomeSkeleton && skeleton == 'welcome_section'">
        <welcome-skeleton />
     </div>
      <div class="container wt-main-section" v-if="appSkeleton && skeleton == 'app_section'">
        <app-skeleton />
     </div>
      <div class="container wt-main-section" v-if="serviceSkeleton && skeleton == 'service_section'">
        <service-skeleton />
     </div>
      <div class="container wt-main-section" v-if="howWorkSkeleton && skeleton == 'work_tab_section'">
        <how-work-skeleton />
     </div>
      <div class="container wt-main-section" v-if="freelancerSkeleton && skeleton == 'freelancer_section'">
        <freelancer-skeleton />
     </div>
      <div class="container wt-main-section" v-if="articleSkeleton && skeleton == 'article_section'">
        <article-skeleton />
     </div>
      <div class="container wt-main-section" v-if="workVideoSkeleton && skeleton == 'work_video_section'">
        <work-video-skeleton />
     </div>
      <div class="container wt-main-section" v-if="categoryV2Skeleton && skeleton == 'categoryV2'">
        <category-v2-skeleton />
     </div>
      <div class="container wt-main-section" v-if="jobSkeleton && skeleton == 'jobs_section'">
        <job-skeleton />
     </div>
      <div class="container-fluid wt-main-section" v-if="freelancerV2Skeleton && skeleton == 'freelancer_section_v2'">
        <freelancer-v2-skeleton />
     </div>
      <div class="container wt-main-section" v-if="packageSkeleton && skeleton == 'package_section'">
        <package-skeleton />
     </div>
      <div class="container wt-main-section" v-if="categoryV3Skeleton && skeleton == 'categoryV3'">
        <category-v3-skeleton />
     </div>
     <div class="container wt-main-section" v-if="headingSkeleton && skeleton == 'heading'">
        <heading-skeleton />
      </div>
    </div>
    <div
      v-for="(element, index) in sections"
      :key="'section'+element.id+index"
      :class="'section-main-wrapper'+element.id+index"
    >
      <slider  
        :element_id="element.id"
        :sliders="form.meta.sliders" 
        :page_id="page_id"
        :symbol="symbol"
        v-if="element.section =='slider'">
      </slider>
      <heading
        :element_id="element.id"
        :parent_index="index"
        :heading_section="form.meta.headings"
        @editData="editSection(element)"
        v-if="element.section =='heading'"
      />
      <editor
        :element_id="element.id"
        :parent_index="index"
        :editor_section="form.meta.content"
        @editData="editSection(element)"
        v-else-if="element.section =='content_section'"
      />
      <categories 
        :element_id="element.id"
        :categories="form.meta.cat"
        @editData="editSection(element)"
        :parent_index="index" 
        v-else-if="element.section =='category'">
      </categories>
      <services 
        :element_id="element.id"
        :services="form.meta.services"
        @editData="editSection(element)"
        :parent_index="index" 
        :access_type="access_type" 
        v-else-if="element.section =='service_section'">
      </services>
      <freelancers 
        :element_id="element.id"
        :freelancers="form.meta.freelancers"
        @editData="editSection(element)"
        :parent_index="index" 
        v-else-if="element.section =='freelancer_section'">
      </freelancers>
      <articles 
        :element_id="element.id"
        :articles="form.meta.articles"
        @editData="editSection(element)"
        :parent_index="index" 
        v-else-if="element.section =='article_section'">
      </articles>
      <app 
        :element_id="element.id"
        :apps="form.meta.app_section"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='app_section'">
      </app>
      <work-tab 
        :element_id="element.id"
        :work_sec="form.meta.work_tabs"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='work_tab_section'">
      </work-tab>
      <work-video 
        :element_id="element.id"
        :work_sec="form.meta.work_videos"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='work_video_section'">
      </work-video>
      <welcome 
        :element_id="element.id"
        :welcome_section="form.meta.welcome_sections"
        @editData="editSection(element)"
        :parent_index="index"
        :pageID="page_id" 
        v-else-if="element.section =='welcome_section'">
      </welcome>
      <categories-v2
        :element_id="element.id"
        :categories="form.meta.categoriesSecondVersion"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='categoryV2'">
      </categories-v2>
      <categories-v3
        :element_id="element.id"
        :categories="form.meta.categoriesThirdVersion"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='categoryV3'">
      </categories-v3>
      <freelancers-v2 
        :element_id="element.id"
        :freelancers="form.meta.freelancersSecondVersion"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='freelancer_section_v2'">
      </freelancers-v2>
      <jobs 
        :element_id="element.id"
        :jobs="form.meta.jobs"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        v-else-if="element.section =='jobs_section'">
      </jobs>
      <packages 
        :element_id="element.id"
        :packages="form.meta.packages"
        @editData="editSection(element)"
        :parent_index="index" 
        :pageID="page_id"
        :role="auth_role"
        v-else-if="element.section =='package_section'">
      </packages>
      <banner-v1
        :element_id="element.id"
        :banner_sec="form.meta.bannerFirstVersion"
        @editData="editSection(element)"
        :parent_index="index"
        :pageID="page_id" 
        v-else-if="element.section =='bannerV1'">
      </banner-v1>
    </div>
  </div>
</template>
<script>
import slider from './sections/sliders/index'
import heading from './sections/heading'
import editor from './sections/editor'
import categories from './sections/categories'
import services from './sections/services'
import freelancers from './sections/freelancers'
import articles from './sections/articles'
import app from './sections/app/index'
import workTab from './sections/work_tab'
import workVideo from './sections/work_video'
import welcome from './sections/welcome'
import categoriesV2 from './sections/categoriesV2'
import categoriesV3 from './sections/categoriesV3'
import freelancersV2 from './sections/freelancersV2'
import jobs from './sections/jobs'
import packages from './sections/packages'
import bannerV1 from './sections/bannerV1'
import sliderSkeleton from './skeleton/slider'
import categorySkeleton from './skeleton/categories'
import welcomeSkeleton from './skeleton/welcome'
import appSkeleton from './skeleton/app'
import serviceSkeleton from './skeleton/services'
import howWorkSkeleton from './skeleton/how-work'
import freelancerSkeleton from './skeleton/freelancers'
import articleSkeleton from './skeleton/articles'
import workVideoSkeleton from './skeleton/work_video'
import categoryV2Skeleton from './skeleton/categoriesV2'
import jobSkeleton from './skeleton/jobs'
import freelancerV2Skeleton from './skeleton/freelancersV2'
import packageSkeleton from './skeleton/packages'
import categoryV3Skeleton from './skeleton/categoriesV3'
import headingSkeleton from './skeleton/heading'

export default {
  props:['page_id', 'access_type', 'auth_role', 'symbol', 'slider_style'],
  components: {
    headingSkeleton,
    categoryV3Skeleton,
    packageSkeleton,
    freelancerV2Skeleton,
    jobSkeleton,
    categoryV2Skeleton,
    workVideoSkeleton,
    articleSkeleton,
    freelancerSkeleton,
    howWorkSkeleton,
    serviceSkeleton,
    appSkeleton,
    welcomeSkeleton,
    categorySkeleton,
    sliderSkeleton,
    slider,
    heading,
    editor,
    categories,
    services,
    freelancers,
    articles,
    app,
    workTab,
    workVideo,
    welcome,
    categoriesV2,
    categoriesV3,
    freelancersV2,
    jobs,
    packages,
    bannerV1
  },
  data () {
    return {
      skeletons:[],
      headingSkeleton: false,
      categoryV3Skeleton: false,
      packageSkeleton: false,
      freelancerV2Skeleton: false,
      jobSkeleton: false,
      categoryV2Skeleton: false,
      workVideoSkeleton: false,
      articleSkeleton: false,
      freelancerSkeleton: false,
      howWorkSkeleton: false,
      serviceSkeleton: false,
      appSkeleton: false,
      sliderSkeleton: false,
      categorySkeleton: false,
      welcomeSkeleton: false,
      form: {
        meta_title: '',
        show_page_banner: true,
        show_page_title: false,
        show_page: false,
        page_banner_value:'',
        seo_desc:'',
        parent_id: null,
        slug: '',
        id: '',
        title: '',
        sections: [],
        meta: {
          sliders: [],
          headings: [],
          content: [],
          cat:[],
          services:[],
          freelancers:[],
          app_section:[],
          work_tabs:[],
          work_videos:[],
          welcome_sections:[],
          articles:[],
          categoriesSecondVersion:[],
          freelancersSecondVersion:[],
          jobs:[],
          packages:[],
          bannerFirstVersion:[],
          categoriesThirdVersion:[],
          title:{
            show:true
          } 
        }
      },
      service_section_tabs: [],
      howWorkSectionContent: [],
      articles: [],
      currentElementIndex: '',
      currentSection: '',
      sectionSliders:[],
      sections: [],
      // list:JSON.parse(this.section_list),
      // layouts:JSON.parse(this.layout_list),
      baseURL:APP_URL,
      sectionLocations:[],
      searchableRoles:[],
      pageData:[],
      IconPath:APP_URL+'/images/page-builder/',
      cloneElement:false
    }
  },
  created () {
    this.getPageData()
  },
  methods: {
    getPageData: function () {
      let id = this.page_id
      var self = this
      axios
        .get(APP_URL+ '/get-edit-page/' + id)
        .then(function (response) {
          if (response.data.type == 'success') {
            self.pageData = response.data.page
            if (self.pageData.section_list) {
                self.pageData.section_list.forEach(element => {
                  self.skeletons.push(element.section)
                  if (element.section == 'slider' || element.section == 'bannerV1') {
                    self.sliderSkeleton = true 
                  }
                  if (element.section == 'category') {
                    self.categorySkeleton = true 
                  }
                  if (element.section == 'welcome_section') {
                    self.welcomeSkeleton = true 
                  }
                  if (element.section == 'app_section') {
                    self.appSkeleton = true 
                  }
                  if (element.section == 'service_section') {
                    self.serviceSkeleton = true 
                  }
                  if (element.section == 'work_tab_section') {
                    self.howWorkSkeleton = true 
                  }
                  if (element.section == 'freelancer_section') {
                    self.freelancerSkeleton = true 
                  }
                  if (element.section == 'article_section') {
                    self.articleSkeleton = true 
                  }
                  if (element.section == 'work_video_section') {
                    self.workVideoSkeleton = true 
                  }
                  if (element.section == 'categoryV2') {
                    self.categoryV2Skeleton = true 
                  }
                  if (element.section == 'jobs_section') {
                    self.jobSkeleton = true 
                  }
                  if (element.section == 'freelancer_section_v2') {
                    self.freelancerV2Skeleton = true 
                  }
                  if (element.section == 'package_section') {
                    self.packageSkeleton = true 
                  }
                  if (element.section == 'categoryV3') {
                    self.categoryV3Skeleton = true 
                  }
                  if (element.section == 'heading') {
                    self.headingSkeleton = true 
                  }
                });
            }
            self.form.id = self.pageData.id
            self.form.title = self.pageData.title
            self.form.slug = self.pageData.slug
            self.form.parent_id = self.selected_parent
            self.form.seo_desc = self.seo_desc
            self.form.meta_title = self.pageData.meta_title
            self.form.meta.title.show = self.pageData.show_page_title
            self.form.show_page_banner = self.pageData.show_page_banner
            self.form.page_banner_value = self.pageData.banner
            self.form.show_page = self.pageData.show_page_navbar
            self.getSectionData()
          }
        })
        .catch(function (error) { })
    },
    getSectionData: function () {
      let id = this.page_id
      var self = this
      axios
        .get(APP_URL + '/page/get-sections/' + id)
        .then(function (response) {
          if (response.data.type == 'success') {
            self.pageData.sections = response.data.section_data
            if (self.pageData.section_list) {
              self.sections = self.pageData.section_list
              var sectionArray = Object.keys(self.pageData.sections).map(i => self.pageData.sections[i]);
              sectionArray.forEach(element => {
                element = element.filter(function (sec) {
                  self.sections.find(function (e) {
                    if (typeof sec != 'string') {
                      if (e.id == sec.id) {
                        self.form.meta[e.value].push(sec)
                      }
                    }
                  })
                })
              })
              setTimeout(() => {   
                self.sliderSkeleton = false
                self.categorySkeleton = false
                self.welcomeSkeleton = false
                self.appSkeleton = false
                self.serviceSkeleton = false
                self.howWorkSkeleton = false
                self.freelancerSkeleton = false
                self.articleSkeleton = false
                self.workVideoSkeleton = false
                self.categoryV2Skeleton = false
                self.jobSkeleton = false
                self.freelancerV2Skeleton = false
                self.packageSkeleton = false
                self.categoryV3Skeleton = false
                self.headingSkeleton = false
              }, 1000);
            }
          }
        })
        .catch(function (error) { })
    },
  }
}
</script>
