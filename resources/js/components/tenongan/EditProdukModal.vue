<template>
    <basic-modal buttonShowName="Edit" buttonShowClass="btn btn-primary btn-sm d-inline">
      <template v-slot:button-show="slotProps">
        <button @click="slotProps.setModal(true), setProduk(produk)" class="btn d-inline btn-primary btn-sm">
          Edit
        </button>
      </template>
      <h5 slot="header">Edit Produk</h5>
      <div slot="body">
        {{produk}}
        <form
          id="editForm"
          @submit.prevent="editProduk"
          @keydown="form.onKeydown($event)"
        >
          <div class="form-floating mb-3">
            <input
              v-model="form.kode"
              type="text"
              class="form-control"
              placeholder="kode"
            />
            <label for="floatingInput">Kode</label>
          </div>
          <div class="form-floating mb-3">
            <input
              v-model="form.nama"
              type="text"
              class="form-control"
              placeholder="nama"
            />
            <label for="floatingInput">Nama</label>
          </div>
        </form>
      </div>
      <template v-slot:footer="slotProps">
        <button @click="slotProps.setModal()" class="btn btn-secondary btn-sm">
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
    produk: { type: Object, default: [] },
  },
  data() {
    return {
      form: new Form({
        id: 'test',
        kode: 'test',
        nama: 'test'
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
    },
    setProduk(produk) {
      this.form.id = produk.id;
      this.form.kode = produk.kode;
      this.form.nama = produk.nama;
    },
  },
};
</script>
