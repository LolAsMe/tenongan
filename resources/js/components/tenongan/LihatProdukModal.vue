<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Produk</h5>
    <div slot="body">
      {{ produk }}
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
import Form from "vform";

export default {
  name: "LihatProdukModal",
  props: {
    produk: { type: Object, default: [] },
    showModal: { type: Boolean, default: true }
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
