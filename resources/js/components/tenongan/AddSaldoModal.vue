<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Tambah Saldo</h5>
    <div slot="body">
      <form
        id="addForm"
        @submit.prevent="addSaldo"
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
            v-model="form.pedagang_id"
            type="text"
            class="form-control"
            placeholder="pedagang_id"
          />
          <label for="floatingInput">Pedagang Id</label>
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
  name: "AddSaldoModal",
  components: {
    Modal,
    BasicModal,
  },
  props: {
    showModal: { type: Boolean, default: true },
  },
  data() {
    return {
      form: new Form({
      }),
    };
  },
  methods: {
    async addSaldo() {
      const { data } = await this.form.post("api/saldo/inc/"+this.form.pedagang_id);
      await this.$store.dispatch("saldo/fetchSaldos");
      await this.form.reset();
      this.$emit("toggle");
    },
  },
};
</script>
