<template>
  <div class="row">
    <div class="col">
      <card :title="'Dashboard'">
        {{ "ini halaman Dashboard" }}
        <button class="btn" v-on:click="finish">Finish</button>
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
              multiple
            />
          </div>
        </form>
        <input
          type="submit"
          class="btn btn-primary btn-sm"
          form="importForm"
          value="Import"
        />
        <div class="mb-2" v-for="(value, key) in tempPenjualans" :key="key">
          {{ value }}
        </div>
      </card>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  middleware: "auth",

  // async asyncData () {
  //   const { data: projects } = await axios.get('/api/projects')

  //   return {
  //     projects
  //   }
  // },
  computed: {
    ...mapGetters({
      user: "auth/user",
      tempPenjualans: "penjualan/tempPenjualans",
    }),
  },
  data() {
    return {
      formData: new FormData(),
      files: [],
    };
  },
  methods: {
    async finish() {
      await axios.post("/api/penjualan/temp/conclude");
    },
    async upload() {
      axios
        .post("/api/import/dashboard/penjualan", this.formData, {
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
      this.$store.dispatch("penjualan/fetchPenjualanTemp");
      this.showModal = false;
    },
    handleFileUpload() {
      this.files = [];
      for (let index = 0; index < this.$refs.file.files.length; index++) {
        this.formData.append(
          "files[" + index + "]",
          this.$refs.file.files[index]
        );
        this.files.push(this.$refs.file.files[index]);
        console.log(this.formData);
      }
    },
  },
  // directives: {
  //   role: {
  //     // directive definition
  //     bind: function (el, binding, vnode) {
  //       if (true) {
  //         // replace HTMLElement with comment node
  //         const comment = document.createComment(" ");
  //         Object.defineProperty(comment, "setAttribute", {
  //           value: () => undefined,
  //         });
  //         vnode.elm = comment;
  //         vnode.text = "test";
  //         vnode.isComment = true;
  //         vnode.context = undefined;
  //         vnode.tag = undefined;
  //         vnode.data.directives = undefined;

  //         if (vnode.componentInstance) {
  //           vnode.componentInstance.$el = comment;
  //         }

  //         if (el.parentNode) {
  //           el.parentNode.replaceChild(comment, el);
  //         }
  //       }
  //     },
  //   },
  // },
  created() {
    this.$store.dispatch("penjualan/fetchPenjualanTemp");
  },
  metaInfo() {
    return { title: "Dashboard" };
  },
};
</script>
