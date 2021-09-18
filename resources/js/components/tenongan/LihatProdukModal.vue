<template>
  <basic-modal buttonShowName="Lihat" buttonShowClass="btn btn-primary btn-sm d-inline">
    <h5 slot="header">Produk</h5>
    <div slot="body">
      {{ produk }}
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
  name: "LihatProdukModal",
  props: {
    produk: { type: Object, default: [] },
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
