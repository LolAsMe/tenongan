<template>
  <!-- Modal -->
  <div
    class="modal fade "
    :id="name"
    tabindex="-1"
    :aria-labelledby="idLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <slot name="header">
            <h5 class="modal-title" :id="idLabel">Modal title</h5>
          </slot>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body"><slot name="body"></slot></div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <slot name="footer"> </slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Modal from "~/components/Modal";

export default {
  name: "BigModal",
  components: {
    Modal,
  },
  computed: {
    idLabel: function () {
      return this.name + "label";
    },
  },
  data() {
    return {};
  },
  methods: {},
  props: {
    name: { type: String, default: "defaul" },
  },
};
</script>


<style scoped>
</style>
