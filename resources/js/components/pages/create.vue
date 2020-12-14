<template>
  <div class="col-lg-11 at-preview-wrap">
    <div class="at-dhb-main_content at-listing-holder">
      <draggable class="container list-group dragArea" animation: 0, :list="sections" ref="sortable_section" group="section" @end="sortData" @change="updateSection">
        <div
          class="list-group-item jb-edit-box"
          v-for="(element, index) in sections"
          :key="element.id"
          :id="'section'+index"
        >
          <a href="javascript:void(0);" class="jb-delparent" v-on:click="removeSection('section'+index, index, element.value)"><i class="ti-trash"></i></a>
          <div class="jb-sortable">
            <a href="javascript:void(0);" class="jb-sorting-icon"><i class="ti-fullscreen"></i></a>
            <a href="javascript:void(0);" class="jb-copy"><i class="ti-layers"></i></a>
          </div>
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
          <categories-v2
            :element_id="element.id"
            :categories="form.meta.categoriesSecondVersion"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='categoryV2'">
          </categories-v2>
          <categories-v3
            :element_id="element.id"
            :categories="form.meta.categoriesThirdVersion"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='categoryV3'">
          </categories-v3>
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
          <freelancers-v2 
            :element_id="element.id"
            :freelancers="form.meta.freelancersSecondVersion"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='freelancer_section_v2'">
          </freelancers-v2>
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
            v-else-if="element.section =='app_section'">
          </app>
          <work-tab 
            :element_id="element.id"
            :work_sec="form.meta.work_tabs"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='work_tab_section'">
          </work-tab>
          <work-video 
            :element_id="element.id"
            :work_sec="form.meta.work_videos"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='work_video_section'">
          </work-video>
          <welcome 
            :element_id="element.id"
            :welcome_section="form.meta.welcome_sections"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='welcome_section'">
          </welcome>
          <jobs 
            :element_id="element.id"
            :jobs="form.meta.jobs"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='jobs_section'">
          </jobs>
          <packages 
            :element_id="element.id"
            :packages="form.meta.packages"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='package_section'">
          </packages>
          <banner-v1
            :element_id="element.id"
            :banner_sec="form.meta.bannerFirstVersion"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='bannerV1'">
          </banner-v1>
          <slider 
            :element_id="element.id"
            :sliders="form.meta.sliders"
            @editData="editSection(element)"
            :parent_index="index" 
            v-else-if="element.section =='slider'">
          </slider>
        </div>
      </draggable>
    </div>
    <div id="amt-sidebar-pagebuilder" class="amt-sidebar-pagebuilder">
      <div id="amt-btnmenutoggle" v-on:click="addClass" class="amt-btnmenutoggle">
        <a href="javascript:void(0)" class="btn"><span class="ti-settings"></span></a>
      </div>
      <div class="at-verticalscrollbar">
        <form method="POST" id="pages" class="wt-formtheme wt-formprojectinfo wt-formcategory" @submit.prevent="submitPage()">
          <div class="amt-sidebar-section-wrap" id="amt-sidebar-section-wrap">
            <div class="amt-titlehead">
              <h3>{{ trans('lang.custom_page_builder') }}<em class="amt-tag">{{ trans('hot') }}</em></h3>
              <p>{{ trans('lang.custom_page_builder_note') }}</p>
            </div>
            <div class="amt-section-select">
              <input type="text" name="title" class="form-control" :placeholder="trans('lang.title')" v-model="form.title">
            </div>
            <div class="amt-allsection">
              <span class="amt-allsection__title"><strong> {{ list.length }} {{ trans('lang.sections_avail') }} </strong></span>
              <div class="amt-sections">
                <draggable
                  tag="ul"
                  class="wt-draggable-group dragArea"
                  :list="list"
                  ref="sortable_section"
                  :clone="cloneSection"
                  :sort="false"
                  :group="{ name: 'section', pull: 'clone', put: false }">
                  <li v-for="(element, listIndex) in list" :key="element.name+listIndex">
                    <div class="amt-section-slot">
                      <img :src="IconPath+element.icon" alt="img description">
                      <span>{{ element.name }}</span>
                    </div>
                  </li>
                </draggable>
              </div>
            </div>
            <div class="amt-section-footer">
              <!-- Header Styles -->
              <a href="javascript:void(0);"
                 class="at-collapse-switches"
                 data-toggle="collapse"
                 data-target="#at-collapse-switches1"
                 aria-expanded="false"
              >
                {{ trans('lang.headers') }}
                <i class="ti-angle-right"></i>
              </a>
              <div id="at-collapse-switches1" class="amt-switches-options collapse">
                <headers :form="form"/>
              </div>
              <!-- Footer Styles -->
              <a href="javascript:void(0);"
                 class="at-collapse-switches"
                 data-toggle="collapse"
                 data-target="#at-collapse-switches2"
                 aria-expanded="false"
              >
                {{ trans('lang.footers') }}
                <i class="ti-angle-right"></i>
              </a>
              <div id="at-collapse-switches2" class="amt-switches-options collapse">
                <footers :form="form"/>
              </div>
              <!-- Headers Styles -->
              <a href="javascript:void(0);"
                 class="at-collapse-switches"
                 data-toggle="collapse"
                 data-target="#at-collapse-switches-header"
                 aria-expanded="false"
                 v-on:click="displayHeaderStyling"
              >
                {{ trans('lang.header_styling') }}
                <i class="ti-angle-right"></i>
              </a>
              <div id="at-collapse-switches-header" class="amt-switches-options collapse">
                <header-styling :form="form" :pageID="form.id" :displayColorSettings="displayColorSettings"/>
              </div>
              <!-- Page Options -->
              <a href="javascript:void(0);"
                 class="at-collapse-switches"
                 data-toggle="collapse"
                 data-target="#at-collapse-switches"
                 aria-expanded="true"
              >
                {{ trans('lang.page_options') }}
                <i class="ti-angle-right"></i>
              </a>
              <div id="at-collapse-switches" class="amt-switches-options collapse show">
                <page-data :form="form" :parentPages="parentPages" :pageID="form.id"/>
              </div>
            </div>
          </div>
          <div class="amt-section-content-area" id="amt-section-content-area" style="display:none;">
            <div class="amt-titlehead">
              <h3>
                <a href="javascript.void(0);" class="amt-section-back" v-on:click.prevent="displaySection"><i class="ti-angle-left"></i></a>
                {{ trans('lang.custom_page_builder') }}
                <em class="amt-tag">{{ trans('lang.hot') }}</em>
              </h3>
              <p>{{ trans('lang.custom_page_builder_note') }}</p>
            </div>
            <heading-form
              :headings="form.meta.headings[this.currentElementIndex]"
              v-if="currentSection =='heading'"
            />
            <editor-form
              :editor="form.meta.content[this.currentElementIndex]"
              v-if="currentSection =='content_section'"
            />
            <categories-form
              :category="form.meta.cat[this.currentElementIndex]"
              v-if="currentSection =='category'"
            />
            <categories-v2-form
              :category="form.meta.categoriesSecondVersion[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :cloneElement="cloneElement"
              v-if="currentSection =='categoryV2'"
            />
            <categories-v3-form
              :category="form.meta.categoriesThirdVersion[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :cloneElement="cloneElement"
              v-if="currentSection =='categoryV3'"
            />
            <services-form
              :service="form.meta.services[this.currentElementIndex]"
              :currentElementID="currentElementID"
              v-if="currentSection =='service_section'"
            />
            <freelancers-form
              :freelancer="form.meta.freelancers[this.currentElementIndex]"
              v-if="currentSection =='freelancer_section'"
            />
            <freelancers-v2-form
              :freelancer="form.meta.freelancersSecondVersion[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :cloneElement="cloneElement"
              v-if="currentSection =='freelancer_section_v2'"
            />
            <articles-form
              :article="form.meta.articles[this.currentElementIndex]"
              v-if="currentSection =='article_section'"
            />
            <app-form
              :app="form.meta.app_section[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :styles="appStyleList"
              :cloneElement="cloneElement"
              v-if="currentSection =='app_section'"
            />
            <work-tab-form
              :work="form.meta.work_tabs[this.currentElementIndex]"
              :cloneElement="cloneElement"
              :currentElementID="currentElementID"
              v-if="currentSection =='work_tab_section'"
            />
            <work-video-form
              :work_video="form.meta.work_videos[this.currentElementIndex]"
              :cloneElement="cloneElement"
              :currentElementID="currentElementID"
              v-if="currentSection =='work_video_section'"
            />
            <welcome-form
              :welcome="form.meta.welcome_sections[this.currentElementIndex]"
              :cloneElement="cloneElement"
              :currentElementID="currentElementID"
              v-if="currentSection =='welcome_section'"
            />
            <jobs-form
              :job="form.meta.jobs[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :cloneElement="cloneElement"
              v-if="currentSection =='jobs_section'"
            />
            <packages-form
              :pkg="form.meta.packages[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :cloneElement="cloneElement"
              v-if="currentSection =='package_section'"
            />
            <banner-v1-form
              :banner="form.meta.bannerFirstVersion[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :cloneElement="cloneElement"
              v-if="currentSection =='bannerV1'"
            />
            <slider-form
              :slider="form.meta.sliders[this.currentElementIndex]"
              :currentElementID="currentElementID"
              :cloneElement="cloneElement"
              :styles="sliderStyleList" 
              v-if="currentSection =='slider'"
            />
          </div>
          <div class="at-account-save__button">
            <button type="submit" class="wt-btn btn-success">
              {{ trans('lang.publish') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import Event from '../../event'
import draggable from "vuedraggable"
import PageData from './page-data'
import headers from './headers'
import footers from './footers'
import heading from './sections/heading'
import headingForm from './section-forms/heading'
import editor from './sections/editor'
import editorForm from './section-forms/editor'
import categories from './sections/categories'
import categoriesForm from './section-forms/categories'
import services from './sections/services'
import servicesForm from './section-forms/services'
import freelancersForm from './section-forms/freelancers'
import freelancers from './sections/freelancers'
import articles from './sections/articles'
import articlesForm from './section-forms/articles'
import appForm from './section-forms/app'
import app from './sections/app/index'
import workTabForm from './section-forms/work_tab'
import workTab from './sections/work_tab'
import workVideoForm from './section-forms/work_video'
import workVideo from './sections/work_video'
import welcomeForm from './section-forms/welcome'
import welcome from './sections/welcome'
import categoriesV2Form from './section-forms/categoriesV2'
import categoriesV2 from './sections/categoriesV2'
import categoriesV3Form from './section-forms/categoriesV3'
import categoriesV3 from './sections/categoriesV3'
import freelancersV2Form from './section-forms/freelancersV2'
import freelancersV2 from './sections/freelancersV2'
import jobsForm from './section-forms/jobs'
import jobs from './sections/jobs'
import packagesForm from './section-forms/packages'
import packages from './sections/packages'
import bannerV1Form from './section-forms/bannerV1'
import bannerV1 from './sections/bannerV1'
import sliderForm from './section-forms/slider'
import slider from './sections/sliders/index'
import headerStyling from './header-styling'

let idGlobal = 1

export default {
  props:['section_list', 'layout_list', 'access_type', 'app_styles', 'parent_pages', 'slider_styles'],
  order: 5,
  components: {
    headerStyling,
    draggable,
    footers,
    headers,
    PageData,
    heading,
    headingForm,
    editor,
    editorForm,
    categories,
    categoriesForm,
    services,
    servicesForm,
    freelancersForm,
    freelancers,
    articles,
    articlesForm,
    appForm,
    app,
    workTabForm,
    workTab,
    workVideoForm,
    workVideo,
    welcomeForm,
    welcome,
    categoriesV2Form,
    categoriesV2,
    freelancersV2Form,
    freelancersV2,
    jobsForm,
    jobs,
    packagesForm,
    packages,
    bannerV1Form,
    bannerV1,
    sliderForm,
    slider,
    categoriesV3Form,
    categoriesV3
  },
  data () {
    return {
      displayColorSettings: true,
      currentElementID:'',
      form: {
        meta_title: '',
        show_page_banner: true,
        show_page_title: true,
        show_page: true,
        page_banner_value:'',
        seo_desc:'',
        parent_id: '',
        slug: '',
        id: '',
        title: '',
        sections: [],
        parent_type:'page',
        headerStyling:{
          logo:'',
          menuColor:'',
          menuHoverColor:'',
          color:'',
        },
        meta: {
          headings: [],
          content: [],
          cat:[],
          categoriesSecondVersion:[],
          services:[],
          freelancers:[],
          freelancersSecondVersion:[],
          app_section:[],
          work_tabs:[],
          work_videos:[],
          welcome_sections:[],
          articles:[],
          jobs:[],
          packages:[],
          bannerFirstVersion:[],
          sliders:[],
          categoriesThirdVersion:[],
          header: 'style1',
          footer: 'style1',
          page_order: '',
          title:{
            show:true
          } 
        }
      },
      currentElementIndex: '',
      currentSection: '',
      sectionSliders:[],
      sections: [],
      list: [],
      list:JSON.parse(this.section_list),
      appStyleList: JSON.parse(this.app_styles),
      parentPages: JSON.parse(this.parent_pages),
      sliderStyleList: JSON.parse(this.slider_styles),
      // layouts:JSON.parse(this.layout_list),
      baseURL:APP_URL,
      IconPath:APP_URL+'/images/page-builder/',
      sectionLocations:[],
      searchableRoles:[],
      cloneElement:false
    }
  },
  created: function () {
    document.querySelector('body').classList.add('page-builder-body')
  },
  updated: function() {
    
  },
  methods: {
    displayHeaderStyling: function() {
      var self = this
      self.displayColorSettings = false
      setTimeout (function () {
          self.displayColorSettings = true
      },5 )
    },
    removeSection: function (elementId, index, section) {
      var selectedSectionIndex = this.getArrayIndex(this.form.meta[section], 'parentIndex', index)
      this.form.meta[section].splice(selectedSectionIndex, 1)
      this.sections.splice(index, 1)
      document.getElementById(elementId).remove()
      this.displaySection()
    },
    displaySection: function () {
      document.getElementById('amt-sidebar-section-wrap').style.display = 'block'
      document.getElementById('amt-section-content-area').style.display = 'none'
    },
    editSection: function (element) {
      this.currentSection = element.section
      this.currentElementIndex = this.getArrayIndex(this.form.meta[element.value], 'id', element.id)
      this.currentElementID = element.id
      this.cloneElement = true
      document.getElementById('amt-sidebar-section-wrap').style.display = 'none'
      document.getElementById('amt-section-content-area').style.display = 'block'
    },
    cloneSection: function (evt) {
      this.cloneElement = true
      return {
        name: evt.name,
        section: evt.section,
        value: evt.value,
        icon: evt.icon,
        id: idGlobal++
      }
    },
    addClass: function () {
      document.querySelector('.amt-sidebar-pagebuilder').classList.toggle('amt-pagebuilderon')
    },
    
    submitPage: function () {
      // this.loading = true;
      var self = this
      var l
      self.sections.map(function (item, index) {
        if (self.form.meta[item.value]) {
          var formIndex = self.getArrayIndex(self.form.meta[item.value], 'id', item.id)
          self.form.meta[item.value][formIndex].parentIndex = index
        }
      })
      self.form.sections = JSON.stringify(self.sections)
      axios.post(APP_URL +'/admin/store-page', self.form)
        .then(function (response) {
          if (response.data.type == 'success') {
            self.showMessage(self.trans('lang.page_added'))
            window.location.replace(APP_URL + '/admin/pages');
          } else if (response.data.type == 'error') {
              self.showError(response.data.message);
          }
        })
        .catch(function (error) {
          if (error.response.data.errors.title) {
            self.showError(self.trans('lang.title_required'))
          }
        })
    },
    sortData: function (evt) {
      this.sections = this.sections.sort((a, b) => a.order - b.order)
    },
    updateSection: function (evt) {
      if (evt.added) {
        if (evt.added.element.section == 'heading') {
          var heading = {
            title: 'Add your Heading text here',
            link: '',
            url: '',
            tag: 'h1',
            action: '',
            alignment: '',
            color: '#000',
            padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            margin: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            elementClass: '',
            elementId: '',
            sectionId: '',
            sectionClass: '',
            id: this.sections[evt.added.newIndex].id,
            parentIndex: ''
          }
          this.form.meta.headings.push(heading)
        } else if (evt.added.element.section == 'content_section') {
          var editor = {
            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac augue ac velit congue interdum. Morbi nec nibh sem. Morbi tempor neque in pharetra laoreet. Phasellus feugiat, magna sed mattis placerat, dui lacus maximus massa, sit amet consectetur dolor tortor eu nisi. Nam justo mauris, pretium sit amet condimentum id, dictum sed tellus. Curabitur ac tempor tortor. Fusce consequat, ipsum a sollicitudin cursus, metus libero eleifend tortor, non finibus arcu ante ut nisl. Duis convallis tristique lacus vitae imperdiet. Sed aliquam in ex ac iaculis. Nunc at lacinia diam. In feugiat neque sed nibh suscipit, ut ultricies eros malesuada. Pellentesque ultrices mi quis arcu molestie, efficitur convallis ipsum interdum. Aliquam mauris tortor, imperdiet sit amet euismod at, elementum ac est. Fusce felis purus, aliquet et enim ut, feugiat viverra lectus. Suspendisse cursus nibh nec elit laoreet convallis. Nunc erat tortor, imperdiet ac cursus vel, commodo quis mi.',
            sectionColor: '#ffffff',
            color: '#000',
            padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            margin: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            elementClass: '',
            elementId: '',
            sectionId: '',
            sectionClass: '',
            id: this.sections[evt.added.newIndex].id,
            parentIndex: ''
          }
          this.form.meta.content.push(editor)
        } else if (evt.added.element.section == 'category') {
          var cat = {
            title:'Category Title',
            subtitle:'Category Subtitle',
            description:'Category Description',
            sectionColor: '#ffffff',
            titleColor:'#3d4461',
            subtitleColor:'#3d4461',
            padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            margin: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            sectionId: '',
            sectionClass: '',
            id: this.sections[evt.added.newIndex].id,
            parentIndex: ''
          }
          this.form.meta.cat.push(cat)
        } else if (evt.added.element.section == 'categoryV2') {
          var catV2 = {
            title:'Trending',
            subtitle:'Top Categories',
            description:'Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina',
            sectionColor: '#ffffff',
            backgroundImg: '',
            titleColor:'#3d4461',
            subtitleColor:'#f62b84',
            showAllBtnUrl:'#',
            lastTabTitle:'Explore Categories',
            lastTabDesc:'Consectetur adipisicing elit deius temor incididunt utnenbo',
            padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            margin: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            sectionId: '',
            sectionClass: '',
            id: this.sections[evt.added.newIndex].id,
            parentIndex: ''
          }
          this.form.meta.categoriesSecondVersion.push(catV2)
        } else if (evt.added.element.section == 'categoryV3') {
          var catV3 = {
            title:'Versatile',
            titleTwo:'Categories',
            subtitle:'Explore with our',
            description:'Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum dolore eunfugiat nulla pariatur lokaim urianewce sint.',
            sectionColor: '#ffffff',
            backgroundImg: '',
            titleColor:'#3d4461',
            titleTwoColor:'#9013fe',
            subtitleColor:'#3d4461',
            showAllBtnUrl:'#',
            padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            margin: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            sectionId: '',
            sectionClass: '',
            id: this.sections[evt.added.newIndex].id,
            parentIndex: ''
          }
          this.form.meta.categoriesThirdVersion.push(catV3)
        } else if (evt.added.element.section == 'service_section') {
          var service = {
            title:'Service Title',
            subtitle:'Service Subtitle',
            description:'Service Description',
            sectionColor: '#ffffff',
            titleColor:'#3d4461',
            subtitleColor:'#3d4461',
            padding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            margin: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
              unit: 'px'
            },
            sectionId: '',
            sectionClass: '',
            id: this.sections[evt.added.newIndex].id,
            parentIndex: ''
          }
          this.form.meta.services.push(service)
        } else if (evt.added.element.section == 'freelancer_section') {
            var freelancer = {
              title:'Freelancer Title',
              subtitle:'Freelancer Subtitle',
              description:'Freelancer Description',
              sectionColor: '#ffffff',
              titleColor:'#3d4461',
              subtitleColor:'#3d4461',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.freelancers.push(freelancer)
        } else if (evt.added.element.section == 'freelancer_section_v2') {
            var freelancer = {
              title:'Top',
              titleTwo:'Freelancers',
              description:'Freelancer Description',
              backgroundImg:'',
              sectionColor: '#ffffff',
              titleColor:'#3d4461',
              titleTwoColor:'#f62b84',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.freelancersSecondVersion.push(freelancer)
        } else if (evt.added.element.section == 'article_section') {
            var article = {
              title:'Article Title',
              subtitle:'Article Subtitle',
              description:'Article Description',
              sectionColor: '#ffffff',
              titleColor:'#3d4461',
              subtitleColor:'#3d4461',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.articles.push(article)
        } else if (evt.added.element.section == 'app_section') {
            var app = {
              title:'App Title',
              titleTwo:'Title Two',
              subtitle:'App Subtitle',
              description:'App Description',
              andriod_url: '#',
              ios_url: '#',
              background_image: '',
              app_image: '',
              ios_image: '',
              android_image: '',
              style: null,
              sectionColor: '#ffffff',
              titleColor:'#3d4461',
              titleTwoColor:'#f62b84',
              subtitleColor:'#3d4461',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.app_section.push(app)
        } else if (evt.added.element.section == 'work_tab_section') {
            var work = {
              title:'Work Tab Section Title',
              subtitle:'Work Tab Section Subtitle',
              description:'Work Tab Section Description',
              background_image:'',
              first_tab_icon:'',
              second_tab_icon:'',
              third_tab_icon:'',
              first_tab_title: '',
              first_tab_subtitle: '',
              second_tab_title: '',
              second_tab_subtitle: '',
              third_tab_title: '',
              third_tab_subtitle: '',
              sectionColor: '#ffffff',
              titleColor:'#3d4461',
              subtitleColor:'#3d4461',
              descColor:'#3d4461',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.work_tabs.push(work)
        } else if (evt.added.element.section == 'work_video_section') {
            var work = {
              title:'Work Video Section Title',
              subtitle:'Work Video Section Subtitle',
              description:'Work Video Section Description',
              video_poster:'',
              video_link:'',
              sectionColor: '#ffffff',
              titleColor:'#3d4461',
              subtitleColor:'#3d4461',
              descColor:'#3d4461',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.work_videos.push(work)
        } else if (evt.added.element.section == 'welcome_section') {
            var welcome = {
              first_title:'First section title',
              first_url:'First Section Url',
              first_url_button:'First Section Btn Text',
              first_description:'First Section Description',
              second_title:'Second section title',
              second_url:'Second Section Url',
              second_url_button:'Second Section Btn Text',
              second_description:'Second Section Description',
              welcome_background:'',
              sectionColor: '#ffffff',
              firstTitleColor:'#323232',
              firstDescColor:'#323232',
              firstBtnColor:'#ffffff',
              secondBtnColor:'#ffffff',
              secondTitleColor:'#323232',
              secondDescColor:'#323232',
              descColor:'#3d4461',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.welcome_sections.push(welcome)
        } else if (evt.added.element.section == 'jobs_section') {
            var job = {
              title:'Latest',
              titleTwo:'Jobs Opening',
              description:'Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita',
              backgroundImg: '',
              sectionColor: '#ffffff',
              titleColor:'#3d4461',
              titleTwoColor:'#f62b84',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.jobs.push(job)
        }  else if (evt.added.element.section == 'package_section') {
            var pkg = {
              title:'Top',
              titleTwo:'Packages',
              description:'Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita',
              sectionColor: '#ffffff',
              backgroundImg:'',
              titleColor:'#3d4461',
              titleTwoColor:'#f62b84',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.packages.push(pkg)
        } else if (evt.added.element.section == 'bannerV1') {
            var banner = {
              title:'Most Powerful Directory',
              subtitle:'Available for Service Providers',
              videoTitle:'See For Yourself!',
              videoDesc:'How it works & experience the ultimate joy.',
              videoUrl:'#',
              backgroundImg:'',
              backgroundType:'gradient',
              gradientStyle:'to bottom',
              gradient1:'#934cff',
              gradient2:'#f62b84',
              frontImg:'',
              showSearchForm:true,
              sectionColor: '#a5a5a5',
              titleColor:'#ffffff',
              subtitleColor:'#ffffff',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.bannerFirstVersion.push(banner)
        } else if (evt.added.element.section == 'slider') {
            var slider = {
              style:null,
              slider_image:[],
              inner_banner_image:'',
              floating_image01:'',
              floating_image02:"",
              enable_search_form:true,
              search_form_title:'That Help You To Go Ahead',
              search_form_subtitle:'Best Service Providers',
              price_range_title:'Price Range:',
              listing_tagline:'More than 2500 listings available',
              title: 'Title Your Need',
              subtitle: 'We Have Everyone',
              tagline:'Looking For Professional?',
              description: 'Consectetur adipisicing elition sedames dotem iusmod temporei incuntes utnalo labore etdolore maina aliqua enim adion minim veniam quis nsitrud exercitation ullamco laboris nisiutaliquip ex ea commodo.',
              video_link: '',
              video_title: '',
              video_description: '',
              taglineColor:'#ffffff',
              titleColor:'#ffffff',
              subtitleColor:'#ffffff',
              sectionColor: '#a5a5a5',
              padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
                unit: 'px'
              },
              sectionId: '',
              sectionClass: '',
              id: this.sections[evt.added.newIndex].id,
              parentIndex: ''
            }
            this.form.meta.sliders.push(slider)
        }
        this.editSection(evt.added.element)
      } else if (evt.moved) {
        var self = this
        setTimeout(function () {
          if (evt.moved.section == 'heading') {
            Event.$emit('heading-section-update')
          } else if (evt.moved.section == 'category') {
            Event.$emit('category-section-update')
          } else if (evt.moved.section == 'welcome_section') {
            Event.$emit('welcome-section-update')
          } else if (evt.moved.section == 'app_section') {
            Event.$emit('app-section-update')
          } else if (evt.moved.section == 'service_section') {
            Event.$emit('service-section-update')
          } else if (evt.moved.section == 'work_video_section') {
            Event.$emit('work-video-section-update')
          } else if (evt.moved.section == 'work_tab_section') {
            Event.$emit('work-section-update')
          } else if (evt.moved.section == 'freelancer_section') {
            Event.$emit('freelancer-section-update')
          } else if (evt.moved.section == 'content_section') {
            Event.$emit('editor-section-update')
          } else if (evt.moved.section == 'article_section') {
            Event.$emit('article-section-update')
          } else if (evt.moved.section == 'categoryV2') {
            Event.$emit('category-sectionV2-update')
          } else if (evt.moved.section == 'categoryV3') {
            Event.$emit('category-sectionV3-update')
          } else if (evt.moved.section == 'freelancer_section_v2') {
            Event.$emit('freelancer-sectionV2-update')
          } else if (evt.moved.section == 'jobs_section') {
            Event.$emit('job-section-update')
          } else if (evt.moved.section == 'package_section') {
            Event.$emit('pkg-section-update')
          } else if (evt.moved.section == 'bannerV1') {
            Event.$emit('banner-section-update')
          }
          self.editSection(evt.moved.element)
        }, 100)

      }
      // this.cloneElement = false
    }
  }
}
</script>
<style>
.flip-list-move {
  transition: transform 0.5s;
}
.no-move {
  transition: transform 0s;
}
</style>
