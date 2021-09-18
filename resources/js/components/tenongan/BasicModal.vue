<template>
  <div>
    <slot name="button-show">
      <button type="button" :class="buttonShowClass" @click="showModal = true">
        {{ buttonShowName }}
      </button>
    </slot>
    <modal v-if="showModal" @close="showModal = false">
      <div slot="header" class="p-0">
        <slot name="header"> Default Header </slot>
      </div>
      <div slot="body"><slot name="body"> Default Body </slot></div>
      <div slot="footer"><slot name="footer" v-bind:close="close"> Default Footer </slot></div>

    </modal>
  </div>
</template>

<script>
import Modal from "~/components/Modal";
import Form from "vform";

export default {
  name: "AddProdusenModal",
  components: {
    Modal,
  },
  data() {
    return {
      showModal: false,
      form: new Form({}),
    };
  },
  methods: {
    async addProdusen() {
      const { data } = await this.form.post("api/produsen");
      await this.$store.commit("produsen/addProdusen", data);
      await this.form.reset();
    },
    close(){
      this.showModal = false
    }
  },
  props: {
    buttonShowName: { type: String, default: "Show" },
    buttonShowClass: { type: String, default: "btn btn-primary" }
  },
};
</script>
