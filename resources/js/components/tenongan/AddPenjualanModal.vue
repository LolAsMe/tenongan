<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Titip Penjualan</h5>
    <div slot="body">
      <div class="row">
        <div class="col-8">{{ dataPenjualans }}</div>
        <div class="col-4">
          <form
            id="addForm"
            @submit.prevent="addPenjualan"
            @keydown="form.onKeydown($event)"
          >
            <div class="form-floating mb-3">
              <input
                v-model="form.produk_id"
                type="text"
                class="form-control"
                placeholder="produk_id"
              />
              <label for="floatingInput">Produk ID</label>
            </div>
            <div class="form-floating mb-3">
              <input
                v-model="form.pedagang_id"
                type="text"
                class="form-control"
                placeholder="pedagang_id"
              />
              <label for="floatingInput">Pedagang ID</label>
            </div>
            <div class="form-floating mb-3">
              <input
                v-model="form.titip"
                type="text"
                class="form-control"
                placeholder="titip"
              />
              <label for="floatingInput">Titip</label>
            </div>
            <div class="form-floating mb-3">
              <input
                v-model="form.laku"
                type="text"
                class="form-control"
                placeholder="laku"
              />
              <label for="floatingInput">laku</label>
            </div>
          </form>
            <button class="btn btn-primary" form="addForm">add</button>
            <button class="btn btn-primary" @click="resetDataPenjualan()">reset</button>
        </div>
      </div>
    </div>
    <template v-slot:footer>
      <button @click="$emit('toggle')" class="btn btn-secondary">Close</button>
      <input
        type="submit"
        class="btn btn-primary"
        @click="titip(), $emit('toggle')"
      />
    </template>
  </basic-modal>
</template>

<script>
import Modal from "~/components/Modal";
import { mapGetters, mapActions } from "vuex";

import BasicModal from "~/components/tenongan/BasicModal";
import Form from "vform";

export default {
  name: "AddPenjualanModal",
  components: {
    Modal,
    BasicModal,
  },
  props: {
    showModal: { type: Boolean, default: true },
  },
  computed: mapGetters({
    penjualans: "penjualan/penjualans",
    dataPenjualans: "penjualan/dataPenjualans",
  }),
  data() {
    return {
      form: new Form(),
    };
  },
  methods: {
    async titip() {
      await this.$store.dispatch("penjualan/titip");
      this.$store.dispatch("penjualan/fetchPenjualan");
      this.resetDataPenjualan()
      this.form.reset();
    },
    addPenjualan() {
      this.$store.commit("penjualan/addDataPenjualan", this.form.data());
      this.form.reset();
    },
    resetDataPenjualan(){
      this.$store.commit("penjualan/resetDataPenjualan");
    }
  },
};
</script>
