<template>
    <basic-modal v-if="showModal" @close="$emit('toggle')">
      <template v-slot:button-show="slotProps">
        <button @click="slotProps.setModal(true), setProduk(produk)" class="btn d-inline btn-primary btn-sm">
          Edit
        </button>
      </template>
      <h5 slot="header">Edit Produk</h5>
      <div slot="body">
        <form
          id="editForm"
          @submit.prevent="editProduk"
          @keydown="form.onKeydown($event)"
        >
          <div class="form-floating mb-3">
            <input
              v-model="form.nama"
              type="text"
              class="form-control"
              placeholder="nama"
            />
            <label for="floatingInput">Nama</label>
          </div>
            <div class="form-floating mb-3">
            <input
              v-model="form.harga_jual"
              type="text"
              class="form-control"
              placeholder="Harga Jual"
            />
            <label for="floatingInput">Harga Jual</label>
          </div>
          <div class="form-floating mb-3">
            <input
              v-model="form.harga_beli"
              type="text"
              class="form-control"
              placeholder="Harga Beli"
            />
            <label for="floatingInput">Harga Beli</label>
          </div>
        </form>
      </div>
      <template v-slot:footer="slotProps">
        <button @click="$emit('toggle')" class="btn btn-secondary btn-sm">
          Close
        </button>
        <input
          type="submit"
          class="btn btn-primary btn-sm hasdf"
          form="editForm"
          value="Edit"
          @click="slotProps.setModal()"
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
    produk: { type: Object, default: [] },
  },
  data() {
    return {
      form: new Form({
        nama: 'test',
        harga_jual: 'test',
        harga_beli: 'test'
      }),
      dataProduk: "",
    };
  },
  methods: {
    async editProduk() {
      const { data } = await this.form.patch(
        "api/produk/" + this.form.id
      );
      await this.$store.commit("produk/editProduk", data);
      await this.form.reset();
      this.$emit("toggle");

    },
    setProduk(produk) {
      this.form.id = produk.id;
      this.form.nama = produk.nama;
      this.form.harga_jual = produk.harga_jual;
      this.form.harga_beli = produk.harga_beli;
    },
  },
};
</script>
