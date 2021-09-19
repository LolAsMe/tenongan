<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Edit Penjualan</h5>
    <div slot="body">
      {{ penjualan }}
      <form
        id="editForm"
        @submit.prevent="editPenjualan"
        @keydown="form.onKeydown($event)"
      >
        <div class="form-floating mb-3">
          <input
            v-model="form.idd"
            type="text"
            class="form-control"
            placeholder="idd"
          />
          <label for="floatingInput">id</label>
        </div>
        <!-- <div class="form-floating mb-3">
          <input
            v-model="form.nama"
            type="text"
            class="form-control"
            placeholder="nama"
          />
          <label for="floatingInput">Nama</label>
        </div> -->
      </form>
    </div>
    <template v-slot:footer>
      <button @click="$emit('toggle')" class="btn btn-secondary btn-sm">
        Close
      </button>
      <input
        type="submit"
        class="btn btn-primary btn-sm hasdf"
        form="editForm"
        value="Edit"
      />
    </template>
  </basic-modal>
</template>

<script>
import Modal from "~/components/Modal";
import BasicModal from "~/components/tenongan/BasicModal";
import Form from "vform";

export default {
  name: "AddPenjualanModal",
  components: {
    Modal,
    BasicModal,
  },
  props: {
    penjualan: { type: Object, default: [] },
    showModal: { type: Boolean, default: true },
  },
  data() {
    return {
      form: new Form({
        id: "test",
      }),
      dataPenjualan: "",
    };
  },
  methods: {
    async editPenjualan() {
      const { data } = await this.form.patch("api/penjualan/" + this.form.id);
      await this.$store.commit("penjualan/editPenjualan", data);
      await this.form.reset();
      this.$emit("toggle");
    },
    setPenjualan(penjualan) {
      this.form.id = penjualan.id;
    },
  },
  mounted() {
  },
};
</script>
