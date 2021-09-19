<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Tambah Produk</h5>
    <div slot="body">
      <form
        id="addForm"
        @submit.prevent="addProduk"
        @keydown="form.onKeydown($event)"
      >
        <div class="form-floating mb-3">
          <input
            v-model="form.nama"
            type="text"
            class="form-control"
            placeholder="nama"
          />
          <label for="floatingInput">nama</label>
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="form.produsen_id"
            type="text"
            class="form-control"
            placeholder="produsen_id"
          />
          <label for="floatingInput">produsen_id</label>
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="form.harga_jual"
            type="text"
            class="form-control"
            placeholder="harga_jual"
          />
          <label for="floatingInput">harga_jual</label>
        </div>
        <div class="form-floating mb-3">
          <input
            v-model="form.harga_beli"
            type="text"
            class="form-control"
            placeholder="harga_beli"
          />
          <label for="floatingInput">harga_beli</label>
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
  name: "AddProdukModal",
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
        nama: "",
        produsen_id: "",
        harga_jual: "",
        harga_beli: "",
      }),
    };
  },
  methods: {
    async addProduk() {
      const { data } = await this.form.post("api/produk");
      await this.$store.commit("produk/addProduk", data);
      await this.form.reset();
      this.$emit('toggle')
    },
  },
};
</script>
