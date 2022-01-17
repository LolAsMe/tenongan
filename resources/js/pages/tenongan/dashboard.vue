<template>
  <div class="row">
    <div class="col">
      <card :title="'Dashboard'">
        <div>
          {{ "ini halaman Dashboard" }}
        </div>
        <button class="btn btn-primary" v-on:click="finish">Set</button>
        <button class="btn btn-primary" @click="transact">Transact</button>
        <button class="btn btn-primary" @click="pay">Pay</button>
        <button class="btn btn-primary" @click="reset">Reset</button>
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
        <button class="btn btn-primary" v-on:click="tempClear()">Clear</button>
        <div class="mb-2" v-for="(value, key) in tempPenjualans" :key="key">
          <div>
            ID : {{ value.id }}, FileName:
            {{ value.filename }}
          </div>
          <div>Data : {{ value.data }}</div>
          <div>Path: {{ value.path }}</div>
          <button class="btn btn-primary" v-on:click="tempDelete(value.id)">
            delete
          </button>
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
      this.$store.dispatch("penjualan/fetchPenjualanTemp");
    },
    async tempDelete(id) {
      await axios.post("/api/penjualan/temp/delete/" + id);
      this.$store.dispatch("penjualan/fetchPenjualanTemp");
    },
    async tempClear() {
      await axios.post("/api/penjualan/temp/clear");
      this.$store.dispatch("penjualan/fetchPenjualanTemp");
    },
    async upload() {
      await axios
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
    async transact() {
      const { data } = await axios.post("api/transaksi/penjualan/transact");
      this.$store.dispatch("penjualan/fetchPenjualan");
      console.log(data)
    },
    async pay() {
      const { data } = await axios.post("api/transaksi/penjualan/transact/pay");
      this.$store.dispatch("penjualan/fetchPenjualan");
    },
    async reset() {
      const { data } = await axios.post("api/penjualan/reset");
      this.$store.dispatch("penjualan/fetchPenjualan");
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
