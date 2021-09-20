<template>
    <basic-modal v-if="showModal" @close="$emit('toggle')">
      <template v-slot:button-show="slotProps">
        <button @click="slotProps.setModal(true), setPedagang(pedagang)" class="btn d-inline btn-primary btn-sm">
          Edit
        </button>
      </template>
      <h5 slot="header">Edit Pedagang</h5>
      <div slot="body">
        <form
          id="editForm"
          @submit.prevent="editPedagang"
          @keydown="form.onKeydown($event)"
        >
        <div class="form-floating mb-3">
            <input
              v-model="form.id"
              type="text"
              class="form-control"
              placeholder="id"
            />
            <label for="floatingInput">ID</label>
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
  name: "AddPedagangModal",
  components: {
    Modal,
    BasicModal,
  },
  props: {
    showModal: { type: Boolean, default: true },
    pedagang: { type: Object, default: [] },
  },
  data() {
    return {
      form: new Form({
        nama: 'test',
      }),
      dataPedagang: "",
    };
  },
  methods: {
    async editPedagang() {
      const { data } = await this.form.patch(
        "api/pedagang/" + this.form.id
      );
      await this.$store.commit("pedagang/editPedagang", data);
      await this.form.reset();
      this.$emit("toggle");

    },
    setPedagang(pedagang) {
      this.form.id = pedagang.id;
      this.form.nama = pedagang.nama;
    },
  },
};
</script>
