<template>
  <basic-modal buttonShowName="Lihat" buttonShowClass="btn btn-primary btn-sm">
    <h5 slot="header">Produsen</h5>
    <div slot="body">
      {{ produsen }}
    </div>
    <template v-slot:footer="slotProps">
      <button @click="slotProps.close()" class="btn btn-secondary btn-sm">
        Close
      </button>
    </template>
  </basic-modal>
</template>

<script>
import Modal from "~/components/Modal";
import BasicModal from "~/components/tenongan/BasicModal";
import Form from "vform";

export default {
  name: "LihatProdusenModal",
  props: {
    produsen: { type: Object, default: [] },
  },
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
