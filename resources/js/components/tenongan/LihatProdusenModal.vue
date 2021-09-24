<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Produsen</h5>
    <div slot="body">
      {{ produsen }}
    </div>
    <template v-slot:footer>
      <button @click="$emit('toggle')" class="btn btn-secondary btn-sm">
        Close
      </button>
    </template>
  </basic-modal>
</template>

<script>
import Modal from "~/components/Modal";
import BasicModal from "~/components/tenongan/BasicModal";

export default {
  name: "LihatProdusenModal",
  props: {
    produsen: { type: Object, default: null },
    showModal: { type: Boolean, default: true },
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
