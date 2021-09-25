<template>
  <basic-modal v-if="showModal" @close="showModal = false">
    <h5 slot="header">Import</h5>
    <div slot="body">
      <form
        id="importForm"
        @submit.prevent="upload"
        @keydown="form.onKeydown($event)"
        enctype="multipart/form-data"
      >
        <div class="mb-3">
          <label for="formFile" class="form-label">File Import</label>
          <input
            @change="handleFileUpload"
            ref="file"
            class="form-control"
            type="file"
            id="file"
          />
        </div>
      </form>
    </div>
    <template v-slot:footer>
      <button @click="showModal = false" class="btn btn-secondary btn-sm">
        Close
      </button>
      <input
        type="submit"
        class="btn btn-primary btn-sm"
        form="importForm"
        value="Import"
      />
    </template>
  </basic-modal>
</template>

<script>
import BasicModal from "~/components/tenongan/BasicModal";
import Form from "vform";
import axios from "axios";

export default {
  name: "UploadModal",
  components: {
    BasicModal,
  },
  data() {
    return {
      form: new Form({}),
      showModal: false,
      file: "",
    };
  },
  props:{
    url:{type:String, default:''}
  },
  methods: {
    async upload() {
      let formData = new FormData();
      formData.append("file", this.file);

      axios
        .post("/api/import/"+this.url, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function () {
          console.log("FAILURE!!");
        });

    },
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },
  },
};
</script>
