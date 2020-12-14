<template>
    <vue-dropzone
      :options="dropzoneOptions"
      :id="id"
      :useCustomSlot="true"
      :ref="img_ref"
      :destroyDropzone="false"
      v-on:vdropzone-error="failed"
      v-on:vdropzone-thumbnail="validateDimentation"
      v-on:vdropzone-file-added="addedFile"
      v-on:vdropzone-removed-file="removedFile"
      v-on:vdropzone-queue-complete="successUpload"
      v-on:vdropzone-success="imageUploadSuccess"
      :class="'at-profile-setting__uploadarea'"
    >
        <div class="form-group form-group-label">
          <span v-if="img_label">{{img_label}}:</span>
            <div class="dc-labelgroup">
                <label for="file">
                    <span class="wt-btn">{{ trans('lang.select_files') }}</span>
                </label>
                <span>{{ trans('lang.drop_files') }}</span>
            </div>
        </div>
    </vue-dropzone>
</template>

<script>
import Event from "../event.js";
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
export default {
  props: [
    "id",
    "img_ref",
    "url",
    "name",
    "maxFiles",
    "type",
    "image_width",
    "image_height",
    "image_validation",
    "hidden_input_id",
    "list_id",
    "preview_class",
    "parent_id",
    "upload_title",
    "btn_text",
    "radio_image_name",
    "addEvent",
    "array_type",
    "img_label"
  ],
  components: {
    vueDropzone: vue2Dropzone
  },
  data: function() {
    return {
      fileEvent:this.addEvent,
      options: {
            error: {
                position: 'center',
                timeout: 4000,
            },
        },
      dropzoneOptions: {
        url: this.getUrl(),
        maxFilesize: 2, // MB
        maxFiles: this.getMaxFiles(),
        previewTemplate: this.getImageUploadTemplate(),
        previewsContainer: "." + this.getPreviewerClass(),
        paramName: this.getName(),
        renameFile: function (file) {
            var newName = Math.floor(1000 + Math.random() * 9000) + '-' + file.name;
            return file.renameFilename = newName
        },
        acceptedFiles: "image/*",
        headers: {
          "x-csrf-token": document
            .querySelectorAll("meta[name=csrf-token]")[0]
            .getAttributeNode("content").value
        },
        accept: function(file, done) {
            var myDropzone = this;
            file.acceptDimensions = done;
            var width = 'height';
            var height = 'width';
            Event.$on('invalid-dimentation', (data) => {
                if (data.width) {
                    width = data.width;
                }
                if (data.height) {
                    height = data.height
                }
            })
            file.rejectDimensions = function() { 
                done("image size must be " + width + '*' + height); 
            };
        }
      }
    };
  },
  methods: {
    showError(message){
      return this.$toast.error(' ', message, this.options.error);
    },
    getImageUploadTemplate() {
      return `
                <li>
                    <label>
                        <span>
                            <img data-dz-thumbnail />
                            <span class="at-trash"><a href="javascript:void(0);" data-dz-remove=""><i class="ti-trash"></i></a></span>
                            <span class="at-tick"><span><i class="fas fa-check"></i></span></span>
                        </span>
                    </label>
                </li>
                `;
    },
    getUrl() {
      return this.url;
    },
    getName() {
      return this.name;
    },
    getPreviewerClass() {
      return this.preview_class;
    },
    getAcceptedFiles() {
      
    },
    getMaxFiles() {
      if (this.maxFiles) {
        return this.maxFiles;
      } else {
        return 1;
      }
    },
    failed: function(file, message, xhr) {
      if (message == "You can not upload any more files.") {
        message = "you need to remove file before uploading new one.";
      }
      this.showError(message);
      this.$refs[this.img_ref].removeFile(file);
    },
    removedFile: function(file) {
      this.$emit("fileRemoved", 'file-remove')  
    },
    successUpload: function() {
      this.$emit("addedSuccess", 'file-add')  
    },
    imageUploadSuccess: function () {
      this.$emit("addedFile", 'file-add')  
    },
    addedFile: function(file) {
      // console.log(file.renameFilename)
      let parentClass = this.$refs[this.img_ref].id;
      parent = document.getElementById(this.parent_id)
      var imageList = document.querySelectorAll('.'+parentClass+ ' .at-profile-setting__imgs ul li').length;
      if (imageList > this.$refs[this.img_ref].dropzone.options.maxFiles) {
        var message = "you need to remove file before uploading new one.";
        this.showError(message);
        this.$refs[this.img_ref].removeFile(file);
        return false
      }
      var listitems= parent.getElementsByTagName("li")
      var i;
      for (i=0; i<listitems.length; i++) {
        if (!(listitems[i].id)) {
          listitems[i].setAttribute("id", this.list_id+"-"+i);
          var input = document.createElement("input");
          input.setAttribute("type", "hidden");
          if (this.array_type) {
            input.setAttribute("name",  this.array_type); 
          } else {
            input.setAttribute("name", 'image['+i+']'); 
          }
          input.setAttribute("value", file.renameFilename);
          input.setAttribute("id", this.hidden_input_id+'-'+i);
        }
        // this.$emit("addedFile", 'file-add')  
      }
      var listParent = document.getElementById(file.previewElement.id)
      listParent.appendChild(input);
    },
    validateDimentation: function(file) {
      if (file.accepted !== false) {
        if (this.image_validation == 'min') {
          if (file.width < this.image_width || file.height < this.image_height) {
            Event.$emit("invalid-dimentation", {
              width: this.image_width,
              height: this.image_height
            });
            file.rejectDimensions();
          } else {
            file.acceptDimensions();
          }
        } else {
          if (file.width > this.image_width || file.height > this.image_height) {
            Event.$emit("invalid-dimentation", {
              width: this.image_width,
              height: this.image_height
            });
            file.rejectDimensions();
          } else {
            file.acceptDimensions();
          }
        }
      }
      
    }
  },
  mounted: function() {}
};
</script>
