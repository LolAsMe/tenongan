<template>
  <basic-modal v-show="showModal" @close="showModal = false">
    <h5 slot="header">Edit Transaksi</h5>
    <div slot="body">Test {{ transaksi }}</div>
    <template v-slot:footer>
      <button @click="showModal = false" class="btn btn-secondary btn-sm">
        Close
      </button>
    </template>
  </basic-modal>
</template>

<script>
import BasicModal from "~/components/tenongan/BasicModal";

export default {
  name: "TransaksiDetailModal",
  components: {
    BasicModal,
  },
  data() {
    return {
      showModal: false,
    };
  },
  props: {
    transaksi: { type: Object, default: null },
  },
  methods: {},
};
</script>
