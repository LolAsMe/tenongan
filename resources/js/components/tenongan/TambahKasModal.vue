<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Tambah Kas</h5>
    <div slot="body">
      <form
        id="addForm"
        @submit.prevent="addKas"
        @keydown="form.onKeydown($event)"
      >
        <div class="form-floating mb-3">
          <input
            v-model="form.jumlah"
            type="text"
            class="form-control"
            placeholder="jumlah"
          />
          <label for="floatingInput">Jumlah</label>
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="form.keterangan"
            type="text"
            class="form-control"
            placeholder="keterangan"
          />
          <label for="floatingInput">Keterangan</label>
        </div>
      </form>
    </div>
    <template v-slot:footer>
      <button @click="$emit('toggle')" class="btn btn-secondary btn-sm">
        Close
      </button>
      <input
        type="submit"
        class="btn btn-primary btn-sm"
        form="addForm"
        value="Tambah"
      />
    </template>
  </basic-modal>
</template>

<script>
import Modal from "~/components/Modal";
import BasicModal from "~/components/tenongan/BasicModal";
import Form from "vform";

export default {
  name: "AddKasModal",
  components: {
    Modal,
    BasicModal,
  },
  props: {
    showModal: { type: Boolean, default: true },
  },
  data() {
    return {
      form: new Form({}),
    };
  },
  methods: {
    async addKas() {
      const { data } = await this.form.post("api/kas/inc");
      await this.$store.commit("kas/addLog", data);
      await this.form.reset();
      this.$store.dispatch("kas/fetchKas");
      this.$emit("toggle");
    },
  },
};
</script>
