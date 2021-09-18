<template>
    <basic-modal buttonShowName="Edit" buttonShowClass="btn btn-primary btn-sm d-inline">
      <template v-slot:button-show="slotProps">
        <button @click="slotProps.setModal(true), setProdusen(produsen)" class="btn d-inline btn-primary btn-sm">
          Edit
        </button>
      </template>
      <h5 slot="header">Edit Produsen</h5>
      <div slot="body">
        {{produsen}}
        <form
          id="editForm"
          @submit.prevent="editProdusen"
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
  name: "AddProdusenModal",
  components: {
    Modal,
    BasicModal,
  },
  props: {
    produsen: { type: Object, default: [] },
  },
  data() {
    return {
      form: new Form({
        id: 'test',
        kode: 'test',
        nama: 'test'
      }),
      dataProdusen: "",
    };
  },
  methods: {
    async editProdusen() {
      const { data } = await this.form.patch(
        "api/produsen/" + this.form.id
      );
      await this.$store.commit("produsen/editProdusen", data);
      await this.form.reset();
    },
    setProdusen(produsen) {
      this.form.id = produsen.id;
      this.form.kode = produsen.kode;
      this.form.nama = produsen.nama;
      console.log(this.form.nama)
    },
  },
};
</script>
