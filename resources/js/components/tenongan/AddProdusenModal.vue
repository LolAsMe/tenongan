<template>
    <basic-modal buttonShowName="Tambah">
      <h5 slot="header">Tambah Produsen</h5>
      <div slot="body">
        <form
          id="addForm"
          @submit.prevent="addProdusen"
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
        <button @click="slotProps.close()" class="btn btn-secondary btn-sm">Close</button>
        <input
          type="submit"
          class="btn btn-primary btn-sm"
          form="addForm"
          value="Tambah"
          @click="slotProps.close()"
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
  data() {
    return {
      form: new Form({}),
    };
  },
  methods: {
    async addProdusen() {
      const { data } = await this.form.post("api/produsen");
      await this.$store.commit("produsen/addProdusen", data);
      await this.form.reset();
    },
  },
};
</script>
