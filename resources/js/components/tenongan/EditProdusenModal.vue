<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Edit Produsen</h5>
    <div slot="body">
      {{ produsen }}
      <form
        id="editForm"
        @submit.prevent="editProdusen"
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
  name: "AddProdusenModal",
  components: {
    Modal,
    BasicModal,
  },
  props: {
    produsen: { type: Object, default: [] },
    showModal: { type: Boolean, default: true },
  },
  data() {
    return {
      form: new Form({
        id: "test",
        nama: "test",
      }),
      dataProdusen: "",
    };
  },
  methods: {
    async editProdusen() {
      const { data } = await this.form.patch("api/produsen/" + this.form.id);
      await this.$store.commit("produsen/editProdusen", data);
      await this.form.reset();
      this.$emit("toggle");
    },
    setProdusen(produsen) {
      this.form.id = produsen.id;
      this.form.nama = produsen.nama;
    },
  },
  mounted() {
  },
};
</script>
