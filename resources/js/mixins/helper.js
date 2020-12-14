import Vue from 'vue'

Vue.mixin({
  data () {
    return {
      notificationSystem: {
        success: {
          position: 'topRight',
          timeout: 3000
        },
        error: {
          position: 'topRight',
          timeout: 4000
        },
        completed: {
          overlay: true,
          zindex: 999,
          position: 'center',
          timeout: 1000,
          progressBar: false
        },
        info: {
          overlay: true,
          zindex: 999,
          position: 'center',
          timeout: 3000,
          class: 'iziToast-info',
          id: 'info_notify'
        }
      }
    }
  },
  methods: {
    showError (message) {
      return this.$toast.error(' ', message, this.notificationSystem.error)
    },
    showCompleted (message) {
      return this.$toast.success(' ', message, this.notificationSystem.completed)
    },
    showInfo (message) {
      return this.$toast.info(' ', message, this.notificationSystem.info)
    },
    showMessage (message) {
      return this.$toast.success(' ', message, this.notificationSystem.success)
    },  
    escapeHtml: function(text) {
      var map = {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#039;'
      };
      return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    },
    strip_tags: function(str, allow){ 
      allow = (((allow || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); 
      var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi; 
      var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi; 
      return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) { 
      return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 :''; 
      }); 
    },
    getArrayIndex (array, attr, value) {
        for (var i = 0; i < array.length; i += 1) {
            if (array[i][attr] == value) {
            return i
            }
        }
        return -1
    },
    getHeadingTags () {
      return ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']
    },
    /*
    The function below returns
    packages list
    */
    getPackageDurationList (key = '') {
      let list = {
        '10': this.trans('lang.pckge_duration.10'),
        '30': this.trans('lang.pckge_duration.30'),
        '360': this.trans('lang.pckge_duration.360')
      }
      if (key && (key in list)) {
        return list[key]
      } else {
        return list
      }
    },

    /*
    The function below returns
    Header style list
    */
    getHeaderStyles (key = '') {
      let list = {
        '1': {
          'title': this.trans('lang.style01'),
          'value': 'style1',
          'img' : APP_URL+'/images/page-builder/headers/header1.jpg'
        },
        '2': {
          'title': this.trans('lang.style02'),
          'value': 'style2',
          'img' : APP_URL+'/images/page-builder/headers/header2.jpg'
        },
        '3': {
          'title': this.trans('lang.style03'),
          'value': 'style3',
          'img' : APP_URL+'/images/page-builder/headers/header3.jpg'
        },
        '4': {
          'title': this.trans('lang.style04'),
          'value': 'style4',
          'img' : APP_URL+'/images/page-builder/headers/header4.jpg'
        },
        '5': {
          'title': this.trans('lang.style05'),
          'value': 'style5',
          'img' : APP_URL+'/images/page-builder/headers/header5.jpg'
        }
      }
      if (key && (key in list)) {
        return list[key]
      } else {
        return list
      }
    },

    /*
    The function below returns
    Header style list
    */
    getInnerHeaderStyles (key = '') {
      let list = {
        '1': {
          'title': this.trans('lang.style01'),
          'value': 'style1',
          'img' : APP_URL+'/images/page-builder/headers/header1.jpg'
        },
        '2': {
          'title': this.trans('lang.style02'),
          'value': 'style2',
          'img' : APP_URL+'/images/page-builder/headers/header2.jpg'
        },
        '3': {
          'title': this.trans('lang.style03'),
          'value': 'style3',
          'img' : APP_URL+'/images/page-builder/headers/header3.jpg'
        },
        '4': {
          'title': this.trans('lang.style04'),
          'value': 'style4',
          'img' : APP_URL+'/images/page-builder/headers/header4.jpg'
        },
      }
      if (key && (key in list)) {
        return list[key]
      } else {
        return list
      }
    },

    /*
    The function below returns
    Footer style list
    */
    getFooterStyles (key = '') {
      let list = {
        '1': {
          'title': this.trans('lang.style01'),
          'value': 'style1',
          'img' : APP_URL+'/images/page-builder/footers/footer1.jpg'
        },
        '2': {
          'title': this.trans('lang.style02'),
          'value': 'style2',
          'img' : APP_URL+'/images/page-builder/footers/footer2.jpg'
        },
        '3': {
          'title': this.trans('lang.style03'),
          'value': 'style3',
          'img' : APP_URL+'/images/page-builder/footers/footer3.jpg'
        },
      }
      if (key && (key in list)) {
        return list[key]
      } else {
        return list
      }
    },

    /*
    The function below returns
    Footer style list
    */
    getBackgroundTypes (key = '') {
      let list = {
        '1': {
          'title': this.trans('lang.gradient'),
          'value': 'gradient',
        },
        '2': {
          'title': this.trans('lang.img'),
          'value': 'img',
        },
      }
      if (key && (key in list)) {
        return list[key]
      } else {
        return list
      }
    },

    /*
    The function below returns
    Footer style list
    */
    getGradientStyles (key = '') {
      let list = {
        '1': {
          'title': this.trans('lang.to_top'),
          'value': 'to top',
        },
        '2': {
          'title': this.trans('lang.to_bottom'),
          'value': 'to bottom',
        },
        '3': {
          'title': this.trans('lang.to_left'),
          'value': 'to left',
        },
        '4': {
          'title': this.trans('lang.to_right'),
          'value': 'to right',
        },
      }
      if (key && (key in list)) {
        return list[key]
      } else {
        return list
      }
    },
  }
})