<template>
  <basic-modal buttonShowName="Lihat" buttonShowClass="btn btn-primary btn-sm d-inline">
    <h5 slot="header">Produsen</h5>
    <div slot="body">
      {{ produsen }}
    </div>
    <template v-slot:footer="slotProps">
      <button @click="slotProps.setModal()" class="btn btn-secondary btn-sm">
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
    };
  },
  methods: {
  },
};
</script>
